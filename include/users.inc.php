<?php
    session_start();
    include_once "./dbh.inc.php";
    $sql = "SELECT*FROM users;";
    $result = mysqli_query($conn, $sql);
    $output = "";
    $numrows = mysqli_num_rows($result);
     if($numrows == 1){
        $output .= "No users are available to chat"; 
    }else if(mysqli_num_rows($result) > 0){
        include "data.inc.php";
     }
    echo $output;
?>