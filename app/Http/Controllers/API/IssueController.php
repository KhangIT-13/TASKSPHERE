<?php

namespace App\Http\Controllers\API;

use App\Models\Issue;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function index()
    {
        return Issue::with('project')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'ProjectId' => 'required|exists:projects,ProjectId',
            'IssueName' => 'required|string|max:100',
            'AssignedTo' => 'nullable|exists:users,UserId',
            'Priority' => 'required|in:High,Medium,Low',
            'Status' => 'required|in:Open,InProgress,Closed',
            'Description' => 'nullable|string',
        ]);

        return Issue::create($request->all());
    }

    public function show($id)
    {
        return Issue::with('project')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $issue = Issue::findOrFail($id);
        $issue->update($request->all());
        return $issue;
    }

    public function destroy($id)
    {
        $issue = Issue::findOrFail($id);
        $issue->delete();
        return response()->json(['message' => 'Issue deleted successfully']);
    }
}
