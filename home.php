<?php
$connexion = pg_connect("host=localhost dbname=gps user=postgres password=data") 
or die('Connexion impossible : '.pg_last_error());
include("config1.php"); 
$quer = 'SELECT asset_id FROM public.optifleet_event ';
$resu = pg_query($quer) or die ('Echec requête : '.pg_last_error());
while ($row = pg_fetch_row($resu)) {
  extract ($row);
  $vitrineID=$row[0];
} 
$query1 = 'SELECT idio72,idio239,idio2, extract(hour FROM  event_time)FROM public.optifleet_event ';
$resultat1 = pg_query($query1) or die ('Echec requête : '.pg_last_error());
$query2 = 'SELECT * FROM public.gmao_asset';
$resultat2 = pg_query($query2) or die ('Echec requête : '.pg_last_error());
$query0 = 'SELECT count(*) FROM public.gmao_asset';
$resultat0 = pg_query($query0) or die ('Echec requête : '.pg_last_error());
while ($row = pg_fetch_row($resultat0)) {
  extract ($row);
  $NumVitrine=$row[0];
} 

// Affichage des résultats en HTML
$temperature = array();
$on_off = array();
$open_close = array();
$time = array();

while($row = pg_fetch_assoc($resultat1)) {
 array_push($temperature, $row['idio72']/10);
    array_push($on_off,$row['idio239']);
    array_push($open_close, $row['idio2']);
    array_push($time, $row['date_part']);
    
}
  $result = pg_query($connexion, "SELECT lastlatitude,lastlongitude FROM public.gmao_asset");
  while ($row = pg_fetch_row($result)) {
    extract ($row);
    $lastlatitude=$row[0];
    $lastlongitude=$row[1];
  } 
 

pg_free_result($resultat1);
pg_free_result($resultat2);
pg_close($connexion);
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" 
	integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    
              

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
      <div id="content" class="p-4 p-md-5" >
      <nav class="navbar navbar-expand-lg navbar-light bg-light" >
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
                  
                  
            </nav>
            
            <div class="home">
          
            <div class="shadow-lg p-3 mb-5 bg-white rounded"style="margin:100px 0;">
            <div class="row mx-md-n5">
              <div class="col px-md-5"><div class="p-3  bg-white">
              <h1 style="color:dodgerblue;font-size:25px;">GPRS signification :</h1>
              <p style="font-size:20px;">Le General Packet Radio Service ou GPRS est une norme pour 
              la téléphonie mobile dérivée du GSM (Global System for Mobile Communications).
               On l’appelle parfois le « 2,5 G » pour dire qu’il est à mi-chemin entre le GSM
                (2ème génération) et l’UMTS (3ème génération).
              Le GPRS permet un débit  plus élevé que le GSM et est mieux adapté à la transmission 
              de données nécessaire à la géolocalisation de voitures.</p>
              </div></div>
              <div class="col px-md-5"><div class="p-1  bg-white">
              <img src="gprs1.jpg"  style="width:100%;">
              
              </div></div>
            </div>
            </div>
            
            
       

  
        </div>


    </div>
    </div>
    <script src="jquery.min.js"></script>
    <script src="popper.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="main.js"></script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="a946037d9024943d60899080-|49" defer=""></script>
		
  </body>
</html>

