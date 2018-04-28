        <h1>Édition du profil</h1>
        <form method="post" action="editaccount.php">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">E-Mail</span>
                <input name="editemail" type="email" class="form-control" placeholder="jean.dupont@exemple.com" aria-describedby="basic-addon1">
            </div>
            <br>
            <div class="row">
                <div class="col-md-9">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon2">Biographie</span>
                        <textarea name="editbio" id="editbio" type="text" rows="5" maxlength="500" onKeyDown="textCounter(this, 'maxsize', 500)" onKeyUp="textCounter(this, 'maxsize', 500)" class="form-control" placeholder="Votre biographie ici (500 caractères maximum)" aria-describedby="basic-addon2"></textarea>
                    </div>
                </div>
                <div class="col-md-3 text-right">
                    <input type="button" id="maxsize" size="3" maxsize="3" class="btn btn-primary" readonly value="500">
                </div>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">Contenu supplémentaire</span>
                <textarea name="editcontenusup" type="text" rows="5" class="form-control" placeholder="..." aria-describedby="basic-addon3"></textarea>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon4">Année de naissance</span>
                <input name="edityearofbirth" type="number" class="form-control" min="1900" aria-describedby="basic-addon4">
            </div>
            <br>
            <div>
                <h3>Compétences</h3>
                <br>
                <div id="competences-list" onclick="setPOST()"></div>
                <button type="button" class="btn btn-primary btn-lg" onclick="addCompetence()">+</button>
            </div>
            <input type="hidden" name="editcompetences" id="editcompetences">
            <br><br>
            <button class="btn btn-default btn-lg" type="submit">Valider</button>
        </form>