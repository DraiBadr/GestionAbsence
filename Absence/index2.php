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
          
    //reseption des variables 
	$Année=$_GET["Année"];
    $filière=$_GET["filiére"];
    $groupe=$_GET["groupe"];
    $objetdate=$_GET['date1'];
    $fordate2=date('d-m-Y',strtotime($objetdate));
    $fordate1=date('Y-m-d',strtotime($objetdate));
 

	//selection d'année
	$pdo_statement = $pdo_conn->prepare("SELECT distinct Annéé FROM groupe ");
	$pdo_statement->execute();
	$years = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);	
	//selection des filieres
    $pdo_statement = $pdo_conn->prepare("SELECT distinct codefiliere,nomfiliere from filiere");
	$pdo_statement->execute();
	$filieres = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
    //selection des Groupe
	$pdo_statement = $pdo_conn->prepare("SELECT distinct nomGroupe from groupe");
	$pdo_statement->execute();
	$nomgroupes = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
    // selection des stagiares
    $pdo_statement = $pdo_conn->prepare("SELECT *  FROM stagiaire where codeGroupe='$groupe' order by nomStgr ASC");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);	
    
				
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <title>Absence</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <link rel="icon" href="../images/logo_ofppt.png" type="image/icon">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<?php

function frm_entry_update($succes)
{
  if(isset($_GET['succes']) && ($_GET['succes']==="succes")){
    ?>
   <script>
     jQuery(document).ready(function($){
      alert("<?php echo $succes;?>");
       });
    </script>
  
      <?php
      }
}
frm_entry_update("L'absence est bien saisie");
?>
    <div class="sidebar">
        <div class="logo-details">
            <img src="../images/logo.png" alt="logo" />
            <i class='bx bx-menu' id="btn"></i>
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
                <a href="index.php" class="active">
                    <i class="fa-light fa-file-circle-plus active "></i>
                    <span class="links_name active">Absence</span>
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
                <a href="../Pourcentage/index.php" >
                    <i class="fa-light fa-percent "></i>
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
            <form method="POST" action="options.php">
                <div class="lol">
                    <div class="sel" id="sele">
                        <ul class="ul">
                            <li>
                                <select id="année-scolaire"  name="année-scolaire" >
                                    <option value="" selected disabled>ANNEE</option>
                                    <?php //l'affichage du selection d'année
          
          foreach($years as $row)
          {
            
            echo " <option  value='".$row['Annéé']."'>".$row['Annéé']."</option>";
          }
        ?>

                                </select>
                            </li>
                            <li>
                                <select id="filiére" name="filiére" >
                                    <option value="" selected disabled>FILIERE</option>
                                    <?php //l'affichage du selection des filieres
                                    
                                        foreach($filieres as $row)
                                        {
                                            echo  " <option  value='".$row['codefiliere']."'>".$row['nomfiliere']."</option>";
                                        }
							   ?>
                                </select>
                            </li>
                            <li>
                                <select id="groupe" name="groupe" required>
                                    <option value="" disabled>GROUPE</option>
                                    <?php //l'affichage du selection des groupe
							  foreach($nomgroupes as $row)
				{
				    $selected="";
					if($groupe==$row['nomGroupe'])
            {
              $selected="selected";
            }
					echo  " <option ".$selected." value=".$row['nomGroupe'].">".$row['nomGroupe']."</option>";
				}
                              ?>
                                </select>
                            </li>
                            <li><input type="date" name="date" id="date" min='2022-09-03' class="date" required value=<?= $fordate1 ?>>
                            </li>
                            <li><input type="submit" value="Valider" id="Btn_Valider" name="Valider"></li>
                            
                        </ul>
                    </div>
                </div>
                
            </form>
                <br>
                <?php // //l'affichage de nom du groupe
                
                echo "<h3>$groupe</h3>";
                ?>
                <form action="options.php" method="post">
                <table class="table">
                    <tr>
                        <th class="th" rowspan="2">N<sup>o</sup></th>
                        <th class="th" rowspan="2">CIN</th>
                        <th class="th" rowspan="2">Nom</th>
                        <th class="th" rowspan="2">Prenom</th>
                        <th class="th" colspan="11"><?=$fordate2?></th>
                    </tr>
                    <tr>
                        <td colspan="1" class="check_joure">8:30
                            9:30</td>
                        <td colspan="1" class="check_joure">9:30
                            10:30</td>
                        <td colspan="1" class="check_joure">10:30
                            11:30</td>
                        <td colspan="1" class="check_joure">11:30
                            12:30</td>
                        <td colspan="1" class="check_joure">12:30
                            13:30</td>
                        <td colspan="1" class="check_joure">

                        </td>
                        <td colspan="1" class="check_joure">13:30
                            14:30</td>
                        <td colspan="1" class="check_joure">14:30
                            15:30</td>
                        <td colspan="1" class="check_joure">15:30
                            16:30</td>
                        <td colspan="1" class="check_joure">16:30
                            17:30</td>
                        <td colspan="1" class="check_joure">17:30
                            18:30</td>
                    </tr><?php //l'affichage du tableau d'absence
                    $counter=0;
					foreach($result as $row){
                        $cin=$row['cin'];
                        $pdo_statement = $pdo_conn->prepare("SELECT cin,seance FROM absence where cin='$cin' and date='$fordate1'");
				$pdo_statement->execute();
				$resultab = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                        
                        $checked1="";
                        $checked2="";
						$checked3="";
                        $checked4="";
                        $checked5="";
                        $checked6="";
                        $checked7="";
                        $checked8="";
                        $checked9="";
                        $checked10="";
						?>
                    <tr class="tr">
                        <td class="td"><?= $counter+=1?></td>
                        <td class="td"><a href="../Recherche/index3.php?cin=<?=$cin?>" id="cin-col"><?php  echo $row['cin']?></a></td>
                        <td class="td"><?php echo $row['nomStgr']?></td>
                        <td class="td"><?php echo $row['prenomStgr']?></td>
                        <?php if(in_array((["cin"=> $cin,"seance"=>1]),$resultab)){$checked1='checked';}
                        if(in_array((["cin"=> $cin,"seance"=>2]),$resultab)){$checked2="checked";}
                        if(in_array((["cin"=> $cin,"seance"=>3]),$resultab)){$checked3="checked";}
                        if(in_array((["cin"=> $cin,"seance"=>4]),$resultab)){$checked4="checked";}
                        if(in_array((["cin"=> $cin,"seance"=>5]),$resultab)){$checked5="checked";}
                        if(in_array((["cin"=> $cin,"seance"=>6]),$resultab)){$checked6="checked";}
                        if(in_array((["cin"=> $cin,"seance"=>7]),$resultab)){$checked7="checked";}
                        if(in_array((["cin"=> $cin,"seance"=>8]),$resultab)){$checked8="checked";}
                        if(in_array((["cin"=> $cin,"seance"=>9]),$resultab)){$checked9="checked";}
                        if(in_array((["cin"=> $cin,"seance"=>10]),$resultab)){$checked10="checked";} ?>
                        <td class="td"><input <?=$checked1?> name="check1<?=$row['cin']?>" type="checkbox"></td>
                        <td class="td"><input <?=$checked2?> name="check2<?=$row['cin']?>" type="checkbox"></td>
                        <td class="td"><input <?=$checked3?> name="check3<?=$row['cin']?>" type="checkbox"></td>
                        <td class="td"><input <?=$checked4?> name="check4<?=$row['cin']?>"  type="checkbox"></td>
                        <td class="td"><input <?=$checked5?> name="check5<?=$row['cin']?>"  type="checkbox"></td>

                        <td class="td"></td>
                    
                        <td class="td"><input <?=$checked6?> name="check6<?=$row['cin']?>"  type="checkbox"></td>
                        <td class="td"><input <?=$checked7?> name="check7<?=$row['cin']?>"  type="checkbox"></td>
                        <td class="td"><input <?=$checked8?> name="check8<?=$row['cin']?>"  type="checkbox"></td>
                        <td class="td"><input <?=$checked9?> name="check9<?=$row['cin']?>"  type="checkbox"></td>
                        <td class="td"><input <?=$checked10?> name="check10<?=$row['cin']?>"  type="checkbox"></td>
                    </tr><?php }
                ?></table>
                <input type="hidden" name="groupe" value="<?=$groupe?>">
                <input type="hidden" name="date" value="<?= $fordate1 ?>">
                <input type="submit" name="Enregistrer" value="Enregistrer" id="Btn_Enregistrer" />
            </form>
            <br>
        </div>
    </div>
    </div>
    <script type="text/javascript">
         date.max = new Date().toISOString().split("T")[0];
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
