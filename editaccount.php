<?php
session_start();

if (!isset($_POST)) {
    // redirection sur index.php : cette page permet d'avoir de plus jolies URL mais vérifie également que l'utilisateur est connecté
    // pour éviter de bêtes erreurs 403 ou même éviter de causer une 500
    if (!isset($_SESSION['id'])) {
        $_SESSION['error'] = "## Erreur\nImpossible d'éditer un profil qui n'existe pas !\nPourquoi ne pas aller [créer un compte](createprofile.php) ?";
    }

    header("Location: index.php?view=editaccount");
    exit();
} else {
    
    
    header("Location: index.php");
    exit();
}
?>