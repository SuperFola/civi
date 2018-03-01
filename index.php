<!doctype html:5>
<html>
    <?php require "entete.php"; ?>
    <body>
    <!-- on va utiliser une fonction pour parser le $_GET et savoir quoi afficher -->
    <?php require "parseparameters.php"; ?>
        <div class="container-fluid">
            <?php
                if (isset($_GET)) {
                    // on parse les paramètres
                    $parsed = parseparameters($_GET);
                }
            ?>
        </div>
    </body>
</html>