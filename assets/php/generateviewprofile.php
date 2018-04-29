<?php
$user = $UserManager->findUserByPseudo($parsed["profile"]);

if ($user != null) {
    echo "<h1 style='display:inline-block'>" . $user->getPseudo() . "</h1><span onclick='copyToClipboard(\"" . $SITE_ADRESSE . "/viewprofile.php?profile=" . $parsed["profile"] . "\")' class=\"glyphicon glyphicon-share\" style='float:right' aria-hidden=\"true\"></span><br><br>";
    
    $message = "**E-Mail**: " . $user->getEmail() . "\n\n" .
        "**Âge**: " . $user->getAge() . "\n\n" .
        "**Date d'inscription**: " . $user->getDisplayableDate($user->getTimestampCreation()) . "\n\n" .
        "**Dernière connexion**: " . $user->getLastLogin() . "\n\n" .
        "\n\n\n\n" .
        "# Curriculum Vitae\n\n" .
        str_replace("# ", "## ", $user->getBio())
        ;

    echo $Parsedown->text($message);

    // affichage des compétences
    $competences = $user->getCompetences();
    if (!isset($competences["empty"])) {
        echo $Parsedown->text("# Compétences");
        
        echo "<div class='row'>";
        foreach ($competences as $key => $value) {
            $model = '<div class="progress" style="width:70%"><div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="%value%" aria-valuemin="0" aria-valuemax="100" style="width: %value%%"><span class="sr-only">%value%% Complete (success)</span></div></div>';
            
            echo "<div class='col-md-3'>";
            echo $Parsedown->text("**" . $key . "**");
            echo str_replace("%value%", $value * 20, $model);
            echo "</div>";
        }
        echo "</div>";
    }

    $message = "# Informations supplémentaires\n\n" . str_replace("# ", "## ", $user->getContenuSup());
    echo $Parsedown->text($message);
} else {
    echo $Parsedown->text("## Erreur\n\nL'utilisateur n'existe pas");
}
?>