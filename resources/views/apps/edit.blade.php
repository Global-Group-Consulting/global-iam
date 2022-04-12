@extends("layouts.app")

@section("content")
  <div class="row justify-content-center">


    <div class="col-12 col-md-10 col-xl-10">
      @include("partials.session_error")

      <div class="card">
        <div class="card-header">{{ __('Modifica App') }}</div>

        <div class="card-body">
          <form action="{{route("apps.update", $app->_id)}}" method="POST">
            @csrf
            @method("patch")

            <div class="row">
              <div class="col">
                @include("partials.form_input", [
                  "label" => "Codice",
                  "name" => "code",
                  "value" => $app["code"]
                ])
              </div>
              <div class="col">
                @include("partials.form_input", [
                  "label" => "Descrizione",
                  "name" => "description",
                  "value" => $app["description"]
                ])
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                @include("partials.form_input", [
                  "label" => "Mittente email",
                  "name" => "emailsFrom",
                  "value" => $app["emailsFrom"]
                ])
              </div>
            </div>


            <div class=" d-flex">
              <a href="{{route('apps.index')}}" class="btn btn-outline-secondary me-3"
                 type="reset">Annulla</a>
              <button class="btn btn-success" type="submit">Salva</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
