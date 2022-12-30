<?php
include('../db.php');
$num=$_GET["idAbsence"];
$cin=$_GET["cin"];
$sql="UPDATE absence SET type='non justifie' where idAbsence=?";
$pdo_statement=$pdo_conn->prepare($sql);
$pdo_statement->bindParam(1,$num);
$pdo_statement->execute();
header("location:index3.php?cin=$cin");
?>