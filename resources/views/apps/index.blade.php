@extends("layouts.app")

@section("content")
  <div class="row justify-content-center">

    <div class="col-12 col-md-10 col-xl-10">

      <ul class="nav mb-4 justify-content-center">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('apps.create')}}">
            <i class="fas fa-plus"></i>
            Aggiungi</a>
        </li>
      </ul>

      @include('partials.session_success')

      <div class="card">
        <div class="card-header">{{ __('Lista app disponibili') }}</div>

        <div class="card-body">
          {{-- Data Table --}}
          <table class="table table-striped">
            <thead>
            <tr>
              <th scope="col">Codice</th>
              <th scope="col">Descrizione</th>
              <th scope="col">Utenti</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($apps as $app)
              <tr>
                <th scope="row">
                  {{$app["code"]}}
                </th>
                <td>{{$app->description}}</td>
                <td>{{$app->users->count()}}</td>
                <td>
                  <a href="{{route('apps.edit', $app->_id)}}" class="btn btn-link">
                    <i class="fas fa-edit"></i>
                  </a>
                  <button class="btn btn-link text-danger" data-bs-toggle="modal"
                          data-bs-target="#deleteModal"
                          data-bs-id="{{$app->_id}}">
                    <i class="fas fa-trash"></i>
                  </button>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  @include("partials.modals.delete", [
    "action"=> route("apps.destroy", "_id")
  ])
@endsection
