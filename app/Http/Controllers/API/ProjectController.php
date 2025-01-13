<?php

namespace App\Http\Controllers\API;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return Project::with('category', 'creator', 'members','tasks','projectfiles')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'ProjectName' => 'required|string|max:100',
            'CreatedBy' => 'required|exists:users,UserId',
            'CategoryId' => 'nullable|exists:project_categories,CategoryId',
            'Status' => 'required|in:Planned,Active,OnHold,Completed,Archived',
            'StartDate' => 'nullable|date',
            'EndDate' => 'nullable|date',
        ]);

        return Project::create($request->all());
    }

    public function show($id)
    {
        return Project::with('category', 'creator', 'members')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());
        return $project;
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return response()->json(['message' => 'Project deleted successfully']);
    }
}
