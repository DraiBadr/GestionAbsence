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
if(isset($_GET["erreur"])){
    $erreur=$_GET["erreur"];}
else{
    $erreur="";}

$curyear=date("Y");

?>
<?php 
include ('../db.php');

if(isset($_POST['delete']) && isset($_POST['deleteId'])){
    foreach($_POST['deleteId'] as $deleteId){
            $sql="DELETE from filiere where codefiliere = '$deleteId'";
			$pdo_statement=$pdo_conn->prepare($sql);
			$pdo_statement->execute();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Suppression Des Filières</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="SuppressionDesFilieres.css">
    <link rel="icon" type="image/x-icon" href="../images/logo3.png">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>  
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        <div class="upper-div">
          <h2>Suppression Des Filières</h2>
        </div>
        <form class="" action="" method="POST">
            <table id="table">
              <tr>
                  <th class="th-check"><button type="button" id="selectAll">Sélectionner Tout</button></th>
                  <th hidden class="th">#</th>
                  <th class="th">Nom Filière</th>
                  <th class="th">Année</th>  
              </tr> 
              <?php
                //Le tableau des groupes
                $sql="SELECT * from filiere order by annéé asc,nomfiliere  ";
                $pdo_statement=$pdo_conn->prepare($sql);
                $pdo_statement->execute();
                $absence=$pdo_statement->fetchAll();
                $i = 1;
                foreach($absence as $row){
              ?>
              <tr class="tr">
                <td class="td-check"><input type='checkbox' name='deleteId[]' value='<?php echo $row['codefiliere']?>'/></td>
                <td hidden class="td"><?php $i++; ?></td>
                <td class="td"><?php echo $row['nomfiliere']?></td>
                <td class="td"><?php echo $row['Annéé']?></td>      
              </tr>
              <?php } ?>
            </table>
            <button type="submit" name="delete" id="Btn_Delete" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce filière !!')">Supprimer</button>
        </form>
      </div>
  </body>
</html>
<script>$(document).ready(function () {
  $('body').on('click', '#selectAll', function () {
    if ($(this).hasClass('allChecked')) {
        $('input[type="checkbox"]').prop('checked', false);
    } else {
        $('input[type="checkbox"]').prop('checked', true);
    }
    $(this).toggleClass('allChecked');
  })
});</script>
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
