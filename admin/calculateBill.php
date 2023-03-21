<!DOCTYPE html>
<html lang = "en">
    <?php
        include("../connection/connect.php");
        session_start();
        error_reporting(0);
    ?>
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <meta http-equiv="refresh" content="50" />
        <title> Calculate Bill </title>
    </head>
    <body>
        <center> <h1> Bill Calculation </h1></center>
        <table>
            <tr>
                <td>

                </td>
            </tr>
        </table>
        <select name = "username">    
            <option> -- Select username -- </option>
                <?php 
                    $today = date('y-m-d',strtotime("0 days"));
                    $sql=$conn->query("SELECT distinct users.username FROM users, users_orders WHERE users.u_id = users_orders.u_id AND cast(cast(users_orders.date as date) as date) = '$today'");
                    if($sql ->num_rows > 0){
                        while($row=$sql->fetch_assoc()){
                            echo '<option value = "'.$row['username'].'">'.$row['username'].'</option>';
                        }
                    }
                ?>
            </option>
        </select>
    </body>
</html>