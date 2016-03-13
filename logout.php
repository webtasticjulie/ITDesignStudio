<?php
session_start('tasks');
session_destroy();
unset($_SESSION);
header("location: index.php");
?>