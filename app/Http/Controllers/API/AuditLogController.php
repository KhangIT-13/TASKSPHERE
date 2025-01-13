<?php

namespace App\Http\Controllers\API;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index()
    {
        return AuditLog::with('user')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'ActionType' => 'required|string|max:50',
            'ActionDescription' => 'required|string',
            'UserId' => 'required|exists:users,UserId',
        ]);

        return AuditLog::create($request->all());
    }

    public function show($id)
    {
        return AuditLog::with('user')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $auditLog = AuditLog::findOrFail($id);
        $auditLog->update($request->all());
        return $auditLog;
    }

    public function destroy($id)
    {
        $auditLog = AuditLog::findOrFail($id);
        $auditLog->delete();
        return response()->json(['message' => 'Audit Log deleted successfully']);
    }
}
