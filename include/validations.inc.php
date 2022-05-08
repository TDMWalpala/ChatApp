<?php
     function inputsEmptyRegister($fname, $lname, $email, $password, $re_password){
        $value;
        if(empty($fname) || empty($lname) || empty($email) || empty($password) || empty($re_password)){
            $value = true;
        }else{
            $value = false;
        }
        return $value;
    }

    function inputsEmptyLogin($email, $password){
        $value;
        if(empty($email) || empty($password)){
            $value = true;
        }else{
            $value = false;
        }
        return $value;
    }

    function nameInvalid($fname, $lname){
        $value;
        if(!preg_match("/^[a-zA-Z]+$/", $fname)){
            $value = true;
        }
        else if(!preg_match("/^[a-zA-Z]+$/", $lname)){
            $value = true;
        }
        else{
            $value = false;
        }
        return $value;
    }

    function emailInvalid($email){
        
        $value;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $value = true; 
            // echo("exx");
        }
        else{
            $value = false;
        }
        return $value;
    }
    function passwordInvalid($password){
        $value;
        if(!preg_match("/^.{5,}$/", $password)){
            $value = true; 
        }
        else{
            $value = false;
        }
        return $value;
    }

    function passNotMatch($password, $re_password){
        $value;
        if($password !== $re_password){
            $value = true;
        }
        else{
            $value = false;
        }
        return $value;
    }

    function emailAvailable($conn, $email){
        $value;
        $sql = "SELECT * FROM users WHERE email = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            // header("location: ../index.php?err=failedstmt");
            echo "failed stmt";
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $data = mysqli_stmt_get_result($stmt);
            if(!mysqli_fetch_assoc($data)){
                $value = false;
            }
            else{
                $value = true;
            }
        }
        mysqli_stmt_close($stmt);

        return $value;
    }

    
?>