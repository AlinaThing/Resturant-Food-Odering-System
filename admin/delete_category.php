<?php
include("../connection/connect.php");
error_reporting(0);
session_start();


// sending query
$conn->query("DELETE FROM res_category WHERE c_id = '".$_GET['cat_del']."'");
header("location:add_category.php");  

?>
