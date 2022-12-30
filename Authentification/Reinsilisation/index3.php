<?php 
  include ('../../db.php');
  session_start();
  $email=$_SESSION["email"];
  $erreur="";
  if(isset($_POST["valider"]))
  {
    $newPassword=strip_tags($_POST["newPassword"]);
    $confirmation=strip_tags($_POST["confirmation"]);
    if((!empty($newPassword))&& (!empty($confirmation)))
    {
       
        if (strlen($newPassword) < 3) {
            $erreur= 'Le mot de passe doit contenir au moins 3 caracteres)';
        }
        else{
            
            if($newPassword==$confirmation)
            {
                $sql = "UPDATE compte set password='$newPassword' where email='$email'";

            
                $pdo_statement=$pdo_conn->prepare($sql);
                $pdo_statement->execute();
                header("Location:../authentification.php");    
            }
            else
            {
                $erreur="le mot de passe et la confirmation doivent être identique ";
            }
        }
    }
    else 
    {
        $erreur=" tous les champs sont obligatoire";
    }
    
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reinsilisation</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <link rel="icon" href="../../images/logo_ofppt.png" type="image/icon type">
    <link rel="stylesheet" href=" https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <div class="main">
        <section>
            <form method="POST">
                <h1>Choisissez un nouveau mot de passe</h1>
                <div class="middle">
                    <p>
                        Veuillez créez un nouveau mot de passe .
                        <br/> 
                        Un mot de passe fort est une combinaison de lettres , 
                        de chiffres et de signes de ponctuation .
                    </p>
                    <br/>
                    <div class="input-box">
                    <label>Entrer nouveau mot de passe :</label>
                    <input type="password" id="inp_1" name="newPassword"   placeholder="ENTRER LE MOT DE PASSE" required />
                    <span class="eye" onclick="myfunction()">
                    <i id="hide1"  class="fa fa-eye fa-lg" ></i>
                    <i id="hide2"  class="fa fa-eye-slash fa-lg" ></i>
                </span>
                    </div>
                    <br/>
                    <div class="input-box">

                    <label>Confirmer nouveau mot de passe :</label>
                    <input type="password" id="inp_2" name="confirmation" placeholder="CONFIRMER LE MOT DE PASSE" required />
                    <span class="eye" onclick="myfunction2()">
                    <i id="hide3"  class="fa fa-eye fa-lg" ></i>
                    <i id="hide4"  class="fa fa-eye-slash fa-lg" ></i>
                </span>
                </div >
                   <div id="erreur"><?php echo $erreur; ?></div>

                </div>
                <div class="buttom">
                <input type="submit" id="btn" name="valider" value="Enregistrer">

                </div>
            </form>
        </section>
    </div>
</body>
<script>
        function myfunction(){
            var x= document.getElementById('inp_1');
            var y =document.getElementById('hide1');
            var z=document.getElementById('hide2');

            if(x.type=='password')
            {
                x.type='text';
                y.style.display="block";
                z.style.display="none";
            }
            else
            {
                x.type='password';
                y.style.display="none";
                z.style.display="block";
            } 
        } 
        function myfunction2(){
            var x= document.getElementById('inp_2');
            var y =document.getElementById('hide3');
            var z=document.getElementById('hide4');

            if(x.type=='password')
            {
                x.type='text';
                y.style.display="block";
                z.style.display="none";
            }
            else
            {
                x.type='password';
                y.style.display="none";
                z.style.display="block";
            } 
        } 
    </script>    
</html>
