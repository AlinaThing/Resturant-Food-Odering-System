<?php
include("../connection/connect.php");
error_reporting(0);
session_start();


// sending query
$conn->query("DELETE FROM users WHERE u_id = '".$_GET['user_del']."'");
header("location:allusers.php");  

?>
