<?php

namespace Database\Seeders;

use App\Models\App;
use Illuminate\Database\Seeder;

class AppsSecretsSeeder extends Seeder {
  private $data = [
    "main" => [
      "client" => [
        "type"      => "client",
        "secretKey" => "clt-doqTXN6CKRFzrAh-main",
        "publicKey" => "7BpSpC4q8gg2QSR"
      ],
      "server" => [
        "type"      => "server",
        "secretKey" => "srv-oeLULBTBa8sBUme-main",
        "publicKey" => ""
      ]
    ],
    "club" => [
      "client" => [
        "type"      => "client",
        "secretKey" => "clt-XC3xZYjqh5dY2eK-club",
        "publicKey" => "LXM6DBJP4xz26TB"
      ],
      "server" => [
        "type"      => "server",
        "secretKey" => "srv-NVvy5KgaaNrQu4E-club",
        "publicKey" => ""
      ]
    ]
  ];
  
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $apps = App::all();
    
    foreach ($apps as $app) {
      $matchData = key_exists($app->code, $this->data) ? $this->data[$app->code] : null;
      
      if ($matchData) {
        $app["secrets"] = $matchData;
        
        $app->save();
      }
    }
  }
}
