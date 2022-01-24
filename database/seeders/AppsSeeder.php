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
    App::create(["code" => "main", "title" => "App Global principale", "description" => "Applicazione principale Global"]);
    App::create(["code" => "club", "title" => "App CLUB", "description" => "Applicazione del Club"]);
    App::create(["code" => "news", "title" => "App News & Eventi", "description" => "Gestionale delle news e degli eventi"]);
  }
}
