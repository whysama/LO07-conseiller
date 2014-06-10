<!--head-->
<?php require "application/views/ServiceScolarite/layout/head.php"; ?>
<body>
    <!--header-->
    <?php require "application/views/ServiceScolarite/layout/header.php"; ?>
    <div class = "global">
        <!--aside-->
        <?php require "application/views/ServiceScolarite/layout/aside.php"; ?>
        <div class="content">
            <div id="panel">
                <!--添加单一学生-->
                <form class="form" action="<?php echo URL."ServiceScolarite/ETU_ajout"; ?>" method = "POST">
                    <h3>Ajuter un étudiant:</h3>
                    <label>Nom: </label><input class="text-input" type="text" name="nom" value="" required/>
                    <label>Prenom: </label><input class="text-input" type="text" name="prenom" value="" required />
                    <label>Programme: </label>
                        <select name="programme">
                            <option value="TC">TC</option>
                            <option value="ISI">ISI</option>
                            <option value="SM">SM</option>
                            <option value="MTE">MTE</option>
                            <option value="SRT">SRT</option>
                            <option value="SI">SI</option>
                            <option value="CV ING">CV ING</option>
                            <option value="PMOM">PMOM</option>
                            <option value="HC">HC</option>
                        </select>
                    <label>Semestre: </label><input class="text-input" type="text" name="semestre" value="" required />
                    <input class="full" type="submit" name="submit_ETU_ajout" value = "OK" />
                </form>
                <!--添加CSV学生-->
                <form class="form" action="<?php echo URL;?>ServiceScolarite/ETU_ajout_liste" method = "POST" enctype="multipart/form-data">
                    <h3>Ajuter des étudiants par CSV:</h3>
                    <label>CSV:</label>
                    <input type="file" name="csv"/>
                    <input type="submit" name="submit_etu_ajout_liste" value="OK"/>
                </form>
                <!--升级TC学生-->
                <form class="form" action="<?php echo URL."ServiceScolarite/attribution_etudiant_transfert/" ?>" method = "POST">
                    <h3>Transferer les étudiants de TC:</h3>
                    <label>Id de TC:</label>
                    <input class="text-input" type="text" name="id_ETU">
                    <label>Programme:</label>
                    <select name="programme">
                        <option value="ISI">ISI</option>
                        <option value="SM">SM</option>
                        <option value="MTE">MTE</option>
                        <option value="SRT">SRT</option>
                        <option value="SI">SI</option>
                        <option value="CV ING">CV ING</option>
                        <option value="PMOM">PMOM</option>
                        <option value="HC">HC</option>
                    </select>
                    <input type="submit" name="submit_transfert" value="OK">
                </form>
                <!--清空学生-->
                <div class="form">
                    <h3 class="oneline">Vider la table d'étudiants:</h3>
                    <button class="lien"><a href="<?php echo URL."ServiceScolarite/ETU_vide" ?>">Exécuter</a></button>
                </div>
                <!--分配单一学生菜单-->
                <form class="form" action="<?php echo URL."ServiceScolarite/attribution_nouvel_etudiant_form/";?>" method="POST">
                    <h3>Attribution d'un nouvel étudiant:</h3>
                    <label for="id_etu_attr">id_ETU:</label>
                    <input id="id_etu_attr" class="text-input" type="text" name="id_ETU_attr">
                    <input type="submit" name="submit_attr" value="OK">
                </form>
                <!--自动分配剩余学生-->
                <div class="form">
                    <h3 class="oneline">Attribution automatique des nouveaux étudiants:</h3>
                    <button class="lien"><a href="<?php echo URL."ServiceScolarite/attribution_nouveaux_etudiants"?>">Exécuter</a></button>
                </div>
                <!--上拉菜单-->
                <div class="flip">▲</div>
            </div>
            <!--下拉菜单-->
            <div id="f1" class="flip">▼</div>
            <!--表格-->
            <form action="<?php echo URL."ServiceScolarite/" ?>" method = "POST">
                <h3>Visualisation les étudiants par le programme:</h3>
                <select name="programme_select">
                    <option value="all" selected="selected">All</option>
                    <option value="ISI">ISI</option>
                    <option value="SM">SM</option>
                    <option value="MTE">MTE</option>
                    <option value="SRT">SRT</option>
                    <option value="SI">SI</option>
                    <option value="TC">TC</option>
                    <option value="CV ING">CV ING</option>
                    <option value="PMOM">PMOM</option>
                    <option value="HC">HC</option>
                </select>
                <select name="views" >
                    <option value="all" selected="selected">Tous étudiants</option>
                    <option value="sans">Etudians sans conseiller</option>
                </select>
                <input type="submit" name="submit_select" value="OK" />
            </form>
                
            <table>
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nom</td>
                        <td>Prenom</td>
                        <td>Programme</td>
                        <td>Semestre</td>
                        <td>Delete</td>
                        <?php if($flag){ echo "<td>Attribution</td>";} ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($etu as $etu) { ?>
                    <tr>
                        <td><?php if(isset($etu->id_ETU)) echo $etu->id_ETU;  ?></td>
                        <td><?php if(isset($etu->nom)) echo $etu->nom;  ?></td>
                        <td><?php if(isset($etu->prenom)) echo $etu->prenom;  ?></td>
                        <td><?php if(isset($etu->programme)) echo $etu->programme;  ?></td>
                        <td><?php if(isset($etu->semestre)) echo $etu->semestre;  ?></td>
                        <td><a href="<?php echo URL."ServiceScolarite/ETU_suppression/".$etu->id_ETU; ?>">x</a></td>
                        <?php if ($flag): ?>
                                <td><a href="<?php echo URL."ServiceScolarite/attribution_nouvel_etudiant/".$etu->id_ETU ?>">✓</a></td>
                        <?php endif ?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>






















