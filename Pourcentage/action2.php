<?php
/* This Action for Ajax ? */
include('../db.php');
if (isset($_POST['anneId']) ) {
    $annee=$_POST['anneId'];
    $result= $pdo_conn->prepare("SELECT distinct codefiliere , nomGroupe from groupe where  annéé ='$annee'");
    $result->execute(); 
    $groupe=$result->fetchAll(PDO::FETCH_ASSOC);
     
    echo '<option value="" disabled="" selected="">GROUPE</option>';
    foreach ($groupe as $row) {
       echo  "<option value='" . $row['nomGroupe'] . "'>" . $row['nomGroupe'] . "</option>";
                         }
    
}


?>