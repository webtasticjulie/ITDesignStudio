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
</head>

<body>
  <?php include('header.php');?>
  

  <div id="maincontent">
      <div id="titlebar">
    
    <?php 
    include ('task.class.php');
    $task = new task;
    $tasks = $task->get_users_task('crocheterjulie'); //change later to session username
    // print_r($tasks);
    echo "<h3>".$tasks[0]["name"]."'s Tasks</h3><hr/><br/>";
    for ($i=0; $i< sizeof($tasks); $i++){
        
     //   echo $tasks["task_id"][$i]."<br/>"; 
        
        //echo $tasks[$i]["task_id"]."<br/>";
        echo "Description:  ".$tasks[$i]["task_desc"]."<br/>";
        echo "Created Date:  ".$tasks[$i]["task_date"]."<br/>";
        echo "Deadline:  ".$tasks[$i]["task_deadline"]."<br/>";
        echo "Service Requested:  ".$tasks[$i]["service_desc"];
        echo "<div class='completebutton'><form name='completed'><input type='hidden' name='task_id' value='".$tasks[$i]["task_id"]."'><label for='complete'>Mark as Completed<input type='checkbox' data-mini='true' data-theme='c' name='complete' id='complete' value='Mark as Complete'/></label></form></div>";
        echo "<hr/><br/><br/>";
        
        
    }
    ?>
  </div>
  
  
</body>
</html>
