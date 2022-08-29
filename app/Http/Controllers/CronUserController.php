<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\CronUser;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CronUserController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $users = CronUser::all();
    
    return view("cron_users.index", compact("users"));
  }
  
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    $apps = App::all();
    
    return view("cron_users.create", compact("apps"));
  }
  
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   *
   * @return RedirectResponse
   */
  public function store(Request $request) {
    $data = $request->validate([
      "username" => "required|string",
      "apps"     => "required|array",
    ]);
    
    $password = Str::random(16);
    
    $user = new CronUser([
      "username" => $data["username"],
      "apps"     => $data["apps"],
    ]);
    
    $user->password = Hash::make($password);
    
    $user->save();
    
    return redirect()->route("cron_users.index")->with([
      "status" => "Password utente appena creato: <strong>$password</strong>
      <br>Attenzione, non sarà possibile rivedere tale password. Nel caso la si perda, sarà necessario rigenerarla."
    ]);
  }
  
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   *
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
    return redirect()->route("cron_users.index");
  }
  
  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   *
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    $user = CronUser::findOrFail($id);
    $apps = App::all();
    
    return view("cron_users.edit", compact("apps", "user"));
  }
  
  /**
   * Update the specified resource in storage.
   *
   * @param  Request  $request
   * @param  string   $id
   *
   * @return RedirectResponse
   */
  public function update(Request $request, string $id) {
    $data = $request->validate([
      "username" => "required|string|max:255",
      'apps.*'   => 'nullable|exists:App\Models\App,code'
    ]);
    $user = CronUser::findOrFail($id);
    $user->update($data);
    
    return redirect()->route("cron_users.index")->with(["status" => "Dati salvati correttamente!"]);
  }
  
  public function resetPassword($id) {
    $user     = CronUser::findOrFail($id);
    $password = Str::random(16);
    
    $user->password = Hash::make($password);
    $user->save();
    
    return redirect()->route("cron_users.index")->with([
      "status" => "Password utente modificata: <strong>$password</strong>
      <br>Attenzione, non sarà possibile rivedere tale password. Nel caso la si perda, sarà necessario rigenerarla."
    ]);
  }
  
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   *
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    $user = CronUser::findOrFail($id);
    
    $user->delete();
    
    return redirect()->route("cron_users.index")->with(["status" => "Utente eliminato correttamente!"]);
  }
}
