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
            padding: 3%;
            border: 1px solid rgb(68, 102, 0);
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

        input[type=text]{
            background-color: white;
            color: black;
            border: 1px solid black;
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

        select{
            width: 102%;
        }
    </style>
    <title>task_4</title>
</head>
<body>

        <table>
        <form method="post">
            <tr>
                <th colspan="3" style = "text-align:center; padding:2%">Activity</th>
            </tr>

            <tr>
                <td><Label for = "task_id">Task id: </Label></td>
                <td>
                    <!--<input type = "text" name = "task_id" style="font-size: large;">-->
                    <select name = "task_id" required>
                        <option>--select--</option>  
                        <?php
                            $my_connection = connect();
                    
                            // Checking the connection
                            
                            if(!$my_connection){
                                //die("> Connection failed: ".mysqli_connect_error());
                                //header('Location: '.$emp_page);
                                echo "<option>No Avialable Data</option>";
                            }
                            else{
                                $list = mysqli_query($my_connection, "SELECT DISTINCT TId FROM task");
                                while($row_list = mysqli_fetch_assoc($list)){
                                    echo "<option>".$row_list['TId']."</option>";
                                }
                            }
                            mysqli_close($my_connection);
                        ?>
                    </select>
                </td>
                <td><input type = "reset" name = "Clear" value = "Clear" style="font-size: medium;"></td>
            </tr>
            <tr>
                <td><Label for = "activity">Activity: </Label></td>
                <td><input type = "text" name = "activity" style="font-size: large;" required></td>
                <td style = "text-align:left;" >
                    <input type = "submit" name = "add" value = "add &nbsp&nbsp" style="font-size: medium;">
                </td>
            </tr>
            </form>
            <tr>
                <td colspan="3">
                    
                    <table style="width: 102%; font-size:medium">
                        <tr>
                            <th>Task id</th>
                            <th>Activity</th>
                            <th></th>
                        </tr>
                        <form method="post" action="assgnTAsk.php">
                        <tr>
                            <td></td>
                            <td></td>
                            <td colspan="3" style= "text-align:right;"><input type = "submit" name = "save_db" value = "Save" style="font-size: medium; border-radius: 10px;background-color: rgb(68, 102, 0);"></td>
                            
                        </tr>
                        </form>

                        <?php
                            //ini_set('display_errors', 0);
                            $my_connection = connect();
                            
                            $activity_page = 'Activity.php';

                            if(isset($_POST['add'])){
                                
                                // Checking the connection
                                if(!$my_connection){
                                    die("> Connection failed: ".mysqli_connect_error());
                                    //header('Location: '.$activity_page);
                                }
                                else{
                                    //echo "> Connected Successfully. <br>";
                                    //header('Location: '.$activity_page);
                        
                                    $task_id = $_POST['task_id'];
                                    $activity = $_POST['activity'];
                                    
                                    $sql = "INSERT INTO temp_taskactivities (Tid, activity) 
                                    VALUES ('$task_id', '$activity');"; 
                                    
                                    if (mysqli_query($my_connection, $sql)){
                                        
                                        $output_sql = "SELECT * FROM temp_taskactivities";
                                        $result = mysqli_query($my_connection, $output_sql);
    
                                        if (mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_assoc($result)){
                                                echo "<tr>
                                                <td>".$row['Tid']."</td>
                                                <td>".$row['activity']."</td>
                                                <td></td>
                                                </tr>";
                                            }
                                            mysqli_close($my_connection);
                                        }
                                    }    
                                          
                                    else{
                                        echo "> Something went wrong.<br><br> Error: ".mysqli_error($my_connection);
                                        mysqli_close($my_connection);
                                    }
                                }
                                    
                                
                            }
                            
                            ?>
                    </table>
                    
                </td>
                
            </tr>
            
        </table>

        <a href="Home.php"><button type="button">Back</button></a>
        

    
</body>
</html>