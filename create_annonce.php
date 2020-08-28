<?php 
    $page ='create_annonce';
    require('assets/head.php');
    include('assets/nav.php');
    require('inc/connect.php'); 
    $date = date('Y-m-d');
?>

<div class="col-md-12 text-center">
    <h2 class="py-4">Créez votre annonce personnalisée :</h2>
</div>
<div class="col-md-8 mb-5">
                <p>Pour démarrer veuillez remplir les champs souhaités :</p>
                <form enctype="multipart/form-data" action="create_annonce_post.php" method="POST">
                    <div class="form-group">
                        <label for="exampleInputTitle">Titre de l'annonce</label>
                        <input type="text" class="form-control" name="titre" id="exampleInputTitle"
                             placeholder="Votre titre">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDescription">Description de l'annonce</label>
                        <input type="text" name="description" class="form-control" id="exampleInputDescription"
                            placeholder="Veuillez entrer une description">
                    </div>
                    <div class="form-group">
                    <p>Veuillez entrer les dates de disponibilités de votre logement :</p>
                    <input type="date" name="dateDebut" min="<?= $date ?>">
                    <label for="dateDebut">: Date à laquelle le logement devient disponible</label>
                    </div>
                    <div class="form-group">
                    <input type="date" name="dateFin" min="<?= $date ?>">
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
                             placeholder="Adresse du logement" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCity">Ville</label>
                        <input type="text" class="form-control" name="ville" id="exampleInputCity"
                             placeholder="Ville">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPrice">Prix à la journée en euros</label>
                        <input type="text" class="form-control" name="price" id="exampleInputPrice"
                             placeholder="Veuillez entrer le prix souhaité">
                    </div>
                    <div class="form-group">
                        <label for="file">Selectionnez une image pour l'annonce :
                        <input type="file" id="4" name="image"/>
                        </label>
                    </div>  
                    <input type="submit" name="submit_annonce" class="btn btn-info" value="Envoyez l'annonce">
                </form>
            </div>

<?php require('assets/footer.php'); ?>