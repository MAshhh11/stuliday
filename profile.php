<?php 
    $page ='profile';
    require('inc/connect.php');
    require('inc/function.php'); 
    require('assets/head.php');
    include('assets/nav.php');
    
    if(isset($_SESSION['id'])){
        
            $id = $_SESSION['id'];
            $sql = $db->query("SELECT * FROM users WHERE id = $id");
            $sql->setFetchMode(PDO::FETCH_ASSOC);
    
            $row = $sql->fetch();
        if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['adresse']) && !empty($_POST['email'])){
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $email = htmlspecialchars($_POST['email']);
            $id = $_SESSION['id'];
            

            $sth = $db->prepare("UPDATE users SET lastName=?, firstName=?, email=? WHERE id=?");
    
            $sth->bindValue(1, $nom);
            $sth->bindValue(2, $prenom);
            $sth->bindValue(3, $email);
            $sth->bindValue(4, $id);
    
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
            <div class="col-md-8">
                <p>Veuillez remplir les champs suivants pour mettre à jour votre profil :</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail">Nom</label>
                        <input type="text" class="form-control" name="nom" id="exampleInputEmail"
                            aria-describedby="emailHelp" placeholder="<?= $row['lastName'];?>" value="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Prénom</label>
                        <input type="text" name="prenom" class="form-control" id="exampleInputPassword"
                            placeholder="<?= $row['firstName'];?>" value="">
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
                <a href="create_annonce.php" class="btn btn-primary mb-3">Publier une nouvelle annonce</a>
               <div><?php annoncesCount();?></div>
                <a href="#" class="btn btn-primary mb-3 <?php  if($compt < 1){ echo 'disabled'; } ?>"
                    data-toggle="modal" data-target="#listingResa">Voir mes réservations <span class="badge badge-primary badge-pill">5</span></a>
            </div>
            <div class="col-md-12 text-center pt-5 my-2">
                <a class="btn btn-info back" href="annonces.php">Retour aux annonces</a>
            </div>
        </div>
    </div>
</section>

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

<?php require('assets/footer.php'); ?>