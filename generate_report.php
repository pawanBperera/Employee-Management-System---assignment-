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
            border: 1px solid  rgb(68, 102, 0);
            font-size: larger;
            border-collapse: collapse;
        }

        tr,td,td,th{
            padding: 0.6%;
            border: 1px solid black;
            

        }

        input{
            background-color: rgb(98, 158, 210);
            color: aliceblue;
            border: 0px;
            margin: auto;
            margin-left: 45%;
            width: auto;
            font-size: large;
            background-color: brown;
            color: aliceblue;
            width: 10%;
            height: auto;
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
            background-image:  url("cam.jpg");
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

        h1,h3{
            text-align: center;
        }
        
    </style>
    <title>task_6</title>
    </head>
    <body>

        <h1>Employee Assign Report</h1>

        <h3>Date: <?php echo date("d/m/Y")."<br>";?></h3>

        <table>
        <tr>
            <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Activity ID</th>
            <th>Activity Name</th>
            <th>Task ID</th>
            <th>Task Name</th>
            
        </tr>
            
        <?php
            //ini_set('display_errors', 0);

            $home_page = 'Home.php';
            
            $my_connection = connect();
            // Checking the connection
            if(!$my_connection){
                //die("> Connection failed: ".mysqli_connect_error());
                header('Location: '.$home_page);
            }
            else{
                $output_sql_employee = "SELECT DISTINCT 
                a.Eid as employeeID, e.Name as employeeName,
                a.activityid as actID, ta.activity as activityName,
                a.TId as TaskID,t.Name as taskName
                FROM employee e, assign a, taskactivities ta, Task t
                WHERE e.Eid = a.Eid AND t.TId = a.TId AND a.activityID = ta.activityid";
                
                $result = mysqli_query($my_connection, $output_sql_employee);

                if(!$result){
                    mysqli_close($my_connection);
                    header('Location: '.$home_page);
                }
                else{
                    if (mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo
                            "<tr>
                            <td>".$row['employeeID']."</td>
                            <td>".$row['employeeName']."</td>
                            <td>".$row['TaskID']."</td>
                            <td>".$row['taskName']."</td>
                            <td>".$row['actID']."</td>
                            <td>".$row['activityName']."</td>
                            </tr> ";
                            
                            
                        }
                        mysqli_close($my_connection);
                    }
                }

                
            }    
                
                    
                
                        
       
            //mysqli_close($my_connection);
        
        
            ?>
            </table><br>
        
        <div class="button">
        <form>
            <input type = "submit" value = "Generate Report" name = "genReport"><br><br>
        </form>
        <br><br>
        <a href="Home.php"><button type="button">Back</button></a>
        </div>
        
        

    
</body>
</html>