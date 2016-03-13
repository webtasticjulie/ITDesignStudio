<?php session_start('tasks');?>
<html>
  <head>
    <title>LDAP Test</title>
  </head>
  <body>
    <?php
if (!isset($_POST)){
    echo "Please supply a username and password.";
}else{
echo "<h2>Andrea Julie Beck ".date('m-d-y')."</h2>";
// connect to ldap server
$ldapconn = ldap_connect("localhost") 
    or die("Could not connect to LDAP server.");

// use ldap version V3 protocol  
if (ldap_set_option($ldapconn,LDAP_OPT_PROTOCOL_VERSION,3))
{
    echo "<br/>Using LDAP v3";
}else{
    echo "<br/>Failed to set version to protocol 3";
}

// using ldap bind
//$ldaprdn  = "cn=manager,dc=designstudio1,dc=com"; 
if (isset($_POST["username"])){
    $ldaprdn = "cn=".$_POST['username'].",dc=designstudio1,dc=com";
}else{
    echo "<br/>Please supply a username";
    exit;
}
//$ldappass = "my*password";  // associated password
if ($_POST['password']){
    $ldappass = $_POST['password'];
}else{
    echo "<br/>Please supply a password";
    exit;
}

if ($ldapconn) {

    // binding to ldap server
    $ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass);

    // verify binding
    if ($ldapbind) {
        echo "<br/>".$_POST['username'].", Welcome Back!";
        $_SESSION['username']=$_POST['username'];
        $_SESSION['loggedin']="login";
        header("location: index.php");
    } else {
        
        echo "<br/>Authentication Failed";
        $_SESSION['loggedin']="logout";
    }
}
    
}
?>
  </body>
</html>
