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
            
        ?>
        <div class = "dv">
        <h1 align = "center"> Adminstration </h1>
        <p align = "center"> login form <p>  
        
        <span style = "color:red;"><?php echo $message; ?></span>
        <span style = "color:green;"><?php echo $success; ?></span>
            
        <fieldset class = "block"><center>
            <img src = "../images/manager.jpg"> 
                <form action = "index.php" method = "POST">
                    <p> 
                        Username: 
                        <input type = "text" placeholder = "username" name = "username"><br>
                    </p>
                    <p> 
                        Password: 
                        <input type = "password" placeholder = "Password" name = "password">
                    </p>
                        
                    <br>
                    <input type = "submit" name = "submit" value = "login"> 
                </form>
                <span> Not registered?  <a href = "register.php" name = "submit1">create</span>    
        </fieldset>
        </div>
    </body>
 </html>