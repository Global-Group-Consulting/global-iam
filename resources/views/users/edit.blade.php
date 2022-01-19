@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">

    <div class="col-12 col-md-10 col-xl-10">
      @include('partials.session_success')

      <div class="card">
        <div class="card-header">{{ __('Lista utenti') }}</div>

        <div class="card-body">
          <form action="{{ route('users.update', $user->_id) }}" method="POST">
            @csrf
            @method('patch')

            <div class="row">
              <div class="col-md-6">
                @include("partials.form_input", [
                  "label" => "Nome",
                  "name" => "firstName",
                  "value" => $user->firstName
                ])

                @include("partials.form_input", [
                  "label" => "Cognome",
                  "name" => "lastName",
                  "value" => $user->lastName
                ])

                @include("partials.form_input", [
                  "label" => "Email",
                  "name" => "email",
                  "value" => $user->email
                ])
              </div>

              <div class="col-md-6">
                @include("partials.form_select", [
                  "label" => "Ruoli",
                  "name" => "roles",
                  "value" => $user->roles,
                  "multiple" => true,
                  "size" => 3,
                  "options" => $roles,
                  "optionsKey" => "code",
                  "optionsText" => [
                    "fn" => function ($role) {
                      return $role->code . " - " . $role->description;
                    }
                  ]
                ])

                @include("partials.form_select", [
                  "label" => "App attive",
                  "name" => "apps",
                  "value" => $user->apps,
                  "multiple" => true,
                  "size" => 3,
                  "options" => $apps,
                  "optionsKey" => "code",
                  "optionsText" => [
                    "fn" => function ($app) {
                      return $app->code . " - " . $app->description;
                    }
                  ]
                ])
              </div>
            </div>

            <div class=" d-flex">
              <a href="{{route('users.index')}}" class="btn btn-outline-secondary me-3"
                 type="reset">Annulla</a>
              <button class="btn btn-success" type="submit">Salva</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
