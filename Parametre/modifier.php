<?php
include('../db.php');
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
$rl=$_GET["role"];
$id=$_GET['id'];
$pdo_statement=$pdo_conn->prepare("SELECT * FROM compte where numCompte=$id");
$pdo_statement->bindParam(1,$id);
$pdo_statement->execute();
$result=$pdo_statement->fetch();

$erreur="";

if($_SERVER['REQUEST_METHOD']=="POST")
{
    if(isset($_POST['update']))
    {
      
      $login=strip_tags($_POST['login']);
      $email=strip_tags($_POST['email']);
      
      if (!preg_match("/^[A-Z][a-z]+(\s)*$/",$login)) {
        $erreur = "Votre nom doit être  commencer par un majuscule( seulement la première lettre)";
        
      }   
      else{
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $erreur = "Format d'email non valide";
        }
        else{
        $sql = "update compte set login=? , email=? , sexe=? , role=? where numCompte=$id ";        
        $pdo_statement=$pdo_conn->prepare($sql);
        $pdo_statement->bindParam(1,$login);
        $pdo_statement->bindParam(2,$email);
        $pdo_statement->bindParam(3,$_POST['sexe']);
        $pdo_statement->bindParam(4,$_POST['role']);
        $pdo_statement->execute();
        header("Location:Gest.php");
        }
       
    }
  }
}


$pdo_statement = $pdo_conn->prepare("SELECT * FROM compte where role='admin'");
$pdo_statement->execute();
$pdo_statement->fetch(PDO::FETCH_ASSOC);	
$count=$pdo_statement->rowCount();
 
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Un Compte</title>
    <link rel="stylesheet" href="style5.css">
    <link rel="icon" href="../images/logo_ofppt.png" type="image/icon type">
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
  />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
   </head>
<body>

  <div class="sidebar">
    <div class="logo-details">
      <img src="../images/logo.png" alt="logo" />
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
        
      
 <div class="titre">  <h2>Modifier Un Compte</h2>
              </div>
              <div class="Aj">
            
                <div >
                <div style="margin-top:20px"class="id">  
                <i  class="fa-light fa-user-gear fa-4x"></i> 
                    </div>
                    <table id="Ajtab">
                        <tr>
                            <td>Nom D'Utilisateur :</td>
                            <td><input type="text" name="login" value="<?= $result['login'] ?>"/></td>
                            
                        </tr>
                        <tr>
                            <td >Email :</td>
                            <td ><input type="text" name="email" value="<?= $result['email'] ?>"/></td>
                            
                        </tr>
                     
                        <tr>
                            <td >Genre :</td>

                            <td>
                            <?php 
                                if($result['sexe']=='F')
                                    {?>
                                    Femme <input type="radio" name="sexe" id="" value="F" checked>
                                    Homme <input type="radio" name="sexe" id="" value="M" >
                                    <?php    } 
                                    else{?>
                                        Femme <input type="radio" name="sexe" id="" value="F" >
                                        Homme <input type="radio" name="sexe" id="" value="M" checked>
                                        <?php }                  
                            ?></td>
                            
                        </tr>

                        <?php if($count==1 &&  $rl=="admin"){?>
                        <tr>
                           <td>Role :</td>
                            
                                  <td>
                                    <select name="role">

                                      <option value="admin"selected>Admin</option>
                                      



                                    </select>
                                 </td> 
                            
                        </tr>
                        <?php      }
                 else{?>
                      <tr>
                      <td>Role :</td>
                            <?php 
                                if($result['role']=='utilisateur')
                                    {?>
                                  <td>
                                    <select name="role">

                                      <option value="admin">Admin</option>
                                      <option value="utilisateur" selected>utilisateur</option>



                                    </select>
                                 </td>
                            <?php    } 
                                elseif($result['role']=='admin'){?>
                                  <td>
                                    <select name="role">

                                      <option value="admin" selected>Admin</option>
                                      <option value="utilisateur" >utilisateur</option>



                                    </select>
                                  </td> <?php }                  
                            
                                else{?>
                                  <td>
                                    <select name="role">

                                      <option value="admin" >Admin</option>
                                      <option value="utilisateur" >utilisateur</option>


                                    </select>
                                  </td> <?php }                  
                            ?>
                      </tr>
               <?php  } ?>
                       
                        
                   
                       
                     
                      
                    </table>
                    <div id="err1"><?php echo $erreur;?></div>
                    <button class="btn" name="update">Enregistrer</button>
                    <button type="reset" id="Btn_Annuler">Annuler</button>



                </div>


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
  
           <script>
        function myfunction(){
            var x= document.getElementById('pass');
            var y =document.getElementById('hide1');
            var z=document.getElementById('hide2');

            if(x.type=='password'){
                x.type='text';
                y.style.display="block";
                z.style.display="none";

                }
             else{
                x.type='password';
                y.style.display="none";
                z.style.display="block";

                } } 

                function myfunction1(){
            var x= document.getElementById('pass1');
            var y =document.getElementById('hide3');
            var z=document.getElementById('hide4');

            if(x.type=='password'){
                x.type='text';
                y.style.display="block";
                z.style.display="none";

                }
             else{
                x.type='password';
                y.style.display="none";
                z.style.display="block";

                } } 



    </script> 
    
    
</html>
