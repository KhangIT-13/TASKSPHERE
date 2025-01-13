<?php

namespace App\Http\Controllers\API;

use App\Models\Milestone;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    public function index()
    {
        return Milestone::with('project')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'ProjectId' => 'required|exists:projects,ProjectId',
            'MilestoneName' => 'required|string|max:100',
            'DueDate' => 'nullable|date',
            'Status' => 'nullable|in:Pending,Completed',
        ]);

        return Milestone::create($request->all());
    }

    public function show($id)
    {
        return Milestone::with('project')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $milestone = Milestone::findOrFail($id);
        $milestone->update($request->all());
        return $milestone;
    }

    public function destroy($id)
    {
        $milestone = Milestone::findOrFail($id);
        $milestone->delete();
        return response()->json(['message' => 'Milestone deleted successfully']);
    }
}
