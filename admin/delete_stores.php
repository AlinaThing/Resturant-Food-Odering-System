<?php
include("../connection/connect.php");
error_reporting(0);
session_start();


// sending query
$conn->query("DELETE FROM restaurant WHERE rs_id = '".$_GET['res_del']."'");
header("location : allrestaurant.php");  

?>
