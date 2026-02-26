<?php
session_start();
include("db.php");

$error_msg = "";

if(isset($_POST['login'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM data WHERE name='$name' AND password='$pass'";

    $send = mysqli_query($conn,$query);

    if(mysqli_num_rows($send) == 1){

        $data = mysqli_fetch_assoc($send);

        $_SESSION['name'] = $data['name'];
        $_SESSION['role'] = $data['role'];

        if($data['role'] == "admin"){
            header("Location: admin.php");
            exit();
        }else{  
            header("Location: user.php");
            exit();
        }
    }else{
        $error_msg = "Invalid password or username";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Lost & Found Portal</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(120deg, #f6d365 0%, #fda085 100%); /* Bright sunny gradient */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-wrapper {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            animation: slideUp 0.6s ease-out;
            position: relative;
        }

        .logo-icon {
            text-align: center;
            font-size: 45px;
            color: #2a5298;
            margin-bottom: 10px;
        }

        .login-container h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        #timedisplay {
            text-align: center;
            color: #888;
            font-size: 13px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
        }

        .form-group input {
            width: 100%;
            padding: 14px 15px 14px 40px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
            background: #fdfdfd;
        }

        .form-group input:focus {
            border-color: #2a5298;
            outline: none;
            box-shadow: 0 0 8px rgba(42, 82, 152, 0.2);
            background: #fff;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: #2a5298;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background: #1e3c72;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(30, 60, 114, 0.3);
        }

        .error-msg {
            background: #ffebee;
            color: #c62828;
            padding: 10px;
            border-radius: 6px;
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .footer-links {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
        }

        .footer-links a {
            color: #2a5298;
            text-decoration: none;
            font-weight: 600;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

    <div class="login-wrapper">
        <div class="login-container">
            <div class="logo-icon">
                <i class="fas fa-user-lock"></i>
            </div>
            <h1>Welcome Back</h1>
            <p id="timedisplay"></p>

            <?php if(!empty($error_msg)): ?>
                <div class="error-msg">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error_msg; ?>
                </div>
            <?php endif; ?>

            <form action="" method="post">
                
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" placeholder="Username (eg: 23ubc544)" required>
                </div>

                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password (dd/mm/yyyy)" required>
                </div>

                <button type="submit" name="login" class="btn-submit">
                    Login
                </button> 
            </form>

            <div class="footer-links">
                <p>New here? <a href="ca.php">Create an account</a></p>
            </div>
        </div>
    </div>
     
    <script>
        function updateTime() {
            var now = new Date();
            document.getElementById('timedisplay').innerHTML = now.toLocaleString();
        }
        setInterval(updateTime, 1000);
        updateTime();
    </script>
</body>
</html>