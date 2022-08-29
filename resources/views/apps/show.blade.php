@extends("layouts.app")

@section("content")
  <div class="row justify-content-center">
    <div class="col-12 col-md-10 col-xl-10">
      <div class="card">
        <div class="card-header">{{ __('Dettagli App') }}</div>

        <div class="card-body">
          <div class="row">
            <div class="col">
              <strong>Codice</strong>: {{$app["code"]}}
            </div>
            <div class="col">
              <strong>Descrizione</strong>: {{$app["description"]}}
            </div>
          </div>
          <div class="row">
            <div class="col">
              <strong>Mittente email</strong>: {{$app["emailsFrom"]}}
            </div>

          </div>

          <div class="row">
            <div class="col">
              <h5 class="mt-3 mb-0">Client Keys
                <button class="btn btn-link" data-bs-toggle="modal"
                        data-bs-target="#refreshAppSecrets"
                        data-bs-code="client">
                  <i class="fas fa-sync"></i>
                </button>
              </h5>
              <strong>Client public</strong>: {{$app["secrets"]["client"]["publicKey"] ?? null}}<br>
              <strong>Client secret</strong>: {{$app["secrets"]["client"]["secretKey"] ?? null}}<br>
            </div>
            <div class="col">
              <h5 class="mt-3 mb-0">Server Keys
                <button class="btn btn-link" data-bs-toggle="modal"
                        data-bs-target="#refreshAppSecrets"
                        data-bs-code="server">
                  <i class="fas fa-sync"></i>
                </button></h5>
              <strong>Server secret</strong>: {{$app["secrets"]["server"]["secretKey"] ?? null}}<br>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include("partials.modals.refreshAppSecrets", [
    "action" => route("apps.keys_refresh", ["app" => $app->_id, "code"=>"_code"])
  ])
@endsection
