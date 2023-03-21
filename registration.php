<!DOCTYPE html>
<html lang = "en">
    <?php
        include("connection/connect.php");
        error_reporting(0);
        session_start();
        
        if(isset($_POST['submit'] )) {
            if(empty($_POST['firstname']) ||  
                empty($_POST['lastname'])|| 
                empty($_POST['email']) ||  
                empty($_POST['phone'])||
                empty($_POST['password'])||
                empty($_POST['cpassword'])){
                    $error = "All fields must be Required!";
            }
            else{
                    //cheching username & email if already present
                $check_username= $conn->query("SELECT username FROM users where username = '".$_POST['username']."' ");
                $check_email = $conn->query("SELECT email FROM users where email = '".$_POST['email']."' "); 
                if($_POST['password'] != $_POST['cpassword']){  //matching passwords
                    $error = "Password not match";
                }
                elseif(strlen($_POST['password']) < 6) {
                    $error = "Password Must be >=6";
                }
                elseif(strlen($_POST['phone']) != 10){
                    $error = "invalid phone number!";
                }
                elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                    $error = "Invalid email address please type a valid email!";
                }//$result->num_rows > 0
                elseif($check_username->num->rows > 0){
                    $error = 'username Already exists!';
                }
                elseif($check_email->num_rows > 0){
                    $error = 'Email Already exists!';
                }
                else{
                    $mql = "INSERT INTO users(username,f_name,l_name,email,phone,password) VALUES('".$_POST['username']."','".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['password']."')";
                    $conn->query($mql);
                    $success = "Account Created successfully! <p>You will be redirected in <span id='counter'>5</span> second(s).</p>
                                <script type='text/javascript'>
                                    function countdown() {
                                        var i = document.getElementById('counter');
                                        if (parseInt(i.innerHTML)<=0) {
                                            location.href = 'registration.php';
                                        }
                                        i.innerHTML = parseInt(i.innerHTML)-1;
                                    }
                                    setInterval(function(){ countdown(); },1000);
                                </script>'";
                    header("refresh:5;url=login.php"); // redireted once inserted success
                }
	        }
        }
    ?>
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <title> Registration </title>
        <link rel = "stylesheet" href = "css/style.css">
        <link rel = "stylesheet" href = "css/log.css">
        <style>
            .container {
                position: absolute;
                right: 0;
                margin: 20px;
                max-width: 600px;
                padding: 1px;
                background-color: whitesmoke;
            }
            p{
                color: red;
                background-color:white;
            }
            fieldset{
                float: right;
                background-color: white;
                padding-right: 245px; 
                align: center;
            }
            @media only screen and (min-width: 1400px) {
                /* For desktop: */
                .navbar {width: 8.33%;}
                .bg-img {width: 16.66%;}    
            }
        </style>
    </head>
    <body>

    <nav class = "navbar">
            <img  class = "logo" src = "images/image.png">
            <ul>
                <li> <a class = "home" href = "index.php"> Home </a></li>
                <li> <a href = "dishes.php"> Menu </a></li>
                <?php 
                    $protocol = $_SERVER['SERVER_PROTOCOL'];
                    if(strpos($protocol,"HTTPS")){
                        $protocol = "HTTPS://";
                    }
                    else{
                        $protocol= "HTTP://";
                    }
                    $redirect_link_var=$protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                    if(empty($_SESSION["user_id"])){
                ?>                            
                            <li><a href = "login.php?page_url=<?php echo $redirect_link_var;?>"> login </a></li>
                            <li> <a href = "registration.php"> signup </a> </li>
                <?php
                    }
                    else{
                        $user = $_SESSION['username'];
                        $today = date('Y-m-d', strtotime("0 days"));
                        $sql = $conn->query("SELECT * FROM notification where username = '$user' AND cast(date as date) = '$today' ORDER BY date DESC");
                        //$row = $sql->fetch_assoc();
                ?>
                            <li><a href="feedback.php">feedback</a> </li>
                            <li> 
                                <a href = "#" class = "dropdown"> 
                                    <i class = "bladge"><img src = "images/notification.png" style = "height: 25px; width: 25px;" alt = "photo"/><sup id = "noti_number"></sup>
                                        <span class = "dropdown-content">
                                            <p>
                                                <table class = "notification">
                                                    <?php
                                                        while($row = $sql->fetch_assoc()){
                                                            echo "<tr>";
                                                            echo "<td>".$row['date']. "</td>";
                                                            echo "</td>";
                                                            echo "</tr>";
                                                            echo "<tr>";
                                                            echo "</td>";
                                                            echo "<td class = 'focus'>".$row['message']."</td>";
                                                            echo "</tr>";
                                                        }
                                                    ?>
                                                </table>
                                            </p>
                                        </span>
                                    </i>
                                </a>
                            </li>
                            <li> <a href = "your_orders.php"> Your Orders </a></li>
                            <li> <a href = "logout.php"> Logout </a></li>
                    <?php
                    }
                ?>    
            </ul>
        </nav>
        <div class = "bg-img">
           <!-- <h1> Registration form </h1>-->
            <span><?php echo $error ?>  </span>
                <form action = "" method = "POST" class = "container">
                    <table>
                        <hr>
                        <tr>
                            <th> <h2> Register your form </h2><hr></th>
                        </tr>
                        <br><tr></tr>
                        <tr>
                            <td> Username: </td>
                        </tr>
                        <tr>
                            <td> <input type = "text" placeholder = "username" name = "username"> </td>
                        </tr>
                        <tr>
                            <td> First Name: </td>
                            <td> Last Name: </td>
                        </tr>
                        <tr>
                            <td> <input type = "text" placeholder = "first name" name = "firstname"> </td>
                            <td> <input type = "text" placeholder = "last name" name = "lastname"> </td>
                        </tr>
                        <tr>
                            <td> Email address </td>
                            <td> Phone Number </td>
                        </tr>
                        <tr>
                            <td> <input type = "email" placeholder = "enter email" name = "email"> </td>
                            <td> <input type = "number" placeholder = "enter phone" name = "phone"> </td>
                        </tr>
                        <tr>
                            <td> Password: </td>
                            <td> Repeat password: </td>
                        </tr>
                        <tr>
                            <td> <input type = "password" placeholder = "password" name = "password"> </td>
                            <td> <input type = "password" placeholder = "repassword" name = "cpassword"> </td>
                        </tr>
                    </table>      
                    <input type="submit" value="Register" name="submit">
                </form>
        </div>
    </body>
</html>