<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'status' => 'Leave Management API is running',
        'version' => 'Laravel ' . app()->version(),
    ]);
});
