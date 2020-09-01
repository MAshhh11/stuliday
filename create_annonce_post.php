<?php 
    $page ='create_annonce';
    require('inc/connect.php'); // connexion a la db
    require('assets/head.php'); // appel au fichier contenant le html de l'entete
    include('assets/nav.php'); // appel au fichier contenant le htm de la barre de navigation


    if(isset($_SESSION['id'])){ // si une session est active on récupère les données du formulaire rentrées par l'user
        
        if(!empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['dateDebut']) && !empty($_POST['dateFin']) && !empty($_POST['category']) && !empty($_POST['adresse']) && !empty($_POST['ville']) && !empty($_POST['price'])){
            
            $file = $_FILES['image'];
            $titre = htmlspecialchars($_POST['titre']);
            $description = htmlspecialchars($_POST['description']);
            $dateDebut = $_POST['dateDebut'];
            $dateFin = $_POST['dateFin'];
            $category = $_POST['category'];
            $adresse = htmlspecialchars($_POST['adresse']);
            $ville = htmlspecialchars($_POST['ville']);
            $price = htmlspecialchars($_POST['price']);
            $active = 1; // on défini active en 1 de base 1= libre
            
            if($file['size'] <= 1000000): // si la taille du fichier n'excède pas 1000000 on l'upload
                $dbname = uniqid() . '_' . $file['name'];
                $upload_dir = "annonces/img/";
                $upload_name = $upload_dir . $dbname;
                $move_result = move_uploaded_file($file['tmp_name'], $upload_name);
                if($move_result): 
                  // si l'upload réussi on prépare la requete pour mettre à jour "annonces" dans la db
                        
                    $sth = $db->prepare(" INSERT INTO annonces(title,description,city,category,image_url,address_article,active,price,author_article,start_date,end_date) VALUES (:title,:description,:city,:category,:image_url,:address_article,:active,:price,:author_article,:start_date,:end_date)
                    ");
                        $sth->bindValue(':title',$titre);
                        $sth->bindValue(':description',$description);
                        $sth->bindValue(':city',$ville);
                        $sth->bindValue(':category',$category);
                        $sth->bindValue(':image_url',$upload_name);
                        $sth->bindValue(':address_article',$adresse);
                        $sth->bindValue(':active',$active);
                        $sth->bindValue(':price',$price);
                        $sth->bindValue(':author_article',$_SESSION['id']);
                        $sth->bindValue(':start_date',$dateDebut);
                        $sth->bindValue(':end_date',$dateFin);
                        $sth->execute();
                else: 
                    echo '<div class=alert alert-danger>Error in uploading the file</div>';
                    echo '<a class="btn btn-danger col" href="create_annonce.php">Retour à la page précédente</a>';
                    die();
                endif;
            else: 
                echo 'the size of the file is not suitable';
                echo '<a class="btn btn-danger col" href="create_annonce.php">Retour à la page précédente</a>';
                die();
            endif;
            echo '<div class="alert alert-info"> Votre annonce a bien été ajoutée !</div>';
            echo '<a class="btn btn-success col" href="profile.php">Retour vers votre profil</a>';

        }else{
            echo 'Veuillez remplir tous les champs pour envoyez votre annonce !';
        }
    
}else{
    
    echo '<div class="alert alert-danger"> Il faut vous connecter pour déposer une annonce !</div>';
}


?>




<?php require('assets/footer.php'); ?>