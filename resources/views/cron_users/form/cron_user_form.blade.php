@php
  if(!isset($user)){
    // create a fake user so that the form can be rendered and work properly
    $user = new \App\Models\CronUser();
  }
@endphp

<form action="{{ $form_action }}" method="POST">
  @csrf
  @method($form_method ?? 'post')

  <div class="row">
    <div class="col-md-6">
      @include("partials.form_input", [
        "label" => "Username",
        "name" => "username",
        "value" => old("username", $user->username)
      ])
    </div>

    <div class="col-md-6">
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
    <a href="{{ $back_action }}"
       class="btn btn-outline-secondary me-3"
       type="reset">Annulla</a>
    <button class="btn btn-success" type="submit">{{  $submit_txt ?? "salva"  }}</button>
  </div>
</form>
