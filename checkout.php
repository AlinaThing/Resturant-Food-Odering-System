<!DOCTYPE html>
<html lang = "en">
    <?php
        include("connection/connect.php");
        //include_once "product-action.php";
        error_reporting(0);
        session_start(); 
        if(empty($_SESSION["user_id"])){
	        header('location:login.php');
        }
        else{
            if(!empty($_SESSION['cart'])){
                $total = 0;
                $i = 1;
                foreach($_SESSION['cart'] as $key=>$value){
                    $item_total += $value['item_quantity']*$value['product_price'];
                    $userId = $_SESSION["user_id"];
                    $productName = $value["item_name"];
                    $sqli = $conn->query("SELECT d_id,total_quantity FROM dishes WHERE title = '$productName'");
                    $query = $sqli->fetch_assoc();
                    $d_id = $query['d_id'];
                    $total_quantity = $query['total_quantity'];
                    $productQuantity = $_POST["item_quantity"];
                    $productPrice = $value["product_price"];
                    if(isset($_POST['checkout'])){
                        if($total_quantity >= 1){
                            $status = "unpaid";
                            $sql = "INSERT INTO users_orders(u_id, title, quantity, price, d_id,payment_status)
                                    VALUES('$userId', '$productName', '$productQuantity', '$productPrice', '$d_id', '$status')";
                            $check = $conn->query("SELECT total_quantity from dishes WHERE title = '$productName'");
                            $result = $check->fetch_assoc();
                            $quantity = $result['total_quantity']; 
                            $title = $productName;
                            if($conn->query ($sql) === TRUE) {
                                $update = $quantity-$productQuantity;
                                $total = "UPDATE dishes SET total_quantity = $update WHERE title = '$productName'"; 
                                if($conn->query($total) === TRUE){}
                                else{
                                    echo "Error:" . $total . "<br>" . $conn->error;
                                }
                            }
                            else {
                                echo "Error:" . $sql . "<br>" . $conn->error;
                            }
                        }
                        else{
                            echo "item is out of stock ";
                        }
                        window.alert("Successfully ordered");
                    }  
                }
            }
        }
    ?>
    