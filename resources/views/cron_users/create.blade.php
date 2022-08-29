@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">

    <div class="col-12 col-md-10 col-xl-10">
      @include('partials.session_success')

      <div class="card">
        <div class="card-header">{{ __('Crea un nuovo CronUser') }}</div>

        <div class="card-body">
          @include("cron_users.form.cron_user_form", [
            "form_action"=> route("cron_users.store"),
            "back_action"=> route("cron_users.index"),
            "submit_txt"=> "Crea e salva"
          ])
        </div>
      </div>
    </div>
  </div>
@endsection
