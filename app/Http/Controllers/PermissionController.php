<?php
  
  namespace App\Http\Controllers;
  
  use App\Http\Requests\StoreArticleRequest;
  use App\Http\Requests\StorePermissionRequest;
  use App\Http\Requests\UpdatePermissionRequest;
  use App\Models\Permission;
  use App\Models\Role;
  use http\QueryString;
  use Illuminate\Http\RedirectResponse;
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\DB;
  use Illuminate\View\View;
  
  class PermissionController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View {
//      DB::enableQueryLog();
      $permissions = Permission::raw()->aggregate([
          ['$lookup' => [
            "from"         => 'roles',
            "localField"   => 'code',
            "foreignField" => 'permissions',
            "as"           => 'roles'
          ]],
          [
            '$sort' => ["code" => 1]
          ]
        ]
      )->toArray();
  
      return view("permissions.index", compact("permissions"));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View {
      return view("permissions.create");
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePermissionRequest  $request
     *
     * @return RedirectResponse
     */
    public function store(StorePermissionRequest $request): RedirectResponse {
      $validated = $request->validated();
  
      Permission::create($validated);
  
      return redirect()->route("permissions.index")->with("Permesso creato correttamente");
    }
  
    /**
     * Display the specified resource.
     *
     * @param  Permission  $permission
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission) {
      //
    }
    
    /**
     * @param  string  $code
     *
     * @return RedirectResponse
     */
    public function find(string $code): RedirectResponse {
      $permission = Permission::where("code", $code)->first();
      
      return redirect()->route("permissions.edit", $permission->_id);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Permission  $permission
     *
     * @return View
     */
    public function edit(Permission $permission): View {
      return view("permissions.edit", compact("permission"));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePermissionRequest  $request
     * @param  Permission               $permission
     *
     * @return RedirectResponse
     */
    public function update(UpdatePermissionRequest $request, Permission $permission): RedirectResponse {
      $validated = $request->validated();
      $oldCode   = $permission["code"];
      $newCode   = $validated["code"];
      
      $changedCode = $oldCode !== $newCode;
      
      $permission->update($validated);
      
      // if was renamed, update all existing users
      if ($changedCode) {
        try {
          Role::where("permissions", $oldCode)
            ->update(["permissions.$" => $newCode]);
        } catch (\Exception $e) {
          // if there is an error while updating users, revert the app change
          $permission["code"] = $oldCode;
          $permission->save();
          
          return redirect()->route("permissions.edit", $permission->_id)
            ->with(["error" => "Errore nell'aggiornare il codice del permesso.<br>" . $e->getMessage()]);
        }
      }
  
      return redirect()->route("permissions.index")->with(["status" => "Dati salvati correttamente"]);
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  Permission  $permission
     *
     * @return RedirectResponse
     */
    public function destroy(Permission $permission): RedirectResponse {
      $roles   = Role::where("permissions", $permission->code);
      $counter = $roles->count();
    
      if ($counter > 0) {
        return back()->with('error', "Non è possibile cancellare questo permesso in quanto è in uso da $counter ruoli.
        Prima di procedere, togliere questo permesso da ogni ruolo.");
      }
    
      $permission->delete();
    
      return redirect()->route("permissions.index")->with(["status" => "Permesso eliminato correttamente!"]);
    }
  }
