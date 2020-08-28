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
            header("Location:profile.php?action=d");
        }else{
            header("Location:profile.php?action=e");
        }
    }

    ?>