<?php
  
  namespace App\Http\Controllers;
  
  use App\Http\Requests\StoreAppRequest;
  use App\Http\Requests\UpdateAppRequest;
  use App\Models\App;
  use App\Models\User;
  use Illuminate\Http\RedirectResponse;
  use Illuminate\Http\Request;
  use Illuminate\View\View;
  use Jenssegers\Mongodb\Eloquent\Model;

  class AppController extends Controller {
    private function getAppUsersCount(string $appCode = null) {
      $aggregation = [
        ['$unwind' => [
          'path'                       => '$apps',
          'preserveNullAndEmptyArrays' => true
        ]],
        ['$group' => [
          '_id'   => '$apps',
          'users' => [
            '$sum' => 1
          ]
        ]]
      ];
    
      if ($appCode) {
        array_unshift($aggregation, [
          '$match' => [
            "apps" => $appCode
          ]
        ]);
      }
    
      return User::raw()->aggregate($aggregation)->toArray();
    }
  
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View {
      $users = $this->getAppUsersCount();
    
      $apps = App::all();
      $ids  = array_column($users, "_id");
    
      foreach ($apps as $role) {
        $index = array_search($role->code, $ids);
      
        $role->usersCount = $index === false ? 0 : $users[$index]["users"];
      }
    
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
  
      $app = App::create($validated);
  
      $this->refreshKeys($app, "server");
      $this->refreshKeys($app, "client");
  
      return redirect()->route("apps.show", $app->_id)->with(["status" => "App creata correttamente"]);
    }
  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(App $app) {
      return view("apps.show", compact("app"));
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
  
      return redirect()->route("apps.show", $app->_id)->with(["success" => "Dati salvati correttamente"]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  App  $app
     *
     * @return RedirectResponse
     */
    public function destroy(App $app): RedirectResponse {
      $usersCount = User::where("apps", $app->code)->count();
  
      if ($usersCount > 0) {
        return back()->with('error', "Non pè possibile cancellare questa app in quanto è in uso da $usersCount utenti.
        Prima di procedere, togliere questa app da ogni utente.");
      }
  
      $app->delete();
  
      return redirect()->route("apps.index")->with(["status" => "Elemento eliminato correttamente!"]);
    }
  
    /**
     * @param  App     $app
     * @param  string  $type  sever | client
     *
     * @return string
     * @throws \Exception
     */
    public function refreshKeys(App $app, $type) {
      $secrets = $app["secrets"] ?? [];
    
      if ( !key_exists("client", $secrets)) {
        $secrets["client"] = [
          "type"      => "client",
          "secretKey" => "",
          "publicKey" => ""
        ];
      }
    
      if ( !key_exists("server", $secrets)) {
        $secrets["server"] = [
          "type"      => "server",
          "secretKey" => "",
        ];
      }
    
      $secrets[$type]["secretKey"] = $this->generatePublicKey($type, $app->code);
    
      if ($type === "client") {
        $secrets[$type]["publicKey"] = $this->generatePublicKey($type, $app->code, true);
      }
    
      $app["secrets"] = $secrets;
      $app->save();
    
      return redirect(route("apps.show", $app->_id));
    }
  
    /**
     * @param  string  $type  sever | client
     * @param  string  $appCode
     * @param  bool    $public
     *
     * @return string
     * @throws \Exception
     */
    private function generatePublicKey(string $type, string $appCode, $public = false): string {
      $length = $public ? 8 : 8;
      $prefix = "";
      $suffix = "";
      $secret = "";
    
      if ( !$public) {
        $prefix = $type === "server" ? "srv" : "clt";
      }
    
      $secret = bin2hex(random_bytes($length));
    
      if ( !$public) {
        $suffix = $appCode;
      }
    
      $finalCode     = ($prefix ? $prefix . "-" : '') . $secret . ($suffix ? "-" . $suffix : '');
      $alreadyExists = App::where("secrets.$type." . ($public ? "publicKey" : "secretKey"), $finalCode)->first();
    
      while ($alreadyExists) {
        $secret        = bin2hex(random_bytes($length));
        $finalCode     = ($prefix ? $prefix . "-" : '') . $secret . ($suffix ? "-" . $suffix : '');
        $alreadyExists = App::where("secrets.$type." . ($public ? "publicKey" : "secretKey"), $finalCode)->first();
      }
    
      return $finalCode;
    }
  }
