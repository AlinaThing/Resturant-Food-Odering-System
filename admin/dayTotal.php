<?php
    include("../connection/connect.php");
    session_start();
    error_reporting(0);

    $today = date('Y-m-d');
            $sql = $conn->query("SELECT * FROM users_order WHERE date = '$date'");
            echo $sql;
?>
<!DOCTYPE html>
<html lang = "en">

    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <title> DAY TOTAL </title>
        <style>
            table,th,td{
                border-collapse: collapse;
                border: 1px solid black;
                padding: 20px;
                margin: 20px;
            }
            strong{
                display: center;
            }
        </style>
    </head>
    <body>
    <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link rel = "stylesheet" href = "css/style.css">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href= "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src = "js/hidemenu.js"> </script>
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
                <table>
                    <tr> 
                        <th colspan = "9"> Grand Total Income </th>
                    </tr>
                    <tr> 
                        <th> SN </th>
                        <th> Username </th>
                        <th> Order </th>
                        <th> Dish Name </th>
                        <th> Dish Images </th>
                        <th> Quantity </th>
                        <th> Price </th>
                        <th> Date </th>
                        <th> Total</th>
                    </tr>
                    <?php               
                        $today = date('y-m-d',strtotime("0 days"));
                        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                        //$status = "paid";
                        $sql = $conn->query("SELECT * FROM users_orders WHERE cast(date as date) = '$today' /* AND payment_status = '$status' */ ORDER BY date DESC");
                        if($sql ->num_rows > 0){
                            $i = 1;
                            $total = 0;
                            $row = $sql->fetch_assoc();
                            while($row = $sql -> fetch_assoc()){
                                $checks = $conn->query("SELECT img FROM dishes WHERE title = '$row[title]'");
                                $roww= $checks->fetch_assoc();
                                $check = $conn->query("SELECT username FROM users WHERE u_id = '$row[u_id]'");
                                $rows = $check->fetch_assoc();
                                $total += $row['quantity']*$row['price'];
                    ?>
                                <tr>    
                                    <td> <?php echo $i; ?> </td>
                                    <td> <?php echo $rows['username']; ?> </td>
                                    <td> <?php echo $row['o_id']; ?> </td>
                                    <td> <?php echo $row['title']; ?> </td>
                                    <td> 
                                        <?php echo '<img src="../images/dishes/'.$roww['img'].'" alt="Food logo" style = "width:100px; height:100px;">'?> 
                                    </td>
                                    <td> <?php echo $row['quantity']; ?> </td>
                                    <td> <?php echo $row['price']; ?> </td>
                                    <td> <?php echo $row['date']; ?> </td>
                                    <td> <?php echo $row['quantity']*$row['price']; ?></td>
                                </tr>
                    <?php
                                $i++;
                            }
                    ?>
                                <tr>
                                    <td colspan = "6"><strong> Total </strong></td>
                                    <td colspan = 3 float= "rigth"> <?php echo $total; ?></td>
                                </tr>
                    <?php
                        }
                        else{
                            echo '<td colspan = "8"> <center> No User-Data! </center></td>';
                        }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>