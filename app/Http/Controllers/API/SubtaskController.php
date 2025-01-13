<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use App\Models\Subtask;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    // Lấy danh sách Subtasks
    public function index()
    {
        $subtasks = Subtask::with('task', 'user')->get();
        return response()->json($subtasks);
    }

    // Lấy chi tiết Subtask theo ID
    public function show($id)
    {
        $subtask = Subtask::with('task', 'user')->findOrFail($id);
        return response()->json($subtask);
    }

    // Tạo mới Subtask
    public function store(Request $request)
    {
        $request->validate([
            'TaskId' => 'required|exists:tasks,TaskId',
            'SubTaskName' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'AssignedTo' => 'required|exists:users,UserId',
            'Status' => 'required|in:Pending,InProgress,Completed,Blocked',
            'Priority' => 'required|in:Low,Medium,High',
            'StartDate' => 'required|date',
            'DueDate' => 'required|date|after_or_equal:StartDate',
        ]);

        $subtask = Subtask::create($request->all());

        return response()->json($subtask, 201);
    }

    // Cập nhật Subtask
    public function update(Request $request, $id)
    {
        $request->validate([
            'TaskId' => 'required|exists:tasks,TaskId',
            'SubTaskName' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'AssignedTo' => 'required|exists:users,UserId',
            'Status' => 'required|in:Pending,InProgress,Completed,Blocked',
            'Priority' => 'required|in:Low,Medium,High',
            'StartDate' => 'required|date',
            'DueDate' => 'required|date|after_or_equal:StartDate',
        ]);

        $subtask = Subtask::findOrFail($id);
        $subtask->update($request->all());

        return response()->json($subtask);
    }

    // Xóa Subtask
    public function destroy($id)
    {
        $subtask = Subtask::findOrFail($id);
        $subtask->delete();

        return response()->json(null, 204);
    }
}
