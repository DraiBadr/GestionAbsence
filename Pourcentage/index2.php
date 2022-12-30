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
 $groupe=$_GET['groupe'];
 $mois=$_GET['mois'];
 $mois_fr = Array("", "JANVIER", "FEVRIER", "MARS", "AVRIL", "MAI", "JUIN", "JUILET", "AOUT", "SEPTEMBRE", "OCTOBRE", "NOVEMBRE", "DECEMBRE");
// select groupe
$pdo_statement = $pdo_conn->prepare("SELECT codeGroupe from groupe ");
$pdo_statement->execute();
$groupes= $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
// select filiere
$pdo_statement = $pdo_conn->prepare("SELECT  codefiliere,nomfiliere from filiere ");
$pdo_statement->execute();
$filieres= $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
// select annee
$pdo_statement = $pdo_conn->prepare("SELECT distinct annéé from groupe ");
$pdo_statement->execute();
$annees= $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
// total du stagiaires dans un groupe
$pdo_statement = $pdo_conn->prepare("SELECT cin FROM stagiaire where codeGroupe ='$groupe'");
$pdo_statement->execute();
$total = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
// current year
$pdo_statement = $pdo_conn->prepare("SELECT YEAR(CURDATE()) as year");
$pdo_statement->execute();
$curyear = $pdo_statement->fetch(PDO::FETCH_OBJ);
$curyear=$curyear->year;
$mois1=intval($mois)-1;
$curyear2=strval(intval($curyear)-1);
// last 5 weeks 
if($mois==2){$pdo_statement = $pdo_conn->prepare("select week('$curyear-$mois-1'),week('$curyear-$mois-08'),week('$curyear-$mois-15'),week('$curyear-$mois-22'),week('$curyear-$mois-28')");
    $pdo_statement->execute();
    $semaine = $pdo_statement->fetchAll(PDO::FETCH_OBJ);}
else{
$pdo_statement = $pdo_conn->prepare("select  week('$curyear-$mois-01'),week('$curyear-$mois-08'),week('$curyear-$mois-15'),week('$curyear-$mois-22'),week('$curyear-$mois-29')");
$pdo_statement->execute();
$semaine = $pdo_statement->fetchAll(PDO::FETCH_OBJ);}
$pdo_statement = $pdo_conn->prepare("SELECT distinct absence.cin FROM absence inner join stagiaire on absence.cin=stagiaire.cin where codeGroupe='$groupe' and month(date)=9    ");
$pdo_statement->execute();
$totalabsence9 = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
$totalabsence9=round(count($totalabsence9)/count($total)*100);
$pdo_statement = $pdo_conn->prepare("SELECT distinct absence.cin FROM absence inner join stagiaire on absence.cin=stagiaire.cin where codeGroupe='$groupe' and month(date)=10   ");
$pdo_statement->execute();
$totalabsence10 = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
$totalabsence10=round(count($totalabsence10)/count($total)*100);
$pdo_statement = $pdo_conn->prepare("SELECT distinct absence.cin FROM absence inner join stagiaire on absence.cin=stagiaire.cin where codeGroupe='$groupe' and month(date)=11    ");
$pdo_statement->execute();
$totalabsence11 = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
$totalabsence11=round(count($totalabsence11)/count($total)*100);
$pdo_statement = $pdo_conn->prepare("SELECT distinct absence.cin FROM absence inner join stagiaire on absence.cin=stagiaire.cin where codeGroupe='$groupe' and month(date)=12    ");
$pdo_statement->execute();
$totalabsence12 = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
$totalabsence12=round(count($totalabsence12)/count($total)*100);
$pdo_statement = $pdo_conn->prepare("SELECT distinct absence.cin FROM absence inner join stagiaire on absence.cin=stagiaire.cin where codeGroupe='$groupe' and month(date)=1    ");
$pdo_statement->execute();
$totalabsence1 = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
$totalabsence1=round(count($totalabsence1)/count($total)*100);
$pdo_statement = $pdo_conn->prepare("SELECT distinct absence.cin FROM absence inner join stagiaire on absence.cin=stagiaire.cin where codeGroupe='$groupe' and month(date)=2    ");
$pdo_statement->execute();
$totalabsence2 = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
$totalabsence2=round(count($totalabsence2)/count($total)*100);
$pdo_statement = $pdo_conn->prepare("SELECT distinct absence.cin FROM absence inner join stagiaire on absence.cin=stagiaire.cin where codeGroupe='$groupe' and month(date)=3    ");
$pdo_statement->execute();
$totalabsence3 = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
$totalabsence3=round(count($totalabsence3)/count($total)*100);
$pdo_statement = $pdo_conn->prepare("SELECT distinct absence.cin FROM absence inner join stagiaire on absence.cin=stagiaire.cin where codeGroupe='$groupe' and month(date)=4    ");
$pdo_statement->execute();
$totalabsence4 = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
$totalabsence4=round(count($totalabsence4)/count($total)*100);
$pdo_statement = $pdo_conn->prepare("SELECT distinct absence.cin FROM absence inner join stagiaire on absence.cin=stagiaire.cin where codeGroupe='$groupe' and month(date)=5    ");
$pdo_statement->execute();
$totalabsence5 = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
$totalabsence5=round(count($totalabsence5)/count($total)*100);
$pdo_statement = $pdo_conn->prepare("SELECT distinct absence.cin FROM absence inner join stagiaire on absence.cin=stagiaire.cin where codeGroupe='$groupe' and month(date)=6    ");
$pdo_statement->execute();
$totalabsence6 = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
$totalabsence6=round(count($totalabsence6)/count($total)*100);
$pdo_statement = $pdo_conn->prepare("SELECT distinct absence.cin FROM absence inner join stagiaire on absence.cin=stagiaire.cin where codeGroupe='$groupe' and month(date)=7    ");
$pdo_statement->execute();
$totalabsence7 = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
$totalabsence7=round(count($totalabsence7)/count($total)*100);
$pdo_statement = $pdo_conn->prepare("SELECT count(absence.cin) as count,absence.cin from absence inner join stagiaire on absence.cin=stagiaire.cin where codegroupe='$groupe' group by absence.cin order by count desc limit 5   ");
$pdo_statement->execute();
$countcin = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
$dataPoints = array( 
	array("y" => $totalabsence9, "label" => "SEPTEMBRE"),
	array("y" => $totalabsence10, "label" => "OCTOBRE" ),
	array("y" => $totalabsence11, "label" => "NOVEMBRE" ),
	array("y" => $totalabsence12, "label" => "DECEMBRE" ),
	array("y" => $totalabsence1, "label" => "JANVIER" ),
	array("y" => $totalabsence2, "label" => "FEVRIER" ),
	array("y" => $totalabsence3, "label" => "MARS" ),
    array("y" => $totalabsence4, "label" => "AVRIL" ),
    array("y" => $totalabsence5, "label" => "MAI" ),
    array("y" => $totalabsence6, "label" => "JUIN" ),
    array("y" => $totalabsence7, "label" => "JUIL" ),
);

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
    <link rel="stylesheet" href="style2.css">
    <link rel="icon" href="../images/logo_ofppt.png" type="image/icon type">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script>
window.onload = function() {
    CanvasJS.addColorSet("colors",
                [
                "rgb(117, 180, 255)",
                "rgb(200, 60, 150)",
                "rgb(70, 190, 1)",           
                ]);
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: false,
    colorSet: "colors",
	theme: "light1",
	axisX:{
        labelAngle: 0,
        labelPlacement: "inside",
      },
    dataPointWidth: 40,
	axisY: {
        suffix: "%",
	},
	data: [{
		type: "column",
		yValueFormatString:  '#.# ',
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
}
</script>
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
                <span id="name"><?=$resultname?></span>
                <a href="../deconexion.php"><i class="fa-light fa-right-from-bracket" id="log_out"></i></a>
            </div>
        </div>
    </div>
    <div class="home-section">
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
                                            
                                        echo "<option  value='$row'>$row</option> ";
                                    }}
                                        ?>
                                </select>
                            </li>
                            <li>
                                <select id="filiére" name="filiére" >
                                    <option value="" selected disabled>FILIERE</option>
                                    <?php
                                    foreach($filieres as $row){
                                        
                                            
                                        echo "<option  value='".$row['codefiliere']."'>".$row['nomfiliere']."</option> ";
                                    }
                                       ?>
                                </select>
                            </li>
                            <li>
                                <select id="groupe" name="groupe" required >
                                    <option value="">GROUPE</option>
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
                            </li>
                            
                           
                            <li><input type="submit" value="Valider" name="valider" id="Valider" class="btn_valider" >
                            </li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
        <div id="tableau">
            <h3 class="h2"><?php echo $groupe?></h3>
            <div class="h3" >
            <h3 style="padding-bottom:5px;"  >Pourcentage Par Semaine </h3>
            
            <select id="mois" name="mois" onchange="location = this.value">
                        <option value="">MOIS</option>
                        <option value="index2.php?groupe=<?=$groupe?>&mois=9">SEPTEMBRE</option>
                        <option value="index2.php?groupe=<?=$groupe?>&mois=10">OCTOBRE</option>
                        <option value="index2.php?groupe=<?=$groupe?>&mois=11">NOVEMBRE</option>
                        <option value="index2.php?groupe=<?=$groupe?>&mois=12">DECEMBRE</option>
                        <option value="index2.php?groupe=<?=$groupe?>&mois=1">JANVIER</option>
                        <option value="index2.php?groupe=<?=$groupe?>&mois=2">FEVRIER</option>
                        <option value="index2.php?groupe=<?=$groupe?>&mois=3">MARS</option>
                        <option value="index2.php?groupe=<?=$groupe?>&mois=4">AVRIL</option>
                        <option value="index2.php?groupe=<?=$groupe?>&mois=5">MAI</option>
                        <option value="index2.php?groupe=<?=$groupe?>&mois=6">JUIN</option>
                        <option value="index2.php?groupe=<?=$groupe?>&mois=7">JUILLET</option>
                        <option value="index2.php?groupe=<?=$groupe?>&mois=8">AOUT</option>
            </select></div>
            <table class="table table-bordered table-dark">
                <thead>
                    <tr>
                        <th scope="col"><?= $mois_fr[$mois] ?></th>
                        <th scope="col">Pourcentage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                                foreach($semaine as $array)
                                {foreach($array as $row){
                                    $row2=$row+1;
                                    $curyear1=strval(intval($curyear)+1);
                                    
                                    if(intval($mois)<8 ){
                                        $pdo_statement = $pdo_conn->prepare("SELECT distinct concat(STR_TO_DATE('$curyear1 $row Monday', '%X %V %W'), ' → ' , STR_TO_DATE('$curyear1 $row2 Sunday', '%X %V %W'))");
                                        $pdo_statement->execute();
                                        $dates = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);}
                                    else{
                                    $pdo_statement = $pdo_conn->prepare("SELECT distinct concat(STR_TO_DATE('$curyear $row Monday', '%X %V %W'), ' → ' , STR_TO_DATE('$curyear $row2 Sunday', '%X %V %W'))");
                                    $pdo_statement->execute();
                                    $dates = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);}
                                    foreach($dates as $array){
                                        foreach($array as $rowdate){
                                            $pdo_statement = $pdo_conn->prepare("SELECT distinct absence.cin FROM absence inner join stagiaire on absence.cin=stagiaire.cin where codeGroupe='$groupe' and week(date)=$row");
                                            $pdo_statement->execute();
                                            $totalabsence = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                                            if(isset($rowdate)){
                                            if (count($total)==0){
                                                echo "<tr><td>" .$rowdate."</td><td>0%</td></tr>";}
                                            else{
                                                echo "<tr><td>" .$rowdate."</td><td>".round(count($totalabsence)/ count($total) *100).'%'."</td></tr>";
                                            }}
                                        }
                                    }  
                                }}        
                        ?>
                </tbody>
            </table>
            <br>
            <h3 class="h3">Pourcentage Par Mois</h3>
            <div class="h31" >
            <div id="chartContainer" style=""></div></div>
            <br>
            <h3 class="h3">Les Stagiaires Les Plus Absent</h3>
            <table class="table table-bordered table-dark">
             
                    <tr>
                        <th scope="col">Classement</th>
                        <th scope="col">Stagiaire</th>
                        <th scope="col">Nombre d'heure</th>
                    </tr>
                <?php $counter=0;
                if(empty($countcin)){ ?>
                <tr><td>--------</td><td>--------</td><td>--------</td></tr><?php }
                 else{foreach($countcin as $row){
                    $cin=$row["cin"]; ?>
                    <tr class="tr1"><td><?=$counter+=1?></td>
                    <td><a href="../Recherche/index3.php?cin=<?=$cin?>"><?=$cin?></a></td>
                    <td><?=$row['count']?></td></tr><?php }} ?>
                    </table>
                    <br>
                    
                

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
        menuBtnChange(); //calling the function(optional)
    });
    searchBtn.addEventListener("click", () => { // Sidebar open when you click on the search iocn
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
