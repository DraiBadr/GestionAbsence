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
          
// select groupe

$pdo_statement = $pdo_conn->prepare("SELECT  codeGroupe from groupe ");
$pdo_statement->execute();
$groupes= $pdo_statement->fetchAll(PDO::FETCH_ASSOC);

// select filiere

$pdo_statement = $pdo_conn->prepare("SELECT codefiliere, nomfiliere from filiere ");
$pdo_statement->execute();
$filieres= $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
// select annee
$pdo_statement = $pdo_conn->prepare("SELECT distinct annéé from groupe ");
$pdo_statement->execute();
$annees= $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
$curyear=date("Y");
$curmonth=date("Y-m");
$curmonth2=date("Y-8");
$date= date_diff(date_create($curmonth),date_create($curmonth2));
   $date=$date->format('%R%a ');
if($date<=0){
  $curyear2=$curyear+1;
  $anneescolaire="$curyear/$curyear2";
}
else{
$curyear2=$curyear-1;
$anneescolaire="$curyear2/$curyear";}
/////////////////////
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <title>Pourcentage</title>
    <meta charset="UTF-8">
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
  />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="../images/logo_ofppt.png" type="image/icon type">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <img src="../images/logo.png" alt="logo" />
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
        <li>
                <a href="../Accueil/Accueil.php">
                    <i class="fa-light fa-house "></i>
                    <span class="links_name ">Accueil</span>
                </a>
                <span class="tooltip">Accueil</span>
            </li>
            <li>
                <a href="../Absence/index.php">
                    <i class="fa-light fa-file-circle-plus "></i>
                    <span class="links_name ">Absence</span>
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
                <a href="index.php" class="active">
                    <i class="fa-light fa-percent active"></i>
                    <span class="links_name active">Pourcentage</span>
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
            <h2>Filtre Pourcentage</h2>
        </div> 
        <div class="form">
            
            <form method="post" action="option.php">
                <div class="lol">
                    <div class="sel" id="sele">
                        <ul class="ul">
                            <li>
                                <select id="année-scolaire" name="année-scolaire" >
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
                                    <option value="">GROUPE</option>
                                    <?php
                                    foreach($groupes as $array){
                                        foreach($array as $row){
                                            
                                        echo "<option  value='$row'>$row</option> ";
                                    }}
                                        ?>
                                </select>
                            </li>
                            <!--  <li><input onclick = " window.Location = 'index2.html'" type ="submit" value="valider" id="valider" class="btn_valider"></li> -->
                            <li><input type="submit" value="Valider" name="valider" id="Btn_Valider">
                            </li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
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
    let searchBtn = document.querySelector(".bx-search");

    closeBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        menuBtnChange();
    });


    searchBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        menuBtnChange();
    });


    function menuBtnChange() {
        if (sidebar.classList.contains("open")) {
            closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else {
            closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
    }
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
