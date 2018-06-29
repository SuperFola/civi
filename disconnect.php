<?php
session_start();

if (isset($_SESSION['id'])) {
    // derniers petits réglages avant de déconnecter l'utilisateur
    require "UserManager.php"; $UserManager = new UserManager();  // pour avoir accès à la base de données utilisateurs
    $u = $UserManager->findUser($_SESSION['id']);
    if ($u != null) {
        $u->setLastLogin(time());
        $UserManager->editUser($u);
        $UserManager->updateUsers();
    }
    // suppression de l'identifiant dans la variable de session qui indiquait que l'utilisateur était connecté
    unset($_SESSION['id']);
}

header("Location: index.php?view=disconnected");
exit();
?>