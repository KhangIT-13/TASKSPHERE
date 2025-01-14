<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Subtask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $projects = Project::all();
        $tasks = Task::all();
        $subtasks = Subtask::all();
        return view("admin.index", compact("users", "projects", "tasks", "subtasks"));
    }

    public function allProjects()
    {
        $projects = Project::all();
        return view("admin.all-projects", compact("projects"));
    }

    public function allTasks()
    {
        $tasks = Task::all();
        return view("admin.all-tasks", compact("tasks"));
    }
    public function allSubtasks()
    {
        $subtasks = Subtask::all();
        return view("admin.all-subtasks", compact("subtasks"));
    }

    public function tasksWithProject($projectId)
    {
        $project = Project::findOrFail($projectId);
        $tasks = $project->tasks;
        return view("admin.tasks-with-project", compact("tasks"));
    }

    public function subtasksWithTask($taskId)
    {
        $task = Task::findOrFail($taskId);
        $subtasks = $task->subtasks;
        return view("admin.subtasks-with-task", compact("subtasks"));
    }
}
