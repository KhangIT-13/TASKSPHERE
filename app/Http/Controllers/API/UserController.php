<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'FullName' => 'required|string|max:100',
            'Email' => 'required|email|unique:users',
            'PasswordHash' => 'required|string|min:6',
        ]);

        return User::create($request->all());
    }

    public function show($userid)
    {
        return User::findOrFail($userid);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return $user;
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
