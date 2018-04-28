<?php
session_start();

if (!isset($_POST) or !isset($_POST["text"])) {
    header("Location: index.php?view=search-error");
    exit();
} else {
    $research = htmlspecialchars($_POST["text"]);
    
    // en fonction de la recherche, rediriger sur viewprofile.php?PARAMS (ou index.php?view=search-error en cas d'échec)
    $_SESSION['search'] = "contenu markdown de la recherche";
    
    header("Location: index.php?view=search");
    exit();
}
?>