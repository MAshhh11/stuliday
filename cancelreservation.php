<?php 
    $page='cancelreservation';
    require('inc/connect.php'); // connexion a la db
    require('inc/function.php'); 
    require('assets/head.php');
   
    // si on récupère bien l'id de la reservation on affiche les données de la reservation puis on récupère les données de l'annonce reservée
    if(isset($_SESSION['id'])){
        if(isset($_GET['id'])){
            $reservation_id = $_GET['id'];
            $sql = $db->query("SELECT * FROM reservations WHERE id = $reservation_id");
            $sql->setFetchMode(PDO::FETCH_ASSOC);
        
            $row = $sql->fetch();

            $id_annonce = $row['id_annonce'];
            // on change le active en 1 lorsque la reservation est annulée
            
            $sth = $db->prepare(" UPDATE annonces SET active=1  WHERE id=:id ");
            $sth->bindValue(':id',$id_annonce);
            if($sth->execute()){

                // si ca s'exécute on supprime la ligne dans réservation

                $sth2 = $db->prepare("DELETE FROM reservations WHERE id = $reservation_id");
                $sth2->execute();

                echo "<div class ='alert alert-success'> Votre réservation a bien été supprimée !</div>";
                echo '<a class="btn btn-success col" href="annonces.php">Retour vers les annonces</a>';
            }else{
                echo "<div class ='alert alert-danger'> Une erreur vient de se produire.</div>";
                echo '<a class="btn btn-danger col" href="annonces.php">Retour vers les annonces</a>';

            }
        }
    }else{

    echo "<div class ='alert alert-danger'> Veuillez vous connecter pour cette action</div>";
    }     
    

    ?>