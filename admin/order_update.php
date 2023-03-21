<!DOCTYPE html>
<html lang = "en">
    <?php
        session_start();
        include("../connection/connect.php");
        if(empty($_SESSION["adm_id"])){
	        header('location:index.php');
        }
        if(isset($_POST['update'])){
            $form_id=$_GET['form_id'];
            $status=$_POST['status'];
            $remark=$_POST['remark'];
            $query=$conn->query("insert into remark(frm_id,status,remark) values('$form_id','$status','$remark')");
            if($conn->query($query) === true){}
            $sql=$conn->query("update users_orders set status='$status' where o_id='$form_id'");
            if($conn->query($sql) === true){}
            echo "<script>alert('form details updated successfully');</script>"; 
        }
    ?>
    <head>
    <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel = "stylesheet" href = "css/style.css">
        <script src = "js/hidemenu.js"> </script>
        <title> website </title>
        <style>
            table,td,th{
                padding-right: 10px;
                margin-right: 20px;
            }
            td:nth-child(even){
                float:right;
            }
            strong{
                color: blue;
            }
        </style>
        <script>
            function f2(){
                window.close();
            }
            function f3(){
                window.print();
            }
        </script>
    </head>
    <body>
        <nav class = "navbar">
            <img  class = "logo" src = "../images/image.png">
            <!-- <div id="show"><span><img src = "../images/login.jpg" alt = "photo" id = "show"></span></div>
                <div class="menu" style="display: none;">
                    <ol>
                        <li class = "demo"><a href = "logout.php">Logout</a></li>
                    </ol>
                </div>
            </div> -->
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
                <table>
                    <form method = "post">
                    <tr>
                        <td>
                            <b> Form Number </b>
                        </td>
                        <td>
                            <strong><?php echo htmlentities($_GET['form_id']);?></strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            &nbsp; 
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b> Status </b>
                        </td>
                        <td>
                            <select name = "status" required="required">
                                <option value = ""> Select Status </option>
                                <option value = "pending"> Pending </option>
                                <option value = "in process"> In process </option>
                                <option value = "closed"> Closed </option>
                                <option value = "rejected"> rejected </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b> Remark </b>
                        </td>
                        <td>
                            <textarea name = "remark" cols = "50" rows = "10" required="required"> </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b> Action </b>
                        </td>
                        <td>
                            <input type = "submit" name = "update" value = "Submit">
                            <input type = "Submit2" type = "submit" value = "Close current window" onclick = "return f2();"style = "cursor:pointer;"/>
                        </td>
                    </tr>
                    </form>
                </table>
            </div>
        </div>
    </body>
</html> 

