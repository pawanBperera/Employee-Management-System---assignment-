<?php
    include 'connection.php';

    session_start();

    $home_page = 'Home.php';

    if(empty($_SESSION['user_name']) || empty($_SESSION['password']) || empty($_SESSION['roles'])){
        header('Location: '.$home_page);
    }
    elseif($_SESSION['roles'] == 'Employee'){
        header('Location: '.$home_page);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
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
            background-color: rgb(31, 74, 112);
            color: aliceblue;
            border: 0px;
        }

        ::placeholder{
            color: aliceblue;
        }

        body{
            
            background-color: antiquewhite;
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



    <title>task_3</title>
</head>
<body>
    <form method="post" action = "regTAsk.php">
        <table>
            <tr>
                <th colspan="2" style = "text-align:center;">Task</th>
            </tr>

            <tr>
                <td><Label for = "TId">TId: </Label></td>
                <td><input type = "text" name = "TId" style="font-size: large;" required></td>
            </tr>

            <tr>
                <td><Label for = "Name">Name: </Label></td>
                <td><input type = "text" name = "Name" style="font-size: large;" required></td>
            </tr>

            <tr>
                <td><Label for = "start_date">Start date: </Label></td>
                <td><input type = "date" name = "start_date" style="font-size: large;" required></td>
            </tr>

            <tr>
                <td><Label for = "end_date">End date: </Label></td>
                <td><input type = "date" name = "end_date" style="font-size: large;" required></td>
            </tr>

            <tr>
                <td><Label for = "nature">nature: </Label></td>
                <td><input type = "text" name = "nature" style="font-size: large;" required></td>
            </tr>

            <tr>
                <td style = "text-align:left;">
                    <input type = "reset" name = "Clear" value = "Clear" style="font-size: large; background-color: rgb(68, 102, 0); border-radius: 10px; font-size: large;">
                </td>
                <td style = "text-align:left;" >
                    <input type = "submit" name = "Submit" value = "Submit" style="font-size: large; background-color: rgb(68, 102, 0); border-radius: 10px; font-size: large;">
                </td>
                
            </tr>



        </table>




    </form>
<br><br>
    <a href="Home.php"><button type="button">Back</button></a>
    
</body>
</html>