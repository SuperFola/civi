<?php
$user = $UserManager->findUser($_SESSION['id']);

$message = "# " . $user->getPseudo() . "\n\n" .
    "**E-Mail**: " . $user->getEmail() . "\n\n" .
    "**Âge**: " . $user->getAge() . "\n\n" .
    "**Date d'inscription**: " . $user->getDisplayableDate($user->getTimestampCreation()) . "\n\n" .
    "**Dernière connexion**: " . $user->getLastLogin() . "\n\n" .
    "\n\n\n\n" .
    "## Biographie\n\n" .
    $user->getBio()
    ;

// affichage des compétences
$competences = $user->getCompetences();
if (!isset($competences["empty"])) {
    $message .= "## Compétences\n\n";
    
    foreach ($competences as $key => $value) {
        $model = '<div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="%value%" aria-valuemin="0" aria-valuemax="100" style="width: %value%%"><span class="sr-only">%value%% Complete (success)</span></div></div>';
        $message .= $key . "" . str_replace("%value%", $value, $model);
    }
}

$message .= "## Informations supplémentaires\n\n" . str_replace("\n", "\n\n", $user->getContenuSup());

echo $Parsedown->text($message);
?>