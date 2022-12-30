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

$codeStagiaire=$_GET['id'];
$groupe=$_GET['groupe'];
$sql="select codeStagiaire,cin,nomStgr,prenomStgr,DateNaissance,sexe,codeGroupe from stagiaire where codeStagiaire=:uid";
$query = $pdo_conn->prepare($sql);
$query->bindParam(':uid',$codeStagiaire,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
$pdo_statement=$pdo_conn->prepare("SELECT codeGroupe FROM groupe");
$pdo_statement->execute();
$groupes=$pdo_statement->fetchAll(PDO::FETCH_ASSOC);
if(isset($_GET['groupe'])){
  $groupe=$_GET['groupe'];
}
else{
  $groupe="";
}
$erreur="";
if(isset($_POST['save'])){
 
  $stagiaire = $pdo_statement->fetch(PDO::FETCH_ASSOC);	
    $n=$pdo_statement->rowCount();
    $codeStag =$_POST['CodeStag'] ;
    $cin1 =$_POST['CIN1'] ;
    $nomStg =$_POST['NomStagiaire'];
    $prenomStg =$_POST['PrenomStagiaire'];
    $DateNaiss =$_POST['DateNaissance'];
    $sex =$_POST['Sexe'];
    $codegroupe=$_POST['CodeGroupe'];
    $stmt = $pdo_conn->prepare('UPDATE stagiaire SET codeStagiaire= ?, cin = ?, nomStgr = ?, prenomStgr = ?, DateNaissance = ?, sexe = ?, codeGroupe= ? WHERE codeStagiaire = ?');
    $stmt->execute([$codeStag, $cin1, $nomStg, $prenomStg, $DateNaiss,$_POST['Sexe'] , $codegroupe, $codeStagiaire]);
    $succes="bien modifier";
  foreach($results as $row){
  if($codeStag!=$row->codeStagiaire ||$cin1!=$row->cin || $nomStg!=$row->nomStgr || $prenomStg!=$row->prenomStgr ||$DateNaiss!=$row->DateNaissance ||$sex!=$row->sexe ||$codegroupe!=$row->codeGroupe ){
    header("location:../Groupe/AffichageGroupe.php?Annee=$Annee&filiere=$filiere&groupe=$groupe&succes=$succes");
    exit;
  }
  else{
    header("location:../Groupe/AffichageGroupe.php?Annee=$Annee&filiere=$filiere&groupe=$groupe");
    exit;
  }
}


  
  
}



if(isset($_POST['cancel'])){
  header("location:../Groupe/AffichageGroupe.php?Annee=$Annee&filiere=$filiere&groupe=$groupe");
  exit;
}

foreach($results as $result)
{


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Modification Stagiaire</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit.css">
    <link rel="icon" type="image/x-icon" href="../images/logo3.png">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
    <div class="main_div">
            <h2>Modifier Stagiaire</h2>
            <form method="post">
               <input type="hidden" value="">
               <table>
                  <tr class="tr">
                    <td class="td-label"><label>CodeStagiaire :</label></td>
                    <td class="td-input"><input type="text"  class="input" name="CodeStag" value="<?php echo htmlentities($result->codeStagiaire);?>" required></td>
                  </tr>
                  <tr class="tr">
                    <td class="td-label"><label>CIN :</label></td>
                    <td class="td-input"><input type="text"  class="input" name="CIN1" value="<?php echo htmlentities($result->cin);?>"required></td>
                  <tr class="tr">
                    <td class="td-label"><label>Nom :</label></td>
                    <td class="td-input"><input type="text"  class="input" name="NomStagiaire" value="<?php echo htmlentities($result->nomStgr);?>"required></td>
                  </tr>
                  <tr class="tr">
                    <td class="td-label"><label>Prenom :</label></td>
                    <td class="td-input"><input type="text"  class="input" name="PrenomStagiaire" value="<?php echo htmlentities($result->prenomStgr);?>"required></td>
                  </tr>
                  <tr class="tr">
                    <td class="td-label"><label>Date De Naissance :</label></td>
                    <td class="td-input"><input type="date"  class="input" name="DateNaissance" value="<?php echo htmlentities($result->DateNaissance);?>"required></td>
                  </tr>
                  <tr class="tr">
                    <td class="td-label"><label>Sexe :</label></td>
                    <td class="td-input">
                      <input type="radio" name="Sexe" value="M" <?php echo htmlentities($result->sexe) == "M" ? 'checked="checked"': ''; ?> required/><label id="sexe-h"> Homme </label>
                      <input type="radio" name="Sexe"  value="F" <?php echo htmlentities($result->sexe)== "F" ? 'checked="checked"': ''; ?> required/><label id="sexe-f"> Femme </label> 
                    </td>
                  </tr>
                  <tr class="tr">
                    <td class="td-label"><label>Groupe :</label></td>
                    <td class="td-input">
                      <select name="CodeGroupe">
                      <?php
                                     foreach($groupes as $array){
                                       foreach($array as $row){
                                          $selected="";
                                         if($groupe==$row)
                                          {
                                                      $selected="selected";
                                                  }
                                      echo "<option $selected value='$row'>$row</option> ";
                                  }}
                                      ?>
                      </select>
                      <?php } ?> 
                    </td>
                  </tr>
                  
              
                  
                  <span id="erreur"><?=$erreur?></span>
                  <tr class="tr">

                    <td><button id="Btn_Enregistrer" name="save">Enregistrer</button></td>
                    <td class="td-input">
                      <button id="Btn_Annuler" name='cancel'>Annuler</button>
                    </td>
                  </tr>
                </table>
            </form>
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