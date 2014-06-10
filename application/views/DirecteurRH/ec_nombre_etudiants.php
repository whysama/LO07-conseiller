<!--head-->
<?php require "application/views/DirecteurRH/layout/head.php"; ?>
<body>
    <!--header-->
    <?php require "application/views/DirecteurRH/layout/header.php"; ?>
    <div class = "global">
        <!--aside-->
        <?php require "application/views/DirecteurRH/layout/aside.php"; ?>
        <div class="content">
        	<h3>La liste des EC dans l'ordre décroissant du nombre d'étudiant conseillés</h3>
            <table>
                <thead>
					<tr>
						<td>ID</td>
						<td>Nom</td>
						<td>Prénom</td>
						<td>Nombre d'étudiant</td>
					</tr>
            	</thead>
                <tbody>
                	<?php foreach ($ec as $ec) { ?>
                  	<tr>
                    	<td><?php if(isset($ec->id_EC)) echo $ec->id_EC;  ?></td>
                    	<td><?php if(isset($ec->nom)) echo $ec->nom;  ?></td>
                    	<td><?php if(isset($ec->prenom)) echo $ec->prenom;  ?></td>
                    	<td><?php if(isset($ec->num)){echo $ec->num;}else{ echo 0;}?></td>
                  	</tr>
                	<?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>