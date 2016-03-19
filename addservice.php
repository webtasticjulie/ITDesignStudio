<?php
include('services.class.php');
$service= new services;
if (isset($_POST["addservice"])){
    $service->add_service($_POST["addservice"]);
}else{
    echo "Please provide a service name.";
}
    
?>