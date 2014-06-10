<!--head-->
<?php require "application/views/DirecteurRH/layout/head.php"; ?>
<body>
    <!--header-->
    <?php require "application/views/DirecteurRH/layout/header.php"; ?>
    <div class = "global">
        <!--aside-->
        <?php require "application/views/DirecteurRH/layout/aside.php"; ?>
        <div class="content">
            <!--添加EC-->
            <form class="form" action="<?php echo URL;?>DirecteurRH/EC_ajout" method = "POST">
                <fieldset>
                    <h3>Ajuter un enseignant-chercheur:</h3>
                    <label for="ec_nom" >Nom:</label>
                        <input class="text-input" id="ec_nom" type="text" name="nom" value="" required/>
                    <label for="ec_prenom">Prénom:</label>
                        <input class="text-input" id="ec_prenom" type="text" name="prenom" value="" required/>
                    <label for="ec_bureau">Bureau:</label>
                        <input class="text-input" id="ec_bureau" type="text" name="bureau" value="" required/>
                    <label for="ec_pole">Pole:</label>
                        <select id="ec_pole"name="pole">
                            <option value="P2MN">P2MN</option>
                            <option value="ROSAS">ROSAS</option>
                            <option value="HETIC">HETIC</option>
                            <option value="SUEL">SUEL</option>
                        </select>
                    <input type="submit" name="submit_ec_ajout" value="OK"/>
                </fieldset>
            </form>
            <!--添加EC.csv-->
            <form class="form" action="<?php echo URL;?>DirecteurRH/EC_ajout_liste" method = "POST" enctype="multipart/form-data">
                <h3>Ajuter des enseignants-chercheurs par CSV:</h3>
                <input class="filePrew" type="file" name="csv"/>
                <input type="submit" name="submit_ec_ajout_liste" value="Upload"/>
            </form>
            <!-- 清空EC -->
            <div class="form">
                <h3 class="oneline">Vider les Enseigant-Chercheur</h3>
                <button class="lien"><a href="<?php echo URL;?>DirecteurRH/EC_vide">Exécuter</a></button>
            </div>
            <!--表格：选择并显示 所有EC或Conseiller -->
            <h3>La liste des enseignants ou des conseillers:</h3>
            <form class="choise" action="<?php echo URL;?>DIrecteurRH/" method = "POST">
                <input type="submit" name="submit_role" value="Enseigants-Chercheurs"/>
                <input type="submit" name="submit_role" value="Conseillers"/>
            </form>
            <table>
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nom</td>
                        <td>Prenom</td>
                        <td>Email</td>
                        <td>Bureau</td>
                        <td>Pole</td>
                        <td>Supprimer</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ec as $ec) { ?>
                    <tr>
                        <td><?php if(isset($ec->id_EC)) echo $ec->id_EC;  ?></td>
                        <td><?php if(isset($ec->nom)) echo $ec->nom;  ?></td>
                        <td><?php if(isset($ec->prenom)) echo $ec->prenom;  ?></td>
                        <td><?php if(isset($ec->email)) echo $ec->email;  ?></td>
                        <td><?php if(isset($ec->bureau)) echo $ec->bureau;  ?></td>
                        <td><?php if(isset($ec->pole)) echo $ec->pole;  ?></td>
                        <td><a href="<?php echo URL.'DirecteurRH/EC_suppression/'.$ec->id_EC;?>">x</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>