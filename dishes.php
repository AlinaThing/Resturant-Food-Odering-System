<!DOCTYPE html>
<html lang = "en">
    <?php
        include("connection/connect.php");
        error_reporting(0);
        session_start(); 
        
        include('cartPhp.php');

    ?>
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <meta http-equiv="refresh" content="10" />
        <title> website </title>
        <link rel = "stylesheet" href = "css/style.css">
        <link rel = "stylesheet" href = "css/division.css">
        <link rel = "stylesheet" href = "css/dishes.css">
        <link rel = "stylesheet" href = "css/message.css">
        <script type = "text/javascript" src = "script/dishes.js"></script>
        <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <style>
            select{
                margin-top: 20px;
                padding-top: 10px;
                margin-left: 10px;
            }
            select:hover{
                background-color: aqua;
            }
            span{
                font-family:1px solid black;
            }
            table {
                border-spacing: 0;
                width: 100%;
                transform: translate(25%,25%);
            }

            th, td {
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even){
                background-color: #f2f2f2;
                border-collapse: collapse;
                border: 1px solid black;
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
                        $sqls = "SELECT * FROM notification where username = '$user' AND cast(date as date) = '$today' ORDER BY date DESC";
                        $result = $conn->query($sqls);                        
                ?>
                            <li><a href="feedback.php">feedback</a> </li>
                            <li> 
                                <div id="show"><span><img src = "images/notification.png" style = "height: 25px; width: 25px;" alt = "photo"/></span></div>
                                    <div class="menu" style="display: none;">
                                        <table class = "notification">
                                            <?php
                                                while($row = $result->fetch_assoc()){
                                                    echo "<tr>";
                                                    echo "<th>".$row['date'];
                                                    echo "<br>";
                                                    echo "</th>";
                                                    echo "<td class = 'focus'>".$row['message']."</td>";
                                                    echo "</tr>";
                                                }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </li>
                            <li> <a href = "your_orders.php"> Your Orders </a></li>
                            <li> <a href = "logout.php"> Logout </a></li>
                    <?php
                    }
                ?>    
            </ul>
        </nav>
        <br><br>
        <nav class="nav">
            <select id = "momo" onchange = "selectMomo()">
                    <option>---Momo---</option>
                <?php $sql = $conn->query("SELECT * FROM dishes WHERE c_category = 'momo'");
                    while($rows = $sql->fetch_assoc()){ 
                ?>
                        <option value = "<?php echo $rows['title']; ?>"> <?php echo $rows['title']; ?> </option>
                <?php 
                    }
                ?>
            </select>
            <select id = "chowmein" onchange = "selectChowmein()">
                    <option>---Chowmein---</option>
                <?php $sql = $conn->query("SELECT * FROM dishes WHERE c_category = 'chowmein'");
                    while($rows = $sql->fetch_assoc()){ 
                ?>
                        <option value = "<?php echo $rows['title']; ?>"> <?php echo $rows['title']; ?> </option>
                <?php 
                    }
                ?>
            </select>
            <select id = "pizza" onchange = "selectPizza()">
                    <option>---Pizza---</option>
                <?php $sql = $conn->query("SELECT * FROM dishes WHERE c_category = 'pizza'");
                    while($rows = $sql->fetch_assoc()){ 
                ?>
                        <option value = "<?php echo $rows['title']; ?>"> <?php echo $rows['title']; ?> </option>
                <?php 
                    }
                ?>
            </select>
            <select id = "burger" onchange = "selectBurger()">
                    <option selected>---Burger---</option>
                <?php $sql = $conn->query("SELECT * FROM dishes WHERE c_category = 'burger'");
                    while($rows = $sql->fetch_assoc()){ 
                ?>
                        <option value = "<?php echo $rows['title']; ?>"> <?php echo $rows['title']; ?> </option>
                <?php 
                    }
                ?>
            </select> 
            <form action="" method="POST" class = "form">
                <input type = "text" name =  "search">
                <input type = "submit" name = "submitclick" value = "Search">
                <?php 
                    if(!empty($_SESSION["user_id"])){
                ?>
                        <a href = "cart.php" color= "none"><img src = "images/cart.jpg" style = "height: 30px; width: 30px;"/><i><sup><b><?php echo count($_SESSION["cart"]); ?></b></sup></i></a>
                <?php } ?>
            </form>
        </nav>
        <?php 
            //include("cartPhp.php");
            if(isset ($_POST ['submitclick'])){
                $search_value = $_POST["search"];
                $sql = "SELECT * from dishes where title like '%$search_value%'";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()){
        ?>          
                    <div class = "contains">
                        <div>
                            <?php echo '<img src="images/dishes/'.$row['img'].'" alt="Food logo">'?><br>
                        </div>
                        <div>
                            <form method = "POST" action = "dishes.php?action=add&d_id=<?php echo $row["d_id"] ?>">
                                <?php 
                                    if($row['total_quantity'] > 0){
                                ?>
                                        <input type = "number" name = "quantity" value = 1 min = "1" max = <?php echo $row['total_quantity']; ?>><br>
                                <?php
                                    }
                                    else{
                                        echo '<span class = "error"> out of stock! </span>'."<br>";
                                    }
                                ?>    
                            
                                <p> <?php echo $row['price']; ?></p>
                                <p> <span class = "bold"><?php echo $row['title']; ?></span></p>
                                <p> <?php echo $row['slogan']; ?></p>
                                <input type = "hidden" name = "hidden_image" value = "<?php echo '<img src="images/dishes/'.$row['img'].'"'?>">
                                <input type = "hidden" name = "hidden_price" value = "<?php echo $row['price']; ?>"><br>
                                <input type = "hidden" name = "hidden_name" value = "<?php echo $row['title']; ?>"><br>
                                <input type = "hidden" name = "hidden_slogan" value = "<?php echo $row['slogan']; ?>"><br>
                                    <button class = "buttons" name = "Add_To_Cart">ADD TO CART</button>
                            </form>
                        </div>
                    </div>
        <?php
                }
            }
            else{
                $sql = "SELECT title, slogan, price, img,c_category,total_quantity FROM dishes";
                $result = $conn->query($sql);
            }            
        ?>
        <div class = "vertical-menu">
            <div class = "contains" id = "ans">

            </div>
            <div class = "contain">
                <?php
                    $sql = "SELECT * FROM dishes ORDER BY d_id ASC";
                    $result = $conn->query($sql);
                    if($result ->num_rows > 0){
                        while($row = $result -> fetch_assoc()){
                            echo "<div class = 'grid-item'>";
                ?>
                                <form method = "POST" action = "dishes.php?action=add&d_id=<?php echo $row["d_id"] ?>">
                                    <?php echo '<img src="images/dishes/'.$row['img'].'" alt="Food logo">'?><br>
                                    <?php 
                                        if($row['total_quantity'] > 0){
                                    ?>
                                            <input type = "number" name = "quantity" value = 1 min = "1" max = <?php echo $row['total_quantity']; ?>><br>
                                    <?php
                                        }
                                        else{
                                            echo '<span class = "error"> out of stock! </span>'."<br>";
                                        }
                                    ?>
                                    <br>
                                    <p> <?php echo $row['price']; ?></p>
                                    <p> <?php echo $row['title']; ?></p>
                                    <p> <?php echo $row['slogan']; ?></p>
                                    <input type = "hidden" name = "hidden_price" value = "<?php echo $row['price']; ?>">
                                    <input type = "hidden" name = "hidden_name" value = "<?php echo $row['title']; ?>">
                                    <input type = "hidden" name = "hidden_slogan" value = "<?php echo $row['slogan']; ?>">
                                    <button class = "buttons" name = "Add_To_Cart">ADD TO CART</button>
                                </form>
                <?php
                            echo "</div>";
                        }
                    }
                ?>      
            </div> 
        </div>
        <script>
            $(document).ready(function(){
                $('#show').click(function(){
                    $('.menu').toggle("slide");
                });
            });
        </script>
    </body>
</html>

