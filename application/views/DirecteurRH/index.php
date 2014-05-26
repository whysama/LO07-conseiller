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
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>