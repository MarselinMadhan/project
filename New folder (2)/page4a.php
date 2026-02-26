<?php
session_start();
include("db.php"); // Updated connection method

// Handle Deletion for regular users
if(isset($_GET['delete_id']) && isset($_SESSION['name'])) {
    $del_id = mysqli_real_escape_string($conn, $_GET['delete_id']);
    $user = mysqli_real_escape_string($conn, $_SESSION['name']);
    
    // Delete only mapping to the correct user for safety
    $del_query = "DELETE FROM found WHERE id='$del_id' AND posted_by='$user'";
    mysqli_query($conn, $del_query);
    header("Location: page4a.php");
    exit();
}

$search = "";

if(isset($_GET['search'])){
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query = "SELECT * FROM found WHERE item LIKE '%$search%'";
} else {
    $query = "SELECT * FROM found";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Found Items Details</title>

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
            background: #f4fdf8; /* Light greenish theme for found items */
            min-height: 100vh;
        }

        .main-content {
            padding: 40px 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #5cb85c;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        /* Search Section */
        .search-box {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .search-form {
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            background: white;
            padding: 5px;
        }

        .search-form input {
            flex: 1;
            padding: 12px 15px;
            border: none;
            outline: none;
            font-size: 15px;
            background: transparent;
        }

        .search-form input:focus {
            color: #333;
        }

        .search-form button {
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            background: #5cb85c;
            color: white;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-form button:hover {
            background: #4cae4c;
            box-shadow: 0 4px 8px rgba(92, 184, 92, 0.3);
        }

        .home-btn {
            margin-left: 8px;
            padding: 12px 16px;
            border-radius: 6px;
            background: #5bc0de;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }

        .home-btn:hover {
            background: #31b0d5;
        }

        /* Data Grid Setup */
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        /* Card Design */
        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(92, 184, 92, 0.08); /* Hint of green */
            transition: 0.3s ease;
            position: relative;
            border-top: 4px solid #5cb85c;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(92, 184, 92, 0.15);
        }

        .item-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #5cb85c;
            display: flex;
            align-items: center;
            gap: 8px;
            border-bottom: 1px solid #f0f0f0;
            padding-bottom: 10px;
        }

        .card p {
            margin: 8px 0;
            font-size: 14px;
            color: #555;
            display: flex;
            align-items: baseline;
            gap: 6px;
        }

        .label {
            font-weight: 600;
            color: #333;
            min-width: 60px;
        }

        .no-data {
            text-align: center;
            color: #888;
            font-size: 18px;
            margin-top: 40px;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .no-data i {
            font-size: 40px;
            color: #ccc;
        }

        .btn-card-delete {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 12px;
            background: #e6ffed;
            color: #1cc88a;
            text-decoration: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            transition: 0.3s;
            border: 1px solid #c3e6cb;
        }

        .btn-card-delete:hover {
            background: #1cc88a;
            color: white;
        }

    </style>
</head>

<body>

<?php include("nav.php"); ?>

<div class="main-content">
    <h1><i class="fas fa-clipboard-list"></i> Found Items Registry</h1>

    <div class="container">

        <!-- Search Form -->
        <div class="search-box">
            <form method="GET" class="search-form">
                <input type="text" name="search" placeholder="Search for items..."
                       value="<?php echo htmlspecialchars($search); ?>">

                <button type="submit">
                    <i class="fas fa-search"></i>
                </button>

                <a href="user.php" class="home-btn" title="Back to Dashboard">
                    <i class="fas fa-home"></i>
                </a>
            </form>
        </div>

        <div class="grid-container">
            <?php
            if($result) {
                $rows = mysqli_num_rows($result);

                if($rows > 0){
                    while($pri = mysqli_fetch_assoc($result)){
                        echo "<div class='card'>";
                        echo "<div class='item-title'><i class='fas fa-box'></i> ".htmlspecialchars($pri['item'])."</div>";
                        echo "<p><span class='label'><i class='fas fa-user'></i> Name:</span> ".htmlspecialchars($pri['names'])."</p>";
                        echo "<p><span class='label'><i class='fas fa-phone'></i> Mobile:</span> ".htmlspecialchars($pri['mobile'])."</p>";
                        echo "<p><span class='label'><i class='fas fa-map-marker-alt'></i> Place:</span> ".htmlspecialchars($pri['place'])."</p>";
                        echo "<p><span class='label'><i class='fas fa-user-tag'></i> Reported By:</span> <strong>".htmlspecialchars($pri['posted_by'])."</strong></p>";
                        
                        // Show delete button ONLY if the logged in user matches the posted_by user
                        if(isset($_SESSION['name']) && $_SESSION['name'] == $pri['posted_by']) {
                            echo "<a href='page4a.php?delete_id=" . $pri['id'] . "' class='btn-card-delete' onclick=\"return confirm('Are you sure you want to delete your own report?')\"><i class='fas fa-trash-alt'></i> Delete</a>";
                        }
                        
                        echo "</div>";
                    }
                } else {
                    echo "</div>"; // Close grid explicitly to center the no-data msg
                    echo "<div class='no-data'><i class='fas fa-search-minus'></i> <div>No matching found items found</div></div>";
                    echo "<div>"; // Reopen invisible so grid closing div doesn't break
                }
            } else {
                echo "</div>";
                echo "<div class='no-data'><i class='fas fa-exclamation-triangle'></i> Database error or table missing</div>";
                echo "<div>";
            }
            ?>
        </div>

    </div>
</div>

</body>
</html>
