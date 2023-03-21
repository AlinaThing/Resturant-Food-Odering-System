<!DOCTYPE html>
<html lang = "en">
    <?php
        include("../connection/connect.php");
        error_reporting(0);
        session_start();
        if(empty($_SESSION["adm_id"])){
	        header('location:index.php');
        }
        if(isset($_POST['submit'])){//if upload btn is pressed		
            if(empty($_POST['dish_name'])||empty($_POST['about'])||$_POST['price']==''||$_POST['c_category']==''||$_POST['quantity']==''){	
                $error = '<div class="error">
                        <strong>All fields Must be Fillup!</strong>
                </div>';						
            }
            else{
                $fname = $_FILES['file']['name'];
                $temp = $_FILES['file']['tmp_name'];
                $fsize = $_FILES['file']['size'];
                $extension = explode('.',$fname);
                $extension = strtolower(end($extension));  
                $fnew = uniqid().'.'.$extension;
                $store = "..images/dishes".$filename;                      // the path to store the upload image
                if($extension == 'jpg'||$extension == 'png'||$extension == 'jpeg' ){        
                    if($fsize>=1000000){
                        $error = '<div class="error">
                            <strong>Max Image Size is 1024kb!</strong> Try different Image.
                        </div>';
                    }
                    else{
                        $sql = "INSERT INTO dishes(title,c_category,slogan,price,total_quantity,img) VALUE('".$_POST['dish_name']."','".$_POST['c_category']."','".$_POST['about']."','".$_POST['price']."','".$_POST['quantity']."','".$fname."')";  // store the submited data into the database :images
                        $conn->query($sql); 
                        move_uploaded_file($temp, $store);
                        $success = 	'<div class="success">
                            <strong>Congrass!</strong> New Dish Added Successfully.
                        </div>';
                    }
                }
                elseif($extension == ''){
                    $error = '<div class="error">
                            <strong>select image</strong>
                        </div>';
                }
                else{
                    $error = '<div class="error">
                        <strong>invalid extension!</strong>png, jpg, Gif are accepted.
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
                    echo $success;
                    echo $error;
                ?>
                <h3> Add Menu to Restaurant </h3>
                <form action = '' method = 'post' enctype = "multipart/form-data">
                    <table> 
                        <tr> 
                            <td> Dish Name </td>
                            <td> About </td>
                        </tr>
                        <tr> 
                            <td> <input type = "text" name = "dish_name" placeholder = "Burger House"> </td>
                            <td> <input type = "text" name = "about" placeholder = "slogan"> </td>
                        </tr>
                        
                        <tr> 
                            <td> Price </td>
                            <td> Images </td>
                        </tr>
                        <tr> 
                            <td> <input type="text" name="price" placeholder="Rs"> </td>
                            <td> <input type = "file" name = "file" id = "lastName" placeholder = "12n"> </td>
                        </tr>
                        <tr> 
                            <td> Enter the quantity </td>
                            <td> Select Categories </td>
                        </tr>
                        <tr> 
                            <td> <input type = "number" name = "quantity" min = "1" placeholder = "1"></td>
                            <td>  
                                <select name = "c_category"> 
                                    <option> -- Select Category -- </option>
                                    <?php 
                                        $sql = "SELECT * FROM res_category";
                                        $cat = $conn->query($sql);
                                        while($row = $cat->fetch_assoc()){
                                            echo '<option value = "'.$row['c_name'].'">'. $row['c_name']. '</option>';
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <input type = "submit" name = "submit" value = "save">
                    <a href = "dashboard.php"> Cancel </a>
                </form>
            </div>
        </div>
    </body>
</html> 

