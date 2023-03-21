<?php 
    include('connection/connect.php');
    session_start();
    $user = $_SESSION['username'];
    $today = date('Y-m-d', strtotime("0 days"));
    $sql = "SELECT * FROM notification where username = '$user' AND cast(date as date) = '$today'";
    $result = $conn->query($sql);
    echo $result->num_rows;
    $conn->close();
?>