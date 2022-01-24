<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder {
  private $jsonData = '[{
    "code": "admin",
    "description": "Permette di leggere la lista di tutti gli utenti",
    "permissions": [
      "communications:*",
      "users:*",
      "brites.all:*",
      "club:*",
      "users.all:*",
      "calculator:*",
      "requests.all:*",
      "commissions.all:*",
      "movements.all:*",
      "settings.self:read",
      "settings.self:write",
      "agentbrites.all:*",
      "reports.read",
      "club.orders.all:*",
      "club.products.all:*",
      "club.products_cat.all:*",
      "club.users.all:read",
      "news.all:*"
    ]
  },
  {
    "code": "super_admin",
    "description": "Permessi totali",
    "permissions": [
      "communications:*",
      "users:*",
      "developer:*",
      "translations:*",
      "acl:*",
      "club:*",
      "brites.all:*",
      "users.all:*",
      "calculator:*",
      "requests.all:*",
      "commissions.all:*",
      "movements.all:*",
      "settings.all:read",
      "settings.self:read",
      "settings.self:write",
      "settings.all:write",
      "agentbrites.all:*",
      "reports.read",
      "club.orders.all:*",
      "club.products.all:*",
      "club.products_cat.all:*",
      "club.users.all:read",
      "news.all:*"
    ]
  },
  {
    "code": "clients_servizio",
    "description": "Servizio clienti",
    "permissions": [
      "agentbrites.all:*",
      "calculator:*",
      "communications:*",
      "requests.all:*",
      "settings.self:read",
      "settings.self:write",
      "users.all:*"
    ]
  },
  {
    "code": "client",
    "description": "Cliente standard",
    "permissions": [
      "users.self:read",
      "users.self:write",
      "brites.self:use",
      "brites.self:read",
      "communications:*",
      "movements.self:read",
      "movements.self:write",
      "requests.self:*",
      "settings.self:read",
      "settings.self:write"
    ]
  },
  {
    "code": "agent",
    "description": "Agente standard",
    "permissions": [
      "agentbrites.group:read",
      "calculator:*",
      "commissions.team:add",
      "commissions.team:read",
      "communications:*",
      "movements.self:read",
      "movements.self:write",
      "portfolio.self:read",
      "portfolio.self:write",
      "requests.self:*",
      "settings.self:read",
      "settings.self:write",
      "users.self:read",
      "users.self:write",
      "users.team:read"
    ]
  }
]';
  
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $data = json_decode($this->jsonData);
    
    foreach ($data as $role) {
      Role::create([
        "code" => $role->code,
        "description" => $role->description,
        "permissions" => $role->permissions,
      ]);
    }
  }
}
