<?php
  
  namespace App\Models;
  
  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Jenssegers\Mongodb\Eloquent\Model;
  
  
  class App extends Model {
    use HasFactory;
    
    protected $fillable = ["code", "description"];
    
    public function users() {
      return $this->hasMany(User::class, "apps", "code");
    }
  }
