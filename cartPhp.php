<?php
    include('connection/connect.php');
    session_start();
    error_reporting(0);
    if(isset($_POST["Add_To_Cart"])){
        if(!empty($_SESSION["user_id"])){
            if(isset($_SESSION["cart"])){
                $item_array_id = array_column($_SESSION["cart"],"product_id");
                if(!in_array($_GET["d_id"], $item_array_id)){
                    $count = count($_SESSION["cart"]);
                    $item_array = array(
                        'product_id' => $_GET["d_id"],
                        'product_image' => $_POST["hidden_image"],
                        'item_name' => $_POST["hidden_name"],
                        'product_price' => $_POST["hidden_price"],
                        'item_quantity' => $_POST["quantity"],
                        'slogan' => $_POST["hidden_slogan"],
                    );
                    $id = $value['product_id'];
                    $name = $value['item_name'];
                    $price = $value['product_price'];
                    $quantity = $value['item_quantity'];
                    $sql = "INSERT INTO cart(d_id,title, price, total_quantity)
                            VALUES('$id', '$name', '$price', '$quantity')";
                    echo $sql;
                    $_SESSION["cart"][$count] = $item_array;
                    echo '<script>
                        window.location="dishes.php"
                    </script>';
                }
                else{
                    echo '<script>
                        alert("Product is already added to cart")
                    </script>';
                    echo '<script>
                        window.location="dishes.php"
                    </script>';
                }
            }
            else{
                $item_array = array(
                    'product_id' => $_GET["d_id"],
                    'item_name' => $_POST["hidden_name"],
                    'product_image' => $_POST["hidden_image"],
                    'product_price' => $_POST["hidden_price"],
                    'item_quantity' => $_POST["quantity"],
                    'slogan' => $_POST["hidden_slogan"],
                );
                $_SESSION['cart'][0] = $item_array;
            }
        }
        else{
            header('location:login.php');
        }
    }
    if(isset($_GET["action"])){
        if($_GET["action"] == "delete"){
            foreach($_SESSION['cart'] as $key => $value){
                if($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["cart"][$key]);
                    echo '<script>
                        alert("Product has been removed!!")
                    </script>';
                    echo '<script>
                        window.location= "cart.php"
                    </script>';
                }
            }
        }
    }

    