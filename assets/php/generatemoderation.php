    <h1>Interface d'administration</h1>

    <h2>Profils</h2>

    <p id="profils-lists" class="spoil">
<?php
    echo "<table class='table'>";
        echo "<thead>";
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Username</th>";
                echo "<th>Role</th>";
                echo "<th>Email</th>";
                echo "<th>Last login</th>";
                echo "<th>Action</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        $i = 1;
        foreach ($UserManager->findAll() as $user) {
            echo "<tr>";
                echo "<td>" . $user->getId() . "</td>";
                echo "<td>" . $user->getPseudo() . "</td>";
                echo "<td>" . $user->getRole() . "</td>";
                echo "<td>" . $user->getEmail() . "</td>";
                echo "<td>" . $user->getLastLogin() . "</td>";
                echo "<td><div class=\"dropdown\">";
                echo "<button class=\"btn btn-default dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton$i\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Action <span class=\"caret\"></span></button>";
                echo "<ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton$i\">";
                    echo "<li><a href=\"#\">Voir le profil</a></li>";
                    echo "<li><a href=\"#\">Editer le profil</a></li>";
                    echo "<li role=\"separator\" class=\"divider\"></li>";
                    echo "<li><a href=\"#\">Définir comme recruteur</a></li>";
                    echo "<li role=\"separator\" class=\"divider\"></li>";
                    echo "<li><a href=\"#\">Promouvoir administrateur</a></li>";
                    echo "<li><a href=\"#\">Bannir</a></li>";
                echo "</ul></li></ul></td>";
            echo "</tr>";
            $i++;
        }
        echo "</tbody>";
    echo "</table>";
?>
    </p>
