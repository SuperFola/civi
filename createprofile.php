<?php
session_start();

if (!isset($_POST)) {
    if (isset($_SESSION['id'])) {
        $_SESSION['error'] = "## Erreur\nImpossible de créer un nouveau compte si vous êtes déjà connecté !\nSi c'est bien ce que vous souhaitiez faire, vous pouvez vous [déconnecter](disconnect.php) ;-)";
    }

    // redirection sur index.php, cette page sert uniquement à avoir des URL plus jolies à écrire
    header("Location: index.php?view=createprofile");
    exit();
} else {
    require "UserManager.php"; $UserManager = new UserManager();  // pour avoir accès à la base de données utilisateurs
    
    $name = (isset($_POST['username'])) ? htmlspecialchars($_POST['username']) : null;
    $user = $UserManager->findUserByPseudo($name);
    
    /*if ($user != null) {
        $pass = (isset($_POST['password'])) ? htmlspecialchars($_POST['password']) : "";
        if ($user->checkLogin($pass)) {
            $_SESSION['id'] = $user->getId();
            $_SESSION['name'] = $user->getPseudo();
        } else {
            $_SESSION['error'] = "## Erreur\nLe nom d'utilisateur ou le mot de passe est incorrect";
        }
    } else {
        $_SESSION['error'] = "## Erreur\nLe nom d'utilisateur ou le mot de passe est incorrect";
    }*/
    
    header("Location: editaccount.php");
    exit();
}
?>