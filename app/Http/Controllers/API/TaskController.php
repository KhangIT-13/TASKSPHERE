<?php

namespace App\Http\Controllers\API;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::with('project', 'taskassignments')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'ProjectId' => 'required|exists:projects,ProjectId',
            'TaskName' => 'required|string|max:100',
            'AssignedTo' => 'nullable|exists:users,UserId',
            'Status' => 'required|in:Pending,InProgress,Blocked,Completed',
            'Priority' => 'required|in:High,Medium,Low',
            'StartDate' => 'nullable|date',
            'DueDate' => 'nullable|date',
        ]);

        return Task::create($request->all());
    }

    public function show($id)
    {
        return Task::with('project', 'assignedToUser')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());
        return $task;
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
