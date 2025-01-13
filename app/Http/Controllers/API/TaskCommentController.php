<?php

namespace App\Http\Controllers\API;

use App\Models\TaskComment;
use Illuminate\Http\Request;

class TaskCommentController extends Controller
{
    public function index()
    {
        return TaskComment::with('task', 'user')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'TaskId' => 'required|exists:tasks,TaskId',
            'UserId' => 'required|exists:users,UserId',
            'Comment' => 'required|string',
        ]);

        return TaskComment::create($request->all());
    }

    public function show($id)
    {
        return TaskComment::with('task', 'user')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $taskComment = TaskComment::findOrFail($id);
        $taskComment->update($request->all());
        return $taskComment;
    }

    public function destroy($id)
    {
        $taskComment = TaskComment::findOrFail($id);
        $taskComment->delete();
        return response()->json(['message' => 'Task Comment deleted successfully']);
    }
}
