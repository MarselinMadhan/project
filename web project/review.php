<?php
session_start();
include("db.php"); // Updated connection method

$nm = isset($_SESSION['name']) ? $_SESSION['name'] : 'Unknown User';

// Make sure user is logged in
if (!isset($_SESSION['role']) || $_SESSION['role'] != "user") {
    header("Location: login.php");
    exit();
}

$success_msg = "";

if (isset($_POST['submit_review'])) {
    $review_text = mysqli_real_escape_string($conn, $_POST['review_text']);
    
    // Insert into reviews table
    $query = "INSERT INTO reviews(posted_by, review_text) VALUES('$nm', '$review_text')";
    if (mysqli_query($conn, $query)) {
        $success_msg = "Thank you! Your review has been submitted to the admin.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submit Review - Lost & Found Portal</title>
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
            background: linear-gradient(135deg, #f0f4fd, #e0e8f9); /* Soft professional gradient */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .wrapper {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .form-container {
            width: 100%;
            max-width: 500px;
            padding: 35px;
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            animation: fadeIn 0.5s ease-in-out;
            position: relative;
        }

        .form-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .form-header i {
            font-size: 36px;
            color: #f39c12; /* Star yellow-orange color */
            margin-bottom: 8px;
        }

        .form-header h2 {
            font-size: 24px;
            color: #2c3e50;
        }

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

        textarea {
            padding: 12px;
            border: 1px solid #dcdcdc;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.3s ease;
            resize: vertical;
            height: 120px;
        }

        textarea:focus {
            border-color: #f39c12;
            box-shadow: 0 0 6px rgba(243, 156, 18, 0.2);
            outline: none;
        }

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
            background-color: #f39c12;
            color: white;
        }

        .submit:hover {
            background-color: #e67e22;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3);
        }

        .success-msg {
            background: #e6ffed;
            color: #1cc88a;
            padding: 12px;
            border-radius: 6px;
            text-align: center;
            margin-bottom: 20px;
            font-size: 15px;
            font-weight: 600;
            border: 1px solid #c3e6cb;
        }

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
                <i class="fas fa-star"></i>
                <h2>Leave a Review</h2>
            </div>

            <?php if (!empty($success_msg)): ?>
                <div class="success-msg">
                    <i class="fas fa-check-circle"></i> <?php echo $success_msg; ?>
                </div>
            <?php endif; ?>

            <form action="review.php" method="post">

                <div class="form-group">
                    <label>Your Feedback / Review for Admins</label>
                    <textarea name="review_text" placeholder="Tell us about your experience..." required></textarea>
                </div>

                <div class="button-group">
                    <button type="submit" name="submit_review" class="btn submit">
                        <i class="fas fa-paper-plane"></i> Submit Review
                    </button>
                </div>

            </form>
        </div>
    </div>

</body>
</html>
