<?php
if(isset($_GET['id'])){
    include('../db.php');
        $codeStagiaire = $_GET["id"];
        $stmt = $pdo_conn->prepare("DELETE FROM stagiaire WHERE codeStagiaire=$codeStagiaire") ;
        $stmt->execute();
        echo 'Deleted successfully.';
}



?>