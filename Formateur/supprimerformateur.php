<?php
include('../db.php');
$formateur=$_GET["nomf"];

$sql="DELETE from formateur where nomf='$formateur'";
$pdo_statement=$pdo_conn->prepare($sql);
$pdo_statement->execute();
header("location:listformateur.php")
?>