<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CronUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
  "register" => false,
  "reset"    => false,
  "confirm"  => false
]);

Route::middleware("auth")->get('/', [HomeController::class, 'index'])->name('home');
Route::middleware("auth")->get("permissions/find/{code}", [PermissionController::class, "find"])->name("permissions.find");

Route::middleware("auth")->resource("roles", RoleController::class);
Route::middleware("auth")->resource("apps", AppController::class);
Route::middleware("auth")->resource("users", UserController::class);
Route::middleware("auth")->resource("permissions", PermissionController::class);

Route::middleware("auth")->resource("cron_users", CronUserController::class);
Route::middleware("auth")->put("cron_users/{cron_user}/reset_password", [CronUserController::class, "resetPassword"])->name("cron_users.reset_password");

Route::middleware("auth")->patch("apps/{app}/keys_refresh/{code}", [AppController::class, "refreshKeys"])->name("apps.keys_refresh");

