<!DOCTYPE html>
<html lang = "en">
    <?php
        include("../connection/connect.php");
        error_reporting(0);
        session_start();
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
                <h4> All Menu Data </h4>
                <div class = "display">
                    <table>
                        <thead>
                            <tr>
                                <th> SN </th>
                                <th> Dish Name </th>
                                <th> Slogan </th>
                                <th> Price </th>
                                <th> Quantity </th>
                                <th> Image </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php 
                                $sql = "SELECT * FROM dishes ORDER BY d_id desc";
                                $result = $conn -> query($sql);
                                if($result ->num_rows > 0){
                                    $i = 1;
                                    while($row = $result -> fetch_assoc()){
                                        echo '<tr><td>'. $i .'</td>
                                            <td>'.$row['title'].'</td>
                                            <td>'. $row['slogan'].'</td>
                                            <td>Rs'. $row['price'].'</td>
                                            <td>'. $row['total_quantity'].'</td>
                                            <td> 
                                                <div> 
                                                    <center><img src = "../images/dishes/'.$row['img'].'" style = "max-height: 100px; max-width: 150px;"/></center> 
                                                </div>
                                            </td>
                                            <td><a href="delete_menu.php?menu_del='.$row['d_id'].'"><img src = "../images/delete.png" style = "height: 20px; width: 20px;"></a>
                                                <a href = "update_menu.php?menu_upd='.$row['d_id'].'"><img src = "../images/setting.png" style = "height: 20px; width: 20px;"></a>
                                            </td>';
                                        echo '</tr>';
                                        $i++;
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

