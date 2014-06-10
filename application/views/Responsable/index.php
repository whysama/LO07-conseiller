<!--head-->
<?php require "application/views/Responsable/layout/head.php"; ?>
<body>
    <!--header-->
    <?php require "application/views/Responsable/layout/header.php"; ?>
    <div class = "global">
        <!--aside-->
        <?php require "application/views/Responsable/layout/aside.php"; ?>
        <div class="content">
            <!--添加Conseiller-->
            <form class="form" action="<?php echo URL;?>Responsable/Habilitation_ajout" method = "POST">
                <h3>Habilitation d’un EC:</h3>
                <label for="id_ec">id_EC:</label>
                <input class="text-input" id="id_ec" type="text" name="id_EC" value="" required/>
                <input type="submit" name="submit_Habilitation_ajout" value="OK"/>
            </form>
            <!--添加Conseiller par pole-->
            <form class="form" action="<?php echo URL;?>Responsable/Habilitation_par_pole" method = "POST">
                <h3>Habilitation des EC par pôle:</h3>
                <label>Pole:</label>
                <select name="pole">
                    <option value="P2MN">P2MN</option>
                    <option value="ROSAS">ROSAS</option>
                    <option value="HETIC">HETIC</option>
                    <option value="SUEL">SUEL</option>
                </select>
                <input type="submit" name="submit_Habilitation_par_pole" value="OK">
            </form>
            <!--表格EC-->
            <form class="choise" action="<?php echo URL;?>Responsable/" method = "POST">
                <h3>Tableau de EC:</h3>
                <input type="submit" name ="submit_pole" value="ALL"/>
                <input type="submit" name ="submit_pole" value="P2MN"/>
                <input type="submit" name ="submit_pole" value="ROSAS"/>
                <input type="submit" name ="submit_pole" value="HETIC"/>
                <input type="submit" name ="submit_pole" value="SUEL"/>
            </form>
            <table>
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nom</td>
                        <td>Prenom</td>
                        <td>Email</td>
                        <td>Bureau</td>
                        <td>Pole</td>
                        <td>Habiliter</td>
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
                        <td><a href="<?php echo URL.'Responsable/Habilitation_ajout_form/'.$ec->id_EC;?>">✓</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>