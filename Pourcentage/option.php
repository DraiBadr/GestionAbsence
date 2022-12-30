<?php
 include ('../db.php');
 if($_SERVER['REQUEST_METHOD']=='POST')
 {
		if(isset($_POST["valider"])) 
		    {

$groupe=$_POST['groupe'];
header("Location:index2.php?groupe=$groupe&mois=9");
            }}
?>