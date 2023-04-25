@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">

    <div class="col-12 col-md-10 col-xl-10">
      @include('partials.session_success')

      <div class="card">
        <div class="card-header">{{ __('Lista utenti') }}</div>

        <div class="card-body">
          @php
            $filters = Request::query("filters") ?? [];
            $hasFilters = $filters ? count($filters) > 0 : false;
          @endphp

          {{-- Filters --}}
          <div
              class="accordion accordion-flush {{ !$hasFilters ? 'mb-4' : 'mb-3'  }}"
              id="accordionFilters">
            <div class="accordion-item">
              <h2 class="accordion-header" id="filters-headingOne">
                <button
                    class="accordion-button {{$hasFilters ? '' : 'collapsed'}}"
                    type="button" data-bs-toggle="collapse"
                    data-bs-target="#filters-collapseOne"
                    aria-expanded="{{$hasFilters}}"
                    aria-controls="filters-collapseOne">
                  Filtri
                </button>
              </h2>

              <div id="filters-collapseOne"
                   class="accordion-collapse collapse {{$hasFilters ? 'show': ''}}"
                   aria-labelledby="filters-headingOne"
                   data-bs-parent="#accordionFilters">
                <div class="accordion-body">
                  <form action="" class="row">
                    <div class="col-6">

                      @include("partials.form_input", [
                      "label" => "Nome / Cognome",
                      "name" => "filters[name]",
                      "value" => $filters ? $filters['name'] : ''
                      ])

                      @include("partials.form_input", [
                      "label" => "Email",
                      "name" => "filters[email]",
                      "value" => $filters ? $filters['email'] : ''
                      ])
                    </div>

                    <div class="col-6">
                      @include("partials.form_select", [
                        "label" => "Ruoli",
                        "name" => "filters[roles]",
                        "value" => $filters && key_exists("roles", $filters) ? $filters['roles'] : '',
                        "multiple" => true,
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
                      "name" => "filters[apps]",
                      "value" => $filters && key_exists("apps", $filters) ? $filters['apps'] : '',
                      "multiple" => true,
                      "options" => $apps,
                      "optionsKey" => "code",
                      "optionsText" => [
                      "fn" => function ($app) {
                      return $app->code . " - " . $app->description;
                      }
                      ]
                      ])

                    </div>

                    <div class=" d-flex">
                      <a href="{{route('users.index')}}" class="btn btn-outline-secondary me-3"
                         type="reset">Svuota</a>
                      <button class="btn btn-success" type="submit">Filtra</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          @if($hasFilters)
            <div class="alert alert-info mb-4">
              Risultati trovati: {{ $users->total() }}
            </div>
          @endif

          {{-- Data Table --}}
          <table class="table table-striped">
            <thead>
            <tr>
              <th scope="col">Utente</th>
              <th scope="col">Ruoli</th>
              <th scope="col">App attive</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
              <tr>
                <th scope="row">
                  {{$user->firstName}} {{$user->lastName}}
                  <br>
                  <small>{{$user->email}}</small>
                </th>
                <td>
                  {{ $user->roles ? join(", ", $user->roles) : ''}}</td>
                <td>{{$user->apps ? join(", ", $user->apps) : ''}}</td>
                <td>
                  <a href="{{route('users.edit', $user->_id)}}"
                     class="btn btn-link"><i class="fas fa-edit"></i></a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>

          @include('partials.pagination', ["data" => $users])

        </div>
      </div>
    </div>
  </div>
@endsection
