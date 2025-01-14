<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubtaskController extends Controller
{
    public function index()
    {
        $subtasks = Auth::user()->subtasks()->with('task.project')->get();

        // return $subtasks;
        return view("subtask.subtask-list", compact("subtasks"));
    }

    public function list()
    {
        $subtasks = Auth::user()->subtasks()->with('task.project')->get();

        // return $subtasks;
        return view("subtask.subtask-list-formember", compact("subtasks"));
    }
    public function subtasksWithTask($taskId)
    {
        $subtasks = Task::find($taskId)->subtasks()->with('task.project')->get();

        return view("subtask.subtask-list", compact("subtasks"));
    }
    public function dash()
    {
        $subtasks = Auth::user()->subtasks()->with('task.project')->get();

        // return $subtasks;
        return view("subtask.subtask-dash", compact("subtasks"));
    }
    public function detail($id)
    {
        $subtask = Subtask::with("task", "user", "subtaskfiles")->find($id);
        return view("subtask.subtask-detail", compact("subtask"));
    }

    public function addsubtask()
    {
        $tasks = Auth::user()->tasks()->with('project')->where('RoleInTask', 'Owner')->get();
        return view('subtask.subtask-add', compact('tasks'));
    }
    public function store(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'SubTaskName' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'TaskId' => 'required|exists:tasks,TaskId', // TaskId phải tồn tại trong bảng tasks
            'member' => 'nullable|exists:users,UserId', // ID của thành viên phải hợp lệ
            'StartDate' => 'required|date',
            'DueDate' => 'required|date|after_or_equal:StartDate',
            'Priority' => 'required|in:High,Medium,Low',
        ]);

        // Tạo và lưu subtask
        Subtask::create([
            'SubTaskName' => $validatedData['SubTaskName'],
            'Description' => $validatedData['Description'],
            'TaskId' => $validatedData['TaskId'],
            'AssignedTo' => $validatedData['member'] ?? null,
            'StartDate' => $request->input('StartDate'),
            'DueDate' => $request->input('DueDate'),
            'Priority' => $validatedData['Priority'],
        ]);

        // Redirect hoặc trả về thông báo thành công
        return redirect()->route('subtask.index')->with('success', 'Subtask đã được thêm thành công!');
    }
    public function edit($subtaskId)
    {
        $subtask = Subtask::with('task.project')->find($subtaskId);
        $task = Task::find($subtask->task->TaskId);
        $members = $task->assignedUsers()->get();
        // dd($subtask);
        return view('subtask.subtask-edit', compact('subtask', 'members'));
    }
    public function update(Request $request, $subtaskId)
    {
        // Validate input data
        $validatedData = $request->validate([
            'SubTaskName' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'TaskId' => 'required|exists:tasks,TaskId', // TaskId phải tồn tại trong bảng tasks
            'member' => 'nullable|exists:users,UserId', // ID của thành viên phải hợp lệ
            'StartDate' => 'required|date',
            'DueDate' => 'required|date|after_or_equal:StartDate',
            'Priority' => 'required|in:High,Medium,Low',
        ]);

        // Tìm subtask bằng ID
        $subtask = Subtask::findOrFail($subtaskId);

        // Cập nhật thông tin subtask
        $subtask->update([
            'SubTaskName' => $validatedData['SubTaskName'],
            'Description' => $validatedData['Description'],
            'TaskId' => $validatedData['TaskId'],
            'AssignedTo' => $validatedData['member'] ?? null,
            'StartDate' => $request->input('StartDate'),
            'DueDate' => $request->input('DueDate'),
            'Priority' => $validatedData['Priority'],
        ]);

        // Redirect hoặc trả về thông báo thành công
        return redirect()->route('subtask.index')->with('success', 'Subtask đã được cập nhật thành công!');
    }


    public function updateField(Request $request)
    {
        // dd($request->all());
        $subtask = Subtask::find($request->subtask_id);

        if (!$subtask) {
            return response()->json(['message' => 'Không tìm thấy thông tin'], 404);
        }

        $subtask->Status = $request->status ?? $subtask->Status;
        $subtask->StartDate = $request->start_date ?? $subtask->StartDate;
        $subtask->DueDate = $request->end_date ?? $subtask->DueDate;

        $subtask->save();

        return response()->json(['message' => 'Cập nhật thành công']);
    }

    public function complete(Request $request)
    {
        $subtask = Subtask::find($request->subtask_id);

        if (!$subtask) {
            return response()->json(['message' => 'Không tìm thấy nhiệm vụ'], 404);
        }

        // Cập nhật ngày hoàn thành và trạng thái
        $subtask->CompletedAt = now();
        $subtask->Status = 'Completed';
        $subtask->save();

        return response()->json([
            'message' => 'Đã hoàn thành nhiệm vụ',
            'completed_at' => $subtask->CompletedAt,
            'status' => $subtask->Status
        ]);
    }

    public function destroy($subtaskId)
    {
        try {
            Subtask::find($subtaskId)->delete();
            return response()->json(['message' => 'Đã xóa thành công']);
        } catch (\Exception $e) {
            return response()->json(['message' => "Không thể xóa!"], 404);
        }
    }
}
