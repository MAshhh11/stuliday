<?php 
    $page='userlist';
    require('inc/connect.php'); // connexion à la base de données
    require('assets/head.php'); // appel au fichier contenant le code html de l'entete
    require('inc/function.php');  // appel au fichier contenant les fonctions
    include('assets/nav.php'); // appel au fichier contenant le code html de la barre de navigation

    ?>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-8 mt-5"> 
                        <h2>Liste des utilisateurs du site :</h2>
                    </div>
                </div>
                <div class="row mt-3">
                    <?php
                    // fonction qui affiche les utilisateurs
                        displayAllUsers();
                    ?>
                </div>
                <div class="row">
                    <div class="col-8 mt-5"> 
                        <h2>Liste des réservations effectuées :</h2>
                    </div>
                </div>
                <div class="row mt-3">
                    <?php
                    // fonction qui affiche les réservations
                        displayResa();
                    ?>
                </div>
                <div class="row">
                    <div class="col-8 mt-5"> 
                        <h2>Liste des annonces postées :</h2>
                    </div>
                </div>
                <div class="row mt-3">
                    <?php
                    // fonction qui affiche les annonces
                        displayAnnoncesadmintools();
                    ?>
                </div>
            </div>
        </section>
<?php 
    
require('assets/footer.php'); ?> <!-- appel au fichier contenant le code html de la barre de navigation -->