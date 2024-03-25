<?php
    

    session_start();
    include 'connection.php';

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
            background-color: black;
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
            width: 100px;
            height: 50px;
            font-size: large;
            color: white;
            background-color: green;
        }
        table{
            width: auto;
            height: auto;
            margin: auto;
            padding: 0.9%;
            border: 0px solid rgb(68, 102, 0);
            font-size: larger;
        }

        tr,td,td{
            padding: 0.6%;

        }

        input{
            background-color:  rgb(28, 74, 114);
            color: aliceblue;
            border: 0px;
        }

        ::placeholder{
            color: aliceblue;
        }

        body{
            
            background-color: gray;
            background-image: url('cam.jpg');
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
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
    <title>Login</title>
</head>
<body>
    <h1>StrategicArmorySolutions</h1>

    <h3>Login Page</h3>

    
    <form method="post">
        <table>
            
            <tr>
                <td><label for = "user_name">User Name: </label></td>
                <td><input type = "text" name = "user_name" required><br></td>
            </tr>

            <tr>
                <td><label for = "password">Password: </label></td>
                <td><input type = "password" name = "password" required><br></td>
            </tr>

            <tr>
                <td style = "text-align:left;">
                    <input type = "reset" name = "Clear" value = "Clear" style="font-size: large; border-radius: 10px;background-color: rgb(68, 102, 0);">
                </td>
                <td style = "text-align:left;" >
                    <input type = "submit" name = "login" value = "Login" style="font-size: large; border-radius: 10px;background-color: rgb(68, 102, 0);">
                </td>
                
            </tr>

            <?php 
                if(isset($_POST['login'])){

                    $home_page = 'Home.php';
                    
                    $my_connection = connect();

                    $user_name = $_POST['user_name'];
                    $password = $_POST['password'];

                    
                    if(!$my_connection){
                        die ("> Server is not connected, plz try again");
                    }
                    else{
                        $sql = "SELECT Eid, user_name, password, roles FROM users_accounts WHERE user_name = '$user_name' AND password = '$password'";
                        $result = mysqli_query($my_connection, $sql);
                        if ($result){
                            if(mysqli_num_rows($result)>0){
                                $_SESSION['user_name'] = $user_name;
                                $_SESSION['password'] = $password;
                                
                                $list = mysqli_fetch_assoc($result);
                                $roles = $list['roles'];
                                
                                $_SESSION['roles'] = $roles;

                                
                                $Eid = $list['Eid'];
                                
                                $_SESSION['Eid'] = $Eid;
                                //echo $_SESSION['Eid'];
                                

                                header('Location: '.$home_page);

                                
                                
                            }
                            else{
                                die ("> There is no account, please signup.");
                                
                            }
                            
                        
                        
                        }
                    }
                }

            ?>

                
        </table>





    </form>

    <br> <br>
    <a href="Home.php"><button type="button">Back</button></a>
 
    
        

        
    
</body>
</html>

