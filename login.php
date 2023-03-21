 <!DOCTYPE html>
 <html lang = "en">

  <head>
      <link rel = "stylesheet" href = "css/log.css">
      <link rel = "stylesheet" href = "css/message.css">
      <link rel = "stylesheet" href = "css/style.css">
      <style> 
          #buttn{
            color:#fff;
            background-color: #ff3300;
          }
          span{
            background-color: white;
            color: red;
          }
	  </style>
  </head>
    <title> user login form </title>
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
      <?php
            include("connection/connect.php"); //INCLUDE CONNECTION
            error_reporting(0); // hide undefine index errors
            session_start(); // temp sessions
            if(isset($_POST['submit'])){
                $username = mysqli_real_escape_string($conn,$_POST['username']);  //fetch records from login form
                $password = mysqli_real_escape_string($conn,$_POST['password']);
                if(!empty($_POST["submit"])){
                    $login ="SELECT * FROM users WHERE username='$username' && password='$password'"; //selecting matching records
                    $result=$conn->query($login); //executing
                    $row=$result->fetch_assoc();
                    if(is_array($row)){
                      $_SESSION["user_id"] = $row['u_id']; // put user id into temp session
                      $_SESSION["username"] = $row['username'];
                      $redirect_link=$_REQUEST['page_url'];
                      echo $redirect_link;
                      if($redirect_link==""){
                        header("location: index.php"); // redirect to index.php page
                      }
                      else{
                        header("location: ".$redirect_link); // redirect to index.php page
                      }
                        //$_SESSION['auth'] = 'true';
                    } 
                    else{
                        $error = "Invalid Username or Password!"; // throw error
                    }
                }                
            } 
        ?>
       
        <div class = "bg-img"> 
              <form action = "" method = 'post' class = "container">
                <h1> form login </h1>
                <span><?php echo $error; ?> </span>
                <p> Username: <span>* </span> </p>
                <input type = "text" name = "username"><br>
                <p> Password: <span> * </span></p>
                <input type = "password" name = "password">
                <br><br>
                <input type = "submit" name = "submit" id = "buttn" value = "login"><br>
                <span> Not registered?  </span>
                <button><a href = "registration.php" style = "color:#f30"> Register </a></button>
              </form>  
        </div>
  </body>
 </html>
