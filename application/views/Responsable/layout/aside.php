    <aside>
        <div>
            <img class = "avatar" src="public/img/avatar/img-responsable-<?php echo strtolower($_SESSION['role']);?>.JPG" alt="Aavatar">
            <p class="name"><?php echo $this->info[0]->prenom." ".$this->info[0]->nom;?></p>
            <p class="job">Responsable de <?php echo $_SESSION["role"]?></p>
        </div>
        <div class="asideline"></div>
        <nav>
            <a href="<?php echo URL;?>Responsable/" >Habilitation</a>
            <a href="<?php echo URL;?>Responsable/CONSEILLER_visualisation" >Modification</a>
            <a href="<?php echo URL;?>Responsable/Habilitation_visualisation_etu_ec" >Visualisation <br/>Conseillers - Etudiants</a>
        </nav>
        <div class="asideline"></div>
    </aside>