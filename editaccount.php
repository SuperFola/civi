<?php
session_start();

if (!isset($_POST['editemail']) and !isset($_POST['editbio']) and !isset($_POST['editcontenusup']) and !isset($_POST['edityearofbirth']) and !isset($_POST['editcompetences'])) {
    // redirection sur index.php : cette page permet d'avoir de plus jolies URL mais vérifie également que l'utilisateur est connecté
    // pour éviter de bêtes erreurs 403 ou même éviter de causer une 500
    if (!isset($_SESSION['id'])) {
        $_SESSION['error'] = "## Erreur\nImpossible d'éditer un profil qui n'existe pas !\nPourquoi ne pas aller [créer un compte](createprofile.php) ?";
    }

    header("Location: index.php?view=editaccount");
    exit();
} else {
    require "UserManager.php"; $UserManager = new UserManager();  // pour avoir accès à la base de données utilisateurs
    
    $user = $UserManager->findUser($_SESSION['id']);
    
    $email = (isset($_POST['editemail'])) ? htmlspecialchars($_POST['editemail']) : null;
    $bio = (isset($_POST['editbio'])) ? htmlspecialchars($_POST['editbio']) : null;
    $contenu_sup = (isset($_POST['editcontenusup'])) ? htmlspecialchars($_POST['editcontenusup']) : null;
    $yearofbirth = (isset($_POST['edityearofbirth'])) ? intval($_POST['edityearofbirth']) : null;
    $competences_data = (isset($_POST['editcompetences'])) ? $_POST['editcompetences'] : null;
    
    if ($competences_data != null) {
        $competences_temp = explode("///", $competences_data);
        $competences_1 = array();
        $competences = array();
        foreach ($competences_temp as $c_t) {
            if (strlen($c_t) != 0 && $c_t != "") {
                $competences_1[] = explode('::', $c_t);
                $competences_1[count($competences_1) - 1][1] = intval($competences_1[count($competences_1) - 1][1]);
            }
        }
        foreach ($competences_1 as $c_1) {
            $competences[$c_1[0]] = $c_1[1];
        }
    }
    
    if ($user != null) {
        if ($email != null)
            $user->setEmail($email);
        if ($bio != null and count($bio) <= 500)
            $user->setBio($bio);
        if ($contenu_sup != null)
            $user->setContenuSup($contenu_sup);
        if ($yearofbirth != null)
            $user->setYearOfBirth($yearofbirth);
        if ($competences_data != null)
            $user->setCompetences($competences);
        $UserManager->editUser($user)->updateUsers();
    }
    
    header("Location: index.php");
    exit();
}
?>