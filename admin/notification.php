<!DOCTYPE html>
<html lang = "en">
    <?php
        include("../connection/connect.php");
        session_start();
        error_reporting(0);
        if(empty($_SESSION["adm_id"])){
	        header('location:index.php');
        }
        if(isset($_POST['submit'])){
            if(empty($_POST['username']) || (empty($_POST['message']))){
                echo "All field must be field";
            }
            else{
                $_SESSION['user'] =$username= $_POST['username'];
                $_SESSION['message'] = $_POST['message'];
                $sql = $conn->query("SELECT u_id FROM users where username = '$username'");
                $users = $sql->fetch_assoc();
                $user = $users['u_id'];
                $msg = "INSERT INTO notification(username, message, u_id)
                        VALUES('".$_POST['username']."','".$_POST['message']."','$user')";
                if($conn->query ($msg) === TRUE) {
                }
                else {
                    echo "Error:" . $msg . "<br>" . $conn->error;
                }
                echo "<p>inserted successfully</p>";
            }
        }
    ?>
    <head> 
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link rel = "stylesheet" href = "css/style.css">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href= "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src = "js/hidemenu.js"> </script>
        <style>
            table{
                transform: translate(15%,200%);
            }
            table{
                border-collapse:collapse;
                border: 1px solid black;
            }
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
            p{
                color: green!;
            }
        </style>
        <title> notification </title>
    </head>
    <body>
        <script>
            $(document).ready(function(){
                $('#show').click(function(){
                    $('.menu').toggle("slide");
                });
            });
        </script>
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
                <center>
                    <table> 
                        <form method = "POST">
                        
                            <tr> 
                                <th> 
                                    username:
                                </th> 
                                <td>
                                    <input type = "text" name = "username" placeholder = "enter username">
                                </td>
                            </tr>
                            <tr>
                                <th> 
                                    message:
                                </th> 
                                <td>
                                <input type = "text" name = "message" value = '<?php echo "Your order is ready!"; ?>' >
                                </td>
                            </tr>
                            <tr>    
                                <td> 
                                    <input type = "submit" name = "submit" onclick = "notification()" value = "submit">
                                </td>
                            </tr>
                        </form>
                    </table>
                <center>
            </div>
        </div>
        <script>
            
        </script>
    </body>
</html>