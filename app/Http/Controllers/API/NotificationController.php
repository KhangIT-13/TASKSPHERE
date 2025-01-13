<?php

namespace App\Http\Controllers\API;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return Notification::with('user')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'UserId' => 'required|exists:users,UserId',
            'Message' => 'required|string',
        ]);

        return Notification::create($request->all());
    }

    public function show($id)
    {
        return Notification::with('user')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update($request->all());
        return $notification;
    }

    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        return response()->json(['message' => 'Notification deleted successfully']);
    }
}
