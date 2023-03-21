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
                <h4> All Menu Data </h4>
                <div class = "display">
                    <table id = "mytable">
                        <thead>
                            <tr>
                                <th> Username </th>
                                <th> Title </th>
                                <th> Quantity </th>
                                <th> Price </th>
                                <th> Status </th>
                                <th> Reg date </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                                $today = date('y-m-d', strtotime("0 days"));
                                $status = "Pending";
								$sql="SELECT users.*, users_orders.* FROM users INNER JOIN users_orders ON users.u_id=users_orders.u_id 
                                        WHERE cast(cast(users_orders.date as date) as date) = '$today' /* AND users_orders.status = 'Pending' */ 
                                        ORDER BY users_orders.date DESC";
								$result = $conn->query($sql);
								if($result->num_rows > 0 ){
								    while($rows=$result->fetch_assoc()){
                                        $d_id = $rows['d_id'];
                                        $sqls = $conn->query("SELECT img FROM dishes WHERE d_id = '$d_id'");
                                        $resultt = $sqls->fetch_assoc();
                                        //echo '<img src="../images/dishes/'.$resultt['img'].'" alt="Food logo" style = "width:100px; height:100px;">'; 
										?>
										<?php
											echo ' <tr>
											<td>'.$rows['username'].'</td>
											<td>'.$rows['title'].'</td>
											<td>'.$rows['quantity'].'</td>
											<td>Rs'.$rows['price'].'</td>';
											$status=$rows['status'];
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
											if($status=="rejected"){
										?>
											<td> <button type="button">cancelled</button></td> 
										<?php 
											} 																									
											echo '	<td>'.$rows['date'].'</td>';
										?>
											<td>
												<a href="delete_orders.php?order_del=<?php echo $rows['o_id'];?>" onclick="return confirm('Are you sure?');"> <img src = "../images/delete.png" style = "height: 20px; width: 20px;"></a> 
										<?php
											echo '<a href="view_order.php?user_upd='.$rows['o_id'].'" "><img src = "../images/setting.png" style = "height: 20px; width: 20px;"></i></a>
											</td>
											</tr>';
																					 
									}		
								}
                                else{				
                                    echo '<td colspan="8"><center>No Orders-Data!</center></td>';
                                }
							?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html> 