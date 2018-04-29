<?php
$user = $UserManager->findUser($_SESSION['id']);

if ($user != null) {
    $message = "# " . $user->getPseudo() . "\n\n" .
        "**E-Mail**: " . $user->getEmail() . "\n\n" .
        "**Âge**: " . $user->getAge() . "\n\n" .
        "**Date d'inscription**: " . $user->getDisplayableDate($user->getTimestampCreation()) . "\n\n" .
        "**Dernière connexion**: " . $user->getLastLogin() . "\n\n" .
        "\n\n\n\n" .
        "## Biographie\n\n" .
        $user->getBio()
        ;

    echo $Parsedown->text($message);

    // affichage des compétences
    $competences = $user->getCompetences();
    if (!isset($competences["empty"])) {
        echo $Parsedown->text("## Compétences");
        
        foreach ($competences as $key => $value) {
            $model = '<div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="%value%" aria-valuemin="0" aria-valuemax="100" style="width: %value%%"><span class="sr-only">%value%% Complete (success)</span></div></div>';
            
            echo $Parsedown->text("**" . $key . "**");
            echo str_replace("%value%", $value * 20, $model);
        }
    }

    $message = "## Informations supplémentaires\n\n" . $user->getContenuSup();
    echo $Parsedown->text($message);
} else {
    echo $Parsedown->text("## Erreur\n\nL'utilisateur n'existe pas");
}
?>