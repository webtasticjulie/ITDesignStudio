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
function get_services_checkbox($opt="Y"){
   $link = $this->connect_db();
   $sql = "SELECT Service_DSC, Service_ID FROM services";
   $results= mysqli_query($link, $sql);
   $services = array();

   while ($row = mysqli_fetch_array($results)){
       echo "<label for='services'>".$row['Service_DSC']."<input name=\"services[]\" type=\"checkbox\" value=\"".$row['Service_ID']."\"></label>";
   }
    if ($opt=="Y"){
    echo "<label for='servicesnotlisted'>Add Service not Listed<input name=\"services[]\" id=\"servicesnotlisted\" type=\"checkbox\" value=\"NotListed\"></label>";
    }
   
}

//returns an array of all service providers who actually offer a service
function get_service_providers($id){
   $link = $this->connect_db();
   $sql = "SELECT DISTINCT profiles.name as name, Services.Service_DSC as Service_DSC, services_provided.Profile_ID as Profile_ID from profiles,    services_provided, Services where profiles.Profile_ID= services_provided.Profile_ID AND services_provided.Service_ID = Services. Service_ID";
   
   if (is_numeric($id)){
      $sql.=" AND services_provided.Profile_ID = '".addslashes($id)."' ";
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
} //fu
    
    
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
       }//end of while
       return $providers;
  } //end else
}//fu
    
    
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
}//fu
    
    
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
} //fu
    

//function inserts service provider into database
function add_provider_service($user_id, $service_id){
   
   $link = $this->connect_db();
   $query = mysqli_prepare($link, "INSERT INTO services_provided (Service_ID, Profile_ID) VALUES (?, ?)") or die("Error: ".mysqli_error($link));
   mysqli_stmt_bind_param ($query, "ss", $service_id, $user_id);
   mysqli_stmt_execute($query) or die("Error. Could not insert into the table.". mysqli_error($conn));
   mysqli_stmt_close($query);  //for prepared 

    
}//fu
    
function add_service($service){
   
   $link = $this->connect_db();
   $query = mysqli_prepare($link, "INSERT INTO services (Service_DSC) VALUES (?)") or die("Error: ".mysqli_error($link));
   mysqli_stmt_bind_param ($query, "s", $service);
   mysqli_stmt_execute($query) or die("Error. Could not insert into the table.". mysqli_error($conn));
   $sid = $link->insert_id;

   echo "Successfully added service".$sid;
  
   return $sid;

    
}//fu
    
    
//provide server side validation of form
function validate_form(){
    $error = false; //set error to false for default
  
    if (!isset($_POST['services'])){  // if services isn't set then no checkbox has been selected
        echo "Please provide at least one service.<br/>";
        $error = true;
        
    }
    foreach($_POST as $key=>$value){
       $$key=$value;
        if ($key!="addservice"){
       if (($value=="") || is_null($value)){
           echo "Please supply a value for ".$key."<br/>";
           $error=true;
           exit;
       
       }else{
           if (!is_array($value)){
                if ($key!="Submit"){
                    echo $key." = ".$value."<br/>";
                }
           }//end if
         
       }//end else
        }
        
            
    }//foreach
    //exit code if error present - do not continue to add user
    if ($error == true){
        echo "Please go back and supply all data.";
        echo "<a href=\"#\">Back</a>";
        exit;
    }//if
}//fu
    
//add a provider to the database
function add_provider(){
    $link = $this->connect_db();
    $this->validate_form();
    //check if email account already exists
    $exists=$this->check_exists('profiles', 'Email', $_POST['email']);
    
    $name=$_POST['fname']." ".$_POST['lname'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $username=$_POST['ksuid'];
    
   
    if (strlen($fname)<3){
        echo "Invalid Length Criteria on first name.";
        
    }
    if (strlen($lname)<3){
        echo "Invalid Length Criteria on lastname.";
        exit;
    }
     if (strlen($email)<3){
        echo "Invalid Length Criteria on email.";
        exit;
    }
    if ($exists == 0){  //if user doesn't already exist
        
        $query = mysqli_prepare($link, "INSERT INTO profiles (name, Email, Availability,notifications, ldap_login) VALUES (?, ?, ?, ?,?)") or die("Error: ". mysqli_error($link));
        if ((isset($_POST["optin"])) && ($_POST['optin']=="")){
            $optin="OFF";
        }else{
            $optin="ON";
        }
        mysqli_stmt_bind_param ($query, "sssss", $name, $_POST['email'], $_POST['availability'], $optin, $_POST['ksuid']);
        mysqli_stmt_execute($query) or die("Error. Could not insert into the table.".mysqli_error($link));
        $user_id = $link->insert_id;
        
        
        //if adding a service not listed
        if (isset($_POST['addservice'])){
        $sid= $this->add_service($_POST["addservice"]);
        
         $this->add_provider_service($user_id,$sid);
            
        }   
        foreach($_POST['services'] as $service){
            $service_id=$service;
            $this->add_provider_service($user_id,$service_id);
        }
        //send confirmation email if opted in
         if  (isset($_POST["optin"]) && ($_POST['optin']=="on")){
            $this->sendConfirmation($name, $_POST['email']);
         }
        //add user to ldap
        $this->add_user_ldap($username, 'ResetMe', $fname, $lname, $email);
    
    }    
}// end function
    
function add_user_ldap($username, $password, $firstname, $lastname, $email){

// connect to ldap server
$ldapconn = ldap_connect("localhost") 
or die("Could not connect to LDAP server.");

// use OpenDJ version V3 protocol 
if (ldap_set_option($ldapconn,LDAP_OPT_PROTOCOL_VERSION,3)){
   //echo "<p>Using LDAP v3</p>";
} // end if
else {
   echo "<p>Failed to set version to protocol 3</p>";
} // end else

require('secure/ldap.php');  //store login credentials in an external file not accessible via web

if ($ldapconn) {
    // binding to ldap server
    $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);
    
    // verify binding
   if ($ldapbind) {
      //echo "<p>LDAP bind successful...</p>";
      //create new record
      $ldaprecord['givenName'] = $firstname;
      $ldaprecord['sn'] = $lastname;
      $ldaprecord['cn'] = $username;
      $ldaprecord['objectclass'][0] = "top";
      $ldaprecord['objectclass'][1] = "person";
      $ldaprecord['objectclass'][2] = "inetOrgPerson";
      $ldaprecord['userPassword'] = $password;
      $ldaprecord['mail'] = $email;
      //add new record
      if (ldap_add($ldapconn, "cn=" . $username . 
         ",dc=designstudio1,dc=com", $ldaprecord)){
          $msg = "Thank you <b>" . $firstname . " " .
             $lastname . "</b> for registering on our" . 
                " website.";
          //display thank you message on the website
          echo $msg;
          
      } // end if
      else {
          echo "Error #: " . ldap_errno($ldapconn) . "<br />\n";
          echo "Error: " . ldap_error($ldapconn) . "<br />\n";
          echo("<p>Failed to register you! (add error)</p>");
      }
   } // end if
   else {
      echo("<p>Failed to register you! (bind error)</p>");
   } // end else
   //close ldap connection VERY IMPORTANT
   ldap_close($ldapconn);
} //end if
else {
     echo("<p>Failed to register you! (no ldap server) </p>");
} //end else   
    
    
    
    
}//fu
    
//sends an email after registration
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