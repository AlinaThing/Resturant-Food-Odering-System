<!DOCTYPE html>
 <html>

    <head>
        <!--<link rel = "stylesheet" href = "../css/log.css">
        <link rel = "stylesheet" href = "../css/message.css">
        <style>
            img{
                height: 2%;
                width: 30%;
            }
        </style>-->
        <link rel = "stylesheet" href = "css/index.css">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
      
        <?php
            include("../connection/connect.php"); //INCLUDE CONNECTION
            error_reporting(0); // hide undefine index errors
            session_start(); // temp sessions
            if(isset($_POST['submit']))   // if button is submit
            {
                $username = $_POST['username'];  //fetch records from login form
                $password = $_POST['password'];
                
                if(!empty($_POST["submit"]))   // if records were not empty
                {
                    $loginquery ="SELECT * FROM admin WHERE username='$username' && password='$password'"; //selecting matching records
                    $result=$conn->query($loginquery); //executing
                    $row=$result->fetch_assoc();
                    if(is_array($row))  // if matching records in the array & if everything is right
                    {
                        $_SESSION["adm_id"] = $row['adm_id']; // put user id into temp session
                        header("refresh:1;url=dashboard.php"); // redirect to index.php page
                    } 
                    else
                    {
                        $message = "Invalid Username or Password!"; // throw error
                    }
                }                
            }
            if(isset($_POST['submit1'])){
                if(empty($_POST['cr_user']) || 
                    empty($_POST['cr_email']) ||
                    empty($_post['cr_pass']) ||
                    empty($_post['cr_cpass']) ||
                    empty($_POST['code'])){
                        $message = "All fields must be filled!";
                }
                else{
                    $check_username= $conn->query("SELECT username FROM admin where username = '".$_POST['cr_user']."' ");
	                $check_email = $conn->query("SELECT email FROM admin where email = '".$_POST['cr_email']."' ");
	                 $check_code = $conn->query("SELECT adm_id FROM admin where code = '".$_POST['code']."' ");
                    if($_POST['cr_pass'] != $_POST['cr_cpass']){
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
	                        $mql = "INSERT INTO admin (username,password,email,code) VALUES ('".$_POST['cr_user']."','".md5($_POST['cr_pass'])."','".$_POST['cr_email']."','".$_POST['code']."')";
							$conn->query($mql);
							$success = "Admin Added successfully!";
						}
                    }
                }                 
            }
            
        ?>
        <span style = "color:red;"><?php echo $message; ?></span>
        <span style = "color:green;"><?php echo $success; ?></span>
        <div class = "account-page">
            <div class = "container">
                <div class = "row">
                    <div class = "col-2">
                        <img src = "../images/background.jpg" width = "500%" alt = "img"/>
                    </div>
                    <div class = "col-2">
                        <div class = "form-container">
                            <div class = "form-btn">
                                <span onclick= "login()"> Login </span>
                                <span onclick = "register()"> Register </span>
                                <hr id = "Indicator">
                            </div>
                            <form id = "RegisterForm" method = "POST">
                                <input type="text" placeholder="username" name="cr_user"/>
                                <input type="text" placeholder="email address"  name="cr_email"/>
                                <input type="password" placeholder="password"  name="cr_pass"/>
                                <input type="password" placeholder="Confirm password"  name="cr_cpass"/>
                                <input type="password" placeholder="Unique-Code"  name="code"/>
                                <button type = "submit" class = "btn" name = "submit1"> Register </button>
                            </form>
                            <form id = "LoginForm" method ="POST">
                                <input type = "text" placeholder = "username" name = "username">
                                <input type = "password" placeholder = "Password" name = "password">
                                <button type = "submit" class = "btn" name = "submit"> login </button><br>
                                <a href = ""> Forget password </a>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var LoginForm = document.getElementById("LoginForm");
            var RegisterForm = document.getElementById("RegisterForm");
            var Indivator = document.getElementById("Indicator");
            function register(){
                RegisterForm.style.transform = "translateX(10px)";
                LoginForm.style.transform = "translateX(0px)";
                Indicator.style.transform = "translateX(100px)";
            }
            function login(){
                RegisterForm.style.transform = "translateX(300px)";
                LoginForm.style.transform = "translateX(300px)";
                Indicator.style.transform = "translateX(0px)";
            }
        </script>
    </body>
 </html>