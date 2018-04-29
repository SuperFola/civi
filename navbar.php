    <!-- Page contenant le code de la barre de navigation pour une maintenance plus simple -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">CV.com</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Accueil <span class="sr-only">(current)</span></a></li>
                <!--<li><a href="#">Link</a></li>-->
                <!--<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">One more separated link</a></li>
                </ul>
                </li>-->
            </ul>
            <form class="navbar-form navbar-left" method="GET" action="search.php">
                <div class="form-group">
                    <input name="q" type="text" class="form-control" placeholder="Ex: électricien, informaticien..." />
                </div>
                <button type="submit" class="btn btn-default">Rechercher</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
<?php if (!isset($_SESSION['id'])) { ?>
                <li><a href="createprofile.php">Inscription</a></li>
                <li><a href="signin.php">Connexion</a></li>
<?php } else { ?>
                <!--<li><a href="disconnect.php">Déconnexion</a></li>-->
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['name'] ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="viewprofile.php?profile=<?php echo $_SESSION['name'] ?>">Mon profil</a></li>
                    <li><a href="editaccount.php">Éditer mon profil</a></li>
                    <!--<li><a href="#">Something else here</a></li>-->
                    <li role="separator" class="divider"></li>
                    <li><a href="disconnect.php">Déconnexion</a></li>
                </ul>
                </li>
<?php } ?>
            </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>