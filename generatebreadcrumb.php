<?php
    /* function generateBreadCrumb
     * $parsed array("key" => "value")
     * génère un breadcrumb bootstrap en fonction de la vue actuelle que l'on récupère dans $parsed
     */
    function generateBreadCrumb($parsed) {
        echo "<ol class=\"breadcrumb\">";
        if (empty($parsed)) {
            echo "<li class=\"active\">Home</li>";
        } else {
            echo "<li><a href=\"#\">Home</a></li>";
            echo "<li><a href=\"#\">Library</a></li>";
            echo "<li class=\"active\">Data</li>";
        }
        echo "</ol>";
    }
?>