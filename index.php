<!DOCTYPE html>
<html lang = "en">
    <?php 
        include("connection/connect.php");
        error_reporting(0);
        session_start();
    ?>
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <title> website </title>
        <link rel = "stylesheet" href = "css/style.css">
        <link rel="stylesheet" href= "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
        
        </style>
    </head>
    <body>
        <div class = "wrapper">
            <nav class = "navbar">
                <img  class = "logo" src = "images/image.png">
                <ul>
                    <li> <a class = "home" href = "index.php"> Home </a></li>
                    <li> <a href = "dishes.php"> Menu </a></li>
                    <?php
						if(empty($_SESSION["user_id"])){
							echo '<li><a href="login.php">login</a> </li>
							    <li><a href="registration.php">signup</a> </li>';
						}
						else{									
							echo  '<li><a href="your_orders.php">your orders</a> </li>';
							echo  '<li><a href="logout.php">logout</a> </li>';
						}
                    ?>
                </ul>
            </nav>
        </div>
    </body>
</html>