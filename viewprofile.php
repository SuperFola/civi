<?php
session_start();

require "UserManager.php"; $UserManager = new UserManager();  // pour avoir accès à la base de données utilisateurs

if (isset($_GET["profile"]) and $UserManager->findUserByPseudo($_GET['profile']) != null) {
    $_SESSION['viewingprofileof'] = htmlspecialchars($_GET['profile']);
} else {
    $_SESSION['error'] = "## Erreur\nImpossible de trouver le profil demandé : ";
    
    // complétion du message d'erreur
    if (isset($_GET['profile']))
        $_SESSION['error'] .= "**" . htmlspecialchars($_GET['profile']) . "**";
    else
        $_SESSION['error'] .= "aucun profil n'a été fourni";
}

header("Location: index.php?view=viewprofile");
exit();
?>