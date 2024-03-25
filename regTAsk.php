<?php

    include 'connection.php';
    //This code is for entering employee in to Employee table

    $task_page = "task.php";

    if(isset($_POST['Submit'])){
        
        $my_connection = connect();

        // Checking the connection
        if(!$my_connection){
            die("> Database Connection failed: ".mysqli_connect_error());
            //header('Location: '.$emp_page);
        }
        else{
            echo "> Only the Database Connected Successfully.<br>";
            //header('Location: '.$emp_page);

            $TId = $_POST['TId'];
            $Name = $_POST['Name'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $nature = $_POST['nature'];

            if(empty($TId)){
                //die("> Eid can't be empty.");
                mysqli_close($my_connection);
                header ('Location: '.$task_page);
            }
            elseif(empty($Name)){
                //die("> telephone can't be empty.");
                mysqli_close($my_connection);
                header ('Location: '.$task_page);
            }
            elseif(empty($start_date)){
                //die("> Name can't be empty.");
                mysqli_close($my_connection);
                header ('Location: '.$task_page);
            }
            elseif(empty($end_date)){
                //die("> Designation can't be empty.");
                mysqli_close($my_connection);
                header ('Location: '.$task_page);
            }
            elseif(empty($nature)){
                //die("> Designation can't be empty.");
                mysqli_close($my_connection);
                header ('Location: '.$task_page);
            }
            else{
                $sql = "INSERT INTO Task (TId, Name, start_date, end_date, nature) 
                VALUES ('$TId', '$Name', '$start_date', '$end_date', '$nature');"; 

                if (mysqli_query($my_connection, $sql)){
                    //echo "> New record have been added.";
                    mysqli_close($my_connection);
                    header('Location: '.$task_page);
                }
                else{
                    echo "> Something went wrong.<br><br> Error: ".mysqli_error($my_connection);
                    mysqli_close($my_connection);
                }
            }
            
            
            
        }

        
    }



?>