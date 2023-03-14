<?php

use App\Http\Controllers\{
    UserController,
    RoleController,
    TestController
};
use Illuminate\Support\Facades\Route;

Route::resource('/user', UserController::class);
Route::middleware('auth')->group(function () {


    Route::resource('/role', RoleController::class);

});
