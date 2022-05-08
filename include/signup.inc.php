<?php 
   session_start();
   include_once "./dbh.inc.php";
   include_once "./validations.inc.php";

   $fname = mysqli_real_escape_string($conn, $_POST['fname']);
   $lname = mysqli_real_escape_string($conn, $_POST['lname']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);
   $re_password = mysqli_real_escape_string($conn, $_POST['re-password']);
   
   if(inputsEmptyRegister($fname, $lname, $email, $password, $re_password)){
        echo "all inputs fields are required";
       
    }else if(nameInvalid($fname, $lname)){
        echo "Invalid name";
    }
    else if(emailInvalid($email)){
        echo "$email is not a valid email!";
    }
    else if(passwordInvalid($password)){
        echo "Invalid Password";
    }
    else if(passNotMatch($password, $re_password)){
        echo "Password not match";
    }
    else if(emailAvailable($conn, $email)){
        echo "$email - This email already exist!";
    }
    else{

        if(isset($_FILES['image'])){
            $img_name = $_FILES['image']['name'];
            $img_type = $_FILES['image']['type'];
            $tmp_name = $_FILES['image']['tmp_name'];
            
            $img_explode = explode('.',$img_name);
            $img_ext = strtolower($img_explode['1']);

            $extensions = array('jpeg', 'png', 'jpg','JPG','JPEG','PNG');
            if(in_array($img_ext, $extensions) === true){

                $time = time();
                $new_img_name = $time.$img_name;

                if(move_uploaded_file($tmp_name,"images/".$new_img_name)){

                    $ran_id = rand(time(), 100000000);
                    $status = "Active now";
                    $encrypt_pass = password_hash($password,PASSWORD_DEFAULT);
                    $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                    VALUES ({$ran_id}, '{$fname}','{$lname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}')");
                    
                    if($insert_query){

                        $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                        
                        if(mysqli_num_rows($select_sql2) > 0){
                            
                            $result = mysqli_fetch_assoc($select_sql2);
                            $_SESSION['unique_id'] = $result['unique_id'];
                            echo "success";
                        }
                        
                    }else{
                        echo "Something went wrong. Please try again!";
                    }
                }
                
            }else{
                echo "Please upload an image file - jpeg, png, jpg";
            } 
            
        }else{
            echo "Please select an image file";
        }
    }

?>