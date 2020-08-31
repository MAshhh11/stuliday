<?php 
    $page='annonce';
    require('inc/connect.php');
    require('assets/head.php');
    require('inc/function.php');
    include('assets/nav.php');

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
                        displayAnnoncesadmintools();
                    ?>
                </div>
            </div>
        </section>
<?php 
    
require('assets/footer.php'); ?>