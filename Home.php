<?php
    

    session_start();
    include 'connection.php';

    if(empty($_SESSION['user_name']) || empty($_SESSION['password']) || empty($_SESSION['roles'])){
        //echo $_SESSION['roles'];
        //echo $_SESSION['user_name'];
        //echo $_SESSION['password'];
        echo '
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
        }
        body{
            margin: 1%;
            background-color: black;
            font-family: Arial, sans-serif;
            background-image:  url("cam.jpg");
            
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

    </style>
    <title>HomePage</title>
    </head>
    <body>
        <h1>StrategicArmorySolutions</h1>

        

        <div class="content">
           

            <div>
                <a href="signup.php"><button id = signup_button>Signup</button></a>
            </div>

            <div>
                <a href="login.php"><button id = login_button>Login</button></a>
            </div>

            <div>
            <a href="help.php">Help Center</a>
            </div>
        </div>

        <div class=""></div>
        
    </body>
    </html>';

    } 
    elseif($_SESSION['roles'] == 'Manager'){
      echo '  
    
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
        }
        body{
            margin: 1%;
            background-color: seashell;
            font-family: Arial, sans-serif;
            background-image:  url("cam.jpg");
        }

        h3{
            margin-top: 0%;
            text-align: center;
            font-size: 120%;
        }
        .content{
            border: 0px solid black;
            margin: auto;
            height: fit-content;
            padding: 1%;
            font-size: larger;
            width: 75%;
            text-align: center;
        }

        h5{
            font-size: 150%;
            text-align: center;
            margin-top: 0%;
        }
        div{
            margin: 2%;
        }
        img{
            margin-left: 49%
        }
        table,th,td{
            border: 1px solid black;
            border-collapse: collapse;
        }
        #logout{
            width: auto;
            font-size: large;
            background-color: brown;
            color: aliceblue;
            width: 6%;
            height: auto;
        }
        
        
    </style>
    <title>HomePage</title>
    </head>
    <body>
    <h1>StrategicArmorySolutions</h1>

   

   

    <div>
        <img width = "50px" src = "images/users2.png">
        <h5 style = "color:rgb(128, 0, 0);">Welcome '; ?>
        <?php echo $_SESSION["user_name"]; ?>
        
        <?php 
        echo '<form method = "post"><input style = "width:10%; height:15%; background-color:rgb(128, 0, 0); border-radius: 15px;
        transition-duration: 0.4s;
        text-align: center;
        display: inline-block;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer; 
        color: rgba(203, 197, 197, 0.69);
        box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);"  type="submit" value = "Logout" name = "logout"></form>';

        if(isset($_POST['logout'])){
            session_destroy();
            $home_page = 'Home.php';
            header('Location: '.$home_page);
        }
        echo'</h5></div>

    <div class="content">
        
        <h5>Options</h5>

        <div>
            <a href="emp.php">Employee Registration</a>
        </div>

        <div>
            <a href="Task.php">Task Registration</a>
        </div>

        <div>
            <a href="Activity.php">Activity Registration</a>
        </div>

        <div>
            <a href="Assign.php">Assign Registration</a>
        </div>  
        
        <div>
            <a href="generate_report.php">Generate Report</a>
        </div>'; 
    

    $my_connection = connect();

    if(!$my_connection){
      die ("Issue with conncting to the database, try again!");
    }
    else{
      
      $user_eid = $_SESSION['Eid'];

      $sql_1 = "SELECT DISTINCT ua.Eid AS User_Eid, ua.user_name AS User_Name, e.email AS email,  
      e.telephone AS Telephone_Number, e.Name AS Name, e.email AS Email, e.Designation AS Designation,
      ua.roles AS Role  
      FROM users_accounts ua, employee e
      WHERE ua.Eid = e.Eid AND ua.Eid = '$user_eid'";

      $sql_2 = "SELECT DISTINCT a.TId AS AssignedTaskID, t.Name AS TaskName, a.activityid AS activityID, ta.activity AS activity    
      FROM users_accounts ua, employee e, assign a, task t, taskactivities ta
      WHERE ua.Eid = a.Eid AND a.Eid = '$user_eid' AND a.TId = t.TId AND a.activityid = ta.activityID";

      $result_1 = mysqli_query($my_connection, $sql_1);
      $result_2 = mysqli_query($my_connection, $sql_2);
        

      $j =0;

      if(!$result_1){
          die ("> Issue with retriveing data, try again!");
      }
      else{
          if(mysqli_num_rows($result_1)>0){
              //echo $_SESSION['Eid'];
              echo"<table style= 'margin:auto;'><tr>
              <th>Eid</th>
              <th>User_Name</th>
              <th>Telephone</th>
              <th>Name</th>
              <th>email</th>
              <th>Designation</th>
              <th>Role</th>
              <th>TaskID</th>
              <th>Task_Name</th>
              <th>Activity_ID</th>
              <th>Activity_Name</th>

              </tr>";
              while($value = mysqli_fetch_assoc($result_1)){
                  echo "<tr>
                  <td>".$value['User_Eid']."</td>
                  <td>".$value['User_Name']."</td>
                  <td>".$value['Telephone_Number']."</td>
                  <td>".$value['Name']."</td>
                  <td>".$value['email']."</td>
                  <td>".$value['Designation']."</td>
                  <td>".$value['Role']."</td>
                  
                  
                  ";
              }
            }
        }
              if(mysqli_num_rows($result_2)>0){
                //echo $_SESSION['Eid'];
                  while($value = mysqli_fetch_assoc($result_2)){
                      if($j == 0){
                          echo "<td>".$value['AssignedTaskID']."</td>
                          <td>".$value['TaskName']."</td>
                          <td>".$value['activityID']."</td>
                          <td>".$value['activity']."</td>
                          </tr>";
                          $j++;
                      }
                      else{
                          echo "
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>".$value['AssignedTaskID']."</td>
                          <td>".$value['TaskName']."</td>
                          <td>".$value['activityID']."</td>
                          <td>".$value['activity']."</td>
                          </tr>";
                      }
                    }
                    
                      
                }
                
                
                else{
                    echo "
                        <td>n/a</td>
                        <td>n/a</td>
                        <td>n/a</td>
                        <td>n/a</td>
                        </tr>";
                }
                
              echo "</table>";
              
            }
    echo '</div>
  </body></html>';


    }

    
    elseif($_SESSION['roles'] == 'Employee'){
        //echo $_SESSION['roles'];
        //echo $_SESSION['user_name'];
        //echo $_SESSION['password'];
        echo '  
      
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
              border-radius: 20px;
          }
          body{
              margin: 1%;
              background-color: seashell;
              font-family: Arial, sans-serif;
            background-image:  url("cam.jpg");
          }
  
          h3{
              margin-top: 0%;
              text-align: center;
              font-size: 120%;
          }
          .content{
              border: 0px solid black;
              margin: auto;
              height: fit-content;
              padding: 1%;
              font-size: larger;
              width: 75%;
              text-align: center;
          }
  
          h5{
              font-size: 150%;
              text-align: center;
              margin-top: 0%;
          }
          div{
              margin: 2%;
          }
          img{
              margin-left: 49%
          }
          table,th,td{
            border: 1px solid black;
            border-collapse: collapse;
        }
          
      </style>
      <title>HomePage</title>
      </head>
      <body>
      <h1>StrategicArmorySolutions</h1>
  
    
  
      
  
      <div>
          <img width = "50px" src = "images/users.png">
          <h5 style = "color:rgb(128, 0, 0);">Welcome '; ?>
          <?php echo $_SESSION["user_name"]; 

          echo '<form method = "post"><input style = "width:10%; height:15%; background-color:rgb(128, 0, 0); 
          border-radius: 15px;
              transition-duration: 0.4s;
              text-align: center;
              display: inline-block;
              margin: 4px 2px;
              transition-duration: 0.4s;
              cursor: pointer; 
              color: rgba(203, 197, 197, 0.69);
              box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);"  type="submit" value = "Logout" name = "logout"></form>';

        if(isset($_POST['logout'])){
            session_destroy();
            $home_page = 'Home.php';
            header('Location: '.$home_page);
        }
          
           
          echo'</h5></div>
  
         <div class="content">
          
          <h5>Profile</h5>';

          

          $my_connection = connect();

          if(!$my_connection){
            die ("Issue with conncting to the database, try again!");
          }
          else{
      
            $user_eid = $_SESSION['Eid'];
      
            $sql_1 = "SELECT DISTINCT ua.Eid AS User_Eid, ua.user_name AS User_Name, e.email AS email,  
            e.telephone AS Telephone_Number, e.Name AS Name, e.email AS Email, e.Designation AS Designation,
            ua.roles AS Role  
            FROM users_accounts ua, employee e
            WHERE ua.Eid = e.Eid AND ua.Eid = '$user_eid'";
      
            $sql_2 = "SELECT DISTINCT a.TId AS AssignedTaskID, t.Name AS TaskName, a.activityid AS activityID, ta.activity AS activity    
            FROM users_accounts ua, employee e, assign a, task t, taskactivities ta
            WHERE ua.Eid = a.Eid AND ua.Eid = '$user_eid' AND a.TId = t.TId AND a.activityid = ta.activityID";
      
            $result_1 = mysqli_query($my_connection, $sql_1);
            $result_2 = mysqli_query($my_connection, $sql_2);
              
      
            $j =0;
      
            if(!$result_1){
                die ("> Issue with retriveing data, try again!");
            }
            else{
                if(mysqli_num_rows($result_1)>0){
                    //echo $_SESSION['Eid'];
                    echo"<table style= 'margin:auto;'><tr>
                    <th>Eid</th>
                    <th>User_Name</th>
                    <th>Telephone</th>
                    <th>Name</th>
                    <th>email</th>
                    <th>Designation</th>
                    <th>Role</th>
                    <th>TaskID</th>
                    <th>Task_Name</th>
                    <th>Activity_ID</th>
                    <th>Activity_Name</th>
      
                    </tr>";
                    while($value = mysqli_fetch_assoc($result_1)){
                        echo "<tr>
                        <td>".$value['User_Eid']."</td>
                        <td>".$value['User_Name']."</td>
                        <td>".$value['Telephone_Number']."</td>
                        <td>".$value['Name']."</td>
                        <td>".$value['email']."</td>
                        <td>".$value['Designation']."</td>
                        <td>".$value['Role']."</td>
                        
                        
                        ";
                    }
                  }
              }
                    if(mysqli_num_rows($result_2)>0){
                      //echo $_SESSION['Eid'];
                        while($value = mysqli_fetch_assoc($result_2)){
                            if($j == 0){
                                echo "<td>".$value['AssignedTaskID']."</td>
                                <td>".$value['TaskName']."</td>
                                <td>".$value['activityID']."</td>
                                <td>".$value['activity']."</td>
                                </tr>";
                                $j++;
                            }
                            else{
                                echo "
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>".$value['AssignedTaskID']."</td>
                                <td>".$value['TaskName']."</td>
                                <td>".$value['activityID']."</td>
                                <td>".$value['activity']."</td>
                                </tr>";
                            }
                          }
                          
                            
                      }
                      
                      
                      else{
                          echo "
                              <td>n/a</td>
                              <td>n/a</td>
                              <td>n/a</td>
                              <td>n/a</td>
                              </tr>";
                      }
                      
                    echo "</table>";
                    
                  }
                }

                  elseif($_SESSION['roles'] == 'Supervisor'){
                    echo '  
                  
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
                      }
                      body{
                          margin: 1%;
                          background-color: seashell;
                          font-family: Arial, sans-serif;
            background-image:  url("cam.jpg");
                      }
              
                      h3{
                          margin-top: 0%;
                          text-align: center;
                          font-size: 120%;
                      }
                      .content{
                          border: opx solid black;
                          margin: auto;
                          height: fit-content;
                          padding: 1%;
                          font-size: larger;
                          width: 75%;
                          text-align: center;
                      }
              
                      h5{
                          font-size: 150%;
                          text-align: center;
                          margin-top: 0%;
                      }
                      div{
                          margin: 2%;
                      }
                      img{
                          margin-left: 49%
                      }
                      table,th,td{
                          border: 1px solid rgb(85, 107, 47);
                          border-collapse: collapse;
                      }
                      #logout{
                          width: auto;
                          font-size: large;
                          background-color: rgb(85, 107, 47);
                          color: aliceblue;
                          width: 6%;
                          height: auto;
                      }
                      
                      
                  </style>
                  <title>Home</title>
                  </head>
                  <body>
                  <h1>Task assign website</h1>
              
                
              
                  
              
                  <div>
                      <img width = "50px" src = "images/users2.png">
                      <h5 style = "color:rgb(128, 0, 0);">Welcome '; ?>
                      <?php echo $_SESSION["user_name"]; ?>
                      
                      <?php 
                      echo '<form method = "post"><input style = "width:10%; height:15%;  background-color:rgb(128, 0, 0); 
                      border-radius: 15px;
                          transition-duration: 0.4s;
                          text-align: center;
                          display: inline-block;
                          margin: 4px 2px;
                          transition-duration: 0.4s;
                          cursor: pointer; 
                          color: rgba(203, 197, 197, 0.69);
                          box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);"  type="submit" value = "Logout" name = "logout"></form>';
              
                      if(isset($_POST['logout'])){
                          session_destroy();
                          $home_page = 'Home.php';
                          header('Location: '.$home_page);
                      }
                      echo'</h5></div>
              
                  <div class="content">
                      
                      <h5>Options</h5>
              
                     
              
                      <div>
                          <a href="Activity.php">Activity Registration</a>
                      </div>
              
                      <div>
                          <a href="Assign.php">Assign Registration</a>
                      </div>  
                      
                      <div>
                          <a href="generate_report.php">Generate Report</a>
                      </div>'; 
                  
              
                  $my_connection = connect();
              
                  if(!$my_connection){
                    die ("Issue with conncting to the database, try again!");
                  }
                  else{
                    
                    $user_eid = $_SESSION['Eid'];
              
                    $sql_1 = "SELECT DISTINCT ua.Eid AS User_Eid, ua.user_name AS User_Name, e.email AS email,  
                    e.telephone AS Telephone_Number, e.Name AS Name, e.email AS Email, e.Designation AS Designation,
                    ua.roles AS Role  
                    FROM users_accounts ua, employee e
                    WHERE ua.Eid = e.Eid AND ua.Eid = '$user_eid'";
              
                    $sql_2 = "SELECT DISTINCT a.TId AS AssignedTaskID, t.Name AS TaskName, a.activityid AS activityID, ta.activity AS activity    
                    FROM users_accounts ua, employee e, assign a, task t, taskactivities ta
                    WHERE ua.Eid = a.Eid AND a.Eid = '$user_eid' AND a.TId = t.TId AND a.activityid = ta.activityID";
              
                    $result_1 = mysqli_query($my_connection, $sql_1);
                    $result_2 = mysqli_query($my_connection, $sql_2);
                      
              
                    $j =0;
              
                    if(!$result_1){
                        die ("> Issue with retriveing data, try again!");
                    }
                    else{
                        if(mysqli_num_rows($result_1)>0){
                            //echo $_SESSION['Eid'];
                            echo"<table style= 'margin:auto;'><tr>
                            <th>Eid</th>
                            <th>User_Name</th>
                            <th>Telephone</th>
                            <th>Name</th>
                            <th>email</th>
                            <th>Designation</th>
                            <th>Role</th>
                            <th>TaskID</th>
                            <th>Task_Name</th>
                            <th>Activity_ID</th>
                            <th>Activity_Name</th>
              
                            </tr>";
                            while($value = mysqli_fetch_assoc($result_1)){
                                echo "<tr>
                                <td>".$value['User_Eid']."</td>
                                <td>".$value['User_Name']."</td>
                                <td>".$value['Telephone_Number']."</td>
                                <td>".$value['Name']."</td>
                                <td>".$value['email']."</td>
                                <td>".$value['Designation']."</td>
                                <td>".$value['Role']."</td>
                                
                                
                                ";
                            }
                          }
                      }
                            if(mysqli_num_rows($result_2)>0){
                              //echo $_SESSION['Eid'];
                                while($value = mysqli_fetch_assoc($result_2)){
                                    if($j == 0){
                                        echo "<td>".$value['AssignedTaskID']."</td>
                                        <td>".$value['TaskName']."</td>
                                        <td>".$value['activityID']."</td>
                                        <td>".$value['activity']."</td>
                                        </tr>";
                                        $j++;
                                    }
                                    else{
                                        echo "
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>".$value['AssignedTaskID']."</td>
                                        <td>".$value['TaskName']."</td>
                                        <td>".$value['activityID']."</td>
                                        <td>".$value['activity']."</td>
                                        </tr>";
                                    }
                                  }
                                  
                                    
                              }
                              
                              
                              else{
                                  echo "
                                      <td>n/a</td>
                                      <td>n/a</td>
                                      <td>n/a</td>
                                      <td>n/a</td>
                                      </tr>";
                              }
                              
                            echo "</table>";
                            
                          }
                  echo '</div>
                </body></html>';
              
              
                  }
                
          
          ?>
  
      
      </body>
      </html>
    <?php
    
    ?>
      
      
    