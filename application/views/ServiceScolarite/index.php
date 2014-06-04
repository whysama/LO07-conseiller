<head>
    <meta charset="utf-8"/>
    <title></title>
    <link rel="stylesheet" type="text/css" href="public/css/reset.css">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script src="public/js/jquery-2.1.1.js"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery("p#function1").click(function() {
                jQuery("div#part1").show();
                jQuery("div#part2").hide();
                jQuery("div#part3").hide();
            });
            jQuery("p#function2").click(function() {
                jQuery("div#part2").show();
                jQuery("div#part1").hide();
                jQuery("div#part3").hide();
            });
            jQuery("p#function3").click(function() {
                jQuery("div#part3").show();
                jQuery("div#part1").hide();
                jQuery("div#part2").hide();
            });

        });
    </script>
</head>
<body lang="fr">
    <header class="head">

    </header>
    <div class = "global">
        <aside class="sidebar">
            <div class = "profile">
                <img class = "avatar" src="public/img/avatar/img-SS.JPG" alt="Aavatar">
                <p class="job">Service scolarité</p>
            </div>
            <nav>
                <p id="function1">Habilitation</p>
                <p id="function2">Modification</p>
                <p id="function3">Visualisation</p>
            </nav>
        </aside>
        <div class="content">
                    <div id="part1">
                        <!--添加单一学生-->
                        <form action="<?php echo URL."ServiceScolarite/ETU_ajout" ?>" method = "POST">
                            <label>Nom:</label>
                            <input type="text" name="nom" value="" required/>
                            <label>Prenom:</label>
                            <input type="text" name="prenom" value="" required />
                            <label>Programme:</label>
                            <input type="text"name= "programme" value="" required />
                            <label>Semestre:</label>
                            <input type="text" name="semestre" value="" required />
                            <input type="submit" name="submit_ETU_ajout" value = "OK" />
                        </form>
                        <!--添加CSV学生-->
                       <form action="<?php echo URL;?>ServiceScolarite/ETU_ajout_liste" method = "POST" enctype="multipart/form-data">
                            <label>CSV:</label>
                            <input type="file" name="csv"/>
                            <input type="submit" name="submit_etu_ajout_liste" value="OK"/>
                       </form>
                        <!--升级TC学生-->
                        <form action="<?php echo URL."ServiceScolarite/attribution_etudiant_transfert/" ?>" method = "POST">
                            <label>Id de TC:</label>
                            <input type="text" name="id_ETU">
                            <label>Programme:</label>
                            <input type="text" name="programme">
                            <input type="submit" name="submit_transfert" value="OK">
                        </form>
                        <!--清空学生-->
                        <a href="<?php echo URL."ServiceScolarite/ETU_vide" ?>">Vider la table d'étudiants</a>
                         <!--自动分配剩余学生-->
                        <a href="<?php echo URL."ServiceScolarite/attribution_nouveaux_etudiants"?>">Attribution automatique des nouveaux étudiants</a>
                        <!--表格-->
                        <form action="<?php echo URL."ServiceScolarite/" ?>" method = "POST">
                            <select name="programme_select">
                                <option value="all">All</option>
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
                                <option value="all">Tous étudiants</option>
                                <option value="sans">Etudians sans conseiller</option>
                            </select>
                            <input type="submit" name="submit_select" value="OK" />
                        </form>

                       <table>
                        <thead style="background-color:#ddd; font-weight: bold;">
                          <tr>
                            <td>ID</td>
                            <td>Nom</td>
                            <td>Prenom</td>
                            <td>Email</td>
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
                            <td><?php if(isset($etu->email)) echo $etu->email;  ?></td>
                            <td><?php if(isset($etu->programme)) echo $etu->programme;  ?></td>
                            <td><?php if(isset($etu->semestre)) echo $etu->semestre;  ?></td>
                            <td><a href="<?php echo URL."ServiceScolarite/ETU_suppression/".$etu->id_ETU; ?>">x</a></td>
                            <?php if ($flag): ?>
                                    <td><a href="<?php echo URL."ServiceScolarite/attribution_nouvel_etudiant/".$etu->id_ETU ?>">go</a></td>
                            <?php endif ?>
                          </tr>
                        <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <div id="part2">
                        <form action="<?php echo URL."ServiceScolarite/" ?>" method = "POST">
                            <select name="programme_select2">
                                <option value="all">All</option>
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
                            <input type="submit" name="submit_select2" value="OK" />
                        </form>

                        <table>
                        <thead style="background-color:#ddd; font-weight: bold;">
                          <tr>
                            <td>Etudiant</td>
                            <td>Eseignant</td>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($etu2 as $etu) { ?>
                          <tr>
                        <td><?php if(isset($etu->EC_NOM)&&isset($etu->EC_PRENOM)) echo $etu->EC_PRENOM." ".$etu->EC_NOM;  ?></td>
                            <td><?php if(isset($etu->ETU_PRENOM)&&isset($etu->ETU_NOM)) echo $etu->ETU_PRENOM." ".$etu->ETU_NOM;  ?></td>
                          </tr>
                        <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <div id="part3">

                    </div>
        </div>
    </div>
</body>






















