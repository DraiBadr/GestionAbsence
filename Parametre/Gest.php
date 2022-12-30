<?php

include("../db.php");
session_start();
      if(empty($_SESSION["login"]) || empty($_SESSION["password"])) 
      {
        header("Location:../Authentification/authentification.php");
     
      }
      $result1="";
      $user=$_SESSION["login"];
      $role=$_SESSION["role"];
      $genre=$_SESSION["sexe"];
      if($role!="Admin" && $role!="admin"){
        
        header("Location:parrametre.php");
      }
      else{
        if($genre=="M"){ $result1="Monsieur ".$user;}
        if($genre=="F"){ $result1="Madame ".$user;}
          }
$pdo_statement = $pdo_conn->prepare("SELECT * FROM compte order by numCompte asc");
$pdo_statement->execute();
$result = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);	
if(isset($_POST['ajouter'])){
  header('location:Ajouter.php');
}

$pdo_statement = $pdo_conn->prepare("SELECT * FROM compte where role='admin'");
$pdo_statement->execute();
$pdo_statement->fetch(PDO::FETCH_ASSOC);	
$count=$pdo_statement->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>

   
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gestion Des Comptes</title>


    <meta charset="UTF-8">
    <link rel="stylesheet" href="style3.css">
    <link rel="icon" href="../images/logo_ofppt.png" type="image/icon type">
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet" />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>

  <div class="sidebar">
    <div class="logo-details">
      <img src="../images/logo.png"  alt="logo" />
        <i class='bx bx-menu' id="btn" ></i>
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
        <a href="../Absence/index.php" >
          <i class="fa-light fa-file-circle-plus "></i>
          <span class="links_name " >Absence</span>
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
       <a href="../Formateur/formateur.php">
        <i class="fa-light fa-chalkboard-user"></i>
         <span class="links_name">Formateur</span>
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
       <a href="Parrametre.php" class="active">
       <i class="fa-light fa-gear active"></i>
         <span class="links_name active">Paramètre</span>
       </a>
       <span class="tooltip">Paramètre</span>
     </li>
    </ul>
    <div class="profile">
      <div class="profile-details">
        <i class="fa-light fa-circle-user" id="user"></i>
        <!-- <span id="name"><?php echo $result1; ?></span> -->
        <a href="../deconexion.php"><i class="fa-light fa-right-from-bracket" id="log_out"></i></a>
      </div>
    </div>
  </div>

  <div class="home-section" align="center"> 
    
    <form method="POST">
        <div class="titre"> <h2>Gestion Des Comptes</h2>
              </div>
      
              <div id="Aj" >
             
                <table  >
                    <tr>
                      <th >Utilisateur</th>
                      <th>Role</th>
                      
                      <th colspan="2">Modifier/Supprimer</th>

                    </tr>
                    <?php
                        foreach($result as $compte){
                                $id=$compte['numCompte'];
                                $role=$compte["role"];
                    ?>
                      <tr>
                        <td><?= $compte['login'] ?></td>
                        
                        <td >
                              <?= $compte['role'] ?>
                        </td>
                        
                      <td><a href="modifier.php?id=<?= $id ?>&role=<?= $role ?>"><i class="fa-light fa-user-pen fa-lg"></i></a></i></td>
               
                        
                        
                       <?php if($role=="utilisateur" )
                       { ?>
                        <td><a href="delete.php?id=<?= $id ?>"><i style="color:red" class="fa-light fa-user-minus fa-lg"></i></a></td>
                 <?php      }
                 else{?>
                       <td><i style="color:red" class="fa-light fa-user-minus fa-lg"></i></a></td>
               <?php  } ?>


                      </tr>
                    <?php
                        }
                    ?>
                    
                  </table>
                  
              
              <p>Pour ajouter un nouveau compte veuillez cliquer sur le boutton <strong><em>"Ajouter Un Compte"</em></strong>.</p>
        <button id="btn" name='ajouter' class="btn">Ajouter Un Compte</button>

              </div>
              


    </form>
    


</div>
  
</body>
<script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    let searchBtn = document.querySelector(".bx-search");
  
    closeBtn.addEventListener("click", ()=>{
      sidebar.classList.toggle("open");
      menuBtnChange();//calling the function(optional)
    });
  
    searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
      sidebar.classList.toggle("open");
      menuBtnChange(); //calling the function(optional)
    });
  
    // following are the code to change sidebar button(optional)
    function menuBtnChange() {
     if(sidebar.classList.contains("open")){
       closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
     }else {
       closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
     }
    }
    </script>
 

    
</html>
