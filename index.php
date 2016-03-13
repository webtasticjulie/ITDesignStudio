<?php session_start('tasks');?>

<!DOCTYPE html>

<html>
<head>
  <title>Design Studio CCSE</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
  <link rel="stylesheet" href="style.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
  <script type="text/javascript">
      $("#search").keyup(function(event){
          if (event.keyCode == 13){
              $("#go").click();
          }
          
      });
    
  </script>
</head>

<body>
    
   <?php include('header.php');?>
    <div id="maincontent">
       
    <div id="titlebar">
    <h3>Welcome</h3>
        
    <hr>
        <span style="width: 30%; float: left; padding: 1em;">
        <?php if (!isset($_SESSION['username'])){ ?>
        <form name="username" method="post" action="login.php" transition="flip">
            <label for="username">Username:<input type="text" name="username" id="username" maxlength="50"/></label><br/>
            <label for="password">Password:<input type="password" name="password" id="password"/></label>
            <input type="submit" value="Submit"/>

        </form>
        <?php }else{
        echo "Welcome ".$_SESSION['username'];
                }
                ?>
        </span>
         <strong>Welcome! Looking for service providers? Need help with PHP? We have a community of individuals listed on our site offering services from PHP tutoring to HTML.  </strong>
        <p><a href="registration.php" data-transition="slide">Register</a> for our site!</p>
        <h4>Admins</h4>
        <ul>
            <li>Julie Beck</li>
            <li>Alfonso Madrid</li>
            <li>Pakorn</li>
            <li>Don</li>
        </ul>

  </div>

 

  <footer>
    &copy; 2016
  </footer>
</body>
</html>
