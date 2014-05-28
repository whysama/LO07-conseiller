<div id="user">
    <h2>Directeur des Resources Humaines</h2>
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

  <!--表格3-->
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