<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Found Item Report</title>

    <!-- Font Awesome for Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Light Professional Background */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f4f8fb, #e8f4f8);
            min-height: 100vh;
        }

        /* Centering the form */
        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 70px); /* Account for navbar */
            padding: 20px;
        }

        /* Form Card */
        .form-container {
            width: 100%;
            max-width: 400px;
            padding: 35px;
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            animation: fadeIn 0.5s ease-in-out;
            position: relative;
        }

        /* Header Section */
        .form-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .form-header i {
            font-size: 32px;
            color: #5cb85c;
            margin-bottom: 8px;
        }

        .form-header h2 {
            font-size: 24px;
            color: #2c3e50;
        }

        /* Form Groups */
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 18px;
        }

        label {
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 14px;
            color: #555;
        }

        input {
            padding: 12px;
            border: 1px solid #dcdcdc;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.3s ease;
        }

        input:focus {
            border-color: #5cb85c;
            box-shadow: 0 0 6px rgba(92, 184, 92, 0.2);
            outline: none;
        }

        /* Buttons */
        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 15px;
        }

        .btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
        }

        .submit {
            background-color: #5cb85c;
            color: white;
        }

        .submit:hover {
            background-color: #4cae4c;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(92, 184, 92, 0.3);
        }

        .reset {
            background-color: #f1f3f5;
            color: #333;
            border: 1px solid #ddd;
        }

        .reset:hover {
            background-color: #e2e6ea;
            transform: translateY(-2px);
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <?php include("nav.php"); ?>

    <div class="wrapper">
        <div class="form-container">

            <div class="form-header">
                <i class="fas fa-hand-holding-heart"></i>
                <h2>Found Item Report</h2>
            </div>

            <form action="page3a.php" method="post">

                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" placeholder="Enter your name" required>
                </div>

                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" name="mobile" pattern="[0-9]{10}" placeholder="Enter 10-digit number" required>
                </div>

                <div class="form-group">
                    <label>Found Item</label>
                    <input type="text" name="item" placeholder="Enter found item name" required>
                </div>

                <div class="form-group">
                    <label>Place</label>
                    <input type="text" name="place" placeholder="Where did you find it?" required>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn submit">
                        <i class="fas fa-paper-plane"></i> Submit
                    </button>
                    <button type="reset" class="btn reset">
                        <i class="fas fa-undo"></i> Reset
                    </button>
                </div>

            </form>
        </div>
    </div>

</body>
</html>
