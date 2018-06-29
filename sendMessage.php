<?php
    session_start();

    require "./UserManager.php"; $UserManager = new UserManager();  // pour avoir accès à la base de données utilisateurs

    if (isset($_SESSION['id']) && isset($_POST) && isset($_POST["recipient"]) && isset($_POST["content"]) && isset($_POST["title"])) {
        $u = $UserManager->findUserByPseudo($_POST["recipient"]);
        if ($u != null) {
            $u->sendMessage(time(), htmlspecialchars($_POST["title"]), $UserManager->findUserByPseudo($_SESSION['name']), htmlspecialchars($_POST["content"]));
            $UserManager->editUser($u)->updateUsers();
        } else {
            $_SESSION['error'] = "## Erreur\nImpossible de trouver le destinataire";
        }
    } else {
        $_SESSION['error'] = "## Erreur\nLe message n'a pu être envoyé";
    }

    header("Location: index.php?view=messageModal");
    exit();
?>
