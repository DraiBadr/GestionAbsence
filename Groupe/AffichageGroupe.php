
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
$Annee = $_GET["Annee"];
$filiere = $_GET["filiere"];
$groupe = $_GET['groupe'];
// select groupe

$pdo_statement = $pdo_conn->prepare("SELECT  codeGroupe from groupe ");
$pdo_statement->execute();
$groupes= $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
//selection des Groupe
$pdo_statement = $pdo_conn->prepare("SELECT distinct nomGroupe from groupe");
$pdo_statement->execute();
$nomgroupes = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);

// select filiere

$pdo_statement = $pdo_conn->prepare("SELECT codefiliere, nomfiliere from filiere ");
$pdo_statement->execute();
$filieres= $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
// select annee
$pdo_statement = $pdo_conn->prepare("SELECT distinct annéé from groupe ");
$pdo_statement->execute();
$annees= $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
$pdo_statement = $pdo_conn->prepare("SELECT distinct codefiliere,nomGroupe from groupe where codeGroupe='$groupe'");
$pdo_statement->execute();
$groupes = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
$pdo_statement = $pdo_conn->prepare("SELECT *  FROM stagiaire where codeGroupe='$groupe' order by nomStgr ASC");
$pdo_statement->execute();
$result = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
$curyear=date("Y");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Groupe</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Groupe/AffichageGroupe.css">
    <link rel="icon" type="image/x-icon" href="../images/logo3.png">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>  
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
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
frm_entry_update("bien modifier");
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
        <div class="form">
            <form method="POST" action="valide.php" >
                <div class="lol">
                    <div class="sel" id="sele">
                        <ul class="ul">
                            <li>
                            <select id="année-scolaire" name="année-scolaire">
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
                            <select id="filiére" name="filiére" >
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
                            <select id="groupe" name="groupe" required >
                                    <option value="" selected disabled >GROUPE</option>
                                    <?php //l'affichage du selection des groupe
                                           foreach($nomgroupes  as $array){
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
                            </li>
                            <li>
                                <input type="submit" value="Valider" id="valider" name="valider" class="btn_valider">
                            </li>
                        </ul>
                    </div>
                </div>
            </form>
            <div>
              <div>
                <h2 id="ListesStagiares">Listes des Stagiaires</h2>
                <?php
                    foreach ($groupes as $row) {
                      echo  "<h3>" . $row['nomGroupe'] . "</h3>";
                    }
                    ?>
              </div>
              <div>
                        <table id="table">
                                  <thead>
                                  <tr>
                                  <th class="th">Code Stagiaire</th>
                                      <th class="th" >CIN</th>
                                      <th class="th">Nom</th>
                                      <th class="th">Prenom</th>
                                      <th class="th">Date De Naissance</th>
                                      <th class="th">Sexe</th>
                                      <th class="th">Groupe</th>   
                                       <th class="th">Modifier / Supprimer</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                    
                                  <?php
                                  foreach ($result as $row) {
                                   echo "<tr id=$row[codeStagiaire] class='tr'>
                                   <td class='td'>$row[codeStagiaire]</td>
                                   <td class='td'>$row[cin]</td>
                                   <td class='td' >$row[nomStgr]</td>
                                   <td class='td'>$row[prenomStgr]</td>
                                   <td class='td'>$row[DateNaissance] </td>
                                   <td class='td'>$row[sexe]</td>
                                   <td class='td'>$row[codeGroupe]</td>
                                   <td class='td2'id='btn-group'>
                                             <a class='update' name='update' id='update' href='../Groupe/edit.php?id=$row[codeStagiaire]&groupe=$groupe'><i class='fa-light fa-pen-to-square'></i></a>
                                             <span class='remove' id='delete'><i class='fa-light fa-trash'></i></span>
                                   </td>
                                   </tr>";
                                   }
                                   ?>
                                  </tbody>
                        </table>
              </div>
              <br/>
              <a  class="ajoutestg" href="../Groupe/CreationStagiaire.php?groupeName=<?=$groupe?>" role="button">Ajouter Un Stagiaire</a>
              <br/><br/><br/>
            </div>
        </div>
      </div>
  </body>
  <script type="text/javascript">
$(".remove").click(function(){
  var id = $(this).parents("tr").attr("id");
  if(confirm('Are you sure to remove this  stagiaire ?'))
  {
      $.ajax({
        url: 'delete.php',
        type: 'GET',
        data: {id: id},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
              $("#"+id).remove();
              alert("Record removed successfully");  
        }
      });
  }
});
</script>                                 
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
    // filiere dependent ajax
    $("#filiére").on("change", function(){
      var filiereId = $(this).val();
      $.ajax({
        url :"action.php",
        type:"POST",
        cache:false,
        data:{filiereId:filiereId},
        success:function(data){
          $("#groupe").html(data);
        }
      });
    });
  });
    // annee dependent ajax
    $("#année-scolaire").on("change",function(){
      var anneId = $(this).val();
      $.ajax({
        url :"action2.php",
        type:"POST",
        cache:false,
        data:{anneId:anneId},
        success:function(data){
          $('#groupe').html(data);
        }
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
