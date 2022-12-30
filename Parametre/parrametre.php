
<!DOCTYPE html>
<html lang="en">
<head>
<?php  
  include ('../db.php');
  session_start();
  if(empty($_SESSION["login"]) || empty($_SESSION["password"])) 
 {
    header("Location:../Authentification/authentification.php");
 } 
  
      $result="";
      $user=$_SESSION["login"];
      $role=$_SESSION["role"];
      $genre=$_SESSION["sexe"];
      if($role==="Admin" || $role==="admin"){
        
        header("Location:parramAdmin.php");
      }
      
    
$erreur="";
$erreur1="";
if($_SERVER['REQUEST_METHOD']=='POST')
{  $pass1=strip_tags($_POST['pass1']);
  $pass=strip_tags($_POST['password']);
  $confirm=strip_tags($_POST['confirmation']);
   
 
  
 if(isset($_POST["enregister"])) 
   {
    if ( empty($pass) || empty($confirm)|| empty($pass1))
    {         
       $erreur="Tous les champs sont obligatoire";
    }
    else{
      
        $sql = "select * from compte WHERE `compte`.`login` =?";
        $pdo_statement = $pdo_conn->prepare( $sql );
        $pdo_statement->bindParam(1, $user);
        $pdo_statement->execute();
        $resultat = $pdo_statement->fetch();
        if($resultat["password"] === $_POST["pass1"])
        {
         
          if (strlen($pass) < 3) {
            $erreur= 'Mot de passe doit contenir au moins 3 caracteres)';
          }
          else{
              if($pass===$confirm)
            {
                $sql = "UPDATE `compte` SET `password` = ? WHERE `compte`.`login` = ?";
                $pdo_statement = $pdo_conn->prepare( $sql );
                $pdo_statement->bindParam(1, $_POST["password"]);
                $pdo_statement->bindParam(2, $user);
                $pdo_statement->execute();
                $erreur1="votre mot de passe a été modifié"; 
                $erreur='';               
            };
    
            if ($pass!==$confirm)
            {
              
                $erreur="le password et la confirmation doivent être identique";
            }
        }}
        else{
          $erreur="l'ancien mot de passe est incorrect";
        }    
 }	
}
}

 
?>

    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètre</title>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="../images/logo_ofppt.png" type="image/icon type">
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"/>
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
        <!-- <span id="name"><?=$result;?></span> -->
        <a href="../deconexion.php"><i class="fa-light fa-right-from-bracket" id="log_out"></i></a>
      </div>
    </div>
  </div>

  <div class="home-section"> 
  <div class="titre"><h2> Paramètre de  </h2>
                </div>
    <form method="POST">
                <div class="parram">
              
                  
                <div style="margin-top:20px"class="id">  
                      
            <i class="fa-light fa-circle-user fa-4x" ></i>
                    </div>
                    <!-- <span ><?php echo $result; ?></span> -->
                    
                    <table>
                        <tr>
                            <td><label>Ancien mot de passe :</label></td>
                            <div class="Set">  
                              <td><input id='pass1' type="password" required name="pass1">
                           
                            <span class="eye" onclick="myfunction3()">
                            <i id="hide5" class="fa-light fa-eye"></i>
                                <i id="hide6" class="fa-light fa-eye-slash"></i>
                </span>
                          
                          </div>
                        </td>
                          
                            
                        </tr>
                        <tr>
                            <td>
                                <label>Nouveau Mot de passe :</label>
                                
                            </td>
                            <td>
                              <div class="Set">
                                <input type="password" id='pass' required name="password">
                                <span class="eye" onclick="myfunction()">
                                <i id="hide1" class="fa-light fa-eye"></i>
                                <i id="hide2" class="fa-light fa-eye-slash"></i>
                </span>
                              </div>
                            </td>
                        </tr>
                        <tr><td>
                            <label>Confirmer le nouveau mot de passe :
                            </label>
                            
                        </td>
                        <td>
                          <div  class="Set"> <input id='conf' required type="password" name="confirmation">
                        <span class="eye" onclick="myfunction2()">
                        <i id="hide3" class="fa-light fa-eye"></i>
                                <i id="hide4" class="fa-light fa-eye-slash"></i>
                </span>
                      </div>
                           
                        </td>
                    </tr>
                       <tr>
                        <td colspan=2><div id="err1"><?php echo $erreur;?></div>
                        <div id="err2"><?php echo $erreur1;?></div>
                        </td>
                       </tr>
                    </table>
                    <button class="Enrg" type="submit"  name="enregister">Enregistrer</button>

                </div>

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


                function myfunction2(){
            var x= document.getElementById('conf');
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
                function myfunction3(){
            var x= document.getElementById('pass1');
            var y =document.getElementById('hide5');
            var z=document.getElementById('hide6');

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
