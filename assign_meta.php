<?php

    include 'connection.php';

    $my_connection = connect();

    if (!empty($_POST["Tid"])) {
        $Tid = $_POST["Tid"]; 
        $query="SELECT activityid FROM taskactivities WHERE Tid=$Tid";
        $results = mysqli_query($my_connection, $query);

        foreach ($results as $activityid){
?>
            <option><?php echo $activityid["activityid"];?>
    </option>
    
    
<?php
        }
    }
    mysqli_close($my_connection);
?>  