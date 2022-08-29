@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">

    <div class="col-12 col-md-10 col-xl-10">
      @include('partials.session_success')

      <ul class="nav mb-4 justify-content-center">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('cron_users.create')}}">
            <i class="fas fa-plus"></i>
            Aggiungi</a>
        </li>
      </ul>

      <div class="card">
        <div class="card-header">{{ __('Lista CronUsers') }}</div>

        <div class="card-body">

          {{-- Data Table --}}
          <table class="table table-striped">
            <thead>
            <tr>
              <th scope="col">Utente</th>
              <th scope="col">Apps</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
              <tr>
                <td>{{$user->username}}</td>
                <td>{{$user->apps ? join(", ", $user->apps) : ''}}</td>
                <td class="text-end">
                  <a href="{{route('cron_users.edit', $user->_id)}}"
                     class="btn btn-link"><i class="fas fa-edit"></i></a>

                  <button class="btn btn-link text-danger" data-bs-toggle="modal"
                          data-bs-target="#deleteModal"
                          data-bs-id="{{$user->_id}}">
                    <i class="fas fa-trash"></i>
                  </button>


                  <button class="btn btn-link text-danger" data-bs-toggle="modal"
                          data-bs-target="#resetCronUserPassword"
                          data-bs-code="{{$user->_id}}">
                    <i class="fas fa-key"></i>
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
    "action"=> route("cron_users.destroy", "_id")
  ])

  @include("partials.modals.resetCronUserPassword", [
    "action"=> route("cron_users.reset_password", "_code")
  ])
@endsection
