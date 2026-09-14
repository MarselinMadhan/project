<?php
session_start();
include("db.php");

// Ensure admin authentication
if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: login.php");
    exit();
}

$current_view = isset($_GET['view']) ? $_GET['view'] : 'lost';
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Validate view parameter
if (!in_array($current_view, array('lost', 'found', 'review'))) {
    $current_view = 'lost';
}

// Generate CSV Filename
$filename = ucfirst($current_view) . "_Report_" . date('Y-m-d') . ".csv";

// Output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// Setup the column headers and query based on the active view
if ($current_view == 'review') {
    fputcsv($output, array('ID', 'Posted By', 'Review', 'Created At'));
    
    if (!empty($search)) {
        $query = "SELECT id, posted_by, review_text, created_at FROM reviews WHERE review_text LIKE '%$search%'";
    } else {
        $query = "SELECT id, posted_by, review_text, created_at FROM reviews ORDER BY created_at DESC";
    }
} elseif ($current_view == 'found') {
    fputcsv($output, array('ID', 'Reported By', 'Item Category/Name', 'Found Name', 'Mobile', 'Place Found'));
    
    if (!empty($search)) {
        $query = "SELECT id, posted_by, item, names, mobile, place FROM found WHERE item LIKE '%$search%'";
    } else {
        $query = "SELECT id, posted_by, item, names, mobile, place FROM found";
    }
} else {
    // Default: lost
    fputcsv($output, array('ID', 'Reported By', 'Time', 'Item Category/Name', 'Owner Name', 'Mobile', 'Place Lost'));
    
    if (!empty($search)) {
        $query = "SELECT id, posted_by, time, item, names, mobile, place FROM lost WHERE item LIKE '%$search%'";
    } else {
        $query = "SELECT id, posted_by, time, item, names, mobile, place FROM lost";
    }
}

// Execute query and fetch records
$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Output each row of the data, format line as CSV and write to file pointer
        fputcsv($output, $row);
    }
}

fclose($output);
exit();
?>
