<?php 
    $page ='deleteannonce';
    require('inc/connect.php');
    require('inc/function.php'); 
    require('assets/head.php');
    include('assets/nav.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sth = $db->prepare("DELETE FROM users WHERE id = $id");
        $sth->execute();
        
        if($sth){
            echo "<div class ='alert alert-success'> User supprimé !</div>";
            echo '<a class="btn btn-success col" href="userlist.php">Retour vers Admin tools</a>';
        }else{
            echo "<div class ='alert alert-danger'> Une erreur est survenue !</div>";
            echo '<a class="btn btn-danger col" href="userlist.php">Retour vers Admin tools</a>';
        }
    }

    ?>