<?php
    //This code is for entering employee in to Employee table
    include 'connection.php';

    $emp_page = "emp.html";

    if(isset($_POST['Submit'])){

        $my_connection = connect();
        $emp_page = 'emp.php';
        

        // Checking the connection
        if(!$my_connection){
            die("> Database Connection failed: ".mysqli_connect_error());
            //header('Location: '.$emp_page);
        }
        else{
            echo "> Only the Database Connected Successfully. <br>";
            //header('Location: '.$emp_page);

            $Eid = $_POST['Eid'];
            $telephone = $_POST['telephone'];
            $Name = $_POST['Name'];
            $email = $_POST['email'];
            $Designation = $_POST['designator'];

            if(empty($Eid)){
                //die("> Eid can't be empty.");
                mysqli_close($my_connection);
                header ('Location: '.$emp_page);
            }
            elseif(empty($telephone)){
                //die("> telephone can't be empty.");
                mysqli_close($my_connection);
                header ('Location: '.$emp_page);
            }
            elseif(empty($Name)){
                //die("> Name can't be empty.");
                mysqli_close($my_connection);
                header ('Location: '.$emp_page);
            }
            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                //die("> email can't be empty.");
                mysqli_close($my_connection);
                header ('Location: '.$emp_page);
            }
            elseif(empty($Designation)){
                //die("> Designation can't be empty.");
                mysqli_close($my_connection);
                header ('Location: '.$emp_page);
            }
            else{
                $sql = "INSERT INTO employee (Eid, telephone, Name, email, Designation) 
                VALUES ('$Eid', '$telephone', '$Name', '$email', '$Designation');"; 

                if (mysqli_query($my_connection, $sql)){
                    //echo "> New record have been added.";
                    mysqli_close($my_connection);
                    header('Location: '.$emp_page);
                }
                else{
                    mysqli_close($my_connection);
                    echo "> Something went wrong.<br><br> Error: ".mysqli_error($my_connection);
                }
            }
            
            
        }

        
    }



?>