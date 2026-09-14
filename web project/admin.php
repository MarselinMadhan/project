<?php
session_start();
include("db.php");

// Ensure admin authentication
if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: login.php");
    exit();
}

$msg = "";
$msg_type = ""; // success, error

// 1. Handle User Deletion
if (isset($_POST['delete_user'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    
    // Check if user exists
    $query2 = "SELECT * FROM data WHERE name='$name' AND role='user'";
    $send2 = mysqli_query($conn, $query2);

    if (mysqli_num_rows($send2) > 0) {
        $query = "DELETE FROM data WHERE name='$name' AND role='user'";
        mysqli_query($conn, $query);
        $msg = "User '$name' deleted successfully.";
        $msg_type = "success";
    } else {
        $msg = "User '$name' not found or cannot delete admins.";
        $msg_type = "error";
    }
}

// 2. Handle Lost Report Deletion
if (isset($_GET['delete_lost'])) {
    $id = (int)$_GET['delete_lost'];
    $delete = "DELETE FROM lost WHERE id='$id'";
    mysqli_query($conn, $delete);
    $msg = "Lost report deleted successfully.";
    $msg_type = "success";
}

// 3. Handle Found Report Deletion
if (isset($_GET['delete_found'])) {
    $id = (int)$_GET['delete_found'];
    $delete = "DELETE FROM found WHERE id='$id'";
    mysqli_query($conn, $delete);
    $msg = "Found report deleted successfully.";
    $msg_type = "success";
}

// 4. Handle Review Deletion
if (isset($_GET['delete_review'])) {
    $id = (int)$_GET['delete_review'];
    $delete = "DELETE FROM reviews WHERE id='$id'";
    mysqli_query($conn, $delete);
    $msg = "Review deleted successfully.";
    $msg_type = "success";
}

// Determine which tab to show (lost, found, review, or users)
$current_view = 'lost';
if(isset($_GET['view'])) {
    if($_GET['view'] == 'found') $current_view = 'found';
    if($_GET['view'] == 'review') $current_view = 'review';
    if($_GET['view'] == 'users') $current_view = 'users';
}
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Query data based on view
if ($current_view == 'found') {
    if (!empty($search)) {
        $query = "SELECT * FROM found WHERE item LIKE '%$search%'";
    } else {
        $query = "SELECT * FROM found";
    }
} elseif ($current_view == 'review') {
    if (!empty($search)) {
        $query = "SELECT * FROM reviews WHERE review_text LIKE '%$search%'";
    } else {
        $query = "SELECT * FROM reviews ORDER BY created_at DESC";
    }
} elseif ($current_view == 'users') {
    if (!empty($search)) {
        $query = "SELECT * FROM data WHERE name LIKE '%$search%' AND role='user'";
    } else {
        $query = "SELECT * FROM data WHERE role='user'";
    }
} else {
    // defaults to lost
    if (!empty($search)) {
        $query = "SELECT * FROM lost WHERE item LIKE '%$search%'";
    } else {
        $query = "SELECT * FROM lost";
    }
}
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            background: #f4f6f9; /* Professional dashboard background */
            min-height: 100vh;
        }

        .admin-wrapper {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* Top Notification */
        .notification {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .notification.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .notification.error {
            background-color: #f8ffff;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Layout Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 30px;
        }

        @media (max-width: 900px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Sidebar / Controls */
        .sidebar {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            height: fit-content;
        }

        .sidebar h2 {
            color: #2c3e50;
            font-size: 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .delete-user-form {
            background: #fefefe;
            border: 1px solid #eee;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .delete-user-form h3 {
            font-size: 16px;
            color: #e74c3c;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .delete-user-form input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .btn-delete {
            width: 100%;
            padding: 10px;
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
            font-weight: 600;
        }

        .btn-delete:hover {
            background: #c0392b;
        }

        /* Tabs/Buttons */
        .tabs {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .tab-btn {
            padding: 12px 15px;
            background: #f1f3f5;
            color: #333;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: 0.3s;
        }

        .tab-btn:hover {
            background: #e2e6ea;
        }

        .tab-btn.active.lost {
            background: #d9534f;
            color: white;
        }

        .tab-btn.active.found {
            background: #5cb85c;
            color: white;
        }

        .tab-btn.active.review {
            background: #f39c12;
            color: white;
        }

        .tab-btn.active.active-users {
            background: #3498db;
            color: white;
        }

        /* Main Content */
        .main-content {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .main-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #eee;
        }

        .main-header h1 {
            color: <?php 
                if($current_view == 'found') echo '#5cb85c';
                elseif($current_view == 'review') echo '#f39c12';
                elseif($current_view == 'users') echo '#3498db';
                else echo '#d9534f'; 
            ?>;
            font-size: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-box form {
            display: flex;
            gap: 5px;
        }

        .search-box input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            outline: none;
        }

        .search-box button {
            padding: 8px 15px;
            background: #34495e;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-download {
            padding: 8px 15px;
            background: #27ae60;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: 0.3s;
        }

        .btn-download:hover {
            background: #219150;
        }

        /* Cards Grid */
        .records-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .record-card {
            background: #fdfdfd;
            border: 1px solid #eee;
            padding: 20px;
            border-radius: 10px;
            position: relative;
            transition: 0.3s;
            border-top: 4px solid <?php 
                if($current_view == 'found') echo '#5cb85c';
                elseif($current_view == 'users') echo '#3498db';
                else echo '#d9534f'; 
            ?>;
        }

        .record-card:hover {
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
            transform: translateY(-3px);
        }

        .item-title {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .record-card p {
            font-size: 14px;
            color: #555;
            margin: 6px 0;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .record-card .label {
            font-weight: 600;
            color: #333;
            min-width: 60px;
        }

        .btn-card-delete {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 12px;
            background: #ffeded;
            color: #e74c3c;
            text-decoration: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            transition: 0.3s;
            border: 1px solid #fadcdc;
        }

        .btn-card-delete:hover {
            background: #e74c3c;
            color: white;
        }

        .no-data {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px;
            color: #888;
            font-size: 16px;
            background: #f9f9f9;
            border-radius: 8px;
        }

    </style>
</head>
<body>

    <?php include("nav.php"); ?>

    <div class="admin-wrapper">

        <?php if(!empty($msg)): ?>
            <div class="notification <?php echo $msg_type; ?>">
                <i class="fas fa-<?php echo $msg_type == 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>

        <div class="dashboard-grid">
            
            <!-- Sidebar Controls -->
            <div class="sidebar">
                <h2><i class="fas fa-user-shield"></i> Admin Panel</h2>
                
                <div class="delete-user-form">
                    <h3><i class="fas fa-user-times"></i> Delete a User</h3>
                    <form action="" method="post">
                        <input type="text" name="name" placeholder="Enter Username (e.g. 23ubc544)" required>
                        <button type="submit" name="delete_user" class="btn-delete" onclick="return confirm('WARNING: Are you sure you want to completely delete this user?');">
                            Remove User
                        </button>
                    </form>
                </div>

                <h3><i class="fas fa-database"></i> Record Types</h3><br>
                <div class="tabs">
                    <a href="admin.php?view=lost" class="tab-btn <?php echo $current_view == 'lost' ? 'active lost' : ''; ?>">
                        <i class="fas fa-exclamation-circle"></i> View Lost Reports
                    </a>
                    <a href="admin.php?view=found" class="tab-btn <?php echo $current_view == 'found' ? 'active found' : ''; ?>">
                        <i class="fas fa-hand-holding-heart"></i> View Found Reports
                    </a>
                    <a href="admin.php?view=review" class="tab-btn <?php echo $current_view == 'review' ? 'active review' : ''; ?>">
                        <i class="fas fa-star"></i> View User Reviews
                    </a>
                    <a href="admin.php?view=users" class="tab-btn <?php echo $current_view == 'users' ? 'active active-users' : ''; ?>">
                        <i class="fas fa-users"></i> View Registered Users
                    </a>
                </div>
            </div>

            <!-- Main Dashboard Area -->
            <div class="main-content">
                
                <div class="main-header">
                    <h1>
                        <i class="fas fa-<?php echo $current_view == 'found' ? 'clipboard-list' : 'list-ul'; ?>"></i> 
                        Manage <?php echo ucfirst($current_view); ?> Items
                    </h1>
                    
                    <div class="search-box">
                        <form method="GET">
                            <input type="hidden" name="view" value="<?php echo $current_view; ?>">
                            <input type="text" name="search" placeholder="Search item..." value="<?php echo htmlspecialchars($search); ?>">
                            <button type="submit"><i class="fas fa-search"></i></button>
                            <a href="export.php?view=<?php echo urlencode($current_view); ?>&search=<?php echo urlencode($search); ?>" class="btn-download" title="Download Report as CSV">
                                <i class="fas fa-download"></i> Export
                            </a>
                        </form>
                    </div>
                </div>

                <div class="records-grid">
                    <?php
                    if ($result && mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='record-card'>";
                            
                            // If it's a review, the fields are different
                            if ($current_view == 'review') {
                                echo "<div class='item-title'><i class='fas fa-comment-dots'></i> User Review</div>";
                                echo "<p><span class='label'><i class='fas fa-user-tag'></i> User:</span> <strong>" . htmlspecialchars($row['posted_by']) . "</strong></p>";
                                echo "<p><span class='label'><i class='fas fa-calendar-alt'></i> Date:</span> " . htmlspecialchars($row['created_at']) . "</p>";
                                echo "<br><p>\"" . nl2br(htmlspecialchars($row['review_text'])) . "\"</p>";
                                
                                $delete_param = 'delete_review';
                            } elseif ($current_view == 'users') {
                                echo "<div class='item-title'><i class='fas fa-user-circle'></i> " . htmlspecialchars($row['name']) . "</div>";
                                echo "<p><span class='label'><i class='fas fa-shield-alt'></i> Role:</span> <strong>" . ucfirst(htmlspecialchars($row['role'])) . "</strong></p>";
                                echo "<p><span class='label'><i class='fas fa-key'></i> Password:</span> " . htmlspecialchars($row['password']) . "</p>";
                                
                                // We can reuse the delete_user logic but as a GET request for consistency
                                // Or just keep it as is. Let's make it a hidden form or a link that mimics the sidebar.
                                $delete_param = 'delete_user_via_get'; // We'll need a small handler for this
                            } else {
                                echo "<div class='item-title'><i class='fas fa-box'></i> " . htmlspecialchars($row['item']) . "</div>";
                                
                                echo "<p><span class='label'><i class='fas fa-user'></i> Name:</span> " . htmlspecialchars($row['names']) . "</p>";
                                echo "<p><span class='label'><i class='fas fa-phone'></i> Mobile:</span> " . htmlspecialchars($row['mobile']) . "</p>";
                                echo "<p><span class='label'><i class='fas fa-map-marker-alt'></i> Place:</span> " . htmlspecialchars($row['place']) . "</p>";
                                
                                if (isset($row['time'])) {
                                    echo "<p><span class='label'><i class='far fa-clock'></i> Time:</span> " . htmlspecialchars($row['time']) . "</p>";
                                }

                                // Who posted it
                                if (isset($row['posted_by']) && !empty($row['posted_by'])) {
                                    echo "<p><span class='label'><i class='fas fa-user-tag'></i> Reported By:</span> <strong>" . htmlspecialchars($row['posted_by']) . "</strong></p>";
                                }

                                // Delete URL dynamically matching the view
                                $delete_param = $current_view == 'found' ? 'delete_found' : 'delete_lost';
                            }
                            
                            // We pass back the active view as well so the page remembers which tab we are on after delete
                            if ($current_view == 'users') {
                                // For users, we use a slightly different delete link that targets the name
                                echo "<form action='admin.php' method='POST' style='display:inline;'>
                                        <input type='hidden' name='name' value='".htmlspecialchars($row['name'])."'>
                                        <button type='submit' name='delete_user' class='btn-card-delete' style='border:none; cursor:pointer; width:auto; padding:8px 12px; margin-top:15px;' onclick=\"return confirm('Are you sure you want to permanently delete this user?')\">
                                            <i class='fas fa-trash-alt'></i> Delete User
                                        </button>
                                      </form>";
                            } else {
                                echo "<a href='admin.php?view={$current_view}&{$delete_param}=" . urlencode($row['id']) . "' 
                                       class='btn-card-delete'
                                       onclick=\"return confirm('Are you sure you want to permanently delete this record?')\">
                                       <i class='fas fa-trash-alt'></i> Delete
                                      </a>";
                            }

                            echo "</div>";
                        }
                    } else {
                        echo "<div class='no-data'>";
                        echo "<i class='fas fa-folder-open' style='font-size: 30px; margin-bottom: 15px; color: #ccc;'></i><br>";
                        echo "No " . htmlspecialchars($current_view) . " items found.";
                        echo "</div>";
                    }
                    ?>
                </div>

            </div>

        </div>
    </div>

</body>
</html>
