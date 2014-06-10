<!--head-->
<?php require "application/views/Responsable/layout/head.php"; ?>
<body>
    <!--header-->
    <?php require "application/views/Responsable/layout/header.php"; ?>
    <div class = "global">
        <!--aside-->
        <?php require "application/views/Responsable/layout/aside.php"; ?>
        <div class="content">
        	<h3>Tableau de conseillers <?php echo $_SESSION['role'];?>:</h3>
            <table>
				<thead>
                    <tr>
                        <td>ID</td>
                        <td>Nom</td>
                        <td>Prenom</td>
                        <td>Email</td>
                        <td>Pole</td>
                        <td>Programme</td>
                        <td>Supprimer</td>
                	</tr>
				</thead>
                <tbody>
                    <?php foreach ($conseiller as $conseiller) { ?>
                    <tr>
                        <td><?php if(isset($conseiller->id_EC)) echo $conseiller->id_EC;  ?></td>
                        <td><?php if(isset($conseiller->nom)) echo $conseiller->nom;  ?></td>
                        <td><?php if(isset($conseiller->prenom)) echo $conseiller->prenom;  ?></td>
                        <td><?php if(isset($conseiller->email)) echo $conseiller->email;  ?></td>
                        <td><?php if(isset($conseiller->pole)) echo $conseiller->pole;  ?></td>
                        <td><?php if(isset($conseiller->programme)) echo $conseiller->programme;  ?></td>
                        <td><a href="<?php echo URL.'Responsable/Habilitation_suppression/'.$conseiller->id_EC;?>">x</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>