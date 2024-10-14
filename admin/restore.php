<?php
// Include your database connection file
include "connection.php";

// Get the ID of the row to be restored
$id = $_GET['restore'];

// Query to restore the row from the archive table to the client table
$query = "INSERT INTO client (company_code, assigned_to, location_n, model_description, serial_number, added_at)
          SELECT company_code, assigned_to, location_n, model_description, serial_number, added_at
          FROM tbl_archive
          WHERE ID = $id";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Query to delete the row from the archive table
    $delete_query = "DELETE FROM tbl_archive WHERE ID = $id";

    // Execute the delete query
    $delete_result = mysqli_query($conn, $delete_query);

    // Check if the delete query was successful
    if ($delete_result) {
        // Redirect to the archive_data.php page
        header("Location: archive_data.php");
        exit();
    } else {
        // Handle the error
        echo "Error deleting row from archive table: " . mysqli_error($conn);
    }
} else {
    // Handle the error
    echo "Error restoring row to client table: " . mysqli_error($conn);
}