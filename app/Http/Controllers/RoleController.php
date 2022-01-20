<?php
  
  namespace App\Http\Controllers;
  
  use App\Http\Requests\StoreRoleRequest;
  use App\Http\Requests\UpdateRoleRequest;
  use App\Models\Permission;
  use App\Models\Role;
  use App\Models\User;
  use Illuminate\Http\RedirectResponse;
  use Illuminate\Http\Request;
  use Illuminate\View\View;
  
  class RoleController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View {
      $roles = Role::raw()->aggregate([
        ['$lookup' => [
          "from"         => 'users',
          "localField"   => 'code',
          "foreignField" => 'roles',
          "as"           => 'users'
        ]]
      ])->toArray();
  
      return view("roles.index", compact("roles"));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View {
      $permissions = Permission::orderBy("code")->get();
      
      return view("roles.create", compact("permissions"));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRoleRequest  $request
     *
     * @return RedirectResponse
     */
    public function store(StoreRoleRequest $request): RedirectResponse {
      $validated = $request->validated();
      
      Role::create($validated);
      
      return redirect()->route("roles.index")->with(["status" => "Ruolo creato correttamente!"]);
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
     * @param  Role  $role
     *
     * @return View
     */
    public function edit(Role $role): View {
      $permissions = Permission::orderBy("code")->get();
      
      return view("roles.edit", [
        "role"        => $role,
        "permissions" => $permissions
      ]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRoleRequest  $request
     * @param  Role               $role
     *
     * @return RedirectResponse
     */
    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse {
      $validated = $request->validated();
      $oldCode   = $role["code"];
      $newCode   = $validated["code"];
      
      $changedCode = $oldCode !== $newCode;
      
      $role->update($validated);
      
      // if was renamed, update all existing users
      if ($changedCode) {
        try {
          User::where("roles", $oldCode)
            ->update(["roles.$" => $newCode]);
        } catch (\Exception $e) {
          // if there is an error while updating users, revert the app change
          $role["code"] = $oldCode;
          $role->save();
          
          return redirect()->route("roles.edit", $role->_id)
            ->with(["error" => "Errore nell'aggiornare il codice del ruolo.<br>" . $e->getMessage()]);
        }
      }
      
      return redirect()->route("roles.index")->with(["status" => "Dati salvati correttamente"]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return RedirectResponse
     */
    public function destroy(Role $role): RedirectResponse {
      $usersCount = $role->users->count();
      if ($usersCount > 0) {
        return back()->with('error', "Non pè possibile cancellare questo ruolo in quanto è in uso da $usersCount utenti.
        Prima di procedere, togliere questo ruolo da ogni utente.");
      }
      
      $role->delete();
      
      return redirect()->route("roles.index")->with(["status" => "Ruolo eliminato correttamente!"]);
    }
  }
