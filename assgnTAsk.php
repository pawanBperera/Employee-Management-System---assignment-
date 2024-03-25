<?php
    ini_set('display_errors', 0);

    include 'connection.php';

    $my_connection = connect();

    $activity_page = 'Activity.php';

    if(isset($_POST['save_db'])){
        
        if(!$my_connection){
            die("> Connection failed: ".mysqli_connect_error());
            //header('Location: '.$activity_page);
        }
        else{
            //echo "> Connected Successfully. <br>";
            //header('Location: '.$activity_page); 

            $output_sql = "SELECT * FROM temp_taskactivities";
            
            if (mysqli_query($my_connection, $output_sql)){

                $result = mysqli_query($my_connection, $output_sql);

                if (mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $task_id = $row['Tid'];
                        $activity = $row['activity'];

                        $sql_savedb = "INSERT INTO taskactivities (Tid, activity) 
                        VALUES ('$task_id', '$activity');"; 
                        
                        if (mysqli_query($my_connection, $sql_savedb)){
                            continue;
                        }
                        else{
                            echo "Tid: ".$task_id." and activity: ".$activity." couldn't enter.";
                            continue;
                        }
                        
                    }
                    $sql_table_refresh = "DELETE FROM temp_taskactivities";
                    mysqli_query($my_connection, $sql_table_refresh);

                    mysqli_close($my_connection);

                    
                }
            }    
                  
            else{
                echo "> Something went wrong.<br><br> Error: ".mysqli_error($my_connection);
                mysqli_close($my_connection);
            }
        }
           
        //mysqli_close($my_connection);
        
        header('Location: '.$activity_page);
        
    }

?>