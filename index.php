<?php session_start(); ?>
<!doctype html>
<html>
<?php require "entete.php"; ?>
    <body>
    <!-- on va utiliser une fonction pour parser le $_GET et savoir quoi afficher -->
<?php
require "Parsedown.php"; $Parsedown = new Parsedown();  // pour parser du markdown en HTML
require "UserManager.php"; $UserManager = new UserManager();  // pour avoir accès à la base de données utilisateurs
require "parseparameters.php";  // pour parser les paramètres GET de la page
require "generatebreadcrumb.php";  // pour générer le "fil d'Ariane"
?>
        <div class="container-fluid">
<?php
require "navbar.php";  // inclus et génère la navbar

if (isset($_GET) && !empty($_GET)) {
    // on parse les paramètres
    $parsed = parseparameters($_GET);
    // et on affiche le fil d'Ariane
    if ($parsed["valid"] == true)
        generateBreadCrumb($parsed);
    else
        generateBreadCrumb(array(), /* focus */ true);
} else {
    // fil d'Ariane par défaut
    generateBreadCrumb(array());
}
?>
<!-- Définition principale avec la gestion des vues -->
<?php if(!isset($parsed) or (isset($parsed["view"]) and $parsed["view"] == "undefined")) { ?>
            <div class="jumbotron">
                <h1>Hello, world !</h1>
                <p>Tu cherches un emploi ? Un stage ? Une école ? Alors ce site est fait pour toi !</p>
                <p><a class="btn btn-primary btn-lg" href="?view=about" role="button">En savoir plus</a></p>
            </div>
    <?php if (isset($parsed["view"]) and $parsed["view"] == "undefined") { ?>
        <div class="alert alert-info" role="alert">
            <a href="#" class="alert-link">Oh snap ! Impossible de trouver la page</a>. <a href="index.php">Retour à la maison</a>
        </div>
    <?php } ?>
<?php } else {
    if ($parsed["view"] == "undefined") {
        echo $Parsedown->text(file_get_contents("./assets/views/undefined"));
    } elseif ($parsed["view"] == "createprofile") {
        if (isset($_SESSION['error'])) {
            echo $Parsedown->text($_SESSION['error']);
            // nettoyage
            unset($_SESSION['error']);
        } else {
            // affichage de la vue pour créer son profil
            require "generateformcreateprofile.php";
        }
    } elseif ($parsed["view"] == "editaccount") {
        if (isset($_SESSION['error'])) {
            echo $Parsedown->text($_SESSION['error']);
            // nettoyage
            unset($_SESSION['error']);
        } else {
            // affichage de la vue pour éditer son profil ------------------------------------------------------------
        }
    } elseif ($parsed["view"] == "search") {
        echo $Parsedown->text($_SESSION['search']);
        // nettoyer la variable de session
        unset($_SESSION['search']);
    } elseif ($parsed["view"] == "viewprofile") {
        if (isset($_SESSION["error"])) {
            echo $Parsedown->text($_SESSION['error']);
            // nettoyage de la variable de session error
            unset($_SESSION['error']);
        } else {
            // affichage du profil demandé --------------------------------------------------------------------------
            
            // nettoyage
            unset($_SESSION['viewingprofileof']);
        }
    } elseif ($parsed["view"] == "about") {
        echo $Parsedown->text(file_get_contents("./assets/views/about"));
    } else if ($parsed["view"] == "search-error") {
        echo "Impossible de trouver ce que vous cherchez, une équipe de chimpanzés sur-entrainés a probablement trouvé avant vous ce que vous cherchiez :(";
    } else if ($parsed["view"] == "disconnect") {
        if (isset($_SESSION['error'])) {
            echo $Parsedown->text($_SESSION['error']);
            // nettoyage
            unset($_SESSION['error']);
        } else {
            // affichage de la vue de déconnexion
            echo $Parsedown->text(file_get_contents("./assets/views/disconnect"));
        }
    } else if ($parsed["view"] == "signin") {
        if (isset($_SESSION['error'])) {
            echo $Parsedown->text($_SESSION['error']);
            // nettoyage
            unset($_SESSION['error']);
        } else {
            // affichage de la vue pour se connecter
?>
        <form method="POST" action="signin.php">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Nom Prénom</span>
                <input id="username" type="text" class="form-control" placeholder="Dupont Jean" aria-describedby="basic-addon1">
            </div>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">Mot de passe</span>
                <input id="password" type="password" class="form-control" placeholder="******" aria-describedby="basic-addon3">
            </div>
            <button type="submit" class="btn btn-default">Valider</button>
        </form>
<?php
        }
    } else { ?>
        <script type="text/javascript">window.location.replace("index.php?view=undefined");</script>
    <?php } ?>
<?php } ?>
        </div>
    </body>
</html>