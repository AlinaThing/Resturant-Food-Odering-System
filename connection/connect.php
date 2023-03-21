

<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "online_order";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if(!$dbname){
    die("Connection failed: ". mysqli_connect_error());
  }
?>