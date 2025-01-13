<?php

namespace App\Http\Controllers\API;


use App\Models\ProjectFile;
use Illuminate\Http\Request;

class ProjectFileController extends Controller
{
    public function index(){
        $projectFile = ProjectFile::with("project", "user")->get();
        // $projectFile = ProjectFile::all();
        return response()->json($projectFile);
    }
}

