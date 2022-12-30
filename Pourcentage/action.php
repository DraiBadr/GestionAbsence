<?php
/* This Action for Ajax ? */
include('../db.php');
if (isset($_POST['anneId']) ) {
   $annee=$_POST['anneId'];
   $result1 = $pdo_conn->prepare("SELECT  codefiliere,nomfiliere from filiere where Annéé ='$annee'");
   $result1->execute();
   $filiere = $result1->fetchAll(PDO::FETCH_ASSOC);
    
   echo '<option value="" disabled="" selected="">FILIERE</option>';
    foreach ($filiere as $row) {
           echo  "<option value='" . $row['codefiliere'] . "'>" . $row['nomfiliere'] . "</option>";
    }   
}
elseif(isset($_POST['filiereId']) && !empty($_POST['filiereId'])) {
         $result= $pdo_conn->prepare("SELECT distinct codefiliere , nomGroupe from groupe where  codefiliere =".$_POST['filiereId']);
         $result->execute(); 
         $groupe=$result->fetchAll(PDO::FETCH_ASSOC);
         {
         echo '<option value="" disabled="" selected="">GROUPE</option>';
         foreach ($groupe as $row) {
            echo  "<option value='" . $row['nomGroupe'] . "'>" . $row['nomGroupe'] . "</option>";
                              }
         } 
      }


?>