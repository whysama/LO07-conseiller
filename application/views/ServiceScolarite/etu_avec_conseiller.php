<!--head-->
<?php require "application/views/ServiceScolarite/layout/head.php"; ?>
<body>
    <!--header-->
    <?php require "application/views/ServiceScolarite/layout/header.php"; ?>
    <div class = "global">
        <!--aside-->
        <?php require "application/views/ServiceScolarite/layout/aside.php"; ?>
        <div class="content">
            <h3>La liste de EC et leurs étudiants conseillés:</h3>
            <form class="choise" action="<?php echo URL."ServiceScolarite/ETU_avec_conseiller_list"; ?>" method = "POST" name="form_programme">
                <input type="submit" name="programme_etu_avec_conseiller" value="All">
                <input type="submit" name="programme_etu_avec_conseiller" value="TC">
                <input type="submit" name="programme_etu_avec_conseiller" value="SM">
                <input type="submit" name="programme_etu_avec_conseiller" value="ISI">
                <input type="submit" name="programme_etu_avec_conseiller" value="MTE">
                <input type="submit" name="programme_etu_avec_conseiller" value="SRT">
                <input type="submit" name="programme_etu_avec_conseiller" value="SI">
                <input type="submit" name="programme_etu_avec_conseiller" value="CV ING">
                <input type="submit" name="programme_etu_avec_conseiller" value="HC">
                <input type="submit" name="programme_etu_avec_conseiller" value="PMOM">
            </form>
            <table>
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Eseignant</td>
                        <td>Etudiant</td>
                        <td>Programme</td>
                    </tr>
                </thead>
                    <tbody>
                    <?php foreach ($etu as $etu) { 
                    ?>
                        <?php if (isset($temp_id) && $temp_id == $etu->id_EC): ?>                
                            <tr>
                                <td></td>
                                <td></td>
                                <td><?php if(isset($etu->ETU_PRENOM)&&isset($etu->ETU_NOM)) echo $etu->ETU_PRENOM." ".$etu->ETU_NOM;  ?></td>
                                <td><?php if(isset($etu->programme)) echo $etu->programme?></td>
                            </tr>
                        <?php else: ?>
                            <tr class="seperate">
                                <td><?php if(isset($etu->id_EC)) echo $etu->id_EC;  ?></td>
                                <td><?php if(isset($etu->EC_NOM)&&isset($etu->EC_PRENOM)) echo $etu->EC_PRENOM." ".$etu->EC_NOM;  ?></td>
                                <td><?php if(isset($etu->ETU_PRENOM)&&isset($etu->ETU_NOM)) echo $etu->ETU_PRENOM." ".$etu->ETU_NOM;  ?></td>
                                <td><?php if(isset($etu->programme)) echo $etu->programme?></td>
                            </tr>
                        <?php endif ?>

                    <?php 
                        $temp_id = $etu->id_EC;
                        } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>