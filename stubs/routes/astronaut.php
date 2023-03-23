<?php

use App\Http\Controllers\{
    PermissionController,
    UserController,
    RoleController,
};
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    
    Route::resource('/user', UserController::class);

    Route::resource('/role', RoleController::class);

    Route::resource('/permission', PermissionController::class);

});
