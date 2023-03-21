<!DOCTYPE html>
<html lang = "en">
    <?php
        session_start();
        error_reporting(0);
        if(empty($_SESSION["adm_id"])){
	        header('location:index.php');
        }
        include("../connection/connect.php");
        include_once("product-action.php");
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
            table,td,th{
                background-color: whitesmoke;
                border-collapse: collapse;
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
        </style>
        <script language="javascript" type="text/javascript">
            $(document).ready(function(){
                $('#show').click(function(){
                    $('.menu').toggle("slide");
                });
            });
            var popUpWin=0;
            function popUpWindow(URLStr, left, top, width, height){
                if(popUpWin){
                    if(!popUpWin.closed) popUpWin.close();
                }
                popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
            }
        </script>
        <!-- 
        <style>
            
            ul li{
                float: right;
            }
            span img{
                float: right;
                border-radius: 50%;
                height: 70px;
                width: 70px;
            }
            #demo{
                float: right;
                opacity: 0.5;
            }
        </style> -->
        
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
                <h4> View User Orders </h4>
                <table>
                    <tbody> 
                        <?php 
                            $sql = "SELECT users.*, users_orders.* FROM users INNER JOIN users_orders ON users.u_id = users_orders.u_id WHERE o_id = '".$_GET['user_upd']."'";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                        ?>
                        <tr>
							<td><strong>username:</strong></td>
							<td><center><?php echo $row['username']; ?></center></td>
							<td rowspan=2><center>
							   <a href="javascript:void(0);" onClick="popUpWindow('order_update.php?form_id=<?php echo htmlentities($row['o_id']);?>');" title="Update order">
									 <button type="button" class="btn btn-primary">Take Action</button>
                                </a></center>
						    </td>
						</tr>	
						<tr>
							<td><strong>Title:</strong></td>
							<td><center><?php echo $row['title']; ?></center></td>
						</tr>	
						<tr>
							<td><strong>Quantity:</strong></td>
							<td><center><?php echo $row['quantity']; ?></center></td>
						</tr>
						<tr>
							<td><strong>Price:</strong></td>
						    <td><center>Rs<?php echo $row['price']; ?></center></td>
                            <td rowspan=2 colspan=2><center>
								<a href="javascript:void(0);" onclick="popUpWindow('userprofile.php?newform_id=<?php echo htmlentities($row['o_id']);?>');" title="Update order">
								    <button type="button" class="btn btn-primary">View User Detials</button></a>
								</center>
                            </td>
						</tr>
						<tr>
							<td><strong>Date:</strong></td>
							<td><center><?php echo $row['date']; ?></center></td>
						</tr>
						<tr>
							<td><strong>status:</strong>
                            </td>
                            <?php 
                                $status=$row['status'];
                                if($status=="" or $status=="NULL"){
                            ?>
                            <td> <center><button>Pending</button></center></td>
                            <?php 
                                }
                                if($status=="in process"){ 
                            ?>
                                <td>   <center><button>On a Way!</button></center></td> 
                            <?php
                                }
                                if($status=="closed"){
                            ?>
                                    <td>  <center><button>Delivered</button></center></td> 
                                } 
                            <?php
                                if($status=="rejected"){
                            ?>
                                <td>  <center><button>cancelled</button> </center></td> 
                            <?php 
                                } 
                            ?>			   																							
						</tr>
                    </tbody>
                </table>
            </div> 
        </div> 
    </body> 
</html>
<?php } ?>