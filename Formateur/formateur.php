<?php
session_start();
if(empty($_SESSION["login"]) || empty($_SESSION["password"])) 
{
  header("Location:../Authentification/authentification.php");
} 
$resultname="";
    $user=$_SESSION["login"];
    $role=$_SESSION["role"];
    $genre=$_SESSION["sexe"];
    
    if($genre=="M"){ $resultname="Monsieur ".$user;}
    if($genre=="F"){ $resultname="Madame ".$user;}
if(isset($_GET["erreur"])){
$erreur=$_GET["erreur"];}
else{
  $erreur="";}
 
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="formateur.css" />
    <link
      rel="stylesheet"
      href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css"
    />
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formateur</title>
    <link rel="icon" href="../images/logo_ofppt.png" type="image/icon">
  </head>

  <body>
  
    <div class="sidebar">
      <div class="logo-details">
        <img src="../images/logo.png" alt="logo" />
        <i class="bx bx-menu" id="btn"></i>
      </div>
      <ul class="nav-list">
        <li>
        <a href="../Accueil/Accueil.php" >
        <i class="fa-light fa-house"></i>
          <span class="links_name " >Accueil</span>
        </a>
         <span class="tooltip">Accueil</span>
        </li>
        <li>
          <a href="../Absence/index.php">
            <i class="fa-light fa-file-circle-plus"></i>
            <span class="links_name">Absence</span>
          </a>
          <span class="tooltip">Absence</span>
        </li>
        <li>
          <a href="../Recherche/index.php">
            <i class="fa-light fa-file-magnifying-glass"></i>
            <span class="links_name">Recherche</span>
          </a>
          <span class="tooltip">Recherche</span>
        </li>
        <li>
          <a href="../Pourcentage/index.php">
            <i class="fa-light fa-percent"></i>
            <span class="links_name">Pourcentage</span>
          </a>
          <span class="tooltip">Pourcentage</span>
        </li>
        <li>
          <a href="../Groupe/PageGroupe.php">
            <i class="fa-light fa-folder-plus"></i>
            <span class="links_name">Gestion Groupe</span>
            </a>
          <span class="tooltip">Gestion Groupe</span>
        </li>
        <li>
          <a href="formateur.php" class="active">
            <i class="fa-light fa-chalkboard-user active"></i>
            <span class="links_name active">Formateur</span>
          </a>
          <span class="tooltip">Formateur</span>
        </li>
        <li>
          <a href="../Note/index.php">
            <i class="fa-light fa-file-pen"></i>
            <span class="links_name">Note</span>
          </a>
          <span class="tooltip">Note</span>
        </li>
        <li>
          <a href="../Parametre/parrametre.php">
            <i class="fa-light fa-gear"></i>
            <span class="links_name">Paramètre</span>
          </a>
          <span class="tooltip">Paramètre</span>
        </li>
      </ul>
      <div class="profile">
        <div class="profile-details">
          <i class="fa-light fa-circle-user" id="user"></i>
          <!-- <span id="name"><?=$resultname?></span> -->
          <a href="../deconexion.php"><i class="fa-light fa-right-from-bracket" id="log_out"></i></a>
        </div>
      </div>
    </div>
    <div class="home-section">
      <div id="titre">
         <h2>Gestion des Formateurs</h2>
      </div>
      <div class="form">
        <form method="post" action="option.php">
          <div class="lol">
            <div class="sel" id="sele">
              <ul class="ul">
                <li>
                  <input type="text" placeholder=" nom de Formateur" name="formateur" id="Formateur" required />
                  <div style='color:red;'><?=$erreur?></div>
                </li>
                <li>
                  <input
                    type="submit"
                    name="valider"
                    value="Valider"
                    id="Btn_Valider"
                  />
                </li>
                <li class='btn'>
                <a href="ajouter.php">
                  <input
                    type="button"
                    value="Ajouter Formateur"
                    id="insert"
                    class="btn_insert"
                    name="Ajouter"
                  /></a>

                  <!--  <li><input onclick = " window.Location = 'index2.html'" type ="submit" value="valider" id="valider" class="btn_valider"></li> -->
                </li>
                <li class='btn'>
                  <a href="listformateur.php">
                  <input
                    type="button"
                    value="List Formateur"
                    id="insert"
                    class="btn_list"
                    name="list"
                  /></a></li>
              
                

               
              </ul>
            </div>
          </div>
        </form>
      </div>
    </div>
    <script>
      let sidebar = document.querySelector(".sidebar");
      let closeBtn = document.querySelector("#btn");
      let searchBtn = document.querySelector(".bx-search");

      if (closeBtn) {
        closeBtn.addEventListener("click", () => {
          sidebar.classList.toggle("open");
          menuBtnChange();
        });
      }

      if (searchBtn) {
          searchBtn.addEventListener("click", () => {
          sidebar.classList.toggle("open");
          menuBtnChange();
        });
      }

      function menuBtnChange() {
        if (sidebar.classList.contains("open")) {
          closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else {
          closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
      }
    </script>
  
  </body>
  
</html>
