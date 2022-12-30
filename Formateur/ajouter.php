<?php
include('../db.php');
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
$pdo_statement = $pdo_conn->prepare("select nomF from formateur");
$pdo_statement->execute();
$formateurall= $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
if($_SERVER['REQUEST_METHOD']=="POST"){
	if(isset($_POST['Ajouter'])){
    $formateur=$_POST['formateur'];
    $formateur=strtoupper($formateur);
    }
    if(in_array((["nomF"=> $formateur]),$formateurall)){
      header("Location:formateurValide.php?nomf=$formateur");}
  else{
    $sql="INSERT INTO formateur(nomF,codeGroupe)VALUES(?,'Default')";
      $pdo_statement=$pdo_conn->prepare($sql);
      $pdo_statement->bindParam(1,$formateur);
      $pdo_statement->execute();
      header("Location:formateurValide.php?nomf=$formateur");
		}}
 
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
    <link rel="icon" href="../images/logo_ofppt.png" type="image/icon type">
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
          <span class="links_name">Accueil</span>
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
          <a href="../Recherche">
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
          <a href="../deconexion.php"><i class="fa-light fa-right-from-bracket" id="log_out"></i></a>
        </li>
    </div>
    <div class="home-section">
    <div id="titre">
        <h2>Création D'un Formateur</h2>
    </div>
    <div class="form">
      
		<form method="post" action="" class="divAjouter" class='f'>
			<ul class="ul">
      <tr>
			<li>
          <input type="text" name="formateur" required placeholder="Nom Formateur " class='inp-ajouter' >
      </li>
      </tr>
      <tr>
     

      </ul>
        </li>
				</ul>
			<ul>
				<li>
          <input type="submit" name="Ajouter" value="Ajouter" class='btn-ajouter'>
        </li>
			</ul>
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
