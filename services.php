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
    <h3>Services</h3>
    <hr>
  </div>
   <?php include ('services.class.php');
   $service = new services();
   $services = $service->get_services();
   foreach ($services as $service){
    echo "<p><strong>".$service."</strong></p>"; 
    echo "<a href=\"service_providers.php?filter=".$service."\">Find a service provider>></a>";
   }



  ?>

           
  </div>
</body>
</html>
