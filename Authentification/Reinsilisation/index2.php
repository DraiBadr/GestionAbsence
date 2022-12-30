<?php
 function hideEmailAddress($email)
{

    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        list($first, $second) = explode('@', $email);
		
		
		$valuelen = ceil(strlen($first) / 2);
	    $first = str_replace(substr($first,-$valuelen), str_repeat('*',$valuelen), $first); 
		
		 list($address1, $address2) = explode('.', $second);
		
		
		
		$valuelen = ceil(strlen($address2) / 4);
	    $afterdot = str_replace(substr($address2,-$valuelen), str_repeat('*',$valuelen), $address2); 
		
	 }
        $hideEmailAddress = $first . '@' . $address1 . '.' . $address2;
		return $hideEmailAddress;
		
}
?>
<?php 
session_start();
include ('../../db.php');
$erreur="";
$otp=$_SESSION["code"];
$varemail=$_SESSION["email"];
$showemail = hideEmailAddress($varemail);
if(isset($_POST["valider"]) && isset($_POST['otp']))
{
    
    
    
    if (isset($_POST["valider"])) 
    $submit_otp=$_POST["otp"];
    if ($submit_otp == $otp){
        header("location:index3.php");
    }
    else
    {
        $erreur="Votre code de sécurité est incorrecte";
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
    <link rel="stylesheet" href="style2.css">
    <link rel="icon" href="../../images/logo_ofppt.png" type="image/icon type">

</head>
<body>
    <div class="main">
        <section>
            <form method="POST">
                <h1>Entrer le code de sécurité</h1>
                <div class="middle">
                    <p>
                        Nous avons vous envoyez un code de sécurité à votre e-mail (<?=$showemail;?>) .
                        <br/>
                        Veuillez Entrer le code :
                    </p>
                    <br/>
                    <input type="text" id="inp" name="otp" placeholder="ENTRER LE CODE" required />
                   <div id="erreur"><?php echo $erreur; ?></div>

                </div>
                <div class="buttom">
                <input type="submit" id="btn" name="valider" value="ENVOYER">

                </div>
            </form>
        </section>
    </div>
</body>
</html>
