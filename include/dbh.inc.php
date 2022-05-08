<?php
   $dbServer = "localhost";
   $dbUser = "root";
   $dbPass = "";
   $database = "chat_app";

   $conn = mysqli_connect($dbServer, $dbUser, $dbPass, $database);

    if(!$conn){
        die("Connection Failed : ".mysqli_connect_error());
    }
?>