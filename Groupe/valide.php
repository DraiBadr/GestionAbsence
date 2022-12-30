<?php
include('../db.php');

if(isset($_POST['valider'])){

            if(isset($_POST['année-scolaire'])) 
                {
                    $Annee= $_POST['année-scolaire'];
                }
            if(isset($_POST['filiére'])) 
                {
                    $filiere= $_POST['filiére'];
                }
            if(!empty($_POST['groupe'])) 
                {
                    $groupe= $_POST['groupe'];
                }
            header("location: AffichageGroupe.php?Annee=$Annee&filiere=$filiere&groupe=$groupe");
            exit();
       
     

}

?>