<?php
session_start();
include("db.php"); // Replaced manual connection with db.php connection

$nm = $_POST['name'];
$mo = $_POST['mobile'];
$it = $_POST['item'];
$pl = $_POST['place'];

// Specifically grab the session username
$posted_by = isset($_SESSION['name']) ? $_SESSION['name'] : 'Unknown User';

$query = "INSERT INTO found(names,mobile,item,place,posted_by) VALUES('$nm','$mo','$it','$pl','$posted_by')";
$ins = mysqli_query($conn, $query); // Changed $con to $conn based on db.php setup
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submission Success</title>
    <!-- Font Awesome for Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1cc88a, #4e73df); /* Green to Blue for found items */
        }

        .wrapper {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .card {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            padding: 35px 30px;
            border-radius: 14px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            animation: fadeIn 0.6s ease-in-out;
            position: relative;
        }

        .card-icon {
            text-align: center;
            font-size: 40px;
            color: #1cc88a;
            margin-bottom: 15px;
        }

        .card h2 {
            text-align: center;
            color: #17a673;
            margin-bottom: 25px;
            font-size: 24px;
        }

        .data {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #eee;
        }

        .data p {
            margin: 10px 0;
            font-size: 15px;
            color: #333;
            display: flex;
            justify-content: space-between;
            border-bottom: 1px dashed #ddd;
            padding-bottom: 8px;
        }

        .data p:last-child {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }

        .data span {
            font-weight: 600;
            color: #555;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .success {
            margin-top: 25px;
            padding: 12px;
            background: #e6ffed;
            color: #1cc88a;
            border: 1px solid #c3e6cb;
            border-radius: 8px;
            text-align: center;
            font-weight: 600;
            font-size: 15px;
        }

        .btn {
            margin-top: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            background: #1cc88a;
            color: white;
            padding: 12px;
            border-radius: 8px;
            transition: 0.3s;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #17a673;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(28, 200, 138, 0.3);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
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
    <div class="card">
        <div class="card-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h2>Data Submitted Successfully</h2>

        <div class="data">
        <p><span>Name:</span> <?php echo $nm; ?></p>
        <p><span>Mobile:</span> <?php echo $mo; ?></p>
        <p><span>Item:</span> <?php echo $it; ?></p>
        <p><span>Place:</span> <?php echo $pl; ?></p>
        </div>

        <div class="success">
            Your found item report has been uploaded successfully!
        </div>

        <a href="user.php" class="btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
    </div>
</div>

</body>
</html>