<?php
include ('../db.php');
if($_SERVER['REQUEST_METHOD']=='POST')
{
       if(isset($_POST["valider"])) 
           {
            $cin=$_POST["cin"];
            $pdo_statement = $pdo_conn->prepare("SELECT * FROM stagiaire  where cin='$cin'");
			//lancer l'éxecution de la requete préparé via la méthode execute;
			$pdo_statement->execute();
			$result = $pdo_statement->fetch();
         var_dump($result);
            if(($result)!==false){
            header("Location:index3.php?cin=$cin");					
           }else{
            $erreur="Ce CIN est incorrect !";
            header("location:index.php?erreur=$erreur");
           }}
         
        elseif(isset($_POST["justifier"])) 
           {
            $cin=$_POST["cin"];
            header("Location:index3.php?cin=$cin");					
           }
           
} 
?>
