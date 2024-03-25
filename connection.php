<?php
    function connect(){
        $server_name = "localhost";
        $user_name = "root";
        $password = "";
        $database_name = "project"; 

        return mysqli_connect($server_name, $user_name, $password, $database_name);
    }

?>