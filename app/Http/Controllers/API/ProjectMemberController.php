<?php

namespace App\Http\Controllers\API;

use App\Models\ProjectMember;
use Illuminate\Http\Request;

class ProjectMemberController extends Controller
{
    public function index()
    {
        return ProjectMember::with('project', 'user')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'ProjectId' => 'required|exists:projects,ProjectId',
            'UserId' => 'required|exists:users,UserId',
            'RoleInProject' => 'nullable|in:Manager,Contributor,Observer',
        ]);

        return ProjectMember::create($request->all());
    }

    public function show($id)
    {
        return ProjectMember::with('project', 'user')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $projectMember = ProjectMember::findOrFail($id);
        $projectMember->update($request->all());
        return $projectMember;
    }

    public function destroy($id)
    {
        $projectMember = ProjectMember::findOrFail($id);
        $projectMember->delete();
        return response()->json(['message' => 'Project Member deleted successfully']);
    }
}
