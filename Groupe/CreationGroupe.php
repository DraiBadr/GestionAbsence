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

// select filiere

$pdo_statement = $pdo_conn->prepare("SELECT codefiliere, nomfiliere from filiere ");
$pdo_statement->execute();
$filieres= $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
// select annee
$pdo_statement = $pdo_conn->prepare("SELECT distinct annéé from groupe ");
$pdo_statement->execute();
$annees= $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
$curyear=date("Y");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Création D'une Groupe</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CreationGroupe.css">
    <link rel="icon" type="image/x-icon" href="../images/logo3.png">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>  
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
          <h2>Création D'un Groupe</h2>
        </div> 
        <div class="upper-div">
            <a href="CreationFiliere.php"><input type="submit" value="Filière" id="Btn_Filiere"></a>
            <a href="CreationGroupe.php"><input type="submit" value="Groupe" id="Btn_Groupe"></a>
            <a href="CreationStagiaire.php"><input type="submit" value="Stagiaire" id="Btn_Stagiaire"></a>
        </div> 
        <div class="form">
        <form method="post" action="ajouterGroupe.php" >
              <div class="lol">
                  <div class="sel" id="sele">
                  <ul>
                      <li>
                                <select id="année-scolaire" name="année-scolaire" required>
                                    <option value="" selected disabled>ANNEE</option>
                                    <?php
                                    foreach($annees as $array){
                                        foreach($array as $row){
                                        echo "<option  value='$row'/>$row</option> ";
                                    }}
                                        ?>
                                </select>
                            </li>
                            <li>
                                <select id="filiére" name="filiére" required >
                                    <option value="" selected disabled>FILIERE</option>
                                    <?php
                                    foreach($filieres as $row){
                                        {
                                        echo "<option value='".$row['codefiliere']."'>".$row['nomfiliere']."</option> ";
                                    }}
                                        ?>
                                </select>
                            </li>
                            <li>
                                <input type="text" name="Groupe" id="Groupe"  placeholder="Nom Groupe" required/>
                                <span id="erreur"><?=$erreur?></span>
                            </li>
                            <li>
                              <input type="submit" name="valider" value="Ajouter" id="Btn_Ajouter">
                            </li>
                            <li>
                              <a href="SuppressionDesGroupes.php">
                              <input name="supprimer" value="Suppression Des Groupes" id="Btn_Supp">
                              </a>
                          </li>
                      </ul>
                  </div>
              </div>
          </form>
      </div>
      </div>
      </div>
  </body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
    // annee dependent ajax
    $("#année-scolaire").on("change",function(){
      var anneId = $(this).val();
      $.ajax({
        url :"action.php",
        type:"POST",
        cache:false,
        data:{anneId:anneId},
        success:function(data){
          $("#filiére").html(data);
        }
      });
    });
  }); 
</script>
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
