<?php
  
  namespace App\Models;
  
  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Jenssegers\Mongodb\Eloquent\Model;
  
  class Permission extends Model {
    use HasFactory;
    
    protected $collection = "acl_permissions_models";
    
    protected $fillable = ["code", "description"];
    
    public function roles() {
      return $this->hasMany(Role::class, "permissions", "code");
    }
  }
