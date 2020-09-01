<?php
    $page='index';
    require ('inc/connect.php'); // lien de connexion à la base de données
    require ('inc/function.php');// lien vers nos fonctions


?>
<?php
require('assets/head.php'); // appel au fichier contenant le code html de l'entete
include('assets/nav.php'); // appel au ficher contenant le code html de la barre de navigation

?>
<section>

<!-- CAROUSEL de la page d'accueil -->

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
  <div class="carousel-caption d-flex flex-column">
  <div class="jumbotron jumbotron-fluid col-md-12 text-center text-dark">
                    <h1 class="display-4">Bienvenue sur Stuliday !</h1>
                    <?php if(empty($_SESSION)){ ?> <p class="lead"> <br> <a href ='login.php'> Connectez-vous </a>ou<a href ='login.php'> Inscrivez-vous</a></p> <?php } ?>
                </div>
  </div>
    <div class="carousel-item active">
      <img src="img/fond.jpg" width=1200 height=600 class="img-fluid w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/terrasses.jpg" width=1200 height=600 class="img-fluid w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/combi.jpg" width=1200 height=600 class="img-fluid w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/pont.jpg" width=1200 height=600 class="img-fluid w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/green.jpg" width=1200 height=600 class="img-fluid w-100" alt="...">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

</section>
<?php 

require('assets/footer.php');  // appel au fichier contenant le code html pour le footer
?>