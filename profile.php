<?php 
    $page ='profile';
    require('inc/connect.php'); // connexion à la db
    require('inc/function.php');  // appel aux fonctions
    require('assets/head.php'); // html de l'entete
    include('assets/nav.php'); // html de la nav
    
    // si un user est connecté on recupère l'id et on prépare une requete pour afficher les données
    if(isset($_SESSION['id'])){
            $id = $_SESSION['id'];
            $sql = $db->query("SELECT * FROM users WHERE id = $id");
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $row = $sql->fetch();
            
        // si les champs du formulaire ne sont pas vide on récupere les données insérées pour l'user pour les mettre à jour dans la BD   
        if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email'])){
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $email = htmlspecialchars($_POST['email']);
            $id = $_SESSION['id'];
            

            $sth = $db->prepare("UPDATE users SET lastName=?, firstName=?, email=? WHERE id=?");
    
            $sth->bindValue(1, $nom);
            $sth->bindValue(2, $prenom);
            $sth->bindValue(3, $email);
            $sth->bindValue(4, $id);
            // si la requete s'execute on affiche un msg de succès
            if($sth->execute()){
                echo "<div class ='alert alert-success'> Votre profil a bien été mis à jour</div>";
                

            }else{
                echo "<div class ='alert alert-danger'> Une erreur vient de se produire.</div>";
                
            }
        }
     
        
    }

?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="py-4">Mon profil :</h2>
            </div>

            <!-- formulaire de mise à jour de profil -->
            <div class="col-md-8">
                <p>Veuillez remplir les champs suivants pour mettre à jour votre profil :</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail">Nom</label>
                        <input type="text" class="form-control" name="nom" id="exampleInputEmail"
                            aria-describedby="emailHelp" value="<?= $row['lastName'];?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Prénom</label>
                        <input type="text" name="prenom" class="form-control" id="exampleInputPassword"
                            value="<?= $row['firstName'];?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail"
                            aria-describedby="emailHelp" value="<?= $row['email'];?>">
                    </div>
                    <input type="submit" name="submit_update" class="btn btn-info" value="Mettre à jour">
                </form>
            </div>
            <div class="col-md-4">
                <a href="create_annonce.php" class="btn btn-info mb-3">Publier une nouvelle annonce</a>
               <div><?php annoncesCount();?></div>
               <div><?php reservationsCount();?></div>
            </div>
            <div class="col-md-12 text-center pt-5 my-2">
                <a class="btn btn-info back" href="annonces.php">Retour aux annonces</a>
            </div>
        </div>
    </div>
</section>

<!-- Modal afficher mes annonces -->
<div class="modal fade" id="listingAnnonces" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog listings" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mes annonces</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <?php displayYourAnnonces(); ?>
            </div>
        </div>
    </div>
</div>


<!-- Modal afficher mes reservations -->
<div class="modal fade" id="listingResa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog listings" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mes reservations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <?php displayYourReservation(); ?>
            </div>
        </div>
    </div>
</div>

<?php require('assets/footer.php'); ?>