<!DOCTYPE html>
<html lang = "en">
    <?php 
        include("connection/connect.php");
        include_once "product-action.php";
        error_reporting(0);
        session_start(); 
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name = "viewport" content = "width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
        <meta http-equiv="refresh" content="5" />
        <meta http-equiv= "X-UA-Compatible" content = "ie-edge">
        <title> cart </title>
        <link rel = "stylesheet" href = "css/dishes.css">
        <link rel = "stylesheet" href = "css/style.css">
        <style>
            table,td,th{
                border-collapse: collapse;
                border: 1px solid black;
            }
            .navbarr{
                background-color: violet;
                width: 100%;
                height: 100px;
            }
            .navbarr a{
                float: right;
                padding-right: 30px;
            }
            i{
                font-size: 40px;
            }
            .error{
                color: red;
                font-weight: bold;
            }
        </style>
        <title> Cart </title>
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
                            <li> <a href = "your_orders.php"> Your Orders </a></li>
                            <li> <a href = "logout.php"> Logout </a></li>
                    <?php
                    }
                ?>    
            </ul>
        </nav><br><br>
        <nav class = "navbarr">
            <h3>Shopping Cart &nbsp;&nbsp;<img src = "images/shopping cart.png" style = "height: 40px;width: 40px;"></h3>
            <a href = "cart.php" color= "none"><img src = "images/cart.jpg" style = "height: 30px; width: 30px;"/><i><sub><?php echo count($_SESSION["cart"]); ?></sub></i></a>
        </nav>
        <br><br><br>
        <h1> <center> MY CART </center></h1>
        <?php echo $success; ?>
        <?php echo $error; ?>
        <center>
        <form action = "checkout.php" method = "POST">
        <table>
            <thead>
                <tr>
                    <th><h4> SN </h4></th>
                    <th><h4> Title </h4></th>
                    <th><h4> Image </h4></th>
                    <th><h4> Quantity </h4></th>
                    <th><h4> Slogan </h4></th>
                    <th><h4> Price Details </h4></th>
                    <th><h4> Total Price </h4></th>
                    <th><h4> Remove Item </h4></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if(!empty($_SESSION['cart'])){
                        $total = 0;
                        $i = 1;
                        foreach($_SESSION['cart'] as $key=>$value){
                            $id= $value['product_id'];
                            $sql = "SELECT * FROM dishes WHERE d_id = '$id'";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            
                ?>
                            <tr>
                                <td> <?php echo $i ?></td>
                                <td> <?php echo $value['item_name'];?> </td>
                                <td> <?php echo '<img src="images/dishes/'.$row['img'].'" alt="Food logo" style = "width:100px; height:100px;">'?> </td>
                                <?php 
                                    if($row['total_quantity'] > 0){
                                ?>
                                        <td><input type = "number" class = "iquantity" onchange = "subTotal()" min = "1" max = <?php echo $row['total_quantity']; ?> name = "item_quantity" value= "<?php echo $value['item_quantity'];?>"> </td>
                                <?php
                                    }
                                    else{
                                        echo '<td class = "error"> out of stock! </td>';
                                    }
                                ?>
                                <td> <?php echo $value['slogan'];?> </td>
                                <td> Rs<?php echo $value['product_price'];?><input type = "hidden" class = "iprice" value = "<?php echo $value['product_price'];?>"></td>
                                <?php echo "<td class = 'itotal'>  </td>"; ?>
                                <td><a href = "dishes.php?action=delete&id=<?php echo $value['product_id'];?>"> <center><span> <img src = "images/delete.png" style = "height: 50px; width: 70px;"> <span></center></a></td>
                            </tr>  
                <?php 
                            $i++;
                        }
                ?>
                        <tr>
                                <td colspan = "6" align= "right"> Total </td>
                                <th colspan = "2" align = "right" id = "grandTotal"></th>
                        </tr>
                        <tr>
                                <td colspan = "6" align = "center"> </td>
                                <td colspan = "2"><a href = "checkout.php?id = <?php echo $_GET['d_id'];?>&action=check"><input type = "submit" onclick="return confirm('Are you sure?');" name = "checkout" id = "checkout" value = "Checkout"> </a></td>
                            </tr>
                <?php
                    }
                ?>  
            </tbody>
        </table>
        </form>
        </center>
        <script>
            var gt = 0;
            var iprice = document.getElementsByClassName('iprice');
            var iquantity = document.getElementsByClassName('iquantity');
            var itotal = document.getElementsByClassName('itotal');
            var grandTotal = document.getElementById('grandTotal');
            function subTotal(){
                gt = 0;
                for(i = 0; i < iprice.length;i++){
                    itotal[i].innerText = (iprice[i].value)*(iquantity[i].value);
                    gt = gt+ (iprice[i].value)*(iquantity[i].value);
                }
                grandTotal.innerText = gt;
            }
            subTotal();
        </script>
    </body>
</html>