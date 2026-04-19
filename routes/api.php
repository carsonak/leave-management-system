<?php

use App\Http\Controllers\AdminLeaveRequestController;
use App\Http\Controllers\LeaveRequestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Normal user routes
    Route::get('/leave-requests', [LeaveRequestController::class, 'index']);
    Route::post('/leave-requests', [LeaveRequestController::class, 'store']);

    // Admin routes
    Route::prefix('admin')->group(function () {
        Route::get('/leave-requests/pending', [AdminLeaveRequestController::class, 'pending']);
        Route::get('/leave-requests/user/{userId}', [AdminLeaveRequestController::class, 'userLeaves']);
        Route::patch('/leave-requests/{leaveRequest}', [AdminLeaveRequestController::class, 'updateStatus']);
    });
});
