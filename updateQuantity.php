<?php 
session_start();
    include("cart.php");
    $cartid = $_POST['cart_id']
    $qty = $_POST['qty'];
    $upd = "UPDATE cart SET qty = '$qty' WHERE id = '$cart_id'";
    $conn->query($upd);
?>
<tbody>
                <?php 
                    if(!empty($_SESSION['cart'])){
                        $total = 0;
                        $i = 1;
                        foreach($_SESSION['cart'] as $key=>$value){
                            
                ?>
                        <form id = "frm<?php echo $value['product_id']; ?>">
                            <input type = "hidden" name = "cart_id" value = "<?php echo $value['product_id'];?>">
                            <tr>
                                <td> <?php echo $i ?></td>
                                <td> <?php echo $value['item_name'];?> </td>
                                <td> <input type = "number" min = "1" name = "quantity" value = " <?php echo $value['item_quantity'];?>" 
                                        onchange = "updateCart(<?php echo $row['id']; ?>)" onkeyup = "updateCart(<?php echo $value['product_id'];?>)"> </td>
                                <td> <?php echo $value['slogan'];?> </td>
                                <td> Rs<?php echo $value['product_price'];?></td>
                                <td> Rs <?php echo number_format($_POST['quantity']*$value['product_price'], 2)?> </td>
                                <td><a href = "dishes.php?action=delete&id=<?php echo $value['product_id'];?>"> <center><span> <img src = "images/delete.png" style = "height: 50px; width: 100px;"> <span></center></a></td>
                            </tr>  
                        </form>
                <?php
                    $total = $total + ($value["item_quantity"]*$value["product_price"]); 
                ?>
                            <tr>
                                <td colspan = "5" align= "right"> Total </td>
                                <th align = "right"> Rs <?php echo number_format($total,2);?> </th>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan = "5" align = "center"> </td>
                                <td colspan = "2"><a href = "checkout.php?d_id = <?php echo $_GET['d_id'];?>&action=check"><input type = "submit" onclick="return confirm('Are you sure?');" name = "checkout" id = "checkout" value = "Checkout"> </a></td>
                            </tr>
                <?php 
                            $i++;
                        }
                    }
                ?>  
            </tbody>