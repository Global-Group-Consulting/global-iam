<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;


class Role extends Model {
  use HasFactory;
  
  protected $collection = "acl_roles_models";
  
  protected $fillable = ["code", "description", "permissions"];
  
  public function users() {
    return $this->hasMany(User::class, "roles", "code");
  }
}
