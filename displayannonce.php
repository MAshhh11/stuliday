<?php 
    $page ='displayannonce';
    require('inc/connect.php');
    require('inc/function.php'); 
    require('assets/head.php');
    include('assets/nav.php');

?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">    
                <h1>Votre annonce :</h1>
            </div>
        </div>
        <div class="row">
            <?php
                displayAnnonce();
            ?>
        </div>
    </div>
</section>

<?php require('assets/footer.php'); ?>