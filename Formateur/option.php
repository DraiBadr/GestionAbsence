<?php
include '../db.php';
if($_SERVER['REQUEST_METHOD']=='POST')
 {
		if(isset($_POST["valider"])) 
		    {
        $formateur=$_POST["formateur"];
        $erreur="ce Formateur n'existe pas";
        $formateur=strtoupper($formateur);
        $pdo_statement = $pdo_conn->prepare("select distinct nomf from formateur");
        $pdo_statement->execute();
        $formateurs= $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
        if(in_array(["nomf"=>$formateur],$formateurs)){
            header("location:formateurValide.php?nomf=$formateur");}
        else{
            header("location:formateur.php?erreur=$erreur");
        }
        }
        if(isset($_POST['Ajouter']) ){
            $formateur=$_POST['formateur2'];

            
            $pdo_statement = $pdo_conn->prepare("SELECT codegroupe from formateur where nomf='$formateur' ");
            $pdo_statement->execute();
            $groupes= $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
            $groupe=$_POST['codeGroupe'];
            if(in_array((["codegroupe"=>$groupe]),$groupes)){
              header("Location:formateurValide.php?nomf=$formateur");}
            if($groupe == null){
              header("Location:formateurValide.php?nomf=$formateur");
            }else{
            $sql="INSERT INTO formateur(nomF,codeGroupe) VALUES (?,'$groupe')";
            $pdo_statement=$pdo_conn->prepare($sql);
            $pdo_statement->bindParam(1,$formateur);
              $pdo_statement->execute();
              header("Location:formateurValide.php?nomf=$formateur");
                }}}
        
        ?>