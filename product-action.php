<?php
if(!empty($_GET["action"])) {
	foreach($_SESSION['cart'] as $key=>$value){
		$productId = $value['product_id'];
		$quantity = $value['item_quantity'];
	}
$productId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
$quantity = isset($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : '';

switch($_GET["action"])
 {
	case "add":
		if(!empty($quantity)) {
								$stmt = $db->prepare("SELECT * FROM dishes where d_id= ?");
								$stmt->bind_param('i',$productId);
								$stmt->execute();
								$productDetails = $stmt->get_result()->fetch_object();
                                $itemArray = array($productDetails->d_id=>array('title'=>$productDetails->title, 'd_id'=>$productDetails->d_id, 'quantity'=>$quantity, 'price'=>$productDetails->price));
					if(!empty($_SESSION["cart"])) 
					{
						if(in_array($productDetails->d_id,array_keys($_SESSION["cart"]))) 
						{
							foreach($_SESSION["cart"] as $k => $v) 
							{
								if($productDetails->d_id == $k) 
								{
									if(empty($_SESSION["cart"][$k]["quantity"])) 
									{
									$_SESSION["cart"][$k]["quantity"] = 0;
									}
									$_SESSION["cart"][$k]["quantity"] += $quantity;
								}
							}
						}
						else 
						{
								$_SESSION["cart"] = $_SESSION["cart"] + $itemArray;
						}
					} 
					else 
					{
						$_SESSION["cart"] = $itemArray;
					}
			}
			break;
			
	case "remove":
		if(!empty($_SESSION["cart"]))
			{
				foreach($_SESSION["cart"] as $k => $v) 
				{
					if($productId == $v['d_id'])
						unset($_SESSION["cart"][$k]);
				}
			}
			break;
			
	case "empty":
			unset($_SESSION["cart"]);
			break;
			
	case "check":
			header("location:checkout.php");
			break;
	}
}