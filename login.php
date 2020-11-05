<?php
$connexion = pg_connect("host=localhost dbname=gps user=postgres password=data") 
or die('Connexion impossible : '.pg_last_error());
include("config1.php"); 
$quer = 'SELECT distinct asset_id FROM public.optifleet_event ';
$resu = pg_query($quer) or die ('Echec requête : '.pg_last_error());
while ($row = pg_fetch_row($resu)) {
  extract ($row);
  $vitrineID=$row[0];
} 
$query0 = 'SELECT count(*) FROM public.gmao_asset';
    $resultat0 = pg_query($query0) or die ('Echec requête : '.pg_last_error());
    while ($row = pg_fetch_row($resultat0)) {
      extract ($row);
      $NumVitrine=$row[0];
    } 
$query1 = 'SELECT idio72,idio239,idio2, extract(hour FROM  event_time)FROM public.optifleet_event';
$resultat1 = pg_query($query1) or die ('Echec requête : '.pg_last_error());

// Affichage des résultats en HTML 
  
if(isset($_POST['submit']))
{
  $username = $_POST['usname'];
  $useremail = $_POST['user_email'];
  $userpassword = $_POST['user_password'];
$query2 = "INSERT INTO public.user(user_full_name, email_user, pass_word) VALUES('$username', '$useremail', '$userpassword')";
$resultat2 = pg_query($query2) or die ('Echec requête : '.pg_last_error());
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);

set_include_path("." . PATH_SEPARATOR . ($UserDir = dirname($_SERVER['DOCUMENT_ROOT'])) . "/pear/php" . PATH_SEPARATOR . get_include_path());
require_once "Mail.php";
/*Voici les détails du serveur SMTP Gmail :
Serveur SMTP : smtp.gmail.com.
Utilisateur SMTP: Votre nom d'utilisateur complet dans Gmail (adresse e-mail), par exemple votremail@gmail.com.
Mot de passe SMTP : votre mot de passe Gmail.
Port SMTP : 465.
TLS / SSL : Obligatoire.*/
$host = "";
$username = "My.vitrine20@gmail.com";
$password = "Myvitrine2020";
$port = "800";
$to = $useremail;
$email_from = "My vitrine";
$email_subject = "Subject Line Here:" ;
$email_body = "whatever you like" ;
$email_address = $useremail;

$headers = array ('From' => $email_from, 'To' => $to, 'Subject' => $email_subject, 'Reply-To' => $email_address);
$smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));
$mail = $smtp->send($to, $headers, $email_body);


if (PEAR::isError($mail)) {
echo("<p>" . $mail->getMessage() . "</p>");
} else {
echo("<p>Message successfully sent!</p>");
}
}
pg_close($connexion);
?>


<!doctype html>
<html lang="en">
  <head>
  	<title>Signe in</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" 
	integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="jquery.min.js"></script>
    <script src="popper.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="main.js"></script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="a946037d9024943d60899080-|49" defer=""></script>
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
		<nav id="sidebar" class="active">
        <ul class="list-unstyled components mb-5">

          <li class="active">
            <a href="home.php"><span class="fa fa-home"></span> Home</a>
          </li>
           <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="vitrine.php" role="button" aria-haspopup="true" aria-expanded="false"><span class="fas fa-tachometer-alt"></span> Vitrine</a>
              <div class="dropdown-menu">
              <?php
              
              for ($x = 1; $x <=$NumVitrine ; $x++) {
                if($vitrineID==$x)
                {
               echo "<a class='dropdown-item ' style='color:black;font-size:20px; text-align: center;'
               href='vitrine.php'>vitrine$x</a>";
               }
             }
            ?>
              </div>
        </li>
        <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span class="fas fa-users-cog"></span> pages</a>
              <div class="dropdown-menu">
                          <a class="dropdown-item" style="color:black;   text-align: center;" href="signe.php">Connexion</a>
                          <a class="dropdown-item" style="color:black;   text-align: center;" href="login.php">Login</a>
                          
              </div>
        </li>
        </ul>
              
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5" style="background-image: url('purpule.jpeg'); background-size:cover;">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
                    <div class="collapse navbar-collapse"  id="navbarSupportedContent">
                    <div class="logo">
                    <h1 style="margin:0 300px"> <i class="fas fa-location-arrow" style="color:dodgerblue;"></i>My vitrine</h1>
                   
                    </div>
                </div>
                    </div> 
                   
            </nav>
            
            <div class="home">
            <div class="shadow-lg p-3 mb-3 bg-white rounded" style="width:60%;margin:100px 200px;height:100%; raduis:50px;">
            <form class="form" method="post">
              <div class="form-group">
              <label for="name">User</label>
                <input type="text" id="name"  class="form-control mx-sm-1" name="usname" >
              <label for="email">email</label>
                <input type="text" id="email" place-holder="....@exemple.com" class="form-control mx-sm-1" name="user_email" >
                <label for="inputPassword6">Password</label>
                <input type="password" id="inputPassword6" class="form-control mx-sm-1" aria-describedby="passwordHelpInline" name="user_password">
                <small id="passwordHelpInline" class="text-muted">
                  Must be 8-20 characters long.
                </small>
              </div>
              <button type="submit" class="btn btn-primary" name="user" >submit</button> <label> </label>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </form>
    
                
	
  </body>
</html>