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
                <img class = "avatar" src="public/img/avatar/img-DRH.JPG" alt="Aavatar">
                <p class="job">Directeur des Resources Humaines</p>
            </div>
            <nav>
                <p id="function1">Habilitation</p>
                <p id="function2">Modification</p>
                <p id="function3">Visualisation</p>
            </nav>
        </aside>
        <div class="content">
            <div id="part1">
              <!-- 清空EC-->
                 <a href="<?php echo URL.'DirecteurRH/EC_vide'?>">Vider les Enseigant-Chercheur</a>
                <!--添加EC-->
                 <form action="<?php echo URL;?>DirecteurRH/EC_ajout" method = "POST">
                      <label>NOM</label>
                      <input type="text" name="nom" value="" required/>
                      <label>PRONOM</label>
                      <input type="text" name="prenom" value="" required/>
                      <label>BUREAU</label>
                      <input type="text" name="bureau" value="" required/>
                      <label>POLE</label>
                      <input type="text" name="pole" value="" required/>
                      <input type="submit" name="submit_ec_ajout" value="OK"/>
                 </form>
                <!--添加EC.csv-->
                 <form action="<?php echo URL;?>DirecteurRH/EC_ajout_liste" method = "POST" enctype="multipart/form-data">
                      <input type="file" name="csv"/>
                      <input type="submit" name="submit_ec_ajout_liste" value="OK"/>
                 </form>
                <!--表格-->
                <table>
                  <thead style="background-color:#ddd; font-weight: bold;">
                    <tr>
                      <td>ID</td>
                      <td>Nom</td>
                      <td>Prenom</td>
                      <td>Email</td>
                      <td>Bureau</td>
                      <td>Pole</td>
                      <td>Modifier</td>
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
            <div id="part2">
              <!--表格2-->
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
            <div id="part3">
              <table>
                  <thead style="background-color:#ddd; font-weight: bold;">
                    <tr>
                      <td>ID</td>
                      <td>Conseiller</td>
                      <td>Etudiant</td>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($ec_e2 as $ec_e2) { ?>
                    <tr>
                      <td><?php if(isset($ec_e2->id_EC)) echo $ec_e2->id_EC;  ?></td>
                      <td><?php if(isset($ec_e2->EC_NOM)&&isset($ec_e2->EC_PRENOM)) echo $ec_e2->EC_PRENOM." ".$ec_e2->EC_NOM;  ?></td>
                      <td><?php if(isset($ec_e2->ETU_PRENOM)&&isset($ec_e2->ETU_NOM)) echo $ec_e2->ETU_PRENOM." ".$ec_e2->ETU_NOM;  ?></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</body>