<?php
class services{
public $service_desc;

function services(){
 $this->service_desc="";
    
}
//gets all services from database 
function get_services(){
   $link = $this->connect_db();
   $sql = "SELECT Service_DSC FROM services";
   $results= mysqli_query($link, $sql);
   $services = array();
   while ($row = mysqli_fetch_array($results)){
       $services[]=$row['Service_DSC'];
   }
   return $services;
}
    
//creates a dynamic drop down of services and applys filter for searching
function get_services_dd(){
   $link = $this->connect_db();
   $sql = "SELECT Service_DSC FROM services";
   $results= mysqli_query($link, $sql);
   $services = array();
   echo "<select name=\"search\" onchange=\"location.href='?filter='+this.value;\" style=\"float:right;\">";
   echo "<option>Filter</option>";
   while ($row = mysqli_fetch_array($results)){
       echo "<option name=\"search\" value=\"".$row['Service_DSC']."\">".$row['Service_DSC']."</option>";
   }
   echo "</select><br/><br/>";
   
}
    
//creates dynamic list of checkboxs for registration form
function get_services_checkbox(){
   $link = $this->connect_db();
   $sql = "SELECT Service_DSC, Service_ID FROM services";
   $results= mysqli_query($link, $sql);
   $services = array();

   while ($row = mysqli_fetch_array($results)){
       echo "<label for='services'>".$row['Service_DSC']."<input name=\"services[]\" type=\"checkbox\" value=\"".$row['Service_ID']."\"></label>";
   }
    
   
}

//returns an array of all service providers who actually offer a service
function get_service_providers($id){
   $link = $this->connect_db();
   $sql = "SELECT DISTINCT profiles.name as name, Services.Service_DSC as Service_DSC, services_provided.Profile_ID as Profile_ID from profiles,    services_provided, Services where profiles.Profile_ID= services_provided.Profile_ID AND services_provided.Service_ID = Services. Service_ID";
   
   if (is_numeric($id)){
      $sql.=" AND services_provided.Profile_ID = '".stripslashes($id)."' ";
   } 
   
  
  $services = array();
  $x=0;
  $results= mysqli_query($link, $sql);
  while ($row = mysqli_fetch_array($results)){
       
       $services['desc'][$x]=$row['Service_DSC'];
       $services['provider'][$x]=$row['name'];
       $services['Profile_ID'][$x]=$row['Profile_ID'];
       $x++;
   }
    
  
   
   return $services;
}
    
//get providers that offer services
function get_providers($id){
   $link = $this->connect_db();
  
   $sql = "SELECT DISTINCT profiles.name as name, profiles.email as email, COALESCE(services_provided.Profile_ID, 0) as Profile_ID from profiles, services_provided, Services where profiles.Profile_ID= services_provided.Profile_ID AND services_provided.Service_ID = Services. Service_ID";
  if (is_numeric($id)){
      $sql.=" AND services_provided.Profile_ID = '".$id."' ";
  }
  if($_GET){
  if (isset($_GET["filter"])){
  if($_GET["filter"]!=""){
       $sql.=" AND Services.Service_DSC LIKE '%".addslashes(urldecode($_GET["filter"]))."%' ";
   }
  }
  }
  $providers = array();
  $x=0;
  $results= mysqli_query($link, $sql);
  if (mysqli_num_rows($results)==0){
      echo "Sorry, no providers found with that criteria.";
      exit;
  }else{
      while ($row = mysqli_fetch_array($results)){

           $providers['provider'][$x]=$row['name'];
           $providers['Profile_ID'][$x]=$row['Profile_ID'];
           $providers['email'][$x]=$row['email'];
           $x++;
       }



       return $providers;
  }
}
function check_exists($table, $field, $value){
  $link = $this->connect_db();
  $sql= "SELECT * FROM ".$table." WHERE ".$field." = '".$value."'";
  $results= mysqli_query($link, $sql); 
  $num_rows=mysqli_num_rows($results);
  if ($num_rows > 0){
     echo "<span style=\"color: red; font-weight: bold;\">An account is already registered to that email address.</span>";
     return $num_rows;
  }else{
      return 0;
  }
}
//connects to database and returns link  
function connect_db(){
    $link = new mysqli('localhost', 'my_user', 'my*password', 'abeck');
    if (!$link){
      echo "ERROR: Unable to connect to MySQL. ".PHP_EOL;
      echo "Debug".mysqli_connect_errno().PHP_EOL;
      echo "Debug error".mysqli_connect_error().PHP_EOL;
      exit;
  }
  return $link;
}

//function inserts service provider into database
function add_provider_service($user_id, $service_id){
   
   $link = $this->connect_db();
   $query = mysqli_prepare($link, "INSERT INTO services_provided (Service_ID, Profile_ID) VALUES (?, ?)") or die("Error: ".mysqli_error($link));
   mysqli_stmt_bind_param ($query, "ss", $service_id, $user_id);
   mysqli_stmt_execute($query) or die("Error. Could not insert into the table.". mysqli_error($conn));
   mysqli_stmt_close($query);  //for prepared 

    
}
//provide server side validation of form
function validate_form(){
    $error = false; //set error to false for default
  
    if (!isset($_POST['services'])){  // if services isn't set then no checkbox has been selected
        echo "Please provide at least one service.<br/>";
        $error = true;
        
    }
    foreach($_POST as $key=>$value){
       $$key=$value;
       if (($value=="") || is_null($value)){
           echo "Please supply a value for ".$key."<br/>";
           $error=true;
       }else{
           if (!is_array($value)){
                if ($key!="Submit"){
                echo $key." = ".$value."<br/>";
                }
           }
           
       }
            
    }
    //exit code if error present - do not continue to add user
    if ($error == true){
        echo "Please go back and supply all data.";
        echo "<a href=\"#\">Back</a>";
        exit;
    }
}

function add_provider(){
    $link = $this->connect_db();
    $this->validate_form();
    //check if email account already exists
    $exists=$this->check_exists('profiles', 'Email', $_POST['email']);
    
    $name=$_POST['fname']." ".$_POST['lname'];
    if ($exists == 0){  //if user doesn't already exist
        
        $query = mysqli_prepare($link, "INSERT INTO profiles (name, Email, Availability,notifications) VALUES (?, ?, ?, ?)") or die("Error: ". mysqli_error($link));
        mysqli_stmt_bind_param ($query, "ssss", $name, $_POST['email'], $_POST['availability'], $_POST['optin']);
        mysqli_stmt_execute($query) or die("Error. Could not insert into the table.".mysqli_error($link));
        $user_id = $link->insert_id;

        foreach($_POST['services'] as $service){
            $service_id=$service;
            $this->add_provider_service($user_id,$service_id);
        }
        //send confirmation email if opted in
         if ($_POST['optin']=="on"){
            $this->sendConfirmation($name, $_POST['email']);
         }
    
    }    
}// end function
    
function sendConfirmation($name, $email){
    $message= $name.", Thank you for registering with our site.  Your registration has been confirmed.";
    $subject="Registration Confirmation";
    if (mail($email, $subject, $message)){
            echo ("<p>Confirmation email message successfully sent!</p>");
    }else{
            echo ("<p>Confiramtion email message delivery failed.</p>");
    }
    
}

}//end of class

?>