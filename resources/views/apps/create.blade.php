@extends("layouts.app")

@section("content")
  <div class="row justify-content-center">

    <div class="col-12 col-md-10 col-xl-10">
      <div class="card">
        <div class="card-header">{{ __('Crea una nuova App') }}</div>

        <div class="card-body">
          <form action="{{route("apps.store")}}" method="POST">
            @csrf

            <div class="row">
              <div class="col">
                @include("partials.form_input", [
                  "label" => "Codice",
                  "name" => "code",
                  "value" => old("code")
                ])
              </div>
              <div class="col">
                @include("partials.form_input", [
                  "label" => "Descrizione",
                  "name" => "description",
                  "value" => old("description")
                ])
              </div>
            </div>

            <div class=" d-flex">
              <a href="{{route('apps.index')}}" class="btn btn-outline-secondary me-3"
                 type="reset">Annulla</a>
              <button class="btn btn-success" type="submit">Crea</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
