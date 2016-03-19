<?php
// transfer a task to someone else
$task_id=$_POST["task_id"]; //task id in db of the task being transferred
$transfer_to = $_POST["transfer"];  //Profile_ID of user the task is being transferred to


include('task.class.php');
$task = new task;
$task->transfer_task($task_id, $transfer_to);
?>