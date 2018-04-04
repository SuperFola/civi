<?php
    if (!isset($_POST) || !isset($_POST["text"])) {
        header("Location: index.php?view=search-error");
        exit();
    }
?>