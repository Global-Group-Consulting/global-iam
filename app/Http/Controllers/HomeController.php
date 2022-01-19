<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller {

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(REQUEST $request) {
    return view("home");
  }
}
