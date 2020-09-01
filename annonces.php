<?php 
    $page='annonce';
    require('inc/connect.php'); // connexion a la base de données
    require('assets/head.php'); // appel au code html de l'entete
    require('inc/function.php'); // appel aux fichier contenant nos fonctions
    include('assets/nav.php'); // appel au code html contenant la barre de navigation

    ?>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-8 mt-5"> 
                        <h1>Liste des annonces :</h1>
                    </div>
                </div>
                <div class="row">
                    <?php
                        // Fonction qui affiche la liste des annonces
                        displayAllAnnonces();
                    ?>
                </div>
            </div>
        </section>
<?php 
    
require('assets/footer.php'); ?>