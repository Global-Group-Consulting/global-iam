<?php
  
  use App\Http\Controllers\AppController;
  use App\Http\Controllers\HomeController;
  use App\Http\Controllers\RoleController;
  use App\Http\Controllers\UserController;
  use App\Http\Controllers\PermissionController;
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
  
