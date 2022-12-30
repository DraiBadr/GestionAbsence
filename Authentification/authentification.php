<html lang="en">
<head>
   <?php  
include ('../db.php');
?>
<?php
$erreur='';
session_start();

if($_SERVER["REQUEST_METHOD"]=='POST'){
	
    if(isset($_POST['connect'])){
        if (preg_match("/^[A-Z][a-z]+(\s)*$/",$_POST['username'])) {
            if(isset($_POST['username']) and isset($_POST['password'])){
                $sql='SELECT  * from compte where login=? AND password=? limit 1';
                $pdo_statement=$pdo_conn->prepare($sql);
                $pdo_statement->bindParam(1,$_POST['username']);
                $pdo_statement->bindParam(2,$_POST['password']);
                $pdo_statement->execute();
                $result=$pdo_statement->fetch(PDO::FETCH_ASSOC);
                $n=$pdo_statement->rowCount();
                if(empty($_POST['username']) or empty($_POST['password']))
                {
                    $erreur=" Tous Les champs sont obligatoires ";
                }
                else
                {
                    if ($n!=0)
                    {
                        $_SESSION["login"]=$_POST['username'];
                        $_SESSION["password"]=$_POST['password'];
                        $_SESSION["sexe"]=$result['sexe'];
                        $_SESSION["role"]=$result['role'];
                            header("Location:../Accueil/accueil.php"); 
                        }
                       
                    
                    else
                    {
                        $erreur=" Le nom d'utilisateur ou le mot de passe est incorrect ";
                    }            
                }
                
            }
          }
          else { $erreur=" Le nom d'utilisateur ou le mot de passe est incorrect ";}
		
	}
	
	
}

?> 
    <title>Authentification</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <link rel="icon" href="../images/logo_ofppt.png" type="image/icon type">
    <link rel="stylesheet" href=" https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <form method="POST" class="form_horizontal" action="authentification.php">
    <div class="form-bg ">
        <div class="container-fluid">
        <div class="row">
            <img src="../images/logo3.png" alt="ofppt logo" class="center"/>
        <div id="side_conx_div">
            <h4>connexion</h4>
        <div class="div_conx">
            <div class="input-box">
                <i class="fa fa-user-o fa-2x" style="color: grey;" aria-hidden="true"></i>
                <input type="text" id="username" name="username" placeholder="Nom d'utlisateur" >
            </div>
            <div class="input-box">
                <i class="fa fa-lock fa-2x" style="color: grey;" aria-hidden="true"></i>
                <input id="pass" type="password" name="password" placeholder="Mot de passe" >
                <span class="eye" onclick="myfunction()">
                    <i id="hide1"  class="fa fa-eye fa-lg" ></i>
                    <i id="hide2"  class="fa fa-eye-slash fa-lg" ></i>
                </span>
            </div>
            <div id="erreur">
	    	<?php echo $erreur ; ?>
            </div>
            <div class="option">
                <a href="Reinsilisation/index1.php" id="a_1">Mot De Passe Oublié ?</a>
            </div>
            <div class="buttom_color">
            <button type=" submit" id="connect" name="connect"  class="connexion">connexion</button>
            </div>
        </div>
        </div>
        </div>
    </div>
    </form> 
    <script>
        function myfunction(){
            var x= document.getElementById('pass');
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
    </script>    
</body>
</html>
