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
       foreach($_POST['services'] as $service){
            $service_id=$service;
            $status="In Progress";
            $description=addslashes($_POST['description']);
            $duedate = addslashes($_POST['taskdue']);
            $provider = addslashes($_POST['providers']);
            $task->create_task($description, $status , $duedate, $service_id, $provider);
            
        }
        echo "<h4>Submitted</h4><p>Your request has been submitted.</p>";
       
   }else{ //show the form
      $providers = $task->get_providers('');
      
   ?>
      <form name="openticket" method="post" action="open.php" data-transition="slide">
          <label for="requestor">Requestor's KSU ID:<input type="text" name="requestor" id="requestor" placeholder="Name"/></label>
          <label for="description">Description:<textarea name="description" id="description" placeholder="Please enter any information about this request."></textarea></label>
          <input type="hidden" name="serviceprovider" value="<?php echo $_GET["id"];?>"/>
          <label for="providers">Provider:
          <select name="providers" id="providers" required>
          <?php $task->create_provider_dd($providers, $_GET["id"]); ?>
          </select>
          </label>
          <label>Service Requested:</label>
          <?php
          $task->get_services_checkbox();
          ?>
          <label for="taskdue">Due Date:</label><input type="date" name="taskdue" required/>
          <input type="submit" name="createtask" value="Submit"/>
    
      
      </form>
    <?php } ?>
           
  </div>
</body>
</html>
