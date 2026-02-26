<?php
session_start();
include("db.php");

$error_msg = "";

if(isset($_POST['create'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    $role = "user";

    // Basic validation to make sure fields aren't empty
    if(empty($name) || empty($pass)) {
        $error_msg = "Please fill in all fields.";
    } else {
        // Check if user already exists
        $check_query = "SELECT * FROM data WHERE name='$name'";
        $check_result = mysqli_query($conn, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            $error_msg = "An account with this username already exists.";
        } else {
            // Insert new user
            $query = "INSERT INTO data(`name`, `password`, `role`) VALUES ('$name','$pass','$role')";
            
            if(mysqli_query($conn, $query)){
                echo "<script>alert('Account created successfully! Please login.');
                       window.location='login.php';</script>";
                exit();
            } else {
                $error_msg = "An error occurred while creating the account.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Lost & Found Portal</title>
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

        .signup-wrapper {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .signup-container {
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

        .signup-container h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            color: #888;
            font-size: 14px;
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

    <div class="signup-wrapper">
        <div class="signup-container">
            <div class="logo-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <h1>Create Account</h1>
            <p class="subtitle">Join the Lost & Found Portal</p>

            <?php if(!empty($error_msg)): ?>
                <div class="error-msg">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error_msg; ?>
                </div>
            <?php endif; ?>

            <form action="" method="post">
                <div class="form-group">
                    <i class="fas fa-id-card"></i>
                    <input type="text" name="name" placeholder="Enter your ID or Roll Number" required>
                </div>

                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="pass" placeholder="Password (e.g. dd/mm/yyyy)" required>
                </div>

                <button type="submit" name="create" class="btn-submit">
                    Create Account
                </button>
            </form>

            <div class="footer-links">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </div>
    </div>

</body>
</html>