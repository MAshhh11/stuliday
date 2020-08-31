<?php 
    $page ='modify_annonce_post';
    require('inc/connect.php');
    require('inc/function.php'); 
    require('assets/head.php');
    include('assets/nav.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
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
            $active = 1;
    
            if($file['size'] <= 1000000):
                $dbname = uniqid() . '_' . $file['name'];
                $upload_dir = "annonces/img/";
                $upload_name = $upload_dir . $dbname;
                $move_result = move_uploaded_file($file['tmp_name'], $upload_name);
                if($move_result): 
                     
                    $sth = $db->prepare(" UPDATE annonces SET title=:title, description=:description,city=:city, category=:category, image_url=:image_url, address_article=:address_article ,active=:active, price=:price,author_article=:author_article, start_date=:start_date, end_date=:end_date  WHERE id=:id
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
                        $sth->bindValue(':id',$id);
                        $sth->execute();
                else: 
                    echo '<div class=alert alert-danger>Error in uploading the file</div>';
                    echo '<a class="btn btn-danger col" href="modifyannonce.php">Retour à la page précédente</a>';
                    die();
                endif;
            else: 
                echo 'the size of the file is not suitable';
                echo '<a class="btn btn-danger col" href="modifyannonce.php">Retour à la page précédente</a>';
                die();
            endif;
            echo '<div class="alert alert-info"> Votre annonce a bien été mise à jour !</div>';
            echo '<a class="btn btn-success col" href="annonces.php">Retour vers les annonces</a>';

        }else{
            echo 'Veuillez remplir tous les champs pour envoyez votre annonce !';
        }
    
}else{
    echo 'Il faut vous connecter pour déposer une annonce !';
}

?>