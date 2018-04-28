        <form method="POST" action="createprofile.php">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Nom Prénom</span>
                <input id="username" type="text" class="form-control" placeholder="Dupont Jean" aria-describedby="basic-addon1">
            </div>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon2">e-mail</span>
                <input id="email" type="email" class="form-control" placeholder="jean.dupont@exemple.com" aria-describedby="basic-addon2">
            </div>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">Mot de passe</span>
                <input id="pass-1" type="password" class="form-control" placeholder="******" aria-describedby="basic-addon3">
            </div>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon4">Répéter le mot de passe</span>
                <input id="pass-2" type="password" class="form-control" placeholder="******" aria-describedby="basic-addon4">
            </div>
            <button id="submit-profile" class="btn-default disabled" type="submit" class="btn btn-default">Envoyer</button>
        </form>
        
        <script type="text/javascript" src="./assets/js/passwordCheckingRegister.js"></script>