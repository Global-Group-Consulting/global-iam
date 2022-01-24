@extends("layouts.app")

@section("content")
  <div class="row justify-content-center">

    <div class="col-12 col-md-10 col-xl-10">

      <ul class="nav mb-4 justify-content-center">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('permissions.create')}}">
            <i class="fas fa-plus"></i>
            Aggiungi</a>
        </li>
      </ul>

      @include('partials.session_success')

      <div class="card">
        <div class="card-header">{{ __('Lista Permessi disponibili') }}</div>

        <div class="card-body">
          {{-- Data Table --}}
          <table class="table table-striped">
            <thead>
            <tr>
              <th scope="col">Codice</th>
              <th scope="col">Descrizione</th>
              <th scope="col">Ruoli</th>
              <th></th>
            </tr>
            </thead>
            <tbody>

            @php
              $lastLetter = ""
            @endphp
            @foreach($permissions as $permission)
              @php
                $currentLetter = substr($permission->code, 0, 1);
                $newLetter = $lastLetter !== $currentLetter;
                $lastLetter = $currentLetter;
              @endphp

              @if($newLetter)
                <tr class="table-warning ">
                  <td colspan="99" class="fw-bolder">{{strtoupper($currentLetter)}}</td>
                </tr>
              @endif

            <tr>
              <th scope="row">
                {{$permission["code"]}}
              </th>
              <td>{{$permission->description}}</td>
              <td>{{$permission->roles->count()}}</td>
              <td class="text-nowrap">
                <a href="{{route('permissions.edit', $permission->_id)}}" class="btn btn-link">
                  <i class="fas fa-edit"></i>
                </a>
                <button class="btn btn-link text-danger" data-bs-toggle="modal"
                        data-bs-target="#deleteModal"
                        data-bs-id="{{$permission->_id}}">
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
    "action"=> route("permissions.destroy", "_id")
  ])
@endsection
