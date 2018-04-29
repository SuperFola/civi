        <h1>Édition du profil</h1>
        <i>La rédaction du mini Curriculum Vitae et du paragraphe "Contenu supplémentaire" au format Markdown est supportée</i>
        <?php $u = $UserManager->findUser($_SESSION['id']); ?>
        <form method="post" action="editaccount.php">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">E-Mail</span>
                <input name="editemail" type="email" class="form-control" placeholder="jean.dupont@exemple.com" aria-describedby="basic-addon1" value="<?php if ($u != null) echo $u->getEmail() ?>">
            </div>
            <br>
            <div class="row">
                <div class="col-md-9">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon2">Curriculum Vitae</span>
                        <textarea name="editbio" id="editbio" type="text" rows="5" maxlength="500" onKeyDown="textCounter(this, 'maxsize', 500)" onKeyUp="textCounter(this, 'maxsize', 500)" class="form-control" placeholder="Votre biographie ici (500 caractères maximum)" aria-describedby="basic-addon2"><?php if ($u != null) echo $u->getBio(); ?></textarea>
                    </div>
                </div>
                <div class="col-md-3 text-right">
                    <input type="button" id="maxsize" size="3" maxsize="3" class="btn btn-primary" readonly value="<?php if ($u != null) { echo 500-strlen($u->getBio()); } else { echo "500"; } ?>">
                </div>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">Contenu supplémentaire</span>
                <textarea name="editcontenusup" type="text" rows="5" class="form-control" placeholder="..." aria-describedby="basic-addon3"><?php if ($u != null) echo $u->getContenuSup() ?></textarea>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon4">Année de naissance</span>
                <input name="edityearofbirth" type="number" class="form-control" min="1900" aria-describedby="basic-addon4" value="<?php if ($u != null) echo $u->getYearOfBirth() ?>">
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