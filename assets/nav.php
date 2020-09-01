<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
  <div class="container">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="index.php" style="font-family:Lobster;font-size: 35px; color: #555">Stuliday</a>
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
    
      <?php // si il y a une session et que l'id est 6 alors on affiche les "admin tools"
      if (isset($_SESSION['id']) && $_SESSION['id'] == 6){
        ?>
        <li class="nav-item">
          <a class="nav-link" href="userlist.php">Admin tools</a>
        </li>
        <?php } ?>
      <li class="nav-item">
        <a class="nav-link" href="annonces.php">Annonces</a>
      </li>
      <?php // si il n'y a pas de session alors on affiche "login"
      if (empty($_SESSION)){
        ?>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
      <?php
      }
      ?>
      
      <?php // si un utilisateur est connecté on "affiche mon compte"
      if (isset($_SESSION['email'])){
        ?>
        <li class="nav-item">
          <a href="profile.php" class="nav-link">Mon compte</a>
        </li>
        <li class="nav-item">
        <a href="?logout" class="nav-link">Se déconnecter</a>
        </li>
        <?php
      }
      ?>
      
      
    </ul>
    
  </div>
  </div>
</nav>