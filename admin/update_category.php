<!DOCTYPE html>
<html lang = "en">
    <?php
        include("../connection/connect.php");
        error_reporting(0);
        session_start();
        if(empty($_SESSION["adm_id"])){
	        header('location:index.php');
        }
        if(isset($_POST['submit'] )){
            if(empty($_POST['c_name'])){
			    $error = '<div class="error">
					<strong>field Required!</strong>
				</div>';
		    }
            else{
                $sql = "UPDATE res_category set c_name ='$_POST[c_name]' where c_id='$_GET[cat_upd]'";
                $conn->query($sql);
                $success = 	'<div class="success">
                    <strong>Updated!</strong> Successfully.</br>
                </div>';
            }
        }
    ?>
    <head>
    <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel = "stylesheet" href = "css/style.css">
        <link rel = "stylesheet" href = "css/adduser.css">
        <link rel = "stylesheet" href = "css/nav.css">
        <script src = "js/hidemenu.js"> </script>
        <title> website </title>
        <style>
            span img{
                float: right;
                border-radius: 50%;
                height: 70px;
                width: 70px;
            }
            .demo{
                float: right;
                bottom: 400px;
            } 
        </style>
        <script>
            $(document).ready(function(){
                $('#show').click(function(){
                    $('.menu').toggle("slide");
                });
            });
        </script>
    </head>
    <body>
        <nav class = "navbar">
            <img  class = "logo" src = "../images/image.png">
            <div id="show"><span><img src = "../images/login.jpg" alt = "photo" id = "show"></span></div>
                <div class="menu" style="display: none;">
                    <ol>
                        <li class = "demo"><a href = "logout.php">Logout</a></li>
                    </ol>
                </div>
            </div>
        </nav>
        <div class = "grid-container">
           <div>
                <h2> Home </h2>
                <hr>
                <button id="menu1">Dashboard</button><br>
                <div class="menu1" style="display: none;">
                    <ol>
                        <li><a href = "dashboard.php"> Dashboard </a></li>
                    </ol>
                </div>
                <button id="menu2"> Log </button><br>
                <div class="menu2" style="display: none;">
                    <ol>
                        <li><a href = "allusers.php"> All Users </a></li>
                        <li><a href = "add_users.php"> Add Users </a></li>
                    </ol>
                </div>
                <button id="menu3"> Store </button><br>
                <div class="menu3" style="display: none;">
                    <ol>
                        <li><a href = "add_category.php"> Add Categories </a></li>
                        <li><a href = "notification.php"> Notification </a></li>
                        <li><a href = "dayTotal.php"> Total </a></li>
                    </ol>
                </div>
                <button id="menu4"> Menus </button><br>
                <div class="menu4" style="display: none;">
                    <ol>
                        <li><a href = "all_menu.php"> All Menus </a></li>
                        <li><a href = "add_menu.php"> Add Menus </a></li>
                    </ol>
                </div>
                <button id="menu5"> Users </button>
                <div class="menu5" style="display: none;">
                    <ol>
                        <li><a href = "all_orders.php"> All Orders </a></li>
                    </ol>
                </div>
            </div>
            <div>
                <h2> Dashboard </h2>
                <div class = "bodynav">
                    <ul>
                        <li> Home </li> &gt;
                        <li> Dashboard </li>
                    </ul>
                </div>
                <?php echo $error;
                    echo $success;
                ?>
                <h4> Update Restaurant Category </h4>
                <form action = '' method = 'post'>
                    <?php 
                        $sql = "SELECT * FROM res_category WHERE c_id = '$_GET[cat_upd]'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                    ?>
                    <label> Category </label>
                    <input type = "text" name = "c_name" value = "<?php echo $row['c_name'];?>" placeholder = "category name">
                    <input type = "submit" name = "submit" value = "save">
                    <a href = "dashboard.php"> Back </a>
            </div>
        </div>
    </body>
</html> 

