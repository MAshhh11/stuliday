<?php 
    $page ='deleteannonce';
    require('inc/connect.php'); // connexion à la base de données
    require('inc/function.php'); // appel au ficher contenant nos fonctions
    require('assets/head.php'); // appel au ficher contenant le code html de l'entete
    include('assets/nav.php'); // appel au ficher contenant le code html de la barre de navigation

    // requete qui récupère l'id de l'annonce et qui prépare une requete SQL de suppression
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sth = $db->prepare("DELETE FROM annonces WHERE id = $id");
        $sth->execute();
        
        if($sth){
            echo "<div class ='alert alert-success'> Annonce bien supprimée !</div>";
        echo '<a class="btn btn-success col" href="profile.php">Retour vers votre profil</a>';
        }else{
            echo "<div class ='alert alert-danger'> Une erreur vient de se produire.</div>";
        echo '<a class="btn btn-danger col" href="profile.php">Retour vers votre profil</a>';
        }
    }

    ?>