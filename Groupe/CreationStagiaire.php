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
if($genre=="M"){ $result1="Monsieur ".$user;}
if($genre=="F"){ $result1="Madame ".$user;}
if(isset($_GET['groupeName'])){
  $groupeName=$_GET['groupeName'];
}
else{
  $groupeName="";
}
$pdo_statement=$pdo_conn->prepare("SELECT codeGroupe,nomGroupe FROM groupe");
$pdo_statement->execute();
$groupe=$pdo_statement->fetchAll(PDO::FETCH_ASSOC);
$sucess="bien_Ajouté";
$erreur="";
$curyear=date("Y");
if($_SERVER["REQUEST_METHOD"]=="POST"){ 
    if(isset($_POST['ajouter']))
    {  
      $pdo_statement = $pdo_conn->prepare("SELECT * FROM stagiaire where cin=? or codeStagiaire=?");
      $pdo_statement->bindParam(1,$_POST["Cin"]);
      $pdo_statement->bindParam(2,$_POST["codeStagiaire"]);
      $pdo_statement->execute();
      $stagiaire = $pdo_statement->fetch(PDO::FETCH_ASSOC);	
      $n=$pdo_statement->rowCount();
      if($n==0){
      $codeStagiaire=strip_tags($_POST['codeStagiaire']);
      $Cin=strip_tags($_POST['Cin']);
      $Nom=strip_tags($_POST["Nom"]);
      $Prenom=strip_tags($_POST['Prenom']);
        $sql = "INSERT INTO stagiaire VALUES ( ?,?,?,?,?,?,?)";
        $pdo_statement=$pdo_conn->prepare($sql);
        $pdo_statement->bindParam(1,$codeStagiaire);
        $pdo_statement->bindParam(2,$Cin);
        $pdo_statement->bindParam(3,$Nom);
        $pdo_statement->bindParam(4,$Prenom);
        $pdo_statement->bindParam(5,$_POST['Date']);
        $pdo_statement->bindParam(6,$_POST['Sexe']);
        $pdo_statement->bindParam(7,$_POST['groupe']);
        $pdo_statement->execute();
        header("Location:../Groupe/CreationStagiaire.php?groupeName=$_POST[groupe]&succes=$sucess");
      }
      else{
        $erreur="Ce stagiaire existe deja !";
      }
        }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Création D'un Stagiaire</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CreationStagiaire.css">
    <link rel="icon" type="image/x-icon" href="../images/logo3.png">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css">
  </head>
  <body>
<?php
function frm_entry_update($succes)
{
if(isset($_GET['succes'])){
  ?>
  <script>
    jQuery(document).ready(function($){
    alert("<?php echo $succes;?>");
      });
  </script>

    <?php
    }
}
frm_entry_update("bien Ajouté");
?>
      <div class="sidebar">
        <div class="logo-details">
          <img src="../images/logo.png" alt="logo" />
          <i class='bx bx-menu' id="btn" ></i>
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
            <a href="PageGroupe.php" class="active">
              <i class="fa-light fa-folder-plus active"></i>
              <span class="links_name active">Gestion Groupe</span>
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
          <a href="../Parametre/parrametre.php">
            <i class="fa-light fa-gear"></i>
            <span class="links_name">Paramétre</span>
          </a>
          <span class="tooltip">Paramétre</span>
        </li>
        </ul>
        <div class="profile">
            <div class="profile-details">
              <i class="fa-light fa-circle-user" id="user"></i>
              <span id="name"><?php echo $result1; ?></span>
              <a href="#">
                <i class="fa-light fa-right-from-bracket" id="log_out"></i>
              </a>
            </div>
        </div>
      </div>
      <div class="home-section">
        <div id="titre">
          <h2>Création D'un Stagiare</h2>
        </div> 
        <div class="upper-div">
            <a href="CreationFiliere.php"><input type="submit" value="Filière" id="Btn_Filiere" class="Filiere"></a>
            <a href="CreationGroupe.php"><input type="submit" value="Groupe" id="Btn_Groupe" class="Groupe"></a>
            <a href="CreationStagiaire.php"><input type="submit" value="Stagiaire" id="Btn_Stagiaire" class="Stagiaire"></a>
        </div> 
        <div class="form">
          <form method="post" >
              <div class="lol">
                  <div class="sel" id="sele">
                      <ul>  
                            <li>
                                <input type="text" name="codeStagiaire" id="codeStagiaire" placeholder="Code Stagiaire" required/>
                            </li>
                            <li>
                                <input type="text" name="Cin" id="Cin" placeholder="Cin" required/>
                            </li>
                            <li>
                                <input type="text" name="Nom" id="Nom" placeholder="Nom" required/>
                            </li>
                            <li>
                                <input type="text" name="Prenom" id="Prenom" placeholder="Prenom" required/>
                            </li>
                            <li>
                                <input type="date" name="Date" id="Date"required/>
                            </li>
                            <li>
                                <input type="radio" name="Sexe" class="Sexe" checked value="M"/><span class="name">Masculin</span>
                                <input type="radio" name="Sexe" class="Sexe" value="F"/><span class="name">Feminin</span>
                            </li>
                            <li>
                                <select name="groupe" required>
                                    <option value="rien">Groupe</option>
                                    <?php 
                                     foreach($groupe as $array){
                                       foreach($array as $row){
                                          $selected="";
                                         if($groupeName==$row)
                                          {
                                                      $selected="selected";
                                                  }
                                      echo "<option $selected value='$row'>$row</option> ";
                                  }}
                                      ?>
                                </select>
                                <div><?= $erreur?></div>
                            </li>
                            <li><input type="submit" name="ajouter" value="Ajouter" id="Btn_Ajouter"></li>
                      </ul>
                  </div>
              </div>
          </form>
        </div>
        <br>
      </div>
      </div>
  </body>
</html>
<script>
  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");
  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
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
