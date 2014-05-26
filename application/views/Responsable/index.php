<div id="user">
    <h2>Responsable de <?php echo $_SESSION["role"]?></h2>
    <h5><?php echo $this->info[0]->prenom." ".$this->info[0]->nom;?></h5>
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
    <!--表格1-->
    <table>
    <thead style="background-color:#ddd; font-weight: bold;">
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
        <td><?php if(isset($c->pole)) echo $c->programme;  ?></td>
        <td><a href="<?php echo URL.'Responsable/Habilitation_suppression/'.$c->id_EC;?>">x</a></td>
      </tr>
    <?php } ?>
    </tbody>
    </table>
    <!--表格2-->
    <table>
    <thead style="background-color:#ddd; font-weight: bold;">
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