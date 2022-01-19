<?php
  
  namespace App\Http\Controllers;
  
  use App\Http\Requests\StoreAppRequest;
  use App\Http\Requests\UpdateAppRequest;
  use App\Models\App;
  use App\Models\User;
  use Illuminate\Http\RedirectResponse;
  use Illuminate\Http\Request;
  use Illuminate\View\View;
  
  class AppController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View {
      $apps = App::all();
      
      return view("apps.index", compact("apps"));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View {
      return view("apps.create");
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreAppRequest  $request
     *
     * @return RedirectResponse
     */
    public function store(StoreAppRequest $request): RedirectResponse {
      $validated = $request->validated();
      
      App::create($validated);
      
      return redirect()->route("apps.index")->with(["status" => "App creata correttamente"]);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
      //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App  $app
     *
     * @return View
     */
    public function edit(App $app): View {
      return view("apps.edit", compact("app"));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateAppRequest  $request
     * @param  App               $app
     *
     * @return RedirectResponse
     */
    public function update(UpdateAppRequest $request, App $app): RedirectResponse {
      $validated = $request->validated();
      $oldCode   = $app["code"];
      $newCode   = $validated["code"];
      
      $changedCode = $oldCode !== $newCode;
      
      $app->update($validated);
      
      // if was renamed, update all existing users
      if ($changedCode) {
        try {
          User::where("apps", $oldCode)
            ->update(["apps.$" => $newCode]);
        } catch (\Exception $e) {
          // if there is an error while updating users, revert the app change
          $app["code"] = $oldCode;
          $app->save();
          
          return redirect()->route("apps.edit", $app->_id)
            ->with(["status" => "Errore nell'aggiornare il codice dell'applicazione.<br>" . $e->getMessage()]);
        }
      }
      
      return redirect()->route("apps.index")->with(["status" => "Dati salvati correttamente"]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  App  $app
     *
     * @return RedirectResponse
     */
    public function destroy(App $app): RedirectResponse {
      $usersCount = $app->users->count();
      if ($usersCount > 0) {
        return back()->with('error', "Non pè possibile cancellare questa app in quanto è in uso da $usersCount utenti.
        Prima di procedere, togliere questa app da ogni utente.");
      }
      
      $app->delete();
      
      return redirect()->route("apps.index")->with(["status" => "Elemento eliminato correttamente!"]);
    }
  }
