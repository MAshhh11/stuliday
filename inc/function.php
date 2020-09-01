<?php

    function random_images($h,$w){
        echo "http://loremflickr.com/$h/$w/house,mansion"; // fonction qui génère des images random pour alimenter la page d'accueil à base de maisons, manoirs
    }

    function shorten_text($text, $max = 120, $append =' &hellip;'){ 
        if (strlen($text)<=$max) return $text;
        $return = substr($text,0,$max);
        if (strpos($text,' ')===false) return $return . $append;
        return preg_replace('/\w+$/',' ',$return) . $append ; //fonction qui raccourcit le texte de description des annonces sans couper les mots
    }

    function displayAllUsers(){ //fonction admin pour afficher tous les users
        if (isset($_SESSION['id']) && $_SESSION['id'] == 6){
        global $db;
        $sql = $db->query("SELECT * FROM users");
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $sql->fetch()){ 
        ?>
           <div class="col-4">
                <div class="card p-3 mt-3">
                    <h3>Utilisateur n°<?= $row['id']; ?></h3>
                    <div class="card-body">
                        <p>Email: <?= $row['email']; ?></p>
                        <p>First name: <?= $row['firstName']; ?></p>
                        <a class="btn btn-info mb-3" href="deleteuser.php?id=<?= $row['id']; ?>"> Supprimer l'utilisateur</a>
                    </div>
                </div>
            </div>
        <?php
        }
        } else {
            echo "<div class ='alert alert-danger'> Veuillez vous connecter en tant qu'admin pour voir la liste des utilisateurs.</div>";
            
        }
    }

    function displayResa(){ // fonction admin pour afficher toutes les reservations
        if (isset($_SESSION['id']) && $_SESSION['id'] == 6){
        global $db;
        $sql = $db->query("SELECT * FROM reservations");
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $sql->fetch()){ 
        ?>
           <div class="col-4">
                <div class="card p-2 mt-3">
                    <div class="card-body">
                    <h3>Réservation n°<?= $row['id']; ?></h3>
                        <p>Utilisateur n° : <?= $row['id_user']; ?></p>
                        <p>Annonce n° : <?= $row['id_annonce']; ?></p>
                        <p>Date : <?= $row['dateReservation']; ?></p>
                        <div class="mt-3">
                        <a class="btn-info btn" href="displayannonce.php?id=<?= $row['id_annonce']; ?>">Voir l'annonce</a>
                        </div>
                        <div class="mt-3">
                        <a class="btn btn-info mb-3" href="cancelreservation.php?id=<?= $row['id']; ?>"> Supprimer la réservation</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        } else {
            echo "<div class ='alert alert-danger'> Veuillez vous connecter en tant qu'admin pour voir la liste des réservations.</div>";
            
        }
    }

    function displayAnnoncesadmintools(){ // fonction admin pour afficher toutes les annonces
        if (isset($_SESSION['id']) && $_SESSION['id'] == 6){
        global $db;
        $sql = $db->query("SELECT * FROM annonces");
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $sql->fetch()){ 
        ?>
           <div class="col-4">
                <div class="card mt-3">
                    <img class="card-img-top" src="<?=$row['image_url'];?>" alt="image_annonce" width="300" height="220">
                    <div class="card-body">
                        <div class="card-title">
                            <h2>Annonce n°<?= $row['id']; ?></h2>
                        </div>
                        <div class="card-text">
                            <p>Titre: <?= $row['title']; ?></p>
                            <p>Description: <?= shorten_text($row['description']); ?></p>
                            <p>Ville: <?= $row['city']; ?></p>
                            <p>Prix par jour en euros: <?= $row['price']; ?></p>
                            <p>Location du lieu : Du <?= $row['start_date']; ?> Au <?= $row['end_date']; ?></p>
                            <div class="mt-3">
                            <a class="btn-info btn" href="displayannonce.php?id=<?= $row['id']; ?>">Voir l'annonce</a>
                            </div>
                            <div class="mt-3">
                            <a class="btn btn-info mb-3" href="deleteannonce.php?id=<?= $row['id']; ?>"> Supprimer l'annonce</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        } else {
            echo "<div class ='alert alert-danger'> Veuillez vous connecter en tant qu'admin pour voir la liste des annonces</div>";
            
        }
    }


    function displayAllAnnonces(){ // affiche toutes les annonces sur la page annonce
        if(isset($_SESSION['id'])){
        global $db;
        $sql = $db->query("SELECT * FROM annonces");
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $sql->fetch()){ 
        ?>
           <div class="col-4">
                <div class="card mt-3">
                    <img class="card-img-top" src="<?=$row['image_url'];?>" alt="image_annonce" width="300" height="220">
                    <div class="card-body">
                        <div class="card-title">
                            <h2>Annonce n°<?= $row['id']; ?></h2>
                        </div>
                        <div class="card-text">
                            <p>Titre: <?= $row['title']; ?></p>
                            <p>Description: <?= shorten_text($row['description']); ?></p>
                            <p>Ville: <?= $row['city']; ?></p>
                            <p>Prix par jour en euros: <?= $row['price']; ?></p>
                            <p>Location du lieu : Du <?= $row['start_date']; ?> Au <?= $row['end_date']; ?></p>
                            <a class="btn btn-info mb-3" href="displayannonce.php?id=<?= $row['id']; ?>" >Voir l'annonce</a>
                            <?php 
                                if(($_SESSION['id'] != $row['author_article']) && $row['active'] != 0 ){ ?>
                                    <a class="btn btn-info mb-3" href="reserverannonce.php?id=<?= $row['id']; ?>">Réserver</a>
                                <?php } ?> 
                                       
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        }  else {
            echo "<div class ='alert alert-danger'> Veuillez vous connecter pour voir les annonces.</div>";
            
        }
    }
 
    function displayAnnonce(){ // affiche une annonce sur une page avec toutes ses infos
        if(isset($_SESSION['id'])){
            if(isset($_GET['id'])){
                global $db;
                $annonce_id = $_GET['id'];
                $sql = $db->query("SELECT * FROM annonces WHERE id = $annonce_id");
                $sql->setFetchMode(PDO::FETCH_ASSOC);

                while($row = $sql->fetch()){ 
                ?>
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-6">
                            <img class="img-fluid" src="<?=$row['image_url'];?>" alt="image_annonce" width="800" height="600">
                        </div>
                    
                        <div class="col-6">
                            <h2>Annonce n°<?= $row['id']; ?></h2>
                            <p>Titre: <?= $row['title']; ?></p>
                            <p>Description: <?= $row['description']; ?></p>
                            <p>Adresse: <?= $row['address_article']; ?></p>
                            <p>Ville: <?= $row['city']; ?></p>
                            <p>Prix par jour en euros: <?= $row['price']; ?></p>
                            <p>Location du lieu : Du <?= $row['start_date']; ?> Au <?= $row['end_date']; ?></p>
                            <a class="btn btn-info mb-3 w-25 p-2" href="annonces.php">Retour</a>
                            <?php 
                            if($_SESSION['id'] != $row['author_article'] && $row['active'] != 0){ ?>
                                <a class="btn btn-info mb-3 w-25 p-2" href="reserverannonce.php?id=<?= $row['id']; ?>">Réserver</a>
                            <?php } ?>
                        </div>
                    </div>        
                </div>
                <?php
                }
            }
        } else {
            echo "<div class ='alert alert-danger'> Veuillez vous connecter pour voir les annonces.</div>";
            
        }
    }

    function displayYourAnnonces(){ // affiche dans un modal les annonces propres aux utilisateurs 
        if(isset($_SESSION['id'])){
            global $db;
            $user_id = $_SESSION['id'];
            $sql = $db->query("SELECT * FROM annonces WHERE author_article = $user_id");
            $sql->setFetchMode(PDO::FETCH_ASSOC);

            while($row = $sql->fetch()){ 
            ?>
            <div class="col-12 container">
                    <div class="mt-3">
                        <img class="img-fluid" src="<?=$row['image_url'];?>" alt="image_annonce" width="600" height="400">
                        <div class="">
                            <div class="card-title">
                                <h2>Annonce n°<?= $row['id']; ?></h2>
                            </div>
                            <div class="card-text">
                                <p>Titre: <?= $row['title']; ?></p>
                                <p>Description: <?= $row['description']; ?></p>
                                <p>Adresse: <?= $row['address_article']; ?></p>
                                <p>Ville: <?= $row['city']; ?></p>
                                <p>Prix par jour en euros: <?= $row['price']; ?></p>
                                <p>Location du lieu : Du <?= $row['start_date']; ?> Au <?= $row['end_date']; ?></p>
                                <a class="btn btn-info mb-3" href="modifyannonce.php?id=<?= $row['id']; ?>" >Modifier l'annonce</a>
                                <a class="btn btn-info mb-3" href="deleteannonce.php?id=<?= $row['id']; ?>" >Supprimer l'annonce</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
             }
        }
    }


    function annoncesCount() { // fonction compteur d'annonces pour interface utilisateur
        global $db;
        if(isset($_SESSION['id'])){
            $id_user = $_SESSION['id'];
            $compteur = $db->query("SELECT author_article FROM annonces WHERE author_article = $id_user");
            $compteur->setFetchMode(PDO::FETCH_ASSOC);
            while($result = $compteur->fetchAll()){
                ?>
             <a href="" class="btn btn-info mb-3 <?php  if($result < 1){ echo 'disabled'; } ?>" data-toggle="modal" data-target="#listingAnnonces">Voir mes annonces  
               <span class="badge badge-info badge-pill"><?= COUNT($result); ?></span>
            </a>
            <?php
            }
        }
    }

    function reservationsCount() { // fonction compteur de reservations pour utilisateur
        global $db;
        if(isset($_SESSION['id'])){
            $id_user = $_SESSION['id'];
            $compteur = $db->query("SELECT id_user FROM reservations WHERE id_user = $id_user");
            $compteur->setFetchMode(PDO::FETCH_ASSOC);
            while($result = $compteur->fetchAll()){
                ?>
             <a href="" class="btn btn-info mb-3 <?php  if($result < 1){ echo 'disabled'; } ?>" data-toggle="modal" data-target="#listingResa">Voir mes reservations  
               <span class="badge badge-info badge-pill"><?= COUNT($result); ?></span>
            </a>
            <?php
            }
        }
    }

    function displayYourReservation(){ // Affiche les reservations effectuées dans un modal pour l'user
        if(isset($_SESSION['id'])){
            global $db;
            $user_id = $_SESSION['id'];
            $sql = $db->query("SELECT * FROM reservations WHERE id_user = $user_id");
            $sql->setFetchMode(PDO::FETCH_ASSOC);

            while($row = $sql->fetch()){ 
            ?>
            <div class="col-12">
                <div class="mt-3">
                    <div class="card-title">
                        <h2>Votre réservation :</h2>
                        <p>Annonce n°<?= $row['id_annonce']; ?></p>
                        <p>Réservée le : <?= $row['dateReservation']; ?> </p>
                        <a class="btn btn-info mb-3" href="displayannonce.php?id=<?= $row['id_annonce']; ?>"> Voir l'annonce</a>
                        <a class="btn btn-info mb-3" href="cancelreservation.php?id=<?= $row['id']; ?>"> Annuler la réservation</a>
                    </div>
                </div>
            </div>
            <?php
             }
        }
    }




?>



