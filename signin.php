<?php
session_start();

if (!isset($_POST)) {
    // permet uniquement d'avoir une URL plus jolie à écrire
    // vérifie tout de même si l'utilisateur est déjà connecté ou non

    if (isset($_SESSION['id'])) {
        $_SESSION['error'] = "## Erreur\nImpossible de se connecter, puisque vous l'êtes déjà ! :-P";
    }

    header("Location: index.php?view=signin");
    exit();
} else {
    require "UserManager.php"; $UserManager = new UserManager();  // pour avoir accès à la base de données utilisateurs
    
    $name = (isset($_POST['username'])) ? htmlspecialchars($_POST['username']) : null;
    $user = $UserManager->findUserByPseudo($name);
    
    if ($user != null) {
        $pass = (isset($_POST['password'])) ? htmlspecialchars($_POST['password']) : "";
        if ($user->checkLogin($pass)) {
            $_SESSION['id'] = $user->getId();
            $_SESSION['name'] = $user->getPseudo();
        } else {
            $_SESSION['error'] = "## Erreur\nLe nom d'utilisateur ou le mot de passe est incorrect";
        }
    } else {
        $_SESSION['error'] = "## Erreur\nLe nom d'utilisateur ou le mot de passe est incorrect";
    }
    
    header("Location: index.php");
    exit();
}
?>