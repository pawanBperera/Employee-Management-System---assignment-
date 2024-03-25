<?php
    include 'connection.php';

    session_start();

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        h1{
            border: 0px solid black;
            text-align: center;
            font-size: 400%;
            margin-bottom: 0%;
            color: rgb(34, 51, 1); 
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            border-radius: 10px;
            
        }
        body{
            margin: 1%;
            background-color: seashell;
            background-image: url('cam.jpg');
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
        

        h3{
            margin-top: 0%;
            text-align: center;
            font-size: 120%;
        }
        .content{
            border: 0px solid black;
            margin: auto;
            
            padding: 3%;
            font-size: larger;
            width: 50%;
            height: 10%;
            text-align: center;
        }

        h5{
            font-size: 200%;
            text-align: center;
            margin-top: 0%;
        }
        div{
            margin: 2%;
            padding: 3%;

        }
        button{
            width: 150px;
            height: 50px;
            font-size: large;
            color: rgba(203, 197, 197, 0.69);
            background-color: rgb(68, 102, 0); 
            border-radius: 15px;
            transition-duration: 0.4s;
            text-align: center;
            display: inline-block;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
        }

        button:hover{
            background-color: rgb(120, 160, 20);
            color: white;
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
        }
        table{
            width: auto;
            height: auto;
            margin: auto;
            padding: 0.9%;
            border: 15px solid  rgb(68, 102, 0);
            font-size: larger;
        }

        tr,td,td{
            padding: 0.6%;

        }

        input{
            background-color: rgb(14, 55, 92);
            color: aliceblue;
            border: 0px;
        }

        ::placeholder{
            color: aliceblue;
        }

        body{
            
            background-color: antiquewhite;
        }

        button{
            width: 150px;
            height: 50px;
            font-size: large;
            color: rgba(203, 197, 197, 0.69);
            background-color: rgb(68, 102, 0); 
            border-radius: 15px;
            transition-duration: 0.4s;
            text-align: center;
            display: inline-block;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
        }

        button:hover{
            background-color: rgb(120, 160, 20);
            color: white;
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
        }
        a{
            margin-top: auto;
            margin-left: 47%;
        }
    </style>
    

    <title>Signup</title>
</head>
<body>
    <h1>StrategicArmorySolutions</h1>

    <h3>Signup Page</h3>

    
    <form method="post">
        <table>
            
            <tr>
                <td><Label for = "Eid">Eid: </Label></td>
                <td><input type = "text" name = "Eid" style="font-size: large;" required></td>
            </tr>

            <tr>
                <td><Label for = "user_name">User Name: </Label></td>
                <td><input type = "text" name = "user_name" style="font-size: large;" required></td>
            </tr>

            <tr>
            <td><Label for = "role">Role: </Label></td>
                <td>
                    <select name = "roles" required>
                        
                        <?php
                            
                            $my_connection = connect();
                    
                            // Checking the connection
                            
                            if(!$my_connection){
                                //die("> Connection failed: ".mysqli_connect_error());
                                //header('Location: '.$emp_page);
                                echo "<option>No Avialable Data</option>";
                                $_POST['role'] = "";
                            }
                            else{
                                $list = mysqli_query($my_connection, "SELECT DISTINCT role FROM roles Where role = 'Employee'");
                                while($row_list = mysqli_fetch_assoc($list)){
                                    echo "<option>".$row_list['role']."</option>";
                                }
                            }
                            mysqli_close($my_connection);
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td><Label id = "telephone" for = "telephone">Telephone: </Label></td>
                <td><input type = "number" name = "telephone" style="font-size: large;" placeholder = "+94 " required></td>
            </tr>

            <tr>
                <td><Label for = "Name">Name: </Label></td>
                <td><input type = "text" name = "Name" style="font-size: large;" required></td>
            </tr>

            <tr>
                <td><Label for = "email">email: </Label></td>
                <td><input type = "email" name = "email" style="font-size: large;" required></td>
            </tr>

            <tr>
                <td><Label for = "designator">Designator: </Label></td>
                <td><input type = "text" name = "designator" style="font-size: large;" required></td>
            </tr>

            <tr>
                <td><label for = "password">Password: </label></td>
                <td><input type = "password" name = "password" required><br></td>
            </tr>

            <tr>
                <td><label for = "confirm_password">Confirm Password: </label></td>
                <td><input type = "password" name = "confirm_password" required><br></td>
            </tr>

            <tr>
                <td style = "text-align:left;">
                    <input type = "reset" name = "Clear" value = "Clear" style="font-size: large;border-radius: 10px;background-color: rgb(68, 102, 0);">
                </td>
                <td style = "text-align:left;" >
                    <input type = "submit" name = "signup" value = "Signup" style="font-size: large;border-radius: 10px;background-color: rgb(68, 102, 0);">
                </td>
                
            </tr>

            <?php 
                if(isset($_POST['signup'])){
                    
                    $my_connection = connect();

                    $signup_page = 'signup.php';

                    if(!$my_connection){
                        die("> Database Connection failed: ".mysqli_connect_error());
                        //header('Location: '.$emp_page);
                    }
                    else{
                        //echo "> Only the Database Connected Successfully. <br>";
                        //header('Location: '.$emp_page);
            
                        $Eid = $_POST['Eid'];
                        $user_name = $_POST['user_name'];
                        $roles = $_POST['roles'];
                        $telephone = $_POST['telephone'];
                        $Name = $_POST['Name'];
                        $email = $_POST['email'];
                        $Designation = $_POST['designator'];
                        $password=$_POST['password'];
                        
                        if(empty($Eid)){
                            die("> Eid can't be empty.");
                            
                            //header ('Location: '.$signup_page);
                        }
                        if(empty($user_name)){
                            die("> user_name can't be empty.");
                            //mysqli_close($my_connection);
                            //header ('Location: '.$signup_page);
                        }
                        elseif(empty($telephone)){
                            die("> telephone can't be empty.");
                            //mysqli_close($my_connection);
                            //header ('Location: '.$signup_page);
                        }
                        elseif(empty($Name)){
                            die("> Name can't be empty.");
                            //mysqli_close($my_connection);
                            //header ('Location: '.$signup_page);
                        }
                        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                            die("> email can't be empty.");
                            //mysqli_close($my_connection);
                            //header ('Location: '.$emp_page);
                        }
                        elseif(empty($Designation)){
                            die("> Designation can't be empty.");
                            //mysqli_close($my_connection);
                            //header ('Location: '.$signup_page);
                        }
                        elseif(empty($password)){
                            die("> Designation can't be empty.");
                            //mysqli_close($my_connection);
                            //header ('Location: '.$signup_page);
                        }
                        else{
                            $sql_user_accounts = "INSERT INTO users_accounts (Eid, user_name, password, roles)
                            VALUES ('$Eid', '$user_name', '$password', '$roles')";

                            $sql_employee = "INSERT INTO employee (Eid, telephone, Name, email, Designation)
                            VALUES ('$Eid', '$telephone', '$Name', '$email', '$Designation')";

                            $result1 = mysqli_query($my_connection, $sql_user_accounts);
                            $result2 = mysqli_query($my_connection, $sql_employee);

                            if ($result1 && $result2){
                                ?>

                            <tr>
                                <td colspan = "2" style = "text-align:center;">
                                
                                <?php
                                echo "Account successfully created.";
                                ?>

                                </td>
                            </tr>
                            
                            <tr>
                                <td style = "text-align:center;">
                                    <?php
                                        echo "<a href = 'login.php'>click here</a>"
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        echo " to login";
                                    ?>
                                    </a>
                                </td>
                            </tr>
                                
                                
                                
                            <?php 
                                mysqli_close($my_connection);
                            }
                            else{
                                echo "Account couldn't created. Please try again, if error occur again <a href = 'help.php'>click here</a> for help or report.";
                                mysqli_close($my_connection);
                            }
                            
                        }
                    }
                }?> 
                                    </td>
                                </tr>
                                
                            </table>    
             
    </form>
<br><br>
    <a href="Home.php"><button type="button">Back</button></a>
 
    
        

        
    
</body>
</html>

