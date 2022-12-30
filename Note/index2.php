<?php
include('../db.php');
session_start();
  if(empty($_SESSION["login"]) || empty($_SESSION["password"])) 
 {
    header("Location:../Authentification/authentification.php");
 }
 $curyear=date("Y");
 $resultname="";
 $user=$_SESSION["login"];
 $role=$_SESSION["role"];
 $genre=$_SESSION["sexe"];
 if($genre=="M"){ $resultname="Monsieur ".$user;}
 if($genre=="F"){ $resultname="Madame ".$user;}
$Annee = $_GET["Annee"];
$filiere = $_GET["filiere"];
$groupe = $_GET['groupe'];
$result1 = $pdo_conn->prepare("SELECT distinct Annéé FROM groupe");
$result1->execute();
$anne = $result1->fetchAll(PDO::FETCH_ASSOC);
//selection des filieres
$pdo_statement = $pdo_conn->prepare("SELECT distinct codefiliere,nomfiliere from filiere");
$pdo_statement->execute();
$filieres = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
//selection des Groupe
$pdo_statement = $pdo_conn->prepare("SELECT distinct nomGroupe from groupe");
$pdo_statement->execute();
$nomgroupes = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
$pdo_statement = $pdo_conn->prepare("SELECT distinct codefiliere,nomGroupe from groupe where codeGroupe='$groupe'");
$pdo_statement->execute();
$groupes = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
$pdo_statement = $pdo_conn->prepare("SELECT *  FROM stagiaire where codeGroupe='$groupe' order by nomStgr ASC");
$pdo_statement->execute();
$result = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title>Note</title>
  <link rel="icon" href="logo_ofppt.png" type="image/icon type">
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style2.css">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
       <a href="index.php" class="active">
        <i class="fa-light fa-file-pen active"></i>
         <span class="links_name active">Note</span>
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
      <form method="post" action="validateform.php">
        <div class="lol">
          <div class="sel" id="sele">
            <ul class="ul">
              <li>
                <select id="année-scolaire" name="selectAnnee" >
                  <option disabled="" value="" selected="">ANNEE</option>
                  <?php //l'affichage du selection d'année
          
          foreach($anne as $row)
          {
            
            echo " <option  value='".$row['Annéé']."'>".$row['Annéé']."</option>";
          }
        ?>
                </select>
              </li>
              <li>
                <select id="filiére" name="selectfiliere" >
                  <option disabled="" value="" selected="">FILIERE</option>
                  <?php //l'affichage du selection des filieres
                  foreach ($filieres as $row) {
                    echo  " <option " . $selected . " value='" . $row['codefiliere'] . "'>" . $row['nomfiliere'] . "</option>";
                  }
                  ?>
                </select>
              </li>
              <li>
                <select id="groupe" name="selectgroupe" required>
                  <option disabled="" value="" selected="">GROUPE</option>
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
              <li><input type="submit" value="Valider" name="valider" id="Btn_Valider">
              </li>
            </ul>
            <div>
              <pre> <?php
                    foreach ($groupes as $row) {
                      echo  "<h3>" . $row['nomGroupe'] . "</h3>";
                    }
                    ?></pre>
          <table class="table">
            <tr>
            <th class="th">Numéro</th>
              <th class="th">Groupe</th>
              <th class="th">Nom</th>
              <th class="th">Prenom</th>
              <th class="th">Note</th>           
            </tr>
            <?php
            $counter=0;
            foreach ($result as $row) {
              $stgrcin=$row['cin'];
              $pdo_statement  = $pdo_conn->prepare("select count(nbrHeure) as nbrHeure  from absence  where  absence.cin='$stgrcin' and type='non justifie'");
              $pdo_statement->execute();
              $nbrheure = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
              $nbhAbs=intval($nbrheure[0]["nbrHeure"]);
              $note=20-$nbhAbs/10 ;
            ?>
              <tr class="tr">
               <td class="td"><?= $counter+=1?></td>
                <td class="td"><?php echo $row['codeGroupe'] ?></td>
                <td class="td"><?php echo $row['nomStgr'] ?></td>
                <td class="td"><?php echo $row['prenomStgr'] ?></td>
                <td class="td"><?php echo $note;?></td>
              </tr><?php }
                    ?>
          </table>
              </br>
          </div>
        </div>
        </div>
      </form>
    </div>
  </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function() {
      // annee dependent ajax
      $("#année-scolaire").on("change", function() {
        var anneId = $(this).val();
        $.ajax({
          url: "action.php",
          type: "POST",
          cache: false,
          data: {
            anneId: anneId
          },
          success: function(data) {
            $("#filiére").html(data);
          }
        });
      });
      // filiere dependent ajax
      $("#filiére").on("change", function() {
        var filiereId = $(this).val();
        $.ajax({
          url: "action.php",
          type: "POST",
          cache: false,
          data: {
            filiereId: filiereId
          },
          success: function(data) {
            $("#groupe").html(data);
          }
        });
      });
    });
    // annee dependent ajax
    $("#année-scolaire").on("change", function() {
      var anneId = $(this).val();
      $.ajax({
        url: "action2.php",
        type: "POST",
        cache: false,
        data: {
          anneId: anneId
        },
        success: function(data) {
          $('#groupe').html(data);
        }
      });
    });
</script>
  <script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    closeBtn.addEventListener("click", () => {
      sidebar.classList.toggle("open");
      menuBtnChange(); //calling the function(optional)
    });
    // following are the code to change sidebar button(optional)
    function menuBtnChange() {
      if (sidebar.classList.contains("open")) {
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the iocns class
      } else {
        closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the iocns class
      }
    }
    // Create a condition that targets viewports at least 768px wide
    const mediaQuery = window.matchMedia("(mix-width: 500px)");
    if (mediaQuery.matches) {
      console.log('500');
    }
    const mediaQuery1 = window.matchMedia("(max-width: 1000px)");
    if (mediaQuery1.matches) {
      console.log('1000');
    }
  </script>
</body>

</html>
