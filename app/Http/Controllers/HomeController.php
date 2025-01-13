<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Notification;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\Subtask;
use App\Models\Task;
use App\Models\TaskAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {

        $userid = Auth::user()->UserId;
        $projectmembers = ProjectMember::where("UserId", $userid)->with("project")->get();
        $projects = Auth::user()->projects()->get();
        $projectIds = $projects->pluck("ProjectId")->toArray();
        $taskassignments = TaskAssignment::where("UserId", $userid)->with("task")->get();
        $tasks = Auth::user()->tasks()->with('project')->get();

        // $subtasks = Subtask::where("AssignedTo", $userid)->get();
        $subtasks = Auth::user()->subtasks()->with('task.project')->get();
        $notifications = Notification::where('UserId', Auth::user()->UserId)->get();
        // return $subtasks;
        return view("dashboard", compact("projects","tasks","subtasks", "notifications"));
    }
}
