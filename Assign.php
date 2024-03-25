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
    </style>

    
    <title>task_5</title>
</head>
<body>

        <table>
        <form method="post">
            <tr>
                <th colspan="3" style = "text-align:center; padding:2%">Assign</th>
            </tr>

            <tr>
                <td><Label for = "Eid">Eid: </Label></td>
                <td>
                    <select name = "Eid" required>
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
                                $list = mysqli_query($my_connection, "SELECT DISTINCT Eid FROM employee");
                                while($row_list = mysqli_fetch_assoc($list)){
                                    echo "<option>".$row_list['Eid']."</option>";
                                }
                            }
                            mysqli_close($my_connection);
                        ?>
                    </select>
                </td>
                <td></td>
            </tr>
            <tr>
                <td><Label for = "TId">TId: </Label></td>
                <td>
                
                <!--TId dropdown list-->
                <select name = "TId" onchange = "getId(this.value);" required>
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
                                $list = mysqli_query($my_connection, "SELECT DISTINCT Tid FROM taskactivities");
                                while($row_list = mysqli_fetch_assoc($list)){
                                    echo "<option>".$row_list['Tid']."</option>";
                                }
                            }
                            mysqli_close($my_connection);
                        ?>
                </select>
                </td>

                <td></td>
            </tr>
            <tr>
                <td><Label for = "dateassign">dateassign: </Label></td>
                <td><input type = "date" name = "dateassign" style="font-size: large;" required></td>
                <td></td>
            </tr>
            <tr>
                <td><Label for = "activityid">activityid: </Label></td>
                <!--acyivityid dropdown list-->
                <td>
                <select name = "activityid" id = "activityid">
                    <option>--select--</option>
                    
                </select>
                <!-- 
                <script   src="https://code.jquery.com/jquery-3.1.1.js"   integrity="sha256-
                16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="   crossorigin="anonymous">  
                </script>
                -->

                <script src = "jquery/jquery.js">   
                </script>

                <script>
                        function getId(val){
                            $.ajax({
                                type: "POST",
                                url: "assign_meta.php",
                                data: "Tid="+val,
                                success: function(data){
                                    $("#activityid").html(data);
                                }
                            });
                        }
                    </script>

                </td>
                
                <td><input type = "reset" name = "Clear" value = "Clear &nbsp&nbsp" style="font-size: medium; border-radius: 10px;background-color: rgb(68, 102, 0);"></td>
            </tr>
            <tr>
                <td><Label for = "remarks">remarks: </Label></td>
                <td><input type = "text" name = "remarks" style="font-size: large;"></td>
                <td style = "text-align:left;" >
                    <input type = "submit" name = "submit" value = "Submit" style="font-size: medium; border-radius: 10px;background-color: rgb(68, 102, 0);">
                </td>
            </tr>
            
                       
             <?php
                 //ini_set('display_errors', 0);
                 $my_connection = connect();

                if(isset($_POST['submit'])){
                    
                    // Checking the connection
                    if(!$my_connection){
                        die("> Connection failed: ".mysqli_connect_error());
                        //header('Location: '.$emp_page);
                    }
                    else{
                        //echo "> Connected Successfully. <br>";
                        //header('Location: '.$emp_page);
            
                        $Eid = $_POST['Eid'];
                        $TId = $_POST['TId'];
                        $dateassign = $_POST['dateassign'];
                        $activityid = $_POST['activityid'];
                        $remarks = $_POST['remarks'];
                        
                        $sql = "INSERT INTO assign (Eid, TId, dateassign, activityid, remarks) 
                        VALUES ('$Eid', '$TId', '$dateassign', $activityid, '$remarks');"; 

                        if (mysqli_query($my_connection, $sql)){
                            //echo "> New record have been added.";
                            //header('Location: Assign.php');
                            mysqli_close($my_connection);
                        }
                        else{
                            echo "> Something went wrong.<br><br> Error: ".mysqli_error($my_connection);
                            mysqli_close($my_connection);
                        }
                        
                        
                    }
                        
                    
                }
                
            ?>
                  
            
        </table>
        </form>
<br><br>
        <a href="Home.php"><button type="button">GoBack</button></a>
        

    
</body>
</html>