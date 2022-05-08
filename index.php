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
        <div class="form signup">
            <header>Realtime Chat App</header>
            <form action="#" enctype="multipart/form-data">
                <div class="error-msg"></div>
                <div class="name-details">
                    <div class="field input">
                        <label for="">First Name</label>
                        <input type="text" name="fname" class="input" placeholder="Enter your first Name" required>
                    </div>
                    <div class="field input">
                        <label for="">Last Name</label>
                        <input type="text" name="lname" placeholder="Enter your last Name" required>
                    </div>
                </div>
                <div class="field input">
                    <label for="">Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email Address" required>
                </div>
                <div class="field">
                    <label for="">Select Image</label>
                    <input type="file" name="image" required>
                </div>
                <div class="field input">
                    <label for="">Password</label>
                    <input type="password" name="password" placeholder="Enter new Password" required>
                </div>
                <div class="field input">
                    <label for="">Confirm Password</label>
                    <input type="password" name="re-password" placeholder="Confirm new Password" required>
                </div>
                <div class="field button">
                    <input type="submit" value="Continue">
                </div>
                 
            </form>
            <div class="link">
                Already signed up? <a href="login.php">Login now</a>
            </div>
        </div>
    </div>
    <script src="./javascript/script2.js"></script>
</body>
</html>