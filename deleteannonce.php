<?php 
    $page ='deleteannonce';
    require('inc/connect.php');
    require('inc/function.php'); 
    require('assets/head.php');
    include('assets/nav.php');

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