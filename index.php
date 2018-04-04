<!doctype html:5>
<html>
<?php require "entete.php"; ?>
    <body>
    <!-- on va utiliser une fonction pour parser le $_GET et savoir quoi afficher -->
<?php
require "parseparameters.php";
require "generatebreadcrumb.php";
require "Parsedown.php"; $Parsedown = new Parsedown();
require "UserManager.php"; $UserManager = new UserManager();
?>
        <div class="container-fluid">
<?php
require "navbar.php";

if (isset($_GET) && !empty($_GET)) {
    // on parse les paramètres
    $parsed = parseparameters($_GET);
    if ($parsed["valid"] == true)
        generateBreadCrumb($parsed);
    else
        generateBreadCrumb(array(), /* focus */ true);
} else {
    generateBreadCrumb(array());
}
?>

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