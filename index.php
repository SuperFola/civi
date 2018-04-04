<?php session_start(); ?>
<!doctype html>
<html>
<?php require "entete.php"; ?>
    <body>
    <!-- on va utiliser une fonction pour parser le $_GET et savoir quoi afficher -->
<?php
require "parseparameters.php";  // pour parser les paramètres GET de la page
require "generatebreadcrumb.php";  // pour générer le "fil d'Ariane"
require "Parsedown.php"; $Parsedown = new Parsedown();  // pour parser du markdown en HTML
require "UserManager.php"; $UserManager = new UserManager();  // pour avoir accès à la base de données utilisateurs
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

    } elseif ($parsed["view"] == "createprofile") {
        echo $Parsedown->text("content ~~right~~ **there** *nigga*");
    } elseif ($parsed["view"] == "editaccount") {

    } elseif ($parsed["view"] == "search") {

    } elseif ($parsed["view"] == "viewprofile") {

    } elseif ($parsed["view"] == "about") {

    } else if ($parsed["view"] == "search-error") {
        echo "Impossible de trouver ce que vous cherchez, une équipe de chimpanzés sur-entrainés a probablement trouvé avant vous ce que vous cherchiez :(";
    } else { ?>
        <script type="text/javascript">window.location.replace("index.php?view=undefined");</script>
    <?php } ?>
<?php } ?>
        </div>
    </body>
</html>