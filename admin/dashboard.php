<!DOCTYPE html>
<html lang = "en">
    <?php
        session_start();
        error_reporting(0);
        include("../connection/connect.php");
        if(empty($_SESSION["adm_id"])){
	        header('location:index.php');
        }
    ?>
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link rel = "stylesheet" href = "css/style.css">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href= "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <img  class = "logo" src = "../images/image.png" alt = "photo">
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
                <button id="menu5"> Users </button><br>
                <div class="menu5" style="display: none;">
                    <ol>
                        <li><a href = "all_orders.php"> All Orders </a></li>
                    </ol>
                </div>
            </div>

            <div>
                <h2> dashboard </h2><hr>
                <div class = "store">
                    <div> 
                        <span> <i class = "fa fa-cutlery f-s-40" aria-hidden = "true"> </i> </span>
                        <h3><?php 
                                $today = date('y-m-d',strtotime("0 days"));
                                $result = $conn -> query("SELECT DISTINCT title as counted FROM users_orders WHERE cast(date as date) = '$today'");
                                $rws = $result->num_rows;
                                echo $rws;
                            ?>
                        </h3>
                        <p> Dishes </p>
                    </div>
                    
                    <div> 
                        <span> <i class = "fa fa-user f-s-40 color-danger"> </i> </span>
                        <h3><?php 
                                $result = $conn -> query("SELECT DISTINCT u_id as counted FROM users_orders WHERE cast(date as date) = '$today'");
                                $rws = $result->num_rows;
                                echo $rws;
                            ?>
                        </h3>
                        <p> Customers </p>
                    </div>
                    <div> 
                        <span> <i class = "fa fa-shopping-cart f-s-40" aria-hidden = "true"> </i> </span>
                        <h3><?php 
                                $result = $conn -> query("SELECT DISTINCT o_id as counted FROM users_orders WHERE cast(date as date) = '$today'");
                                $rws = $result->num_rows;
                                echo $rws;
                            ?>
                        </h3>
                        <p> Orders </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html> 
