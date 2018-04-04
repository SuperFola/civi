<?php
    if (!isset($_POST) || !isset($_POST["text"])) {
        header("Location: index.php?view=search-error");
        exit();
    } else {
        $research = htmlspecialchars($_POST["text"]);
        // en fonction de la recherche, rediriger sur viewprofile.php?PARAMS (ou index.php?view=search-error en cas d'échec)
    }
?>