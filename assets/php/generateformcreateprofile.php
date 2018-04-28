        <h1>Création d'un nouveau profil</h1>
        <form method="post" action="createprofile.php">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Nom Prénom</span>
                <input name="username" type="text" class="form-control" placeholder="Dupont Jean" aria-describedby="basic-addon1">
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon2">E-Mail</span>
                <input name="email" type="email" class="form-control" placeholder="jean.dupont@exemple.com" aria-describedby="basic-addon2">
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">Mot de passe</span>
                <input id="pass-1" name="pass-1" type="password" class="form-control" placeholder="******" aria-describedby="basic-addon3">
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon4">Répéter le mot de passe</span>
                <input id="pass-2" name="pass-2" type="password" class="form-control" placeholder="******" aria-describedby="basic-addon4">
            </div>
            <br>
            <button id="submit-profile" class="btn btn-warning btn-sm disabled" type="submit">Envoyer</button>
        </form>