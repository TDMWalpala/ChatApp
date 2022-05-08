<?php 
   session_start();
   include_once "./dbh.inc.php";
   include_once "./validations.inc.php";

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);

   if(inputsEmptyLogin($email, $password)){
       echo "All input fields are required";
   }else if(!emailAvailable($conn, $email) && emailInvalid($email)){
       echo "Email or Password is incorrect";
   }else if(PasswordInvalid($password)){
       echo "Email or Password is incorrect";

   }else{
        $sql = "SELECT* FROM users WHERE email = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "prepare statement failed";
        }
        else{
            mysqli_stmt_bind_param($stmt, "s",$email);
            mysqli_stmt_execute($stmt);
            $data = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($data)){
                $passHashed = $row["password"];
                $isPasswordOk = password_verify($password,$passHashed);
                if($isPasswordOk){
                    $_SESSION["unique_id"] = $row["unique_id"];
                    // if(isset($remember)){
                        // setcookie("emailcookie",$email,time()+(3600*24*7),"/");//7days
                        // setcookie("passwordcookie",$pass,time()+(3600*24*7),"/");
                    // }else{
    // 
                        // if(isset($_COOKIE["emailcookie"])){
                            // setcookie("emailcookie","",time() - (3600*24*7),"/");
                        // }
    // 
                        // if(isset($_COOKIE["passwordcookie"])){
                            // setcookie("passwordcookie","",time() - (3600*24*7),"/");
                        // }
                    // }
    // 
                    // header("Location: ../profile.php");
                    echo "success";
                }
                else{
                    echo "Password is incorrect";
                    exit();
                }

            }else{

                echo "Email is incorrect";
                exit();
            }
        }
        mysqli_stmt_close($stmt);
    }

?>