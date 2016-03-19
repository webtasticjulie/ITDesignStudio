<!DOCTYPE html>

<html>
<head>
  <title>Registration</title>
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
       $('#servicesnotlisted').click(function() {
        if (!$(this).is(':checked')) {
            return confirm("Are you sure?");
        }
    
      }    
</script>
</head>

<body>
  <?php include('header.php');?>
  

  <div id="maincontent">
      <div id="titlebar">
    <h3>Registration</h3>
    <hr>
  </div>
  <?php 
      if ($_POST){
     
      require_once ('services.class.php');
      $service = new services();
      $service->add_provider();
      
   }else{
   ?>
    <script type="text/javascript" src="js/validate.js">

    </script> <!-- Form starts -->
   <!-- onsubmit="return ValidateForm()" -->  
      
    <form name="registration_form"  id="registration_form" action="<?php $_SERVER['PHP_SELF'];?>" method="POST" id="registration_form" data-transition="slide" onsubmit="return ValidateForm()">
      <fieldset>
       

        <table style="width: 50%; margin-left: auto; margin-right: auto;">
          <tr>
            <td><label for="fname">First Name</label></td>

            <td><input name="fname" id="fname" size="30" placeholder="First Name" required></td>
          </tr>

          <tr>
            <td><label for="lname">Last Name</label></td>

            <td><input name="lname" id="lname" size="30" placeholder="Last Name" required></td>
          </tr>

          <tr>
            <td><label for="email">E-mail</label></td>

            <td><input name="email" id="email" placeholder="Email" size="30" required></td>
          </tr>

          <tr>
            <td><label for="ksuid">KSU ID</label></td>

            <td><input name="name" id="ksuid" size="30" placeholder="KSU ID"></td>
          </tr>

          <tr>
            <td>Services</td>

            <td> <?php require_once ('services.class.php');
                    $service = new services();
                    $service->get_services_checkbox();
                 ?>
                
                
                <div id="addservicediv" style="visibility: hidden;">
                    Add service not listed:<input type="text" name="addservice"/>
                </div>
               </td>
          </tr>

          <tr>
            <td><label for="availability">Availability</label></td>

            <td><input type="text" id="availability" name="availability" placeholder="Weekends" required/></td>
          </tr>

          <tr>
            <td><label for="optin">Would you like to receive email
            notifications?</label></td>

            <td><input type="checkbox" name="optin" id="optin"></td>
          </tr>

          <tr>
            <td></td>

            <td><input type="submit" name="Submit" value="Submit"></td>
          </tr>
        </table>
      </fieldset>
    </form><!-- Form ends -->
      <?php } ?>
  </div>
</body>
</html>
