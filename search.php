<?php
session_start();

if (!isset($_POST) or !isset($_POST["text"])) {
    header("Location: index.php?view=search-error");
    exit();
} else {
    require "UserManager.php"; $UserManager = new UserManager();  // pour avoir accès à la base de données utilisateurs
    
    $research = htmlspecialchars($_POST["text"]);
    $results = array();
    
    // on ajoute tous les utilisateurs qui match la recherche dans les résultats
    foreach ($UserManager->findAll() as $user) {
        if (preg_match('/' . $research . '/', $user->getCompactData()) == 1) {
            $results[] = $user;
        }
    }
    
    $_SESSION['search'] = "";
    
    if (count($results) > 1)
        $_SESSION['search'] .= "## " . count($results) . " résultats\n----\n";
    else
        $_SESSION['search'] .= "## " . count($results) . " résultat\n----\n";
    
    foreach ($results as $user) {
        $_SESSION['search'] .= "<a href=\"viewprofile.php?profile=" . htmlentities($user->getPseudo()) . "\">" . $user->getPseudo() . "</a>\n\n";
        $_SESSION['search'] .= "*" . $user->getAge() . " ans, " . $user->getEmail() . "*\n\n";
        $_SESSION['search'] .= str_replace("# ", "## ", $user->getBio()) . "\n\n----\n\n";
    }
    
    header("Location: index.php?view=search");
    exit();
}
?>