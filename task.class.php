<?php
include ('services.class.php');

class task extends services{
var $task_title;
var $task_descr;

function create_task(&$description, $status="In Progress", &$duedate, &$service, &$assigned){
   
   $link = $this->connect_db();
   $query = mysqli_prepare($link, "INSERT INTO tasks (task_date, task_desc, task_status, task_deadline, Service_ID, assigned_to) VALUES (NOW(), ?, ?, ?, ?, ?)") or die("Error: ".mysqli_error($link));
   mysqli_stmt_bind_param ($query, "sssss", $description, $status, $duedate, $service, $assigned);
   mysqli_stmt_execute($query) or die("Error. Could not insert into the table.". mysqli_error($conn));
    $task_id = $link->insert_id;
    $user_id="4";//hard coded for now until we get authentication piece in place
    $this->create_service_request($task_id, $user_id);
    mysqli_stmt_close($query);  //for prepared
    
}//fu

function create_service_request($task_id, $user_id){
   $link = $this->connect_db();
   $query = mysqli_prepare($link, "INSERT INTO service_request(Requester_ID, Task_ID) VALUES ( ?, ?)") or die("Error: ".mysqli_error($link));
   mysqli_stmt_bind_param ($query, "ss", $user_id, $task_id);
   mysqli_stmt_execute($query) or die("Error. Could not insert into the table.". mysqli_error($conn));
    mysqli_stmt_close($query);  //for prepared
   
    
}//fu
    
function create_provider_dd($my_array, $selected){
        echo "<option value=''>SELECT</option>";
        for ($i=0; $i<count($my_array['provider']); $i++){
            echo "<option value='".$my_array['Profile_ID'][$i]."'";
            if ($my_array['Profile_ID'][$i]==$selected){ echo "SELECTED"; }
            echo ">".$my_array['provider'][$i]."</option>";
        }
    

}//fu
    
}// end of class

?>