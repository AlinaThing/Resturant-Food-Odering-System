<!DOCTYPE html>
<html lang = "en">
    <?php
        include("connection/connect.php");
        error_reporting(0);
        session_start();
        if(empty($_SESSION['user_id'])){
            header('location : login.php');
        }
        else{
    ?>
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <title> your's orders </title>
        <link rel = "stylesheet" href = "css/division.css">

        <link rel = "stylesheet" href = "css/style.css">
    </head>
    <body> 
        <nav class = "navbar">
            <img  class = "logo" src = "images/image.png">
            <ul>
                <li> <a class = "home" href = "index.php"> Home </a></li>
                <li> <a href = "dishes.php"> Menu </a></li>
                <?php 
                    if(empty($_SESSION["user_id"])){
                        echo '<li> <a href = "login.php"> login </a></li>
                            <li> <a href = "registration.php"> signup </a> </li>';
                    }
                    else{
                        echo '<li> <a href = "your_orders.php"> Your Orders </a></li>';
                        echo '<li> <a href = "logout.php"> Logout </a></li>';
                    }
                ?>              
            </ul>
        </nav>
        <div class = "transform">
            <fieldset class = "block">
                <table> 
                    <thead> 
                        <tr> 
                            <th> Item </th>
                            <th> Quantity </th>
                            <th> Price </th>
                            <th> Status </th>
                            <th> Date </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php
                            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                            $today = date('y-m-d',strtotime("0 days"));
                            $u_id = $_SESSION['user_id'];
                            $sql = $conn->query("SELECT * FROM users_orders WHERE u_id = '$u_id' AND cast(date as date) = '$today' ORDER BY date DESC");
                            if($sql ->num_rows > 0){
                                while($row = $sql->fetch_assoc()){
                        ?>
                                <tr>
                                    <td> <?php echo $row['title']; ?> </td>
                                    <td> <?php echo $row['quantity']; ?> </td>
                                    <td> <?php echo $row['price']; ?> </td>
                                    <?php
                                        $status=$row['status'];
                                        if($status=="" or $status=="NULL"){
                                    ?>
                                            <td> <button type="button">Dispatch</button></td>
                                    <?php 
                                        }
                                        if($status=="Pending"){
                                    ?>
                                            <td> <button type="button">Pending</button></td>
                                    <?php 
                                        }
                                        if($status=="in process"){ 
                                    ?>
                                            <td> <button type="button">On a Way!</button></td> 
                                    <?php
                                        }
                                        if($status=="closed"){
                                    ?>
                                            <td> <button type="button">Delivered</button></td> 
                                    <?php 
                                        }  
                                    ?>
                                    <td> <?php echo $row['date']; ?> </td>
                                    <td> 
                                        <a href="delete_orders.php?order_del=<?php echo $row['o_id'];?>" onclick="return confirm('Are you sure you want to cancel your order?');">
                                            <img src = "images/delete.png" style = "height : 20px; width : 20px"/>
                                        </a> 
                                    </td>
                                                                
                                </tr>
                                <?php
                                }									
                            }
                            else{
                                echo '<td colspan="6"><center>You have No orders Placed yet. </center></td>';
                            }			 
                        ?>
                    </tbody>
                </table>
            </fieldset>
        </div>
    </body>
</html>

<?php
    }
?>