<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Query\Builder;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 *
 * @property string $username
 * @property array  $apps
 */
class CronUser extends Authenticatable {
  use HasFactory;
  
  protected $connection = "mongodb_legacy";
  
  protected $fillable = [
    "username",
    "apps"
  ];
  
}
