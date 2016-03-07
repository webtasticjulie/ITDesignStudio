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
    
function create_provider_dd($my_array, $selected, $default_text="SELECT"){
        echo "<option value=''>".$default_text."</option>";
        for ($i=0; $i<count($my_array['provider']); $i++){
            echo "<option value='".$my_array['Profile_ID'][$i]."'";
            if ($my_array['Profile_ID'][$i]==$selected){ echo "SELECTED"; }
            echo ">".$my_array['provider'][$i]."</option>";
        }
    

}//fu
    
function get_users_task($username){
   $link = $this->connect_db();
   $query = mysqli_prepare($link, "SELECT task_id, task_deadline, task_desc, task_date,  task_status, task_deadline, services.Service_DSC, profiles.name FROM profiles, tasks, services WHERE services.Service_ID = tasks.Service_ID AND tasks.assigned_to = profiles.Profile_ID AND profiles.ldap_login = ? ORDER BY task_deadline") or die("Error: ".mysqli_error($link));
   mysqli_stmt_bind_param ($query, "s", $username);
   mysqli_stmt_execute($query) or die("Error. Could not query the table.". mysqli_error($conn));
   $result = mysqli_stmt_get_result($query);
    
    if (mysqli_num_rows($result)==0){
      echo "You have no tasks assigned to you.";
      exit;
    }else{
      $x=0;
      while ($row = mysqli_fetch_array($result)){

           $tasks[$x]['task_id']=$row['task_id'];
           $tasks[$x]['task_deadline']=$row['task_deadline'];
           $tasks[$x]['task_desc']=$row['task_desc'];
           $tasks[$x]['task_date']=$row['task_date'];
           $tasks[$x]['task_status']=$row['task_status'];
           $tasks[$x]['service_desc']=$row['Service_DSC'];
           $tasks[$x]['name']=$row['name'];
          
          
           $x++;
       }



       return $tasks;
  }
   
}//fu
    
}// end of class

?>