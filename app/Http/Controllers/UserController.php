<?php
  
  namespace App\Http\Controllers;
  
  use App\Http\Requests\UpdateUserRequest;
  use App\Models\App;
  use App\Models\Role;
  use App\Models\User;
  use Illuminate\Contracts\View\View;
  use Illuminate\Http\RedirectResponse;
  use Illuminate\Http\Request;
  
  class UserController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request): View {
      $filters       = $request->query("filters") ?? [];
      $activeFilters = [];
      
      $roles = Role::all();
      $apps  = App::all();
      
      $users = User::orderBy("roles")
        ->orderBy("firstName")
        ->orderBy("lastName");
      
      foreach ($filters as $key => $value) {
        if ($value) {
          $activeFilters[$key] = $value;
          
          switch ($key) {
            case 'name':
              $users->where("firstName", "like", "%$value%");
              $users->orWhere("lastName", "like", "%$value%");
              break;
            
            case "email":
              $users->where("email", "like", "%$value%");
              break;
            
            default:
              if (is_array($value)) {
                $users->whereIn($key, $value);
              } else {
                $users->where($key, "like", $value);
              }
              
              break;
          }
        }
      }
      
      $users = $users->paginate();
      
      return view('users.index', ["users" => $users, "roles" => $roles, "apps" => $apps]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      //
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      //
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
     * @param  User  $user
     *
     * @return View
     */
    public function edit(User $user): View {
      $roles = Role::all();
      $apps  = App::all();
      
      return view("users.edit", [
        "user"  => $user,
        "roles" => $roles,
        "apps"  => $apps
      ]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  User     $user
     *
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user) {
      $validated = $request->validated();
      
      $user->update($validated);
      
      return redirect()->route("users.index")->with(["status" => "Dati salvati correttamente!"]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      //
    }
  }
