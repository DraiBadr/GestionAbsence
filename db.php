<?php
$servername = "localhost";
$username = "root";
// *** ne change pas le nom du db ****
$db="gestion_ab";
// *** si vous changez le mot de passe remettre le "" lorsque vous avez terminé ***
$password = "";


try 
{
	//object de connexion
	$pdo_conn = new PDO("mysql:host=$servername;dbname=$db",$username,$password);
	// set the PDO error mode to exception
	$pdo_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch(PDOException $e) 
{	
  echo "echec de connexion : " . $e->getMessage();  
}
?>