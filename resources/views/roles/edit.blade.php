@extends("layouts.app")

@section("content")
  <div class="row justify-content-center">
    <div class="col-12 col-md-10 col-xl-10">
      <div class="card ">
        <div class="card-header">{{ __('Modifica Ruolo') }}</div>

        <div class="card-body">
          <form action="{{route("roles.update", $role->_id)}}" method="POST">
            @csrf
            @method("patch")

            <div class="row">
              <div class="col">
                @include("partials.form_input", [
                  "label" => "Codice",
                  "name" => "code",
                  "value" => $role["code"]
                ])
              </div>
              <div class="col">
                @include("partials.form_input", [
                  "label" => "Descrizione",
                  "name" => "description",
                  "value" => $role["description"]
                ])
              </div>
            </div>

            <div class="row">
              <div class="col">
                @include("partials.form_select", [
                  "label" => "Permessi associati",
                  "name" => "permissions",
                  "value" => $role["permissions"],
                  "multiple" => true,
                  "size" => 5,
                  "options" => $permissions,
                  "optionsKey" => "code",
                  "optionsText" => [
                    "fn" => function ($permission) {
                      return $permission->code ;
                    }
                  ]
                ])
              </div>
            </div>

            <div class=" d-flex">
              <a href="{{route('roles.index')}}" class="btn btn-outline-secondary me-3"
                 type="reset">Annulla</a>
              <button class="btn btn-success" type="submit">Crea</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
