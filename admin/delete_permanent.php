<?php
// Include the database connection file
include 'connection.php';

// Get the ID of the record to delete from the URL parameter
$delete_id = $_GET['delete'];

// Create a SQL query to delete the record from the database
$query = "DELETE FROM tbl_archive WHERE ID = '$delete_id'";

// Execute the query
if (mysqli_query($conn, $query)) {
    // Record deleted successfully
    echo "<script>alert('Record deleted permanently!');</script>";
    echo "<script>window.location.href='archive_data.php';</script>";
} else {
    // Error deleting record
    echo "<script>alert('Error deleting record!');</script>";
    echo "<script>window.location.href='archive_data.php';</script>";
}

// Close the database connection
mysqli_close($conn);
?>