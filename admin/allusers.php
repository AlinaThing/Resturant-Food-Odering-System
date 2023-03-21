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
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel = "stylesheet" href = "css/style.css">
        <link rel = "stylesheet" href = "css/alluser.css">
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
                <h3><center> All Registered Users </center></h3>
                <div class = "display">
                    <table>
                        <thead>
                            <tr>
                                <th> Username </th>
                                <th> FirstName </th>
                                <th> LastName</th>
                                <th> Email </th>
                                <th> Phone </th>
                                <th> RegisteredDate </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $sql = "SELECT * FROM users ORDER BY u_id DESC";
                                $result = $conn -> query($sql);
                                if($result ->num_rows > 0){
                                    while($row = $result -> fetch_assoc()){
                                        echo '<tr><td>'. $row['username'].'</td>
                                            <td>'. $row['f_name'].'</td>
                                            <td>'. $row['l_name'].'</td>
                                            <td>'. $row['email'].'</td>
                                            <td>'. $row['phone'].'</td>
                                            <td>'. $row['date'].'</td>
                                            <td><a href="delete_users.php?user_del='.$row['u_id'].'"><img src = "../images/delete.png" style = "height: 20px; width: 20px"></a> 
                                                <a href="update_users.php?user_upd='.$row['u_id'].'"><img src = "../images/setting.png" style = "height: 20px; width : 20px"></a>
                                            </td>
                                        </tr>';
                                    }
                                }
                                else{
                                    echo '<td colspan = "7"> <center> No User-Data! </center></td>';
                                }   
                                                             
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html> 

