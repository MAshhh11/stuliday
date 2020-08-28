<?php 
    $page ='create_annonce';
    require('inc/connect.php'); 
    require('assets/head.php');
    include('assets/nav.php');

            // var_Dump($_SESSION);
            // var_Dump($file = $_FILES['image']);
            // var_Dump($titre = htmlspecialchars($_POST['titre']));
            // var_Dump($description = htmlspecialchars($_POST['description']));
            // var_Dump($dateDebut = $_POST['dateDebut']);
            // var_Dump($dateFin = $_POST['dateFin']);
            // var_Dump($category = $_POST['category']);
            // var_Dump($adresse = htmlspecialchars($_POST['adresse']));
            // var_Dump($ville = htmlspecialchars($_POST['ville']));
            // var_Dump($price = htmlspecialchars($_POST['price']));
            // var_Dump($authorAnnonce = $_SESSION['id']);

    if(isset($_SESSION)){
        // echo 'session ok <br>';
        if(!empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['dateDebut']) && !empty($_POST['dateFin']) && !empty($_POST['category']) && !empty($_POST['adresse']) && !empty($_POST['ville']) && !empty($_POST['price'])){
            // echo 'verifs ok <br>';
            $file = $_FILES['image'];
            $titre = htmlspecialchars($_POST['titre']);
            $description = htmlspecialchars($_POST['description']);
            $dateDebut = $_POST['dateDebut'];
            $dateFin = $_POST['dateFin'];
            $category = $_POST['category'];
            $adresse = htmlspecialchars($_POST['adresse']);
            $ville = htmlspecialchars($_POST['ville']);
            $price = htmlspecialchars($_POST['price']);
            $active = 1;
    
            if($file['size'] <= 1000000):
                $dbname = uniqid() . '_' . $file['name'];
                $upload_dir = "annonces/img/";
                $upload_name = $upload_dir . $dbname;
                $move_result = move_uploaded_file($file['tmp_name'], $upload_name);
                if($move_result): 
                    // echo 'move result ok <br>';
                    // var_Dump($move_result);
                    // var_Dump($upload_name);
                        
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
    echo 'Il faut vous connecter pour déposer une annonce !';
}


?>




<?php require('assets/footer.php'); ?>