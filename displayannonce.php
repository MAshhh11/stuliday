<?php 
    $page ='displayannonce';
    require('inc/connect.php');
    require('inc/function.php'); // appel au fichier des fonctions
    require('assets/head.php');
    include('assets/nav.php');

?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">    
                <h1>Votre annonce :</h1>
            </div>
        </div>
        <div class="row">
            <?php
            // fonction qui affiche une annonce
                displayAnnonce();
            ?>
        </div>
    </div>
</section>

<?php require('assets/footer.php'); ?>