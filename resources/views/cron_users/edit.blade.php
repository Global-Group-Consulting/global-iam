@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">

    <div class="col-12 col-md-10 col-xl-10">
      @include('partials.session_success')

      <div class="card">
        <div class="card-header">{{ __('Lista utenti') }}</div>

        <div class="card-body">
          @include("cron_users.form.cron_user_form", [
            "form_action"=> route("cron_users.update", $user->_id),
            "form_method"=> "patch",
            "back_action"=> route("cron_users.index"),
            "user" => $user,
            "submit_txt"=> "Salva"
          ])
        </div>
      </div>
    </div>
  </div>
@endsection
