<?php
include "../db.php";
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
          
$cin=$_GET["cin"];
//Code pour consulter les information de stagiaire     
			//la saisie de la requete préparé
			$pdo_statement = $pdo_conn->prepare("SELECT * FROM stagiaire  where cin='$cin'");
			//lancer l'éxecution de la requete préparé via la méthode execute;
			$pdo_statement->execute();
			$result = $pdo_statement->fetch();
      $pdo_statement = $pdo_conn->prepare("SELECT sum(nbrHeure) as somme FROM absence where cin='$cin' and type='non justifie'");
			//lancer l'éxecution de la requete préparé via la méthode execute;
			$pdo_statement->execute();
			$somme1 = $pdo_statement->fetch();
      $pdo_statement = $pdo_conn->prepare("SELECT sum(nbrHeure) as somme FROM absence where cin='$cin' and type='justifie'");
			//lancer l'éxecution de la requete préparé via la méthode execute;
			$pdo_statement->execute();
			$somme2 = $pdo_statement->fetch();
      if(empty($somme1['somme'])){
        $somme1['somme']=0;
      }
      if(empty($somme2['somme'])){
        $somme2['somme']=0;
      }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Recherche</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <link rel="icon" href="../images/logo_ofppt.png" type="image/icon type">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css">
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
        <a href="../Absence/index.php" >
          <i class="fa-light fa-file-circle-plus "></i>
          <span class="links_name " >Absence</span>
        </a>
         <span class="tooltip">Absence</span>
      </li>
      <li>
       <a href="index.php" class="active">
        <i class="fa-light fa-file-magnifying-glass active"></i>
         <span class="links_name active">Recherche</span>
       </a>
       <span class="tooltip">Recherche</span>
     </li>
     <li>
       <a href="../Pourcentage/index.php" >
        <i class="fa-light fa-percent"></i>
         <span class="links_name ">Pourcentage</span>
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
      <form method="post" action="option.php" >
        <div class="lol">
          <div class="sel" id="sele">
            <ul class="ul">
              <li>
                <input type="text" name="cin" placeholder="CIN STAGAIRE">
              </li>
              <li>
                  <input  type="submit" value="valider" id="valider" name="valider" class="btn_valider">
              </li>
            </ul>
          </div>
        </div>
      </form>
    <div>
    <!-- l'affichage des infos de stagiaire -->
    <form>
      <div class="div-affiche"> 
        <h3>Information de stagaire</h3>
        <hr/>
        <table id="tb-info-stg">
          <tr><td><span class="infoStg">Nom Stagiaire : </span></td><td><span class="infoStg2"><?=$result['nomStgr']?></span></td></tr>
          <tr><td><span class="infoStg">Prenom Stagiaire :</span></td><td><span class="infoStg2"><?=$result['prenomStgr']?></span></td></tr>
          <tr><td><span class="infoStg">Nom du Groupe :</span></td><td><span class="infoStg2"><?=$result['codeGroupe']?></span></td></tr>
          <tr><td><span class="infoStg">Total heure non justifie :</span> &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp</td><td><span class="infoStg2"><?=intdiv($somme1['somme'],10)."j ".$somme1['somme']%10.?>h</span></td></tr>
          <tr><td><span class="infoStg">Total heure justifie :</span></td><td><span class="infoStg2"><?=intdiv($somme2['somme'],10)."j ".$somme2['somme']%10.?>h</span></td></tr>
        </table>
      </div>
    </form>
    <?php 
    //Le tableau de recherche
			$sql="SELECT * from absence where cin='$cin'";
			$pdo_statement=$pdo_conn->prepare($sql);
			$pdo_statement->execute();
			$absence=$pdo_statement->fetchAll();
		?>
	  <form action="" method="POST">
        <table class="table1">
        <?php if(empty($absence)){?>
        <tr >
        <th class="th1" hidden >id</th>
          <th class="th1">Date d'absence</th>
          <th class="th1">Séance</th>
          <th class="th1">Etat d'absence</th>
          <th class="th1">Appliqué justifié</th>
          <th class="th1">Annuler justification</th>
          <th class="th1">Supprimer absence</th></tr></thead>
          <tbody><tr class="tr1">
          <td class="td1" hidden >-----------</td>
            <td class="td1">-----------</td>
            <td class="td1">-----------</td>
            <td class="td1">-----------</td>
            <td class="td1">---------</td>
            <td class="td1">-----------</td>
            <td class="td1">-----------</td></tr></tbody>
          <?php  }else{ ?>
      <tr class>
    <th class="th1" hidden >id</th>
      <th class="th1">Date d'absence</th>
      <th class="th1">Séance</th>
      <th class="th1">Etat d'absence</th>
      <th class="th1">Appliqué justifié</th>
      <th class="th1">Annuler justification</th>
      <th class="th1">Supprimer absence</th></tr></thead>
    <?php }?>
    <?php
			foreach ($absence as $absence) {
				$idAbsence=$absence['idAbsence'];
        if($absence["seance"]==1){$seance="8:30→9:30";}
        if($absence["seance"]==2){$seance="9:30→10:30";}
        if($absence["seance"]==3){$seance="10:30→11:30";}
        if($absence["seance"]==4){$seance="11:30→12:30";}
        if($absence["seance"]==5){$seance="12:30→13:30";}
        if($absence["seance"]==6){$seance="13:30→14:30";}
        if($absence["seance"]==7){$seance="14:30→15:30";}
        if($absence["seance"]==8){$seance="15:30→16:30";}
        if($absence["seance"]==9){$seance="16:30→17:30";}
        if($absence["seance"]==10){$seance="17:30→18:30";}
			?>
			<tr class="tr1">
        <td hidden ><?php echo $absence['idAbsence']  ?></td>
				<td class="td1"><?php echo $absence['date'] ?></td>
        <td class="td1"><?php echo $seance ?></td>
				<td class="td1"><?php echo $absence['type'] ?></td>
				<td class="td1"><a href="apply_justifié.php?idAbsence=<?=$idAbsence?>&cin=<?=$absence["cin"]?>"><i class="material-icons" style="color:green">check</i></a></td>
				<td class="td1"><a href="Annuler_justification.php?idAbsence=<?= $idAbsence ?>&cin=<?=$absence["cin"]?>"><i class="material-icons" style="color:black">cancel</i></a></td>
				<td class="td1"><a href="Supprimer.php?idAbsence=<?= $idAbsence ?>&cin=<?=$absence["cin"]?>" onclick="return confirm('Etes vous sur de vouloir supprimer cet absence!!')"><i class="material-icons" style="color:red">delete</i></a></td>
			</tr>
			<?php
		}?>
  </div>
  </div>
      </form>
  </div>
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
  // Create a condition that targets viewports at least 768px wide
const mediaQuery = window.matchMedia("(mix-width: 500px)");
if (mediaQuery.matches){
   console.log('500');
  }
const mediaQuery1 = window.matchMedia("(max-width: 1000px)" );
if (mediaQuery1.matches){
   console.log('1000');
  }
  </script>
</body>
</html>
