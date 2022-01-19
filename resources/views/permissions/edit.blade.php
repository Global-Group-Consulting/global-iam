@extends("layouts.app")

@section("content")
  <div class="row justify-content-center">
    <div class="col-12 col-md-10 col-xl-10">
      <div class="card">
        <div class="card-header">{{ __('Modifica Permesso') }}</div>

        <div class="card-body">
          <form action="{{route("permissions.update", $permission->_id)}}" method="POST">
            @csrf
            @method("patch")

            <div class="row">
              <div class="col">
                @include("partials.form_input", [
                  "label" => "Codice",
                  "name" => "code",
                  "value" => $permission["code"]
                ])
              </div>
              <div class="col">
                @include("partials.form_input", [
                  "label" => "Descrizione",
                  "name" => "description",
                  "value" => $permission["description"]
                ])
              </div>
            </div>

            <div class=" d-flex">
              <a href="{{route('permissions.index')}}" class="btn btn-outline-secondary me-3"
                 type="reset">Annulla</a>
              <button class="btn btn-success" type="submit">Salva</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
