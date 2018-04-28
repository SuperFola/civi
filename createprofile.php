<?php
session_start();

if (!isset($_POST['username']) and !isset($_POST['pass-1']) and !isset($_POST['pass-2']) and !isset($_POST['email'])) {
    if (isset($_SESSION['id'])) {
        $_SESSION['error'] = "## Erreur\nImpossible de créer un nouveau compte si vous êtes déjà connecté !\nSi c'est bien ce que vous souhaitiez faire, vous pouvez vous [déconnecter](disconnect.php) ;-)";
    }

    // redirection sur index.php, cette page sert uniquement à avoir des URL plus jolies à écrire
    header("Location: index.php?view=createprofile");
    exit();
} else {
    // si on est là c'est que les mots de passe correspondent car un petit code JS l'a vérifié
    require "UserManager.php"; $UserManager = new UserManager();  // pour avoir accès à la base de données utilisateurs
    
    $name = (isset($_POST['username'])) ? htmlspecialchars($_POST['username']) : null;
    $pass = (isset($_POST['pass-1'])) ? htmlspecialchars($_POST["pass-1"]) : null;
    $confirm = (isset($_POST['pass-2']) and $pass != null) ? true : false;
    $email = (isset($_POST['email'])) ? $_POST['email'] : "";
    
    if ($name != null and $email != "" and $confirm) {
        $user = new User();
        $user->handlePostRequest($name, $pass, $email, 'USER');
        $user->setActivated(true);
        
        /*
        Pour envoyer le lien d'activation par email on pourra utiliser ce code : (et donc enlever le setActivated(true) sur l'utilisateur)
        
        $user->setKey($user->getId() . "--" . md5(uniqid(rand(), true)));
        $message = "Bienvenue sur CV.com, " . $name . " !\r\n" .
                   "Nous avez bien été inscrit sur notre site, et il ne vous reste plus qu'une étape à compléter avant de pouvoir rejoindre nos membres !\r\n" .
                   "Pour valider votre compte, il vous suffit de suivre ce lien : https://cv.com/valid.php?key=" . $user->getKey();
        $headers = 'From: cv@truc.org' . "\r\n" .
                   'Reply-To: cv@truc.org' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();
        mail($email, 'Inscription sur CV.com', wordwrap($message, 70, "\r\n"), $headers);
        */
        
        $UserManager->addUser($user);
        $UserManager->updateUsers();
        
        // connecter l'utilisateur en même temps
        $_SESSION['name'] = $name;
        $_SESSION['id'] = $user->getId();
    } else {
        $_SESSION['error'] = "## Erreur\nImpossible de créer le compte";
    }
    
    header("Location: editaccount.php");
    exit();
}
?>