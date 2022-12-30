<?php
include('../db.php');
$codegroupe=$_GET["codegroupe"];
$formateur=$_GET["nomf"];
$sql="DELETE from formateur where codegroupe='$codegroupe' and nomf='$formateur'";
$pdo_statement=$pdo_conn->prepare($sql);
$pdo_statement->bindParam(1,$codegroupe);
$pdo_statement->execute();
header("location:formateurValide.php?nomf=$formateur")
?>