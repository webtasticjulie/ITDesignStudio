<?php session_start('tasks');?>
<!DOCTYPE html>

<html>
<head>
  <title>My Tasks</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
  $('#transfer').change(function() {
  transfer();
  });
});
    function transfer(){
      alert('here');
      xmlReq = new XMLHttpRequest();
      xmlReq.onreadystatechange = processResponse;

      //call server_side.php
      xmlReq.open("POST", "transfer.php", true);

      //read value from the form
      // encodeURI is used to escaped reserved characters
      parameter = "taskid=" + encodeURI(document.forms["transfer"].task_id.value);

      //send headers
      xmlReq.setRequestHeader("Content-type", 
                  "application/x-www-form-urlencoded");
      xmlReq.setRequestHeader("Content-length", parameter.length);
      xmlReq.setRequestHeader("Connection", "close");

      //send request with parameters
      xmlReq.send(parameter);
      return false; 
    }
</script>
</head>

<body>
  <?php include('header.php');?>
  

  <div id="maincontent">
      <div id="titlebar">
    
    <?php 
    include ('task.class.php');
    $task = new task;
    if (isset($_SESSION['username'])){
        $tasks = $task->get_users_task($_SESSION['username']); //change later to session username

        // print_r($tasks);
        echo "<h3>".$tasks[0]["name"]."'s Tasks</h3><hr/><br/>";
        $providers = $task->get_providers('');
        for ($i=0; $i< sizeof($tasks); $i++){

         //   echo $tasks["task_id"][$i]."<br/>"; 

            //echo $tasks[$i]["task_id"]."<br/>";
            echo "Description:  ".$tasks[$i]["task_desc"]."<br/>";
            echo "Created Date:  ".$tasks[$i]["task_date"]."<br/>";
            echo "Deadline:  ".$tasks[$i]["task_deadline"]."<br/>";
            echo "Service Requested:  ".$tasks[$i]["service_desc"]."<br/>";
            echo "Status:".$tasks[$i]["task_status"]."<br/>";
            echo "<div class='completebutton'><form name='completed'><input type='hidden' name='task_id' value='".$tasks[$i]["task_id"]."'><label for='complete'>Mark as Completed<input type='checkbox' data-mini='true' data-theme='c' name='complete' id='complete' value='Mark as Complete'/></label></form></div>";
            echo "<div class='completebutton'><form name='transfer'><input type='hidden' name='task_id' value='".$tasks[$i]["task_id"]."'><select data-mini='true' data-theme='c' name='transfer' id='transfer' onChange='transfer();'>";
            $task->create_provider_dd($providers, "", "Transfer To:");
            echo "</select></label></form></div>";
            echo "<hr/><br/><br/>";


        }
    }else{
        echo "You must be logged in to see your tasks.";
    }
    ?>
  </div>
  
  
</body>
</html>
