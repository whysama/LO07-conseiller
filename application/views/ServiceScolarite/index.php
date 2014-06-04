<head>
    <meta charset="utf-8"/>
    <title>Service scolarité - Attribution des conseillers à l'UTT</title>
    <link rel="stylesheet" type="text/css" href="public/css/reset.css">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script src="public/js/jquery-2.1.1.js"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery("a#function1").click(function() {
                jQuery("div#part1").show();
                jQuery("div#part2").hide();
                jQuery("div#part3").hide();
            });
            jQuery("a#function2").click(function() {
                jQuery("div#part2").show();
                jQuery("div#part1").hide();
                jQuery("div#part3").hide();
            });
            jQuery("a#function3").click(function() {
                jQuery("div#part3").show();
                jQuery("div#part1").hide();
                jQuery("div#part2").hide();
            });

        });
    </script>
</head>
<body lang="fr">
    <header class="head">
    <!--新增-->
        <span id="title">
            <a  href="<?php echo URL."ServiceScolarite/"?>">Attribution des conseillers à l'UTT</a>
        </span>
        <span id="logout">
            <a href="<?php echo URL;?>Home/logout">Logout</a>
        </span>
    </header>
    <div class = "global">
        <aside class="sidebar">
            <div class = "profile">
                <img class = "avatar" src="public/img/avatar/img-SS.JPG" alt="Aavatar">
                <p class="job">Service scolarité</p>
            </div>
            <nav>
                <ul>
                    <li class="active" id="nav-1"><a id="function1">Gestion & Attribution</a></li>
                    <li id="nav-2"><a id="function2">Visualisation <br/>Etudiant - conseiller</a></li>
                    <li id="nav-2"><a id="function3">EC & Nombre de ETU</a></li>
                </ul>
            </nav>
        </aside>
        <div class="content">
                    <div id="part1">
                        <!--添加单一学生-->

                        <form id="form1" action="<?php echo URL."ServiceScolarite/ETU_ajout" ?>" method = "POST">
                            <fieldset><legend><p>Ajuter un étudiant:</p></legend>
                                <span class = "first">
                                    <label>Nom:</label>
                                    <input type="text" name="nom" value="" required/>
                                </span>
                                <span>
                                    <label>Prenom:</label>
                                    <input type="text" name="prenom" value="" required />
                                </span>
                                <span>
                                    <label>Programme:</label>
                                    <input type="text"name= "programme" value="" required />
                                </span>
                                <span>
                                    <label>Semestre:</label>
                                    <input type="text" name="semestre" value="" required />
                                </span>
                                <span clsss="submit">
                                    <input type="submit" name="submit_ETU_ajout" value = "OK" />
                                </span>
                            </fieldset>
                        </form>
                        <!--添加CSV学生-->
                       <form id="form2".sub action="<?php echo URL;?>ServiceScolarite/ETU_ajout_liste" method = "POST" enctype="multipart/form-data">
                            <fieldset><legend><p>Ajuter des étudiants par CSV:</p></legend>
                                <span class = "first">
                                    <label>CSV:</label>
                                    <input id="file" type="file" name="csv"/>
                                </span>
                                <span clsss="submit">
                                    <input type="submit" name="submit_etu_ajout_liste" value="OK"/>
                                </span>
                            </fieldset>
                       </form>
                        <!--升级TC学生-->
                        <form id="form3"action="<?php echo URL."ServiceScolarite/attribution_etudiant_transfert/" ?>" method = "POST">
                            <fieldset><legend><p>Transferer les étudiants de TC:</p></legend>
                                <span class = "first">
                                    <label>Id de TC:</label>
                                    <input type="text" name="id_ETU">
                                </span>
                                <span>
                                    <label>Programme:</label>
                                    <input type="text" name="programme">
                                </span>
                                <span clsss="submit">
                                    <input type="submit" name="submit_transfert" value="OK">
                                </span>
                            </fieldset>
                        </form>
                        <!--清空学生-->
                        <div class="lien">
                        <a href="<?php echo URL."ServiceScolarite/ETU_vide" ?>">Vider la table d'étudiants</a>
                        </div>
                         <!--自动分配剩余学生-->
                        <div class="lien">
                        <a href="<?php echo URL."ServiceScolarite/attribution_nouveaux_etudiants"?>">Attribution automatique des nouveaux étudiants</a>
                        </div>
                        <!--表格-->
                        <form action="<?php echo URL."ServiceScolarite/" ?>" method = "POST">
                           <legend><p>Visualisation les étudiants par le programme</p></legend>
                            <select id="select1" name="programme_select">
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
                            <td>Eseignant</td>
                            <td>Etudiant</td>
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
                        <!--表格2-->
                      <legend><p>La liste des EC dans l'ordre décroissant du nombre d'étudiant conseillés</p></legend>
                          <table>
                            <thead style="background-color:#ddd; font-weight: bold;">
                              <tr>
                                <td>ID</td>
                                <td>Nom</td>
                                <td>Prenom</td>
                                <td>Num</td>
                              </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($ec_e as $ec_e) { ?>
                              <tr>
                                <td><?php if(isset($ec_e->id_EC)) echo $ec_e->id_EC;  ?></td>
                                <td><?php if(isset($ec_e->nom)) echo $ec_e->nom;  ?></td>
                                <td><?php if(isset($ec_e->prenom)) echo $ec_e->prenom;  ?></td>
                                <td><?php if(isset($ec_e->num)) echo $ec_e->num;  ?></td>
                              </tr>
                            <?php } ?>
                            </tbody>
                          </table>
                        </div>
                    </div>
        </div>
    </div>
</body>






















