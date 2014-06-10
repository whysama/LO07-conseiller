<!--head-->
<?php require "application/views/Responsable/layout/head.php"; ?>
<body>
    <!--header-->
    <?php require "application/views/Responsable/layout/header.php"; ?>
    <div class = "global">
        <!--aside-->
        <?php require "application/views/Responsable/layout/aside.php"; ?>
        <div class="content">
			<h3>Visualisation de les étudiants <?php echo $_SESSION['role'];?> avec leur EC conseiller:</h3>
                    <table>
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Conseiller</td>
                        <td>Etudiant</td>
                    </tr>
                </thead>
                    <tbody>
                    <?php foreach ($ec as $ec) { 
                    ?>
                        <?php if (isset($temp_id) && $temp_id == $ec->id_EC): ?>                
                            <tr>
                                <td></td>
                                <td></td>
                                <td><?php if(isset($ec->ETU_PRENOM)&&isset($ec->ETU_NOM)) echo $ec->ETU_PRENOM." ".$ec->ETU_NOM;  ?></td>
                            </tr>
                        <?php else: ?>
                            <tr class="seperate">
                                <td><?php if(isset($ec->id_EC)) echo $ec->id_EC;  ?></td>
                                <td><?php if(isset($ec->EC_NOM)&&isset($ec->EC_PRENOM)) echo $ec->EC_PRENOM." ".$ec->EC_NOM;  ?></td>
                                <td><?php if(isset($ec->ETU_PRENOM)&&isset($ec->ETU_NOM)) echo $ec->ETU_PRENOM." ".$ec->ETU_NOM;  ?></td>
                            </tr>
                        <?php endif ?>

                    <?php 
                        $temp_id = $ec->id_EC;
                        } 
                    ?>
                  </tbody>
            </table>
        </div>
    </div>
</body>