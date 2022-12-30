<?php
include '../db.php';
$succes="bien_Ajouté";
if($_SERVER['REQUEST_METHOD']=='POST')
 {
		if(isset($_POST["valider"])) 
		    {
                $annee=$_POST["année-scolaire"];
                $filiere=$_POST["filiére"];
                $groupe=$_POST["Groupe"];
                $pdo_statement = $pdo_conn->prepare("select nomfiliere from filiere where codefiliere=$filiere");
                $pdo_statement->execute();
                $nomfiliere= $pdo_statement->fetch();      
                $nomfiliere=$nomfiliere["nomfiliere"];
                $pdo_statement = $pdo_conn->prepare("select codegroupe from groupe ");
                $pdo_statement->execute();
                $groupeall= $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                if(in_array((["codegroupe"=> $groupe]),$groupeall)){   $erreur="Ce groupe existe deja !";
                    header("location:CreationGroupe.php?erreur=$erreur"); 
                }
                else{$pdo_statement = $pdo_conn->prepare("insert  into groupe values(?,?,?,?,?)");
                    $pdo_statement->bindParam(1,$groupe);
                    $pdo_statement->bindParam(2,$annee);
                    $pdo_statement->bindParam(3,$groupe);
                    $pdo_statement->bindParam(4,$filiere);
                    $pdo_statement->bindParam(5,$nomfiliere);
                    $pdo_statement->execute();
                    header("location:CreationGroupe.php?succes=$succes");}
            }}