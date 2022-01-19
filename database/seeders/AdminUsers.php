<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUsers extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $user = new AdminUser([
      "name" => "Admin",
      "email" => "info@leicaflorianrobert.dev",
      "password" => Hash::make('password1234'),
    ]);

    $user->save();
  }
}
