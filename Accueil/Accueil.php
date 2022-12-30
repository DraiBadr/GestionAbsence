<?php
include ('../db.php');
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
$curyear=date("Y");
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="../images/logo3.png">
    <link rel="stylesheet" href=" https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css ">
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
  />    
</head>
<body>
   
    <h1 id="T"><span class='Bspan'>Welcome to our web site  </span></h1>
    <p id="ST">Nous sommes à votre service</p>

<div class="container">
    
    <div class="box">
      <span>
        
      </span>
      <div class="content">
        <h2>Absence</h2>
        <p >Insertion d'absence des stagiaires ou modifier ou annuler l'absence</p>
        <a href="../Absence/index.php">Cliquez ici</a>
      </div>
    </div>

    <div class="box">
      <span></span>
      <div class="content">
        <h2>Recherche</h2>
        <p>Recherche des stagiaires par CIN </p>
        <a href="../Recherche/index.php">Cliquez ici</a>
      </div>
    </div>

    <div class="box">
      <span></span>
      <div class="content">
        <h2>Pourcentage</h2>
        <ul>
            <li>Pourcentage par Mois</li>
            <li>Pourcentage par Semaine</li>
        

        </ul>
        <a  href="../Pourcentage/index.php">Cliquez ici</a>
      </div>
    </div>

    <div class="box">
        <span></span>
        <div class="content">
          <h2>Groupe</h2>
          <ul>
            <li>Création d'un Fillière </li>
            <li>Création d'un Groupe</li>
            <li>Ajoute d'un Stagiaire</li>
        

        </ul>       
           <a href="../Groupe/PageGroupe.php">Cliquez ici</a>
        </div>
      </div>

      <div class="box">
        <span></span>
        <div class="content">
          <h2>Formateur</h2>
            
            <p>Ajoute d'un Formateur
            <br>Recherche  d'un Formateur 
            <br>  Suppression d'un Formateur
            </p>

        

        
          <a  href="../Formateur/formateur.php">Cliquez ici</a>
        </div>
      </div>

      <div class="box">
        <span></span>
        <div class="content">
          <h2>Note</h2>
          <p>
            Les notes des stagiaires par filliére , année , groupe.
          </p>

       <a href="../Note/index.php">Cliquez ici</a>
        </div>
      </div>
      
      <div class="box">
        <span></span>
        <div class="content">
          <h2>Paramètre</h2>
          <ul>
            <li>Modification de mot de passe </li>
            <?php if($role==="admin"){ ?>
                <ul>
                    <li>La gestion des comptes</li>
                </ul>
                <?php };?>
           

        </ul>      
          <a href="../Parametre/Parrametre.php" >Cliquez ici</a>
        </div>
      </div>
  </div>
    
    
</body>

<footer class="text-center text-white" >
    <!-- Grid container -->
    <div class="container pt-4">
      <!-- Section: Social media -->
      <section class="mb-4">
        <!-- Facebook -->
        <a style= "--clr:#0000FF;"
          class="btn btn-link btn-floating btn-lg text-dark m-1"
          href="https://web.facebook.com/ofppt.page.officielle/?_rdc=1&_rdr"
          role="button"
          data-mdb-ripple-color="dark"
          ><i class="fab fa-facebook-f"></i
        ></a>
  
        <!-- Youtube -->
        <a style= "--clr:#ff2972;"
          class="btn btn-link btn-floating btn-lg text-dark m-1"
          href="https://www.youtube.com/c/ofpptchaineofficielle"
          role="button"
          data-mdb-ripple-color="dark"
          >
        <i class="fa-brands fa-youtube"></i></a>
  
        <!-- twitter -->
        <a style= "--clr:#00BFFF;"
          class="btn btn-link btn-floating btn-lg text-dark m-1"
          href="https://twitter.com/OFPPT_Officiel"
          role="button"
          data-mdb-ripple-color="dark"
          ><i class="fab fa-twitter"></i></a>
  
        <!-- Instagram -->
        <a style= "--clr:#FF1493;" 
          class="btn btn-link btn-floating btn-lg text-dark m-1"
          href="https://www.instagram.com/ofppt.officiel/"
          role="button"
          data-mdb-ripple-color="dark"
          ><i class="fab fa-instagram"></i
        ></a>
  
        <!-- Linkedin -->
        <a style= "--clr:#483D8B;"
          class="btn btn-link btn-floating btn-lg text-dark m-1"
          href="https://www.linkedin.com/company/ofpptpageofficielle/"
          role="button"
          data-mdb-ripple-color="dark"
          ><i class="fab fa-linkedin"></i
        ></a>
        
      </section>
      <!-- Section: Social media -->
    </div>
  
    <!-- Copyright -->
    <div class="text-center text-dark p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        Copyright © OFPPT <?php echo($curyear) ;?>
        <a class="text-dark" href="https://www.ofppt.ma/">www.ofppt.ma</a>
    </div>
    <!-- Copyright -->
  </footer>

</html>

