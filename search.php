<?php
session_start();

require "./config.php";

if (!isset($_GET) or !isset($_GET["q"])) {
    header("Location: index.php?view=search-error");
    exit();
} else {
    require "./UserManager.php"; $UserManager = new UserManager();  // pour avoir accès à la base de données utilisateurs
    
    $research = htmlspecialchars($_GET["q"]);
    $results = array();
    
    // on ajoute tous les utilisateurs qui match la recherche dans les résultats
    foreach ($UserManager->findAll() as $user) {
        if (preg_match('/' . $research . '/', $user->getCompactData()) == 1) {
            $results[] = $user;
        }
    }
    
    $_SESSION['search-head'] = "<h2 style='display:inline-block'>";
    if (count($results) > 1)
        $_SESSION['search-head'] .= count($results) . " résultats";
    else
        $_SESSION['search-head'] .= count($results) . " résultat";
    $_SESSION['search-head'] .= "</h2><span onclick='copyToClipboard(\"" . $SITE_ADRESSE . "/search.php?q=" . $research . "\")' class=\"glyphicon glyphicon-share\" style='float:right' aria-hidden=\"true\"></span><br><br>";
    $_SESSION['search'] = "\n\n----\n\n";
    
    foreach ($results as $user) {
        $_SESSION['search'] .= "<a href=\"viewprofile.php?profile=" . htmlentities($user->getPseudo()) . "\">" . $user->getPseudo() . "</a>\n\n";
        $_SESSION['search'] .= "*" . $user->getAge() . " ans, " . $user->getEmail() . "*\n\n";
        $_SESSION['search'] .= str_replace("# ", "## ", $user->getBio()) . "\n\n----\n\n";
    }
    
    header("Location: index.php?view=search");
    exit();
}
?>