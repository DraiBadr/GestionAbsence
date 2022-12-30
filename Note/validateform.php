<?php
include('../db.php');
if(isset($_POST['valider'])){
            if(isset($_POST['selectAnnee'])) 
                {
                    $Annee= $_POST['selectAnnee'];
                }
            if(isset($_POST['selectfiliere'])) 
                {
                    $filiere= $_POST['selectfiliere'];
                }
            if(!empty($_POST['selectgroupe'])) 
                {
                    $groupe= $_POST['selectgroupe'];
                }
            header("location:index2.php?Annee=$Annee&filiere=$filiere&groupe=$groupe");
            exit();
}
?>
