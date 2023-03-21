<?php
    include('connection/connect.php');
    include('cartPhp.php');
    $k = $_POST['id'];
    $k = trim($k);
    $sql = $conn->query("SELECT * FROM dishes WHERE title = '{$k}'");
    while($row = $sql -> fetch_assoc()){
        $d_id = $row['d_id'];
        $max = $row['total_quantity'];
?>
        <form method = "POST" action = "dishes.php?action=add&d_id=<?php echo $row["d_id"]; ?>">
<?php
        echo '<div class = "contain">';
            echo '<div>';
                echo '<img style = "height:50%; width: 50%;" src = "images/dishes/'.$row['img'].'">'."<br>";
            echo '</div>';
            echo '<div>';
?>
            <input type = "number" name = "quantity" value =1 min = "1" max = "<?php echo $max; ?>"><br>
<?php 
                echo "Rs".$row['price']."<br>";
                echo $row['title']."<br>";
                echo $row['slogan']. "<br>";
?>
                <input type = "hidden" name = "hidden_price" value = "<?php echo $row['price']; ?>">
                <input type = "hidden" name = "hidden_name" value = "<?php echo $row['title']; ?>">
                <input type = "hidden" name = "hidden_slogan" value = "<?php echo $row['slogan']; ?>">
                <?php 
                    if(!empty($_SESSION["user_id"])){
                ?>
                        <button class = "buttons" name = "Add_To_Cart">ADD TO CART</button>
                <?php } ?>
<?php
            echo '</div>';
        echo '</div>'."<br>";
        echo '</form>';
    }
?>
<!DOCTYPE html>
<html>
    <head> 
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <title> website </title>
        <link rel = "stylesheet" href = "css/dishes.css">
        <style> 
            .contains + img{
                width: 200%;
                height:200%;
            }
            .contains {
                display: grid;
                grid-template-columns: 50% 50%;
                padding: 10px;
            }
        </style>
    </head>
    <body><br>
        <h1> Other dishes available! </h1>
    </body>
</html>