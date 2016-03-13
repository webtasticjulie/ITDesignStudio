<?php session_start('tasks');?>
<!DOCTYPE html>

<html>
<head>
  <title>Services</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" href="style.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
  <?php include('header.php');?>

  

  <div id="maincontent">
      <div id="titlebar">
    <h3>Service Providers</h3>
    <hr>
  </div>
   <?php 
   include ('services.class.php');
   //instantiate object
   $service = new services(); 
   $service->get_services_dd();
   //get providers from database
   $providers = $service->get_providers("");
 
   //iterate through array displaying providers and services they offer
 
       for ($i=0; $i < sizeof($providers['Profile_ID']); $i++){
          echo "<div class=\"providerinfo\">";
          echo "<h4>".$providers['provider'][$i]."</h4>";
          echo "<h5>Contact Information</h5><hr/><a href=\"mailto:".$providers['email'][$i]."\">".$providers['email'][$i]."</a><br/>";
           
          if (isset($_SESSION['username'])){
              echo "logged in ".$_SESSION['username'];
         echo "<span style='width: 20%; float:right;'><a href='open.php?id=".$providers["Profile_ID"][$i]."' data-role=\"button\">Request Service</a></span>";
          }
           echo "<h5>Services</h5><hr/>";
          $offers = $service->get_service_providers($providers['Profile_ID'][$i]);
          if (sizeof($offers>0)){
              for ($j=0; $j<sizeof($offers['desc']); $j++){
               echo "&bull;".$offers['desc'][$j]."<br/>";
              }
          }
            
          echo "</div>";

       }//end of For
  


  ?>

           
  </div>
</body>
</html>
