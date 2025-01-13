<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectMember;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class ProjectController extends Controller
{
    public function index()
    {
        $projects = Auth::user()->projects()->where('RoleInProject', 'Manager')->with('members')->orderBy("ProjectId", "asc")->get();
        return view("project.project-list", compact("projects"));
    }
    public function dash()
    {
        $projects = Auth::user()->projects()->with('members', 'category', 'creator')->orderBy("ProjectId", "asc")->get();
        return view('project.project-dash', compact('projects'));
    }
    public function detail($id)
    {
        $project = Project::with('tasks', 'members', 'projectfiles')->find($id);
        return view('project.project-detail', compact('project'));
        // return $project;
    }
    public function add()
    {
        $categories = ProjectCategory::all();
        $members = User::where('UserId', '!=', Auth::user()->UserId)->get();

        return view('project.project-add', compact('categories', 'members'));
    }

    public function getProjectMembers($projectId)
    {
        $project = Project::findOrFail($projectId);
        $members = $project->members()->get();
        // dd($members);
        return response()->json(['members' => $members]);
    }
    public function create(Request $request)
    {
        $project = Project::create([
            'ProjectName' => $request->input('ProjectName'),
            'Description' => $request->input('Description'),
            'CreatedBy' => Auth::user()->UserId,
            'CategoryId' => $request->input('CategoryId'),
            'StartDate' => $request->input('StartDate'),
            'EndDate' => $request->input('EndDate'),
            'CreatedAt' => now(),
        ]);
        // Lấy danh sách thành viên từ request
        $members = $request->input('members');  // Mảng các UserId
        

        // Tạo mảng dữ liệu cho bảng pivot, chỉ có 'JoinedAt'
        $membersWithJoinedAt = [];
        if($members != null){
            foreach ($members as $member) {
                $membersWithJoinedAt[$member] = [
                    'JoinedAt' => now(),
                    'RoleInProject' => null,
                ];
            }
        }
        // foreach ($members as $member) {
        //     $membersWithJoinedAt[$member] = [
        //         'JoinedAt' => now(),
        //         'RoleInProject' => null,
        //     ];
        // }
        // Thêm người quản lý (người dùng hiện tại) vào danh sách thành viên với vai trò 'manager'
        $membersWithJoinedAt[Auth::user()->UserId] = [
            'JoinedAt' => now(),
            'RoleInProject' => 'manager',  // Thêm vai trò manager
        ];
        
        // Thêm các thành viên vào bảng projectmembers với thông tin JoinedAt
        if ($membersWithJoinedAt) {
            $project->members()->attach($membersWithJoinedAt);
        }
        return redirect()->route('project.index'); // Kiểm tra dữ liệu gửi lên
    }

    public function member_list($ProjectId)
    {
        $project = Project::findOrFail($ProjectId);
        $members = Project::findOrFail($ProjectId)->members()->withPivot('RoleInProject')->get();
        return view('project.project-members-list', compact('members', 'project'));
    }

    public function add_member($ProjectId)
    {
        $projects = Project::all();
        $project = Project::find($ProjectId);

        // Lấy danh sách thành viên đã có trong dự án
        $projectmembers = $project->members()->pluck('projectmembers.UserId')->toArray();

        // Lấy danh sách người dùng không nằm trong danh sách thành viên dự án
        $members = User::whereNotIn('UserId', $projectmembers)->get();

        return view('project.project-add-member', compact('projects', 'project', 'members'));
    }

    public function updateRole(Request $request)
    {
        try {
            Log::info('Dữ liệu nhận được từ request:', $request->all());

            $validated = $request->validate([
                'user_id' => 'required|integer|exists:users,UserId',
                'project_id' => 'required|integer|exists:projects,ProjectId',
                'role' => 'required|string|in:Manager,Contributor,Observer'
            ]);

            $updated = ProjectMember::where('UserId', $validated['user_id'])
                ->where('ProjectId', $validated['project_id'])
                ->update(['RoleInProject' => $validated['role']]);

            if ($updated) {
                return response()->json(['message' => 'Cập nhật vai trò thành công!']);
            } else {
                return response()->json(['message' => 'Không tìm thấy bản ghi để cập nhật!'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật vai trò: ' . $e->getMessage());
            return response()->json(['message' => 'Cập nhật vai trò thất bại!', 'error' => $e->getMessage()], 500);
        }
    }

    public function createMember(Request $request)
    {
        // Validate form inputs
        $validated = $request->validate([
            'ProjectId' => 'required|exists:projects,ProjectId',
            'membersManager' => 'array|nullable',
            'membersManager.*' => 'exists:users,UserId',
            'membersContributor' => 'array|nullable',
            'membersContributor.*' => 'exists:users,UserId',
            'membersObserver' => 'array|nullable',
            'membersObserver.*' => 'exists:users,UserId',
        ]);

        // Get project ID
        $projectId = $request->input('ProjectId');

        // Lấy danh sách các ID thành viên từ các role
        $managers = $request->input('membersManager', []);
        $contributors = $request->input('membersContributor', []);
        $observers = $request->input('membersObserver', []);

        // Loại bỏ thành viên trong Contributor và Observer nếu họ có trong Manager
        $contributors = array_diff($contributors, $managers);
        $observers = array_diff($observers, $managers);

        // Loại bỏ thành viên trong Observer nếu họ có trong Contributor
        $observers = array_diff($observers, $contributors);

        // Thêm các thành viên vào cơ sở dữ liệu với vai trò tương ứng
        // Quản lý (Manager)
        foreach ($managers as $userId) {
            ProjectMember::updateOrCreate(
                ['ProjectId' => $projectId, 'UserId' => $userId],
                ['RoleInProject' => 'Manager']
            );
        }

        // Thành viên (Contributor)
        foreach ($contributors as $userId) {
            ProjectMember::updateOrCreate(
                ['ProjectId' => $projectId, 'UserId' => $userId],
                ['RoleInProject' => 'Contributor']
            );
        }

        // Người quan sát (Observer)
        foreach ($observers as $userId) {
            ProjectMember::updateOrCreate(
                ['ProjectId' => $projectId, 'UserId' => $userId],
                ['RoleInProject' => 'Observer']
            );
        }

        // Redirect back with success message
        return redirect()->route('project.list_member', ['ProjectId' => $projectId])->with('success', 'Thêm thành viên vào dự án thành công!');
    }

    public function updateStatus(Request $request)
    {
        // Xác thực dữ liệu nếu cần
        $request->validate([
            'project_id' => 'required|exists:projects,ProjectId',
            'status' => 'required|in:Planned,Active,OnHold,Completed,Archived',
        ]);

        // Tìm dự án theo ID
        $project = Project::findOrFail($request->project_id);

        // Cập nhật trạng thái của dự án
        $project->Status = $request->status;
        $project->save();

        // Trả về phản hồi thành công
        return response()->json(['message' => 'Trạng thái dự án đã được cập nhật thành công.']);
    }
    // Method cập nhật ngày bắt đầu
    public function updateStartDate(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,ProjectId',
            'start_date' => 'required|date',
        ]);

        $project = Project::findOrFail($request->project_id);
        $project->StartDate = $request->start_date;
        $project->save();

        return response()->json(['message' => 'Ngày bắt đầu dự án đã được cập nhật thành công.']);
    }

    // Method cập nhật ngày kết thúc
    public function updateEndDate(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,ProjectId',
            'end_date' => 'required|date',
        ]);

        $project = Project::findOrFail($request->project_id);
        $project->EndDate = $request->end_date;
        $project->save();

        return response()->json(['message' => 'Ngày kết thúc dự án đã được cập nhật thành công.']);
    }

    public function edit($id)
    {
        // Lấy thông tin dự án cần sửa
        $project = Project::findOrFail($id);
        // Lấy danh sách danh mục và thành viên
        $categories = ProjectCategory::all();
        $members = User::where('UserId', '!=', Auth::user()->UserId)->get();

        // Lấy danh sách thành viên hiện tại của dự án
        $currentMembers = $project->members()->pluck('Users.UserId')->toArray();

        return view('project.project-edit', compact('project', 'categories', 'members', 'currentMembers'));
    }

    public function update(Request $request, $id)
    {
        // Cập nhật thông tin dự án
        $project = Project::findOrFail($id);
        $project->update([
            'ProjectName' => $request->input('ProjectName'),
            'Description' => $request->input('Description'),
            'CategoryId' => $request->input('CategoryId'),
            'StartDate' => $request->input('StartDate'),
            'EndDate' => $request->input('EndDate'),
            'UpdatedAt' => now(),
        ]);

        // Lấy danh sách thành viên từ request
        $members = $request->input('members'); // Mảng các UserId

        // Tạo mảng dữ liệu cho bảng pivot, chỉ có 'JoinedAt'
        $membersWithJoinedAt = [];
        foreach ($members as $member) {
            $membersWithJoinedAt[$member] = [
                'JoinedAt' => now(),
            ];
        }
        // Thêm người quản lý (người dùng hiện tại) vào danh sách thành viên với vai trò 'manager'
        $membersWithJoinedAt[Auth::user()->UserId] = [
            'JoinedAt' => now(),
            'RoleInProject' => 'manager',  // Thêm vai trò manager
        ];
        // Cập nhật lại các thành viên trong bảng projectmembers
        if ($membersWithJoinedAt) {
            $project->members()->sync($membersWithJoinedAt);
        }

        return redirect()->route('project.index'); // Chuyển hướng đến trang danh sách dự án
    }

    public function delete($id)
    {
        try {
            // Tìm dự án cần xóa
            $project = Project::findOrFail($id);

            // Xóa tất cả các liên kết (task, issue, subtask, member, file, etc.)
            foreach ($project->tasks as $task) {
                $task->subtasks()->delete();
            }
            $project->tasks()->delete();
            $project->issues()->delete();
            $project->members()->detach(); // Xóa liên kết giữa project và members
            $project->projectfiles()->delete();  // Xóa tất cả các file liên quan đến dự án

            // Cuối cùng, xóa dự án
            $project->delete();

            // Thay vì redirect, trả về response JSON với thông báo thành công
            return response()->json(['message' => 'Dự án đã được xóa thành công']);
        } catch (\Exception $e) {
            // Bắt lỗi và hiển thị thông báo
            return response()->json(['message' => 'Có lỗi xảy ra khi xóa dự án'], 500);
        }
    }

    public function deleteMember(Request $request)
    {
        try {
            $memberId = $request->input('member_id');
            $projectId = $request->input('project_id');

            // Xóa thành viên khỏi dự án
            ProjectMember::where('UserId', $memberId)
                ->where('ProjectId', $projectId)
                ->delete();

            return response()->json(['message' => 'Thành viên đã được xóa khỏi dự án!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Không thể xóa thành viên!'], 500);
        }
    }
}
