    <div class="modal fade" id="messagesModal" tabindex="-1" role="dialog" aria-labelledby="messagesModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title inline" id="messagesModalLabel">Messagerie</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
<?php
    $u = $UserManager->findUserByPseudo($_SESSION['name']);
    if ($u != null) {
        if ($u->getUnreadMessages() > 0) {
            if ($u->getUnreadMessages() > 1) {
                echo "<h4>Nouveaux messages</h4>";
            } else if ($u->getUnreadMessages() == 1) {
                echo "<h4>Nouveau message</h4>";
            }

            $i = 0;
            foreach ($u->getArrayOfMessages() as $msg) {
                if ($i >= count($u->getArrayOfMessages()) - $u->getUnreadMessages() && is_array($msg)) {
                    echo "<div class='inline'>";
                        echo $Parsedown->text("**" . $msg["title"] . "**, de : " . $msg["from"]->getPseudo() . "\n");
                    echo "</div>";
                    $content = htmlspecialchars($u->formatMessageToMarkdown($i));
                    echo "<button type='button' class='btn btn-xs btn-primary inline margin-left-10px' data-toggle='modal' data-target='#lireMessage' data-whatever='$content'>Lire</button>";
                    echo "<a href='index.php?view=markMessageAsRead&idx=$i' class='close inline'><span aria-hidden='true'>&times;</span></a><hr>";
                }
                $i++;
            }
        }

        echo "<h4>Anciens messages</h4>";
        $i = 0; $d = 0;
        foreach ($u->getArrayOfMessages() as $msg) {
            if ($i < count($u->getArrayOfMessages()) - $u->getUnreadMessages() && is_array($msg)) {
                echo "<b>" . $msg["title"] . "</b>, de : " . $msg["from"]->getPseudo() . "<br>";
                $d++;
            }
            $i++;
        }

        if ($d == 0)
            echo "Aucun message archivé";
    }
?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nouveauMessageModal">Nouveau message</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          </div>
        </div>
      </div>
    </div>
