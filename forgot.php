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
$query2 = 'SELECT * FROM public.gmao_asset';
$resultat2 = pg_query($query2) or die ('Echec requête : '.pg_last_error());
if(isset($_POST['submit']))
{
  $username = $_POST['usname'];
  $userpassword = $_POST['user_password'];
  $query9 = "SELECT count(*) from public.user where user_full_name='$username' AND  pass_word='$userpassword'";
    $resultat9 = pg_query($query9) or die ('Echec requête : '.pg_last_error());
    while ($row = pg_fetch_row($resultat9)) {
      extract ($row);
      $num_users=$row[0];
    } 
    if($num_users==0)
{
  echo "<script>alert(\"No, the user does not 
  exist\")</script>";
 
}
}


// Affichage des résultats en HTML

$query0 = 'SELECT count(*) FROM public.gmao_asset';
    $resultat0 = pg_query($query0) or die ('Echec requête : '.pg_last_error());
    while ($row = pg_fetch_row($resultat0)) {
      extract ($row);
      $NumVitrine=$row[0];
    } 


pg_close($connexion);
?>

   

<!doctype html>
<html lang="en">
  <head>
  	<title>forgot my password !!</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" 
	integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
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
                    <div class="logo" >
                    <h1 style="margin:0 300px;"> <i class="fas fa-location-arrow" style="color:dodgerblue;"></i>My vitrine</h1>
                    
                    </div>
                </div>
                
                    </div> 
                  
            </nav>
            
            <div class="home">
            <div class="shadow-lg p-3 mb-3 bg-white rounded" style="width:60%;margin:100px 200px;height:100%; raduis:50px;">
            <form class="form" method="post">
              <div class="form-group">
              <div class="imgcontainer">
              <img src="password_en.png" alt="Avatar" class="avatar">
            </div>  
              <label for="name">email</label>
                <input type="email" id="name"  class="form-control mx-sm-1" name="usemail" >
                <label for="inputPassword6">Password</label>
                <input type="password" id="inputPassword6" name="user_password" class="form-control mx-sm-1" aria-describedby="passwordHelpInline"><br>
                <small id="passwordHelpInline" class="text-muted">
                  Must be 8-20 characters long.<br>
                </small>
                <div class="form-check">
              <input class="form-check-input" type="checkbox" id="gridCheck">
              <label class="form-check-label" for="gridCheck">
                remembre me
              </label><br>
    </div>
              </div>
              <button type="submit" class="btn btn-primary">submit </button> <label> </label>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </form>
           
             </div>        
</div>
   
    <script src="jquery.min.js"></script>
    <script src="popper.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="main.js"></script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="a946037d9024943d60899080-|49" defer=""></script>
		
  </body>
</html>
