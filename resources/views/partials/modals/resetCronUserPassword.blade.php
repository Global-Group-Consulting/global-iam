<div class="modal fade" tabindex="-1" id="resetCronUserPassword">
  <div class="modal-dialog">
    <form class="modal-content" action="{{ $action }}" method="post">
      @csrf
      @method('PUT')

      <div class="modal-header">
        <h5 class="modal-title">Ricreare password CronUser?</h5>
      </div>
      <div class="modal-body">
        <p>Sei sicuro di voler creare una nuova password per questo CronUser? L'operazione comporterà il malfunzionamento dei job che usano già questo utente e pertanto dovranno essere aggiornati per usare la nuova password!</p>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
        <button type="submit" class="btn btn-danger">
          Si, ricrea
        </button>
      </div>
    </form>
  </div>
</div>
