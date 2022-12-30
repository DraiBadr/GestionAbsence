<?php
 include ("../db.php");
 if($_SERVER['REQUEST_METHOD']=='POST')
 {
		if(isset($_POST["Valider"])) 
		    { //reseption transitionnel des variables 
				if(isset($_POST['année-scolaire'])){
				$Année=$_POST['année-scolaire'];}
				if(isset($_POST['filiére'])){
				$filiére=$_POST['filiére'];}
				$groupe=$_POST['groupe'];
				$date1=strtr($_REQUEST['date'],'/','-');
			}
		if(isset($_POST["Enregistrer"])){
			if(isset($_POST['année-scolaire'])){
				$Année=$_POST['année-scolaire'];}
				if(isset($_POST['filiére'])){
				$filiére=$_POST['filiére'];}
				$groupe=$_POST['groupe'];
				$date1=strtr($_REQUEST['date'],'/','-');
				// selection du tableau stagiaire
				$pdo_statement = $pdo_conn->prepare("SELECT *  FROM stagiaire where codeGroupe='$groupe'");
				$pdo_statement->execute();
				$result = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
				// l'insertion d'absence de chaque section du journée
				foreach($result as $row){
					$cin=$row["cin"];
					$pdo_statement = $pdo_conn->prepare("SELECT cin,seance FROM absence where cin='$cin' and date='$date1'");
				$pdo_statement->execute();
				$resultab = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
				if(isset($_POST["check1".$row['cin'].""]) && in_array((["cin"=> $cin,"seance"=>1]),$resultab)===false ){	
					$pdo_statement = $pdo_conn->prepare("insert into absence(nbrHeure,date,type,cin,seance) values(1,'$date1','non justifie',?,1)");
					$pdo_statement->bindParam(1,$row["cin"]);
					$pdo_statement->execute();
					$succes="succes";
				}
				if(isset($_POST["check1".$row['cin'].""])===false ){	
					$pdo_statement = $pdo_conn->prepare("delete from absence where cin=? and date= '$date1' and seance=1");
					$pdo_statement->bindParam(1,$row["cin"]);
					$pdo_statement->execute();
					$succes="succes";
				}

				if(isset($_POST["check2".$row['cin'].""]) && in_array((["cin"=> $cin,"seance"=>2]),$resultab)===false ){			
					$pdo_statement = $pdo_conn->prepare("insert into absence(nbrHeure,date,type,cin,seance) values(1,'$date1','non justifie',?,2)");
					$pdo_statement->bindParam(1,$row["cin"]);
					$pdo_statement->execute();
					$succes="succes";
				}
				if(isset($_POST["check2".$row['cin'].""])===false ){	
					$pdo_statement = $pdo_conn->prepare("delete from absence where cin=? and date= '$date1' and seance=2");
					$pdo_statement->bindParam(1,$row["cin"]);
					$pdo_statement->execute();
					$succes="succes";
				}
				if(isset($_POST["check3".$row['cin'].""]) && in_array((["cin"=> $cin,"seance"=>3]),$resultab)===false ){	
					$pdo_statement = $pdo_conn->prepare("insert into absence(nbrHeure,date,type,cin,seance) values(1,'$date1','non justifie',?,3)");
					$pdo_statement->bindParam(1,$row["cin"]);
					$pdo_statement->execute();
					$succes="succes";
				}
				if(isset($_POST["check3".$row['cin'].""])===false ){	
					$pdo_statement = $pdo_conn->prepare("delete from absence where cin=? and date= '$date1' and seance=3");
					$pdo_statement->bindParam(1,$row["cin"]);
					$pdo_statement->execute();
					$succes="succes";
				}
				if(isset($_POST["check4".$row['cin'].""]) && in_array((["cin"=> $cin,"seance"=>4]),$resultab)===false ){
					$pdo_statement = $pdo_conn->prepare("insert into absence(nbrHeure,date,type,cin,seance) values(1,'$date1','non justifie',?,4)");
					$pdo_statement->bindParam(1,$row["cin"]);
					$pdo_statement->execute();
					$succes="succes";
				}
				if(isset($_POST["check4".$row['cin'].""])===false ){	
					$pdo_statement = $pdo_conn->prepare("delete from absence where cin=? and date= '$date1' and seance=4");
					$pdo_statement->bindParam(1,$row["cin"]);
					$pdo_statement->execute();
					$succes="succes";
				}
				if(isset($_POST["check5".$row['cin'].""]) && in_array((["cin"=> $cin,"seance"=>5]),$resultab)===false ){
					$pdo_statement = $pdo_conn->prepare("insert into absence(nbrHeure,date,type,cin,seance) values(1,'$date1','non justifie',?,5)");
					$pdo_statement->bindParam(1,$row["cin"]);
					$pdo_statement->execute();
					$succes="succes";
				}
				if(isset($_POST["check5".$row['cin'].""])===false ){	
					$pdo_statement = $pdo_conn->prepare("delete from absence where cin=? and date= '$date1' and seance=5");
					$pdo_statement->bindParam(1,$row["cin"]);
					$pdo_statement->execute();
					$succes="succes";
				}
				if(isset($_POST["check6".$row['cin'].""]) && in_array((["cin"=> $cin,"seance"=>6]),$resultab)===false ){
					$pdo_statement = $pdo_conn->prepare("insert into absence(nbrHeure,date,type,cin,seance) values(1,'$date1','non justifie',?,6)");
					$pdo_statement->bindParam(1,$row["cin"]);
					$pdo_statement->execute();
					$succes="succes";
				}
				if(isset($_POST["check6".$row['cin'].""])===false ){	
					$pdo_statement = $pdo_conn->prepare("delete from absence where cin=? and date= '$date1' and seance=6");
					$pdo_statement->bindParam(1,$row["cin"]);
					$pdo_statement->execute();
					$succes="succes";
				}
				if(isset($_POST["check7".$row['cin'].""]) && in_array((["cin"=> $cin,"seance"=>7]),$resultab)===false ){
					$pdo_statement = $pdo_conn->prepare("insert into absence(nbrHeure,date,type,cin,seance) values(1,'$date1','non justifie',?,7)");
					$pdo_statement->bindParam(1,$row["cin"]);
					$pdo_statement->execute();
				}
				if(isset($_POST["check7".$row['cin'].""])===false ){	
					$pdo_statement = $pdo_conn->prepare("delete from absence where cin=? and date= '$date1' and seance=7");
					$pdo_statement->bindParam(1,$row["cin"]);
					$pdo_statement->execute();
					$succes="succes";
				}
				if(isset($_POST["check8".$row['cin'].""]) && in_array((["cin"=> $cin,"seance"=>8]),$resultab)===false ){
					$pdo_statement = $pdo_conn->prepare("insert into absence(nbrHeure,date,type,cin,seance) values(1,'$date1','non justifie',?,8)");
					$pdo_statement->bindParam(1,$row["cin"]);
					$pdo_statement->execute();
					$succes="succes";
				}
				if(isset($_POST["check8".$row['cin'].""])===false ){	
					$pdo_statement = $pdo_conn->prepare("delete from absence where cin=? and date= '$date1' and seance=8");
					$pdo_statement->bindParam(1,$row["cin"]);
					$pdo_statement->execute();
					$succes="succes";
				}
				if(isset($_POST["check9".$row['cin'].""]) && in_array((["cin"=> $cin,"seance"=>9]),$resultab)===false ){
					$pdo_statement = $pdo_conn->prepare("insert into absence(nbrHeure,date,type,cin,seance) values(1,'$date1','non justifie',?,9)");
					$pdo_statement->bindParam(1,$row["cin"]);
					$pdo_statement->execute();
					$succes="succes";
				}
				if(isset($_POST["check9".$row['cin'].""])===false ){	
					$pdo_statement = $pdo_conn->prepare("delete from absence where cin=? and date= '$date1' and seance=9");
					$pdo_statement->bindParam(1,$row["cin"]);
					$pdo_statement->execute();
					$succes="succes";
				}
				if(isset($_POST["check10".$row['cin'].""]) && in_array((["cin"=> $cin,"seance"=>10]),$resultab)===false ){
					$pdo_statement = $pdo_conn->prepare("insert into absence(nbrHeure,date,type,cin,seance) values(1,'$date1','non justifie',?,10)");
					$pdo_statement->bindParam(1,$row["cin"]);
					$pdo_statement->execute();
					$succes="succes";
				}
				if(isset($_POST["check10".$row['cin'].""])===false ){	
					$pdo_statement = $pdo_conn->prepare("delete from absence where cin=? and date= '$date1' and seance=10");
					$pdo_statement->bindParam(1,$row["cin"]);
					$pdo_statement->execute();
					$succes="succes";
				}
			//redirection
									
			}}
			header("Location:index2.php?Année=$Année&filiére=$filiére&groupe=$groupe&date1=$date1&succes=$succes");
} 
?>