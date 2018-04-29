<?php
    /* function generateBreadCrumb
     * $parsed array("key" => "value")
     * génère un breadcrumb bootstrap en fonction de la vue actuelle que l'on récupère dans $parsed
     */
    function generateBreadCrumb($parsed, $focus=false) {
        echo "<ol class=\"breadcrumb\">";
        if (empty($parsed)) {
            if (!$focus)
                echo "<li class=\"active\">Accueil</li>";
            else
                echo "<li class=\"active\"><a href=\"index.php\">Accueil</a></li>";
        } else {
            // array("createprofile", "editaccount", "search", "viewprofile", "about", "search-error")
            if ($parsed["view"] == "createprofile") {
                echo "<li><a href=\"index.php\">Accueil</a></li>";
                echo "<li><a href=\"?view=createprofile\">Profil</a></li>";
                echo "<li class=\"active\">Création</li>";
            } else if ($parsed["view"] == "editaccount") {
                echo "<li><a href=\"index.php\">Accueil</a></li>";
                echo "<li><a href=\"?view=editaccount\">Profil</a></li>";
                echo "<li class=\"active\">" . ((isset($_SESSION['name'])) ? $_SESSION['name'] : "Erreur") . "</li>";
            } else if ($parsed["view"] == "search") {
                echo "<li><a href=\"index.php\">Accueil</a></li>";
                echo "<li class=\"active\">Recherche</li>";
            } else if ($parsed["view"] == "viewprofile") {
                echo "<li><a href=\"index.php\">Accueil</a></li>";
                echo "<li><a href=\"viewprofile.php?profile=" . htmlspecialchars($parsed["profile"]) . "\">Profil</a></li>";
                echo "<li class=\"active\">" . htmlspecialchars($parsed["profile"]) . "</li>";
            } else if ($parsed["view"] == "about") {
                echo "<li><a href=\"index.php\">Accueil</a></li>";
                echo "<li class=\"active\">A propos</li>";
            } else if ($parsed["view"] == "disconnected") {
                echo "<li><a href=\"index.php\">Accueil</a></li>";
                echo "<li class=\"active\">Déconnexion</li>";
            } else if ($parsed["view"] == "signin") {
                echo "<li><a href=\"index.php\">Accueil</a></li>";
                echo "<li class=\"active\">Connexion</li>";
            }
        }
        echo "</ol>";
    }
?>