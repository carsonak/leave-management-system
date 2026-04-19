<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateLeaveRequestStatus;
use App\Models\LeaveRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminLeaveRequestController extends Controller
{
    public function pending(Request $request): JsonResponse
    {
        if (! $request->user()->is_admin) {
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        }

        $pending = LeaveRequest::with('user')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return response()->json($pending);
    }

    public function userLeaves(Request $request, int $userId): JsonResponse
    {
        if (! $request->user()->is_admin) {
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        }

        $leaves = LeaveRequest::where('user_id', $userId)->latest()->get();

        return response()->json($leaves);
    }

    public function updateStatus(UpdateLeaveRequestStatus $request, LeaveRequest $leaveRequest): JsonResponse
    {
        if (! $request->user()->is_admin) {
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        }

        $leaveRequest->update($request->validated());

        return response()->json($leaveRequest->fresh());
    }
}
