<?php 
    $page='reserverannonce';
    require('inc/connect.php'); // connexion a la db
    require('inc/function.php'); 
    require('assets/head.php');
   
    // Si l'id est bien récupérée on prépare une requete pour insérer les données de l'user et de l'annonce pour renseigner la table reservations
    if(isset($_SESSION['id'])){
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
    }else{

        echo "<div class ='alert alert-danger'> Veuillez vous connecter pour cette action</div>";
        }
    



    ?>




<!-- REQUETES JOINTES -->

<!-- //requete sql pour afficher les mails des auteurs et les titres d'annonces correspondant :
//SELECT users.email, annonces.title FROM users INNER JOIN annonces WHERE users.id = annonces.author_article
//ou
//SELECT users.email, annonces.title FROM users INNER JOIN annonces ON users.id = annonces.author_article
//Afficher les email et mot de passe des auteurs des annonces
//SELECT users.email,users.password FROM users LEFT OUTER JOIN annonces ON users.id = annonces.author_article
//Afficher la liste d'auteurs qui n'ont pas fait d'annonces
//SELECT users.email,users.password,annonces.title FROM users LEFT OUTER JOIN annonces ON users.id = annonces.author_article WHERE annonces.title IS NULL
//Afficher la liste d'user et les annonces associées
//SELECT u.email,u.password, a.title,a.description FROM users AS u LEFT JOIN annonces AS a ON u.id= a.author_article UNION ALL SELECT u.email,u.password, a.title,a.description FROM users AS u RIGHT JOIN annonces AS a ON u.id = a.author_article WHERE u.id= NULL -->