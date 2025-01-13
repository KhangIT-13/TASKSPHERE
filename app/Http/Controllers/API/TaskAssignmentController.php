<?php

namespace App\Http\Controllers\API;

use App\Models\TaskAssignment;
use Illuminate\Http\Request;

class TaskAssignmentController extends Controller
{
    public function index()
    {
        return TaskAssignment::with('task', 'user')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'TaskId' => 'required|exists:tasks,TaskId',
            'UserId' => 'required|exists:users,UserId',
            'RoleInTask' => 'nullable|in:Owner,Collaborator,Reviewer',
        ]);

        return TaskAssignment::create($request->all());
    }

    public function show($id)
    {
        return TaskAssignment::with('task', 'user')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $taskAssignment = TaskAssignment::findOrFail($id);
        $taskAssignment->update($request->all());
        return $taskAssignment;
    }

    public function destroy($id)
    {
        $taskAssignment = TaskAssignment::findOrFail($id);
        $taskAssignment->delete();
        return response()->json(['message' => 'Task Assignment deleted successfully']);
    }
}
