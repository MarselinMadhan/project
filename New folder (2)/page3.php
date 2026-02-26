<?php
session_start();
include("db.php");
$nm = $_POST['name'];
$mo = $_POST['mobile'];
$it = $_POST['item'];
$pl = $_POST['place'];
$ti = $_POST['time'];

// Specifically grab the session username
$posted_by = isset($_SESSION['name']) ? $_SESSION['name'] : 'Unknown User';

$query = "INSERT INTO lost(time,names,mobile,item,place,posted_by) VALUES('$ti','$nm','$mo','$it','$pl','$posted_by')";
$ins = mysqli_query($conn, $query);
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
            background: linear-gradient(135deg, #d9534f, #f0ad4e);
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
            color: #d9534f;
            margin-bottom: 15px;
        }

        .card h2 {
            text-align: center;
            color: #c9302c;
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
            background: #fdf5f5;
            color: #d9534f;
            border: 1px solid #f7dddc;
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
            background-color: #d9534f;
            color: white;
            padding: 12px;
            border-radius: 8px;
            transition: 0.3s;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #c9302c;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(217, 83, 79, 0.3);
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
            <p><span><i class="fas fa-user"></i> Name:</span> <?php echo htmlspecialchars($nm); ?></p>
            <p><span><i class="fas fa-phone"></i> Mobile:</span> <?php echo htmlspecialchars($mo); ?></p>
            <p><span><i class="fas fa-box"></i> Item:</span> <?php echo htmlspecialchars($it); ?></p>
            <p><span><i class="fas fa-map-marker-alt"></i> Place:</span> <?php echo htmlspecialchars($pl); ?></p>
            <p><span><i class="far fa-clock"></i> Time:</span> <?php echo htmlspecialchars($ti); ?></p>
        </div>

        <div class="success">
            Your lost item report has been uploaded successfully!
        </div>

        <a href="user.php" class="btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
    </div>
</div>

</body>
</html>