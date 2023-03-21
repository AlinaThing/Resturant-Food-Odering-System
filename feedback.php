<?php
    session_start();
    error_reporting(0);
   include('connection/connect.php');
   if(isset($_POST['submit'] )){
        if(empty($_POST['userid']) || empty($_POST['feedback'])){
            echo '<div class="error">
                <strong>All fields Required!</strong>
            </div>';
        }
        else{
            $sql = $conn->query("SELECT username from users where u_id = '".$_POST['userid']."'");
            while($row=fetch_assoc($sql)){
                $user = $row['username'];
                echo $user;
            }
            $conn->query("INSERT INTO feedback(u_id, username, feedback) VALUES('".$_POST['userid']."',$user, '".$_POST['feedback']."')");
            echo '<div class="success">
                            <strong>Congrass!</strong> New feedback Added Successfully.</br>
                </div>';
        }
   }

?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <title> Feedback </title>
        <link rel = "stylesheet" href = "css/style.css">
        <style>
            form{
                width: 50%;
                height: 50%;
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
                    
                    
                    $user = $_SESSION['username'];
                    $today = date('Y-m-d', strtotime("0 days"));
                    $sql = $conn->query("SELECT * FROM notification where username = '$user' AND cast(date as date) = '$today' ORDER BY date DESC");
                    //$row = $sql->fetch_assoc();
                ?>
                    <li><a href="feedback.php">feedback</a> </li>
                    
                    <li> <a href = "your_orders.php"> Your Orders </a></li>
                    <li> <a href = "logout.php"> Logout </a></li>
                   
            </ul>
        </nav>
        <center>
            <div><br><br><br><br><br><br>
                <form method = "POST" class = "form">
                    <fieldset class = "block">
                        <h2> feedback: </h2>                       
                        User name: <input type = "text" name = "hidden_id" readonly value = '<?php echo $_SESSION["username"]; ?>''><br>
                        Feedback: <input type = "text" name = "feedback" value = '<?php echo "food is awesome!"; ?>' ><br>
                        <input type = "submit" value = "submit" name = "submit">
                    </fieldset>
                </form>
            </div>
        </center>
        <script>
            function loadDoc() {
                setInterval(() => {
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("noti_number").innerHTML = this.responseText;
                        }
                    };
                    xhttp.open("GET", "notify.php", true);
                    xhttp.send();
                }, 1000);
            }
        </script>
    </body>
</html>
