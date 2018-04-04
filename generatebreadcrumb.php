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
            echo "<li><a href=\"index.php\">Accueil</a></li>";
            echo "<li><a href=\"?view=TEST1\">TEST1</a></li>";
            echo "<li class=\"active\">TEST2</li>";
        }
        echo "</ol>";
    }
?>