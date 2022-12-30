<?php	
    include("../db.php");
    $id=$_GET['id'];
	$pdo_statement = $pdo_conn->prepare("DELETE FROM compte where numCompte=$id ");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);	header("Location:Gest.php");
?>


