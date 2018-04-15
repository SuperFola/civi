<?php
if (isset($_GET["profile"])) {
    $_SESSION['viewingprofileof'] = htmlspecialchars($_GET['profile']);
} else {
    $_SESSION['error'] = "Impossible de trouver le profile demandé";
}
header("Location: index.php?viewprofile");
exit();
?>