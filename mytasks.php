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
    <h3>Request Service</h3>
    <hr>
  </div>
   <?php 
    include ('task.class.php');
    $task = new task;
   if ($_POST){
       //echo "Task Created";
       $task->create_task($_POST['description']);
       
   }else{ //show the form
   
   ?>
      <form name="openticket" method="post" action="open.php" data-transition="slide">
          <label for="requestor">Requestor's name:<input type="text" name="requestor" id="requestor" placeholder="Name"/></label>
          <label for="description">Description:<textarea name="description" id="description" placeholder="Please enter any information about this request."></textarea></label>
          <input type="hidden" name="serviceprovider" value="<?php echo $_GET["id"];?>"/>
          <input type="submit" name="createtask" value="Submit"/>
    
      
      </form>
    <?php } ?>
           
  </div>
</body>
</html>
