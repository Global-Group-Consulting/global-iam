<?php

namespace Database\Seeders;

use App\Models\App;
use Illuminate\Database\Seeder;

class AppsSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    App::create(["code" => "main", "description" => "Applicazione principale Global"]);
    App::create(["code" => "club", "description" => "Applicazione del Club"]);
  }
}
