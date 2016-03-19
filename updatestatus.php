<?php
// transfer a task to someone else
$task_id=$_POST["task_id"]; //task id in db of the task being updated

include('task.class.php');
$task = new task;
$task->update_status($task_id);
?>