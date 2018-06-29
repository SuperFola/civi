<div class="modal fade" id="nouveauMessageModal" tabindex="-1" role="dialog" aria-labelledby="nouveauMessageModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title inline" id="nouveauMessageModalLabel">Rédiger un nouveau message</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="sendMessage.php">
        <div class="modal-body">
          <div class="form-group">
            <label for="recipient">Destinataire</label>
            <input class="form-control" type="text" name="recipient" id="recipient" />
          </div>
          <div class="form-group">
            <label for="title">Titre</label>
            <input class="form-control" type="text" name="title" id="title" />
          </div>
          <div class="form-group">
            <label for="content">Message</label>
            <textarea class="form-control" row="10" name="content" id="content"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Envoyer</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        </div>
      </form>
    </div>
  </div>
</div>
