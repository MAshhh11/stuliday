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

    function displayAllUsers(){
        global $db;
        $sql = $db->query("SELECT * FROM users");
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $sql->fetch()){ 
        ?>
           <div class="col-4">
                <div class="card p-3 mt-3">
                    <h2>User n°<?= $row['id']; ?></h2>
                    <div class="card-body">
                        <p>Email: <?= $row['email']; ?></p>
                        <p>First name: <?= $row['firstName']; ?></p>
                    </div>
                </div>
            </div>
        <?php
        }
        
    }

    function displayAllAnnonces(){
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
                            <p>Adresse: <?= $row['address_article']; ?></p>
                            <p>Ville: <?= $row['city']; ?></p>
                            <p>Prix par jour en euros: <?= $row['price']; ?></p>
                            <a class="btn btn-primary mb-3" href="displayannonce.php?id=<?= $row['id']; ?>" >Voir l'annonce</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        
    }

    function displayAnnonce(){
        if(isset($_GET['id'])){
            global $db;
            $annonce_id = $_GET['id'];
            $sql = $db->query("SELECT * FROM annonces WHERE id = $annonce_id");
            $sql->setFetchMode(PDO::FETCH_ASSOC);

            while($row = $sql->fetch()){ 
            ?>
            <div class="col-12">
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
                            </div>
                        </div>
                    </div>
                </div>
            <?php
             }
        }
    }

    function displayYourAnnonces(){
        if(isset($_SESSION['id'])){
            global $db;
            $user_id = $_SESSION['id'];
            $sql = $db->query("SELECT * FROM annonces WHERE author_article = $user_id");
            $sql->setFetchMode(PDO::FETCH_ASSOC);

            while($row = $sql->fetch()){ 
            ?>
            <div class="col-12">
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
                                <a class="btn btn-primary mb-3" href="modifyannonce.php?id=<?= $row['id']; ?>" >Modifier l'annonce</a>
                                <a class="btn btn-primary mb-3" href="deleteannonce.php?id=<?= $row['id']; ?>" >Supprimer l'annonce</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
             }
        }
    }


    function annoncesCount() {
        global $db;
        if(isset($_SESSION['id'])){
            $id_user = $_SESSION['id'];
            $compteur = $db->query("SELECT author_article FROM annonces WHERE author_article = $id_user");
            $compteur->setFetchMode(PDO::FETCH_ASSOC);
            while($result = $compteur->fetchAll()){
                ?>
             <a href="" class="btn btn-primary mb-3 <?php  if($result < 1){ echo 'disabled'; } ?>" data-toggle="modal" data-target="#listingAnnonces">Voir mes annonces  
               <span class="badge badge-primary badge-pill"><?= COUNT($result); ?></span>
            </a>
            <?php
            }
        }
    }


?>





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