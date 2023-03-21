<!DOCTYPE html>
 <html>

    <head>
        <link rel = "stylesheet" href = "../css/log.css">
        <link rel = "stylesheet" href = "../css/message.css">
        <style>
            img{
                height: 2%;
                width: 30%;
            }
        </style>
    </head>
    <body>
      
        <?php
            include("../connection/connect.php"); //INCLUDE CONNECTION
            error_reporting(0); // hide undefine index errors
            //session_start(); // temp sessions
            if(isset($_POST['submit1'])){
                if(empty($_POST['cr_user']) || 
                    empty($_POST['cr_email']) ||
                    empty($_POST['cr_pass']) ||
                    empty($_POST['cr_cpass']) ||
                    empty($_POST['code'])){
                        $message = "All fields must be filled!";
                }
                else{
                    $check_username= $conn->query("SELECT username FROM admin where username = '".$_POST['cr_user']."' ");
                    $_SESSION['username'] = $_POST['cr_user'];
	                $check_email = $conn->query("SELECT email FROM admin where email = '".$_POST['cr_email']."' ");
                    $_SESSION['email'] = $_POST['cr_email'];
	                $check_code = $conn->query("SELECT adm_id FROM admin where code = '".$_POST['code']."' ");
                    $_SESSION['code'] = $_POST['code'];
                    if($_POST['cr_pass'] != $_POST['cr_cpass']){
                        $_SESSION['password'] = $_POST['password'];
                        $message = "Password not match";
                    }
                    elseif (!filter_var($_POST['cr_email'], FILTER_VALIDATE_EMAIL)){
                        $message = "Invalid email address please type a valid email!";
                    }
                    elseif($check_username->num_rows > 0){
                        $message = 'username Already exists!';
                    }
                    elseif($check_email->num_rows > 0){
                        $message = 'Email Already exists!';
                    }
                    if($check_code ->num_rows > 0){
                                $message = "Unique Code Already Redeem!";
                    }
                    else{//($result ->num_rows > 0
                        $result = $conn->query("SELECT id FROM admin_codes WHERE codes =  '".$_POST['code']."'");  //query to select the id of the valid code enter by user! 
                        if($result ->num_rows == 0){
                            $message = "invalid code!";
                        } 
                        else{
	                        $mql = "INSERT INTO admin (username,password,email,code) VALUES ('".$_POST['cr_user']."','".($_POST['cr_pass'])."','".$_POST['cr_email']."','".$_POST['code']."')";
							$conn->query($mql);
							$success = "Admin Added successfully!";
						}
                    }
                }                 
            }
            
        ?>
        <div class = "dv">
        <h1 align = "center"> Adminstration </h1>
        <p align = "center"> register form <p>  
        
        <span style = "color:red;"><?php echo $message; ?></span>
        <span style = "color:green;"><?php echo $success; ?></span>
            
        <fieldset class = "block">     
            <form class="register-form" method="post">
                <input type="text" placeholder="username" name="cr_user"/>
                <input type="text" placeholder="email address"  name="cr_email"/><br>
                <input type="password" placeholder="password"  name="cr_pass"/>
                <input type="password" placeholder="Confirm password"  name="cr_cpass"/><br>
                <input type="password" placeholder="Unique-Code"  name="code"/>
                <input type = "submit" name = "submit1" value = "register"> <br>
                <p class="message">Already registered? <a href="index.php">Sign In</a></p>
            </form>   
        </fieldset>
        </div>
    </body>
 </html>