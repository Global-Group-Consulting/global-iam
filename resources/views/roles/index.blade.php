@extends("layouts.app")

@section("content")
  <div class="row justify-content-center">

    <div class="col-12 col-md-10 col-xl-10">

      <ul class="nav mb-4 justify-content-center">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('roles.create')}}">
            <i class="fas fa-plus"></i>
            Aggiungi</a>
        </li>
      </ul>

      @include('partials.session_success')

      <div class="card">
        <div class="card-header">{{ __('Lista Ruoli disponibili') }}</div>

        <div class="card-body">
          {{-- Data Table --}}
          <table class="table table-striped">
            <thead>
            <tr>
              <th scope="col">Codice</th>
              <th scope="col">Permessi</th>
              <th scope="col">Descrizione</th>
              <th scope="col">Utenti</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
              <tr>
                <th scope="row">
                  {{$role["code"]}}
                </th>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" type="button"
                            id="dd_permissions_{{$role->_id}}" data-bs-toggle="dropdown"
                            aria-expanded="false">
                      Mostra
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dd_permissions_{{$role->_id}}"
                        style="max-height: 250px; overflow: auto">
                      @php
                        $permissions = $role->permissions;

                        sort($permissions)
                      @endphp

                      @foreach($permissions as $permission)
                        <li>
                          <a class="dropdown-item" href="{{route('permissions.find', $permission)}}"
                             target="_blank">
                            {{$permission}}
                          </a>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </td>
                <td>{{$role->description}}</td>
                <td>{{$role->users->count()}}</td>
                <td>
                  <a href="{{route('roles.edit', $role->_id)}}" class="btn btn-link">
                    <i class="fas fa-edit"></i>
                  </a>
                  <button class="btn btn-link text-danger" data-bs-toggle="modal"
                          data-bs-target="#deleteModal"
                          data-bs-id="{{$role->_id}}">
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
    "action"=> route("roles.destroy", "_id")
  ])
@endsection
