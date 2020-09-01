<?php 
    $page='reserverannonce';
    require('inc/connect.php'); // connexion a la db
    require('inc/function.php'); 
    require('assets/head.php');
   
    // Si l'id est bien récupérée on prépare une requete pour insérer les données de l'user et de l'annonce pour renseigner la table reservations
    if(isset($_GET['id'])){
        
        $annonce_id = $_GET['id'];
        $sth = $db->prepare("INSERT INTO reservations (id_user,id_annonce) VALUES (:id_user,:id_annonce)");
        $sth->bindValue(':id_user',$_SESSION['id']);
        $sth->bindValue(':id_annonce',$annonce_id);
        $sth->execute();
         // puis on change le active en 0 pour réserver l'annonce
        $sth2 = $db->prepare(" UPDATE annonces SET active=0  WHERE id=:id ");
        $sth2->bindValue(':id',$annonce_id);
        $sth2->execute();

            
            
            echo "<div class ='alert alert-success'> Votre réservation a bien été prise en compte !</div>";
            echo '<a class="btn btn-success col" href="annonces.php">Retour vers les annonces</a>';

        }else{
            
            
            echo "<div class ='alert alert-danger'> Une erreur vient de se produire.</div>";
            echo '<a class="btn btn-danger col" href="annonces.php">Retour vers les annonces</a>';
        
    }
       
    



    ?>