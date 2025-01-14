<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskAssignment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    // public function index($projectId){
    //     $tasks = Task::with('project','taskassignments')->where("ProjectId", $projectId)->get();
    //     // return $tasks;
    //     return view("task.task-list", compact("tasks"));
    // }

    public function detail($id)
    {
        $task = Task::with('project', 'taskAssignments', 'subtasks', 'taskfiles')->find($id);
        return view("task.task-detail", compact("task"));
    }
    public function index()
    {
        // $project = Project::findOrFail($projectId);

        $tasks = Auth::user()->tasks()->with('project')->where('RoleInTask', 'Owner')->get();
        return view('task.task-list', compact('tasks'));
    }
    public function tasksWithProject($projectId)
    {
        $tasks = Task::with('project', 'taskAssignments')->where('ProjectId', $projectId)->get();
        return view('task.task-list', compact('tasks'));
    }
    public function getTaskMembers($TaskId)
    {
        $task = Task::find($TaskId);
        $members = $task->assignedUsers()->get();
        // dd($members);
        return response()->json(['members' => $members]);
    }
    public function dash()
    {
        $tasks = Auth::user()->tasks()->with('project')->get();
        return view('task.task-dash', compact('tasks'));
    }
    // public function detail($TaskId){
    //     $task = Task::findOrFail($TaskId)->with('subtasks')->get();

    // }
    public function create()
    {
        $projects = Auth::user()->projects()->where('RoleInProject', 'Manager')->with('members')->orderBy("ProjectId", "asc")->get();
        // dd($projects);
        return view('task.task-add', compact('projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'TaskName' => 'required|string|max:255',
            'Status' => 'nullable|string|max:50',
            'Priority' => 'nullable|string|max:50',
            'DueDate' => 'nullable|datetime',
            'members' => 'nullable|array',
            'members.*' => 'integer|exists:users,UserId',
        ]);

        $task = Task::create([
            'ProjectId' => $request->input('ProjectId'),
            'TaskName' => $request->input('TaskName'),
            'Description' => $request->input('Description'),
            'AssignedTo' => null,
            'Priority' => $request->input('Priority'),
            'StartDate' => $request->input('StartDate'),
            'DueDate' => $request->input('EndDate'),
        ]);
        // Chuẩn bị danh sách người dùng (bao gồm người dùng hiện tại)
        $assignments = [];
        $assignments[] = [
            'TaskId' => $task->TaskId,
            'UserId' => Auth::user()->UserId,
            'RoleInTask' => "Owner"
        ];

        if (!empty($validated['members'])) {
            foreach ($validated['members'] as $userId) {
                $assignments[] = [
                    'TaskId' => $task->TaskId,
                    'UserId' => $userId,
                    'RoleInTask' => "Collaborator"

                ];
            }
        }

        TaskAssignment::insert($assignments);

        return redirect()->route('tasks.index');
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'TaskName' => 'required|string|max:255',
            'Status' => 'nullable|string|max:50',
            'Priority' => 'nullable|string|max:50',
            'StartDate' => 'nullable|date',
            'DueDate' => 'nullable|date',
            'members' => 'nullable|array',
            'members.*' => 'integer|exists:users,UserId',
        ]);

        // Tìm task cần cập nhật
        $task = Task::findOrFail($id); // $id là ID của task cần cập nhật
        // dd($task);
        // Cập nhật thông tin task
        $task->update([
            'TaskName' => $request->input('TaskName'),
            'Description' => $request->input('Description'),
            'Status' => $request->input('Status'),
            'Priority' => $request->input('Priority'),
            'StartDate' => $request->input('StartDate'),
            'DueDate' => $request->input('EndDate'),
        ]);

        // Chuẩn bị danh sách người dùng (bao gồm người dùng hiện tại) để gán vào task
        $assignments = [];


        // Kiểm tra nếu có các thành viên khác được gán
        if (!empty($validated['members'])) {
            foreach ($validated['members'] as $userId) {
                $assignments[$userId] = [
                    'RoleInTask' => 'Collaborator' // Gán vai trò Member cho các thành viên khác
                ];
            }
        }
        // Thêm người quản lý (người dùng hiện tại) vào danh sách thành viên với vai trò 'manager'
        $assignments[Auth::user()->UserId] = [
            'RoleInTask' => 'Owner',  // Thêm vai trò manager
        ];

        // Cập nhật mối quan hệ giữa task và người dùng (sử dụng sync để đồng bộ)
        $task->assignedUsers()->sync($assignments);

        return redirect()->route('tasks.index');
    }
    public function updateField(Request $request)
    {
        $request->validate([
            'TaskId' => 'required|exists:tasks,TaskId',
            'field' => 'required|string|in:Status,StartDate,DueDate',
            'value' => 'nullable|string',
        ]);

        $task = Task::findOrFail($request->TaskId);
        $task->{$request->field} = $request->value;
        $task->save();

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thành công!',
        ]);
    }
    public function edit($taskId)
    {
        $task = Task::findOrFail($taskId);
        $projects = Auth::user()->projects()->where('RoleInProject', 'Manager')->with('members')->orderBy("ProjectId", "asc")->get();
        // dd($projects);
        $currentMembers = Task::findOrFail($taskId)->assignedUsers()->pluck('Users.UserId')->toArray();
        return view('task.task-edit', compact('task', 'projects', 'currentMembers'));
    }


    public function destroy($taskId)
    {
        try {
            $task = Task::findOrFail($taskId);
            $task->subtasks()->delete();
            // $task->taskfiles()->delete();
            // $task->taskComments()->delete();
            $task->delete();

            return response()->json(['message' => 'Dự án đã được xóa thành công']);
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function members($TaskId)
    {
        $task = Task::findOrFail($TaskId);
        // dd($task);
        $members = Task::findOrFail($TaskId)->assignedUsers()->withPivot('RoleInTask')->get();
        return view('task.task-members-list', compact('members', 'task'));
    }

    public function addMember($TaskId)
    {
        $task = Task::findOrFail($TaskId);
        // Lấy danh sách thành viên đã có trong dự án
        $taskassignments = $task->assignedUsers()->pluck('taskassignments.UserId')->toArray();

        // Lấy danh sách người dùng không nằm trong danh sách thành viên dự án
        $members = User::whereNotIn('UserId', $taskassignments)->get();
        return view('task.task-add-member', compact('task', 'members'));
    }
    public function createMember(Request $request)
    {
        // dd($request->all());
        // Validate form inputs
        $validated = $request->validate([
            'TaskId' => 'required|exists:tasks,TaskId',
            'membersOwner' => 'array|nullable',
            'membersOwner.*' => 'exists:users,UserId',
            'membersReviewer' => 'array|nullable',
            'membersReviewer.*' => 'exists:users,UserId',
            'membersCollaborator' => 'array|nullable',
            'membersCollaborator.*' => 'exists:users,UserId',
        ]);

        // Get task ID
        $taskId = $request->input('TaskId');
        // dd($taskId);
        // Lấy danh sách các ID thành viên từ các role
        $owners = $request->input('membersOwner', []);
        $reviewers = $request->input('membersReviewer', []);
        $collaborators = $request->input('membersCollaborator', []);

        // Loại bỏ thành viên trong Reviewer và Collaborator nếu họ có trong Owner
        $reviewers = array_diff($reviewers, $owners);
        $collaborators = array_diff($collaborators, $owners);

        // Loại bỏ thành viên trong Reviewer nếu họ có trong Collaborator
        $reviewers = array_diff($reviewers, $collaborators);

        // Thêm các thành viên vào cơ sở dữ liệu với vai trò tương ứng
        // Owner
        foreach ($owners as $userId) {
            TaskAssignment::updateOrCreate(
                ['TaskId' => $taskId, 'UserId' => $userId],
                ['RoleInTask' => 'Owner']
            );
        }

        // Reviewer
        foreach ($reviewers as $userId) {
            TaskAssignment::updateOrCreate(
                ['TaskId' => $taskId, 'UserId' => $userId],
                ['RoleInTask' => 'Reviewer']
            );
        }

        // Collaborator
        foreach ($collaborators as $userId) {
            TaskAssignment::updateOrCreate(
                ['TaskId' => $taskId, 'UserId' => $userId],
                ['RoleInTask' => 'Collaborator']
            );
        }

        // Redirect back with success message
        return redirect()->route('tasks.members', ['TaskId' => $taskId])->with('success', 'Thêm thành viên vào công việc thành công!');
    }

    public function updateMemberRole(Request $request)
    {
        // dd($request->all());
        try {
            Log::info('Dữ liệu nhận được từ request:', $request->all());

            $validated = $request->validate([
                'user_id' => 'required|integer|exists:users,UserId',
                'task_id' => 'required|integer|exists:tasks,TaskId',
                'role' => 'required|string|in:Owner,Reviewer,Collaborator'
            ]);

            $updated = TaskAssignment::where('UserId', $validated['user_id'])
                ->where('TaskId', $validated['task_id'])
                ->update(['RoleInTask' => $validated['role']]);

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

    public function deleteMember(Request $request)
    {
        try {
            $memberId = $request->input('member_id');
            $taskId = $request->input('task_id');

            // Xóa thành viên khỏi dự án
            TaskAssignment::where('UserId', $memberId)
                ->where('TaskId', $taskId)
                ->delete();

            return response()->json(['message' => 'Thành viên đã được xóa khỏi dự án!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Không thể xóa thành viên!'], 500);
        }
    }


    public function test()
    {
        $currentMembers = Task::findOrFail(16)->assignedUsers()->pluck('Users.UserId')->toArray();
        dd($currentMembers);
    }
}
