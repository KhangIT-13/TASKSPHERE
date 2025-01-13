<?php

namespace App\Http\Controllers\API;

use App\Models\ProjectCategory;
use Illuminate\Http\Request;

class ProjectCategoryController extends Controller
{
    public function index()
    {
        return ProjectCategory::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'CategoryName' => 'required|string|max:100',
        ]);

        return ProjectCategory::create($request->all());
    }

    public function show($id)
    {
        return ProjectCategory::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $category = ProjectCategory::findOrFail($id);
        $category->update($request->all());
        return $category;
    }

    public function destroy($id)
    {
        $category = ProjectCategory::findOrFail($id);
        $category->delete();
        return response()->json(['message' => 'Project Category deleted successfully']);
    }
}
