<meta charset="UTF-8">
<a href="<?php echo URL."ServiceScolarite/ETU_vide" ?>">Vider la table d'étudiants</a>

<a href="<?php echo URL."ServiceScolarite/attribution_nouveaux_etudiants"?>">GO</a>

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

   <form action="<?php echo URL;?>ServiceScolarite/ETU_ajout_liste" method = "POST" enctype="multipart/form-data">
        <input type="file" name="csv"/>
        <input type="submit" name="submit_etu_ajout_liste" value="OK"/>
   </form>

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