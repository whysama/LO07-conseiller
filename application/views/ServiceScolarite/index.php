<meta charset="UTF-8">
<a href="<?php echo URL."ServiceScolarite/ETU_vide" ?>">Vider la table d'étudiants</a>

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