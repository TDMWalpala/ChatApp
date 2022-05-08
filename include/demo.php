<?php
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                echo "$email - This email already exist!";
            }else{
                if(isset($_FILES['image'])){
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    
                    $img_explode = explode('.',$img_name);
                    $img_ext = end($img_explode);
    
                    $extensions = ["jpeg", "png", "jpg"];
                    if(in_array($img_ext, $extensions) === true){
                        $types = ["image/jpeg", "image/jpg", "image/png"];
                        if(in_array($img_type, $types) === true){
                            $time = time();
                            $new_img_name = $time.$img_name;
                            if(move_uploaded_file($tmp_name,"images/".$new_img_name)){
                                $ran_id = rand(time(), 100000000);
                                $status = "Active now";
                                $encrypt_pass = md5($password);
                                $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                VALUES ({$ran_id}, '{$fname}','{$lname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}')");
                                if($insert_query){
                                    $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                    if(mysqli_num_rows($select_sql2) > 0){
                                        $result = mysqli_fetch_assoc($select_sql2);
                                        $_SESSION['unique_id'] = $result['unique_id'];
                                        echo "success";
                                    }else{
                                        echo "This email address not Exist!";
                                    }
                                }else{
                                    echo "Something went wrong. Please try again!";
                                }
                            }
                        }else{
                            echo "Please upload an image file - jpeg, png, jpg";
                        }
                    } 
                    
                }else{
                    echo "Please select an image file";
                }
            }
        }else{
            echo "$email is not a valid email!";
        }
    }else{
        echo "All input fields are required!";
    }
?>




<?php
    include_once "include/dbh.inc.php";
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: login.php" );
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtime Chat App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="chat-area">
            <header>
            <?php
                    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                    $sql = "SELECT * FROM users WHERE unique_id = {$user_id};";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_assoc($result);
                    }
                ?>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="./include/images/<?php echo $row['img']?>" alt="" srcset="">
                <div class="details">
                    <span><?php echo $row['fname'] ." " . $row['lname'] ?></span>
                    <p><?php echo $row['status'] ?></p>
                </div>
            </header>
            <div class="chat-box">
                <div class="chat outgoing">
                    <div class="details">
                        <p>Lorem ipsum dolor, sit consectetur adipisicing elit. Neque, nobis.</p>
                    </div>
                </div>
                <div class="chat incoming">
                    <img src="./img/hoodie.jpeg" alt="" srcset="">
                    <div class="details">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Neque, nobis.</p>
                    </div>
                </div>
                <div class="chat outgoing">
                    <div class="details">
                        <p>Lorem ipsum dolor, sit consectetur adipisicing elit. Neque, nobis.</p>
                    </div>
                </div>
                <div class="chat incoming">
                    <img src="./img/hoodie.jpeg" alt="" srcset="">
                    <div class="details">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Neque, nobis.</p>
                    </div>
                </div>
                <div class="chat outgoing">
                    <div class="details">
                        <p>Lorem ipsum dolor, sit consectetur adipisicing elit. Neque, nobis.</p>
                    </div>
                </div>
                <div class="chat incoming">
                    <img src="./img/hoodie.jpeg" alt="" srcset="">
                    <div class="details">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Neque, nobis.</p>
                    </div>
                </div>
                <div class="chat outgoing">
                    <div class="details">
                        <p>Lorem ipsum dolor, sit consectetur adipisicing elit. Neque, nobis.</p>
                    </div>
                </div>
                <div class="chat incoming">
                    <img src="./img/hoodie.jpeg" alt="" srcset="">
                    <div class="details">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Neque, nobis.</p>
                    </div>
                </div>
            </div>
            <form action="#" class="typing-area" autocomplete="off">
                <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id'];?>" hidden>
                <input type="text" name="incoming_id" value="<?php echo $user_id;?>" hidden>
                <input type="text" names="message" class="input-field" placeholder="Type here..">
                <button class="send-Btn"><i class="fab fa-telegram-plane"></i></button>
            </form>
        </div> 
    </div>
    <script src="./javascript/chat.js"></script>
</body>
</html>