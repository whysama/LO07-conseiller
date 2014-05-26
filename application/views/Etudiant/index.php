<div id="user">
    <h2>Etudiant</h2>
    <?php
        foreach ($etudiant as $etudiant) {
            echo $etudiant->nom;
            echo $etudiant->prenom;
        }
    ?>

</div>