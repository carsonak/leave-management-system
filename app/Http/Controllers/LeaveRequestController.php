<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaveRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $leaves = $request->user()->leaveRequests()->latest()->get();

        return response()->json($leaves);
    }

    public function store(StoreLeaveRequest $request): JsonResponse
    {
        $leave = $request->user()->leaveRequests()->create($request->validated());

        return response()->json($leave, 201);
    }
}
