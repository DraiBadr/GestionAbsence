<?php
include('../db.php');
$cin=$_GET["cin"];					
$num=$_GET["idAbsence"];
$sql="UPDATE absence SET type='justifie' where idAbsence=?";
$pdo_statement=$pdo_conn->prepare($sql);
$pdo_statement->bindParam(1,$num);
$pdo_statement->execute();
header("location:index3.php?cin=$cin");
?>