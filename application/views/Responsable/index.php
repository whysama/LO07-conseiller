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
                <img class = "avatar" src="public/img/avatar/img-responsable-isi.JPG" alt="Aavatar">
                <p class="name"><?php echo $this->info[0]->prenom." ".$this->info[0]->nom;?></p>
                <p class="job">Responsable de <?php echo $_SESSION["role"]?></p>
            </div>
            <nav>
                <p id="function1">Habilitation</p>
                <p id="function2">Modification</p>
                <p id="function3">Visualisation</p>
            </nav>
        </aside>
        <div class="content">
                    <div id="part1">
                            <!--添加Conseiller-->
                            <form action="<?php echo URL;?>Responsable/Habilitation_ajout" method = "POST">
                                <label>id_EC</label>
                                <input type="text" name="id_EC" value="" required/>
                                <input type="submit" name="submit_Habilitation_ajout" value="OK"/>
                            </form>
                            <!--添加Conseiller par pole-->
                            <form action="<?php echo URL;?>Responsable/Habilitation_par_pole" method = "POST">
                                <select name="pole">
                                    <option value="P2MN">P2MN</option>
                                    <option value="ROSAS">ROSAS</option>
                                    <option value="HETIC">HETIC</option>
                                    <option value="SUEL">SUEL</option>
                                </select>
                                <input type="submit" name="submit_Habilitation_par_pole" value="OK">
                            </form>
                              <!--表格EC-->
                            <form action="<?php echo URL;?>Responsable/" method = "POST">
                                <input type="submit" name ="EC_pole" value="ALL"/>
                                <input type="submit" name ="EC_pole" value="P2MN"/>
                                <input type="submit" name ="EC_pole" value="ROSAS"/>
                                <input type="submit" name ="EC_pole" value="HETIC"/>
                                <input type="submit" name ="EC_pole" value="SUEL"/>
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
                                <td>Habiliter</td>
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
                                <td><a href="<?php echo URL.'Responsable/Habilitation_ajout/'.$ec->id_EC;?>">ok</a></td>
                              </tr>
                            <?php } ?>
                            </tbody>
                            </table>
                    </div>
                    <div id="part2">
                            <!--表格1-->
                            <table>
                            <thead>
                              <tr>
                                <td>ID</td>
                                <td>Nom</td>
                                <td>Prenom</td>
                                <td>Email</td>
                                <td>Bureau</td>
                                <td>Pole</td>
                                <td>Programme</td>
                                <td>Modifier</td>
                              </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($c as $c) { ?>
                              <tr>
                                <td><?php if(isset($c->id_EC)) echo $c->id_EC;  ?></td>
                                <td><?php if(isset($c->nom)) echo $c->nom;  ?></td>
                                <td><?php if(isset($c->prenom)) echo $c->prenom;  ?></td>
                                <td><?php if(isset($c->email)) echo $c->email;  ?></td>
                                <td><?php if(isset($c->bureau)) echo $c->bureau;  ?></td>
                                <td><?php if(isset($c->pole)) echo $c->pole;  ?></td>
                                <td><?php if(isset($c->programme)) echo $c->programme;  ?></td>
                                <td><a href="<?php echo URL.'Responsable/Habilitation_suppression/'.$c->id_EC;?>">x</a></td>
                              </tr>
                            <?php } ?>
                            </tbody>
                            </table>
                    </div>
                <div id="part3">
                    <table>
                      <thead>
                        <tr>
                          <td>Etudiant</td>
                          <td>Conseiller</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($h as $h) { ?>
                        <tr>
                          <td><?php if(isset($h->ETU_NOM) && isset($h->ETU_PRENOM)) echo $h->ETU_PRENOM." ".$h->ETU_NOM;  ?></td>
                          <td><?php if(isset($h->EC_NOM) && isset($h->EC_PRENOM)) echo $h->EC_PRENOM." ".$h->EC_NOM;  ?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                </div>
        </div>
    </div>
</body>