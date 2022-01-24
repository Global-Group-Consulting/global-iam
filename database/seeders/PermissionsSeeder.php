<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder {
  private $jsonData = '[{
  "_id": {
    "$oid": "60340639931bc56570775b30"
  },
  "code": "club:*",
  "description": "Accesso totale alla pagina di gestione del club",
  "created_at": {
    "$date": "2021-02-22T19:30:01.037Z"
  },
  "updated_at": {
    "$date": "2021-02-22T19:30:01.037Z"
  }
},{
  "_id": {
    "$oid": "602b7af5e24cc415a40c6d85"
  },
  "code": "requests.all:write",
  "description": "tbd",
  "created_at": {
    "$date": "2021-02-16T07:57:41.902Z"
  },
  "updated_at": {
    "$date": "2021-02-16T07:57:41.902Z"
  }
},{
  "_id": {
    "$oid": "602b7affe24cc415a40c6d87"
  },
  "code": "requests.self:read",
  "description": "tbd",
  "created_at": {
    "$date": "2021-02-16T07:57:51.496Z"
  },
  "updated_at": {
    "$date": "2021-02-16T07:57:51.497Z"
  }
},{
  "_id": {
    "$oid": "602e50d13f29e36a98e7c474"
  },
  "code": "users.team:read",
  "description": "Legge gli utenti del proprio gruppo",
  "created_at": {
    "$date": "2021-02-18T11:34:41.951Z"
  },
  "updated_at": {
    "$date": "2021-02-18T11:34:41.951Z"
  }
},{
  "_id": {
    "$oid": "602f8c7a3f29e36a98e7c48b"
  },
  "code": "acl:write",
  "description": "Scrittura dei permessi e ruoli",
  "created_at": {
    "$date": "2021-02-19T10:01:30.304Z"
  },
  "updated_at": {
    "$date": "2021-02-19T10:01:30.304Z"
  }
},{
  "_id": {
    "$oid": "602b7ac1e24cc415a40c6d80"
  },
  "code": "users.self:read",
  "description": "tbd",
  "created_at": {
    "$date": "2021-02-16T07:56:49.170Z"
  },
  "updated_at": {
    "$date": "2021-02-16T07:56:49.170Z"
  }
},{
  "_id": {
    "$oid": "602b7ac5e24cc415a40c6d81"
  },
  "code": "users.self:write",
  "description": "tbd",
  "created_at": {
    "$date": "2021-02-16T07:56:53.863Z"
  },
  "updated_at": {
    "$date": "2021-02-16T07:56:53.863Z"
  }
},{
  "_id": {
    "$oid": "603405cf931bc56570775b2d"
  },
  "code": "brites.all:write",
  "description": "Permette di operare sui brite di tutti gli utenti",
  "created_at": {
    "$date": "2021-02-22T19:28:15.609Z"
  },
  "updated_at": {
    "$date": "2021-02-22T19:28:15.610Z"
  }
},{
  "_id": {
    "$oid": "602b7ad5e24cc415a40c6d82"
  },
  "code": "movements.self:write",
  "description": "tbd",
  "created_at": {
    "$date": "2021-02-16T07:57:09.391Z"
  },
  "updated_at": {
    "$date": "2021-02-16T07:57:09.391Z"
  }
},{
  "_id": {
    "$oid": "602b7ad9e24cc415a40c6d83"
  },
  "code": "movements.self:read",
  "description": "tbd",
  "created_at": {
    "$date": "2021-02-16T07:57:13.400Z"
  },
  "updated_at": {
    "$date": "2021-02-16T07:57:13.400Z"
  }
},{
  "_id": {
    "$oid": "602b7af1e24cc415a40c6d84"
  },
  "code": "requests.all:read",
  "description": "tbd",
  "created_at": {
    "$date": "2021-02-16T07:57:37.321Z"
  },
  "updated_at": {
    "$date": "2021-02-16T07:57:37.321Z"
  }
},{
  "_id": {
    "$oid": "60340552931bc56570775b29"
  },
  "code": "club:read",
  "description": "Legge l\'elenco degli utenti del club",
  "created_at": {
    "$date": "2021-02-22T19:26:10.120Z"
  },
  "updated_at": {
    "$date": "2021-02-22T19:26:10.121Z"
  }
},{
  "_id": {
    "$oid": "603405b5931bc56570775b2c"
  },
  "code": "brites.all:read",
  "description": "Permette di leggere i brite di tutti gli utenti",
  "created_at": {
    "$date": "2021-02-22T19:27:49.486Z"
  },
  "updated_at": {
    "$date": "2021-02-22T19:27:49.486Z"
  }
},{
  "_id": {
    "$oid": "603426606a514a2ccc7c70e8"
  },
  "code": "users.all:*",
  "description": "Permessi totatali su tutti gli utenti",
  "created_at": {
    "$date": "2021-02-22T21:47:12.257Z"
  },
  "updated_at": {
    "$date": "2021-02-22T21:47:12.257Z"
  }
},{
  "_id": {
    "$oid": "602b7aa6e24cc415a40c6d7f"
  },
  "code": "portfolio.self:read",
  "description": "tbd",
  "created_at": {
    "$date": "2021-02-16T07:56:22.561Z"
  },
  "updated_at": {
    "$date": "2021-02-16T07:56:22.561Z"
  }
},{
  "_id": {
    "$oid": "602b79b3e24cc415a40c6d79"
  },
  "code": "users.all:write",
  "description": "Permette di leggere la lista di tutti gli utenti",
  "created_at": {
    "$date": "2021-02-16T07:52:19.824Z"
  },
  "updated_at": {
    "$date": "2021-02-16T07:52:19.824Z"
  }
},{
  "_id": {
    "$oid": "60340627931bc56570775b2f"
  },
  "code": "brites.all:*",
  "description": "Accesso completo ai brite di tutti gli utenti",
  "created_at": {
    "$date": "2021-02-22T19:29:43.108Z"
  },
  "updated_at": {
    "$date": "2021-02-22T19:29:43.109Z"
  }
},{
  "_id": {
    "$oid": "602f80443f29e36a98e7c480"
  },
  "code": "translations:*",
  "description": "Accesso totale alle traduzioni",
  "created_at": {
    "$date": "2021-02-19T09:09:24.165Z"
  },
  "updated_at": {
    "$date": "2021-02-19T09:09:24.165Z"
  }
},{
  "_id": {
    "$oid": "6034d25d3bfe6a335417374e"
  },
  "code": "club:approve",
  "description": "Permesso per accettare o meno la richiesta di utilizzo dei Brite",
  "created_at": {
    "$date": "2021-02-23T10:01:01.132Z"
  },
  "updated_at": {
    "$date": "2021-02-23T10:01:01.132Z"
  }
},{
  "_id": {
    "$oid": "602b7aa3e24cc415a40c6d7e"
  },
  "code": "portfolio.self:write",
  "description": "Testo di prova",
  "created_at": {
    "$date": "2021-02-16T07:56:19.366Z"
  },
  "updated_at": {
    "$date": "2021-02-17T09:32:49.602Z"
  },
  "id": "602b7aa3e24cc415a40c6d7e"
},{
  "_id": {
    "$oid": "6034060c931bc56570775b2e"
  },
  "code": "brites.all:add",
  "description": "Permette di aggiungere manualmente brite a qualsiasi utente",
  "created_at": {
    "$date": "2021-02-22T19:29:16.972Z"
  },
  "updated_at": {
    "$date": "2021-02-22T19:29:16.972Z"
  }
},{
  "_id": {
    "$oid": "6034100e931bc56570775b34"
  },
  "code": "brites.self:read",
  "description": "Permette di vedere il resoconto dei propri brite",
  "created_at": {
    "$date": "2021-02-22T20:11:58.284Z"
  },
  "updated_at": {
    "$date": "2021-02-22T20:11:58.284Z"
  }
},{
  "_id": {
    "$oid": "602f73cc3f29e36a98e7c479"
  },
  "code": "communications:*",
  "description": "Tutti i permessi sulle comunicazioni",
  "created_at": {
    "$date": "2021-02-19T08:16:12.235Z"
  },
  "updated_at": {
    "$date": "2021-02-19T08:16:12.236Z"
  }
},{
  "_id": {
    "$oid": "602b79b1e24cc415a40c6d78"
  },
  "code": "users.all:read",
  "description": "Permette di leggere la lista di tutti gli utenti",
  "created_at": {
    "$date": "2021-02-16T07:52:17.971Z"
  },
  "updated_at": {
    "$date": "2021-02-16T07:52:17.971Z"
  }
},{
  "_id": {
    "$oid": "602f8c6a3f29e36a98e7c48a"
  },
  "code": "acl:read",
  "description": "Lettura dei permessi e ruoli",
  "created_at": {
    "$date": "2021-02-19T10:01:14.343Z"
  },
  "updated_at": {
    "$date": "2021-02-19T10:01:14.343Z"
  }
},{
  "_id": {
    "$oid": "602b7afae24cc415a40c6d86"
  },
  "code": "requests.self:write",
  "description": "tbd",
  "created_at": {
    "$date": "2021-02-16T07:57:46.882Z"
  },
  "updated_at": {
    "$date": "2021-02-16T07:57:46.882Z"
  }
},{
  "_id": {
    "$oid": "602f805a3f29e36a98e7c481"
  },
  "code": "developer:*",
  "description": "Accesso totale alla sezione sviluppatore",
  "created_at": {
    "$date": "2021-02-19T09:09:46.908Z"
  },
  "updated_at": {
    "$date": "2021-02-19T09:09:46.908Z"
  }
},{
  "_id": {
    "$oid": "6034056e931bc56570775b2a"
  },
  "code": "club:write",
  "description": "Permette di operare nell\'elenco degli utenti del club",
  "created_at": {
    "$date": "2021-02-22T19:26:38.828Z"
  },
  "updated_at": {
    "$date": "2021-02-22T19:26:38.828Z"
  }
},{
  "_id": {
    "$oid": "60340ff6931bc56570775b33"
  },
  "code": "brites.self:use",
  "description": "Permette di richiedere di usare i propri brite",
  "created_at": {
    "$date": "2021-02-22T20:11:34.033Z"
  },
  "updated_at": {
    "$date": "2021-02-22T20:11:34.034Z"
  }
},{
  "_id": {
    "$oid": "603428e352dc4003dc2de52d"
  },
  "code": "acl:*",
  "description": "Permesso ACL totale",
  "created_at": {
    "$date": "2021-02-22T21:57:55.709Z"
  },
  "updated_at": {
    "$date": "2022-01-19T16:15:42.871Z"
  }
},{
  "_id": {
    "$oid": "60342cf70342fb24689487ed"
  },
  "code": "requests.self:*",
  "description": "Permessi totali sulle proprie richieste",
  "created_at": {
    "$date": "2021-02-22T22:15:19.480Z"
  },
  "updated_at": {
    "$date": "2021-02-22T22:15:19.480Z"
  }
},{
  "_id": {
    "$oid": "60342cde0342fb24689487ec"
  },
  "code": "requests.all:*",
  "description": "Permessi totali su tutte le richieste",
  "created_at": {
    "$date": "2021-02-22T22:14:54.101Z"
  },
  "updated_at": {
    "$date": "2021-02-22T22:14:54.101Z"
  }
},{
  "_id": {
    "$oid": "6036112d6c8eec003ef5a74c"
  },
  "code": "calculator:*",
  "description": "Permette di vedere e usare la calcolatrice",
  "created_at": {
    "$date": "2021-02-24T08:41:17.698Z"
  },
  "updated_at": {
    "$date": "2021-02-24T08:41:17.698Z"
  }
},{
  "_id": {
    "$oid": "6071b9ba1db7c2116417b0ea"
  },
  "code": "commissions.all:read",
  "description": "Leggere la lista delle provvigioni di tutti gli utenti",
  "created_at": "2021-04-09T15:08:11.245Z",
  "updated_at": "2021-04-09T15:08:11.245Z"
},{
  "_id": {
    "$oid": "6071b9ba1db7c2116417b0e5"
  },
  "code": "movements.all:*",
  "description": "Permessi totatli sui movimenti di tutti gli utenti",
  "created_at": "2021-04-09T16:21:16.289Z",
  "updated_at": "2021-04-09T16:21:16.289Z"
},{
  "_id": {
    "$oid": "6071b9ba1db7c2116417b0e6"
  },
  "code": "movements.team:read",
  "description": "Legge i movimenti degli utenti del team",
  "created_at": "2021-04-09T16:20:49.936Z",
  "updated_at": "2021-04-09T16:20:49.936Z"
},{
  "_id": {
    "$oid": "6071b9ba1db7c2116417b0e7"
  },
  "code": "movements.all:read",
  "description": "Legge i movimenti di tutti",
  "created_at": "2021-04-09T16:20:17.607Z",
  "updated_at": "2021-04-09T16:20:17.607Z"
},{
  "_id": {
    "$oid": "6071b9ba1db7c2116417b0e8"
  },
  "code": "commissions.all:*",
  "description": "Permesso totale sulle provvigioni di tutti gli utenti",
  "created_at": "2021-04-09T15:09:53.298Z",
  "updated_at": "2021-04-09T15:09:53.298Z"
},{
  "_id": {
    "$oid": "6071b9ba1db7c2116417b0e9"
  },
  "code": "commissions.team:read",
  "description": "Leggere la lista delle provvigioni solo degli utenti del proprio team",
  "created_at": "2021-04-09T15:08:32.281Z",
  "updated_at": "2021-04-09T15:08:32.281Z"
},{
  "_id": {
    "$oid": "6071ba271db7c2116417b0eb"
  },
  "code": "commissions.all:add",
  "description": "Aggiunge provvigioni a qualsiasi agente",
  "created_at": "2021-03-20T12:50:54.651Z",
  "updated_at": "2021-03-20T12:50:54.651Z"
},{
  "_id": {
    "$oid": "6071ba271db7c2116417b0ec"
  },
  "code": "commissions.all:approve",
  "description": "Permette di approvare o meno le richieste di aggiunta manuale di provvigioni fatte dagli agenti principali di un team",
  "created_at": "2021-03-20T12:54:23.313Z",
  "updated_at": "2021-03-20T12:54:23.313Z"
},{
  "_id": {
    "$oid": "6071ba271db7c2116417b0ed"
  },
  "code": "commissions.team:add",
  "description": "Aggiunge provvigioni ai componenti del suo team",
  "created_at": "2021-03-20T12:51:16.618Z",
  "updated_at": "2021-03-20T12:51:16.618Z"
},{
  "_id": {
    "$oid": "60ac14fa6955972de008e4d0"
  },
  "code": "settings.all:read",
  "description": "Legge le settings di tutta l\'applicazione",
  "created_at": "2021-05-21T15:21:37.480Z",
  "updated_at": "2021-05-21T15:21:37.480Z"
},{
  "_id": {
    "$oid": "60ac14fa6955972de008e4cd"
  },
  "code": "settings.self:write",
  "description": "Permette di modificare le impostazioni del proprio account",
  "created_at": "2021-05-21T15:22:25.770Z",
  "updated_at": "2021-05-21T15:22:25.770Z"
},{
  "_id": {
    "$oid": "60ac14fa6955972de008e4ce"
  },
  "code": "settings.self:read",
  "description": "Legge le impostazioni del proprio account",
  "created_at": "2021-05-21T15:22:06.853Z",
  "updated_at": "2021-05-21T15:22:06.853Z"
},{
  "_id": {
    "$oid": "60ac14fa6955972de008e4cf"
  },
  "code": "settings.all:write",
  "description": "Permette di modificare le settings di tutta l\'app",
  "created_at": "2021-05-21T15:21:51.957Z",
  "updated_at": "2021-05-21T15:21:51.957Z"
},{
  "_id": {
    "$oid": "60d9ffd8d25b9f10645cd04a"
  },
  "code": "agentbrites.all:*",
  "description": "Accesso completo ai brite di tutti gli agenti",
  "created_at": {
    "$date": "2021-06-28T16:59:04.562Z"
  },
  "updated_at": {
    "$date": "2021-06-28T16:59:04.562Z"
  }
},{
  "_id": {
    "$oid": "60da0006d25b9f10645cd04b"
  },
  "code": "agentbrites.group:read",
  "description": "Accesso in lettura ai brite degli agenti del gruppo",
  "created_at": {
    "$date": "2021-06-28T16:59:50.885Z"
  },
  "updated_at": {
    "$date": "2021-06-29T15:52:00.584Z"
  },
  "id": "60da0006d25b9f10645cd04b"
},{
  "_id": {
    "$oid": "6185c6462e12f1003f166d4c"
  },
  "code": "reports.read",
  "description": "Lettura dei report",
  "created_at": {
    "$date": "2021-11-06T00:03:18.053Z"
  },
  "updated_at": {
    "$date": "2021-11-06T00:03:18.053Z"
  }
},{
  "_id": {
    "$oid": "61a634e98125a2003f5fae13"
  },
  "code": "club.users.all:*",
  "description": "Club all users full permissions",
  "created_at": {
    "$date": "2021-11-30T14:27:53.041Z"
  },
  "updated_at": {
    "$date": "2021-11-30T14:27:53.041Z"
  }
},{
  "_id": {
    "$oid": "61a6350c8125a2003f5fae14"
  },
  "code": "club.orders.all:*",
  "description": "All permissions for orders",
  "created_at": {
    "$date": "2021-11-30T14:28:28.662Z"
  },
  "updated_at": {
    "$date": "2021-11-30T14:28:28.662Z"
  }
},{
  "_id": {
    "$oid": "61a6353d8125a2003f5fae15"
  },
  "code": "club.products.all:*",
  "description": "All permissions for club products",
  "created_at": {
    "$date": "2021-11-30T14:29:17.208Z"
  },
  "updated_at": {
    "$date": "2021-11-30T14:29:17.208Z"
  }
},{
  "_id": {
    "$oid": "61a635528125a2003f5fae16"
  },
  "code": "club.products_cat.all:*",
  "description": "All permissions for club products categories",
  "created_at": {
    "$date": "2021-11-30T14:29:38.634Z"
  },
  "updated_at": {
    "$date": "2021-11-30T14:29:38.634Z"
  }
},{
  "_id": {
    "$oid": "61c5865e074b6b003f9a316a"
  },
  "code": "news.all:*",
  "description": "All access to news",
  "created_at": {
    "$date": "2021-12-24T08:35:42.193Z"
  },
  "updated_at": {
    "$date": "2021-12-24T08:35:42.193Z"
  }
}]';
  
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $data = json_decode($this->jsonData);
    
    foreach ($data as $role) {
      Permission::create([
        "code"        => $role->code,
        "description" => $role->description
      ]);
    }
  }
}
