<?php
    include_once "dbh.inc.php";
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
    // echo $searchTerm;
    $output = "";
    $sql = "SELECT * FROM users WHERE fname LIKE'%{$searchTerm}' OR lname LIKE '%{$searchTerm}';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);
    if($row > 0){
        // $output .= "user is found";
        include "data.inc.php";
        
    }else{
        $output .= "No user found";
    }
    echo $output;
     
?>