<!DOCTYPE html>
<html>
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
                $check_cat= $conn->query("SELECT c_name FROM res_category where c_name = '".$_POST['c_name']."' ");
                if(mysqli_num_rows($check_cat) > 0){
                    $error = '<div class="error">
                        <strong>Category already exist!</strong>
                    </div>';
                }
                else{
                    $mql = $conn->query("INSERT INTO res_category(c_name) VALUES('".$_POST['c_name']."')");
                    $success = 	'<div class="success">
                        <strong>Congrass!</strong> New Category Added Successfully.</br>
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
                <h4> Add Restaurant Category </h4>
                <div class = "display">
                    <form action = '' method = 'post'> 
                        <label> Category </label>
                        <input type = "text" name = "c_name" placeholder = "category_name"><br>
                        <input type = "submit" name = "submit" value = "save">
                        <a href = "dashboard.php" > Cancel </a>
                        <h4> Listed Categories </h4>
                        <table>
                            <thead> 
                                <tr> 
                                    <th> ID </th>
                                    <th> Category Name </th>
                                    <th> Date </th>
                                    <th> Action </th> 
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                    $sql = "SELECT * FROM res_category ORDER BY c_id ASC";
                                    $result = $conn->query($sql);
                                    if($result ->num_rows > 0){
                                        while($rows = $result -> fetch_assoc()){
                                            echo '<tr><td>'. $rows['c_id']. '</td>
                                            <td>' . $rows['c_name'].'</td>
                                            <td>' . $rows['date'].'</td>
                                            <td><a href="delete_category.php?cat_del='.$rows['c_id'].'"><img src = "../images/delete.png" style = "height:20px; width : 20px"></a> 
                                            <a href="update_category.php?cat_upd='.$rows['c_id'].'" "><img src = "../images/setting.png" style = "height:20px; width : 20px" ></a>
                                            </td></tr>'; 
                                        }
                                    }
                                    else{
                                        echo '<td colspan ="7"><center> No Categories-Data! </center></td>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html> 

