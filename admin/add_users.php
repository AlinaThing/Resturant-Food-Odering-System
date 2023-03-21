<!DOCTYPE html>
<html lang = "en">
    <?php
        session_start();
        error_reporting(0);
        include("../connection/connect.php");
        if(empty($_SESSION["adm_id"])){
	        header('location:index.php');
        }
        if(isset($_POST['submit'] )){
            if(empty($_POST['uname']) ||
                empty($_POST['fname'])|| 
                empty($_POST['lname']) ||  
                empty($_POST['email'])||
                empty($_POST['password'])||
                empty($_POST['phone']) ||
                empty($_POST['address'])){
                    $error = '<div class = "error">                        
                        <strong>All fields Required!</strong>
                    </div>';
            }
            else{     
                $check_username= $conn -> query("SELECT username FROM users where username = '".$_POST['uname']."' ");
                $check_email = $conn -> query("SELECT email FROM users where email = '".$_POST['email']."' ");
                if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $error = '<div class = "error">
                                <strong>invalid email!</strong>
                    </div>';
                }
                elseif(strlen($_POST['password']) < 6){
                    $error = '<div class = "error">
                        <strong>Password must be >=6!</strong>
                    </div>';
                }
            
                elseif(strlen($_POST['phone']) < 10){
                    $error = '<div class = "error">
                        <strong>invalid phone!</strong>
                    </div>';
                }
                elseif(mysqli_num_rows($check_username) > 0){
                    $error = '<div class = "error">
                        <strong>Username already exist!</strong>
                    </div>';
                }
                elseif(mysqli_num_rows($check_email) > 0){
                    $error = '<div class = "error">
                        <strong>email already exist!</strong>
                    </div>';
                }
                else{
                    $mql = "INSERT INTO users(username,f_name,l_name,email,phone,password,address) VALUES('".$_POST['uname']."','".$_POST['fname']."','".$_POST['lname']."','".$_POST['email']."','".$_POST['phone']."','".md5($_POST['password'])."','".$_POST['address']."')";
                    $result = $conn -> query($mql);
                    $success = 	'<div class = "success">
                        <strong>Congrass!</strong> New User Added Successfully.</br>
                    </div>';
                
                }
            }

        }

    ?>
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel = "stylesheet" href = "css/style.css">
        <link rel = "stylesheet" href = "css/adduser.css">
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
                <h2> Dashboard </h2><hr>
                <?php 
                    echo $error;
                    echo $success;
                ?>
                <div class = "input">
                    <form action = '' method = 'post' enctype = "multipart/form-data">
                        <table>
                            <thead>
                                <tr>
                                    <th colspan = "7"> Add Users </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> Username </td>
                                    <td> First Name </td>
                                </tr>
                                <tr>
                                    <td> <input type = "text" placeholder = "username" name = "uname"> </td>
                                    <td> <input type = "text" placeholder = "alina" name = "fname"> </td>
                                </tr>
                                <tr>
                                    <td> Last Name </td>
                                    <td> Email </td>
                                </tr>
                                <tr>
                                    <td> <input type = "text" placeholder = "thing" name = "lname"> </td>
                                    <td> <input type = "email" placeholder = "example@gmail.com" name = "email"> </td>
                                </tr>
                                <tr>
                                    <td> Password </td>
                                    <td>  Phone </td>
                                </tr>
                                <tr>
                                    <td> <input type = "password" placeholder = "password" name = "password"> </td>
                                    <td> <input type = "number" placeholder = "phone" name = "phone"> </td>
                                </tr>
                                <tr>
                                    <td> Address </td>
                                </tr>
                            </tbody>
                        </table>
                        <textarea name = "address" type = "text" style = "height:100px; width:350px" ></textarea>
                        <br>
                        <input type = "submit" name = "submit" value = "save">
                        <a href = "dashboard.php" > Cancel </a>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html> 

