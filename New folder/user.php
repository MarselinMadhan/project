<?php
session_start();

$nm = $_SESSION['name'];

if($_SESSION['role']!="user"){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lost & Found Portal - Dashboard</title>
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
            height: 100vh; /* Fixed height to prevent scroll */
            overflow: hidden; /* Hide scrollbars */
            display: flex;
            flex-direction: column;
            margin: 0;
            padding: 0;
        }

        .main-wrapper {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .dashboard-container {
            background: white;
            width: 100%;
            max-width: 700px;
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            padding: 25px 40px;
            text-align: center;
            animation: fadeIn 0.8s ease-out;
            position: relative;
        }

        .welcome-header {
            margin-bottom: 20px;
        }

        .welcome-header h1 {
            color: #2c3e50;
            margin-bottom: 8px;
            font-size: 28px;
        }

        .welcome-header h4 {
            color: #7f8c8d;
            font-weight: 500;
        }

        .logo-icon {
            font-size: 45px;
            color: #4e73df;
            margin-bottom: 15px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            color: #34495e;
            margin-bottom: 5px;
        }

        .subtitle {
            color: #95a5a6;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .btn-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .btn-grid {
                grid-template-columns: 1fr;
            }
        }

        .btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 15px;
            text-decoration: none;
            border-radius: 12px;
            color: white;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .btn i {
            font-size: 32px;
        }

        .btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .btn.lost {
            background: linear-gradient(135deg, #d9534f, #c9302c);
        }

        .btn.found {
            background: linear-gradient(135deg, #5cb85c, #4cae4c);
        }

        .btn.details-lost {
            background: linear-gradient(135deg, #f0ad4e, #ec971f);
        }

        .btn.details-found {
            background: linear-gradient(135deg, #5bc0de, #31b0d5);
        }

        footer {
            margin-top: 20px;
            color: #bdc3c7;
            font-size: 13px;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(20px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
    </style>
</head>

<body>

    <?php include("nav.php"); ?>

    <div class="main-wrapper">
        <div class="dashboard-container">
            
            <div class="welcome-header">
                <h1>Welcome Back, <?php echo htmlspecialchars($nm); ?>! 👋</h1>
                <h4 id="timedisplay"></h4>
            </div>

            <div class="logo-icon">
                <i class="fas fa-search-location"></i>
            </div>

            <div class="title">Lost & Found Portal</div>
            <div class="subtitle">Helping you reconnect with your belongings</div>

            <div class="btn-grid">
                <a href="page2.php" class="btn lost">
                    <i class="fas fa-exclamation-circle"></i>
                    Report Lost Item
                </a>

                <a href="page2a.php" class="btn found">
                    <i class="fas fa-hand-holding-heart"></i>
                    Report Found Item
                </a>

                <a href="page4.php" class="btn details-lost">
                    <i class="fas fa-list-ul"></i>
                    View Lost Items
                </a>

                <a href="page4a.php" class="btn details-found">
                    <i class="fas fa-clipboard-list"></i>
                    View Found Items
                </a>
            </div>

            <footer>
                © 2026 Lost & Found Management System
            </footer>

        </div>
    </div>

    <!-- Adding inline script because time.js might be too simple or need updating -->
    <script>
        function updateTime() {
            var now = new Date();
            document.getElementById('timedisplay').innerHTML = '<i class="far fa-clock"></i> ' + now.toLocaleString();
        }
        setInterval(updateTime, 1000);
        updateTime();
    </script>
    <script src="time.js"></script>

</body>
</html>
