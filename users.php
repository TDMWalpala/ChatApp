<?php
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: ./login.php");

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
        <div class="users">
            <header>
                <?php
                    include_once "include/dbh.inc.php";
                    $sql = "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']};";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_assoc($result);
                    }
                ?>
                <div class="content">
                    <img src="./include/images/<?php echo $row['img']?>" alt="" srcset="">
                    <div class="details">
                        <span><?php echo $row['fname'] ." " . $row['lname'] ?></span>
                        <p><?php echo $row['status'] ?></p>
                    </div>
                </div>
                <a href="#" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">select an user to start chat</span>
                <input type="text" placeholder="Enter name to search..">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">
                  
            </div>
        </div>
    </div>
    <script src="./javascript/script1.js"></script>
</body>
</html>