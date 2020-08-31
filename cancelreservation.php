<?php 
    $page='reserverannonce';
    require('inc/connect.php');
    require('inc/function.php');
    require('assets/head.php');
   

    if(isset($_GET['id'])){
        $reservation_id = $_GET['id'];
        $sql = $db->query("SELECT * FROM reservations WHERE id = $reservation_id");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
    
        $row = $sql->fetch();

        $id_annonce = $row['id_annonce'];
        
        $sth = $db->prepare(" UPDATE annonces SET active=1  WHERE id=:id ");
        $sth->bindValue(':id',$id_annonce);
        if($sth->execute()){

            $sth2 = $db->prepare("DELETE FROM reservations WHERE id = $reservation_id");
            $sth2->execute();

            echo "<div class ='alert alert-success'> Votre réservation a bien été supprimée !</div>";
            echo '<a class="btn btn-success col" href="annonces.php">Retour vers les annonces</a>';
        }else{
            echo "<div class ='alert alert-danger'> Une erreur vient de se produire.</div>";
            echo '<a class="btn btn-danger col" href="annonces.php">Retour vers les annonces</a>';

        }
    }
       
    

    ?>