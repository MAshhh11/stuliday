<?php 
    $page ='modifyannonce';
    require('inc/connect.php'); // connexion à la db
    require('inc/function.php'); 
    require('assets/head.php');
    include('assets/nav.php');
    $date = date('Y-m-d'); // définition de la variable date qui correspond a la date du jour
    $end_date = date('Y-m-d', strtotime('+1 days')); // définition de la variable end_date qui correspond a la date du jour +1 jour

    // si l'id de l'annonce est bien recupérée on prépare une requete pour afficher les données de l'annonce ciblée

    if(isset($_SESSION['id'])){
        if(isset($_GET['id'])){
            global $db;
            $annonce_id = $_GET['id'];
            $sql = $db->query("SELECT * FROM annonces WHERE id = $annonce_id");
            $sql->setFetchMode(PDO::FETCH_ASSOC);

            $row = $sql->fetch();
        }
?>

<div class="col-md-12 text-center">
    <h2 class="py-4">Modification de votre annonce :</h2>
</div>
<div class="col-md-8 mb-5">
<!-- formulaire de modification du l'annonce -->
                <p>Veuillez modifiee les champs souhaités :</p>
                <form enctype="multipart/form-data" action="modify_annonce_post.php?id=<?= $row['id'] ?>" method="POST">
                    <div class="form-group">
                        <label for="exampleInputTitle">Titre de l'annonce</label>
                        <input type="text" class="form-control" name="titre" id="exampleInputTitle"
                             value="<?= $row['title'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDescription">Description de l'annonce</label>
                        <input type="text" name="description" class="form-control" id="exampleInputDescription"
                            value="<?= $row['description'] ?>">
                    </div>
                    <div class="form-group">
                    <p>Veuillez entrer les dates de disponibilités de votre logement :</p>
                    <input type="date" name="dateDebut" value="<?= $row['start_date'] ?>" min="<?= $date ?>">
                    <label for="dateDebut">: Date à laquelle le logement devient disponible</label>
                    </div>
                    <div class="form-group">
                    <input type="date" name="dateFin" value="<?= $row['end_date'] ?>" min="<?= $end_date ?>">
                    <label for="dateFin">: Date de la veille où le logement devient indisponible</label>
                    </div>
                    <div class="form-group">
                    <label for="type-select">Type de logement:</label>
                        <select name="category" id="type-select">
                            <option value=""> Selectionnez l'option </option>
                            <option value="t1">T1</option>
                            <option value="t2">T2</option>
                            <option value="t3">T3</option>
                            <option value="t4">T4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputAddress">Adresse du logement </label>
                        <input type="text" class="form-control" name="adresse" id="exampleInputAddress"
                             value="<?= $row['address_article'] ?>" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCity">Ville</label>
                        <input type="text" class="form-control" name="ville" id="exampleInputCity"
                             value="<?= $row['city'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPrice">Prix à la journée en euros</label>
                        <input type="text" class="form-control" name="price" id="exampleInputPrice"
                             value="<?= $row['price'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="file">Selectionnez une image pour l'annonce :
                        <input type="file" id="4" name="image"/>
                        </label>
                    </div>  
                    <input type="submit" name="submit_annonce" class="btn btn-info" value="Envoyez l'annonce">
                </form>
            </div>
            <div class="col-5">
            <a class="btn btn-info mb-3" href="profile.php" >Retour sans faire de modifications</a>
            </div>
            <?php
    }else{
        echo '<div class="alert alert-danger">Il faut vous connecter pour effectuer cette action !</div>';
    }

require('assets/footer.php'); ?>