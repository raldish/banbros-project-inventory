<?php
    include "connection.php";

    $id = $_GET['archive'];

    // Retrieve the data to be archived from the database
    $query = "SELECT * FROM client WHERE ID = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Check if the data exists
    if ($row) {
        // Insert the data into the archive table
        $query = "INSERT INTO tbl_archive (ID, company_code, assigned_to, location_n, model_description, serial_number, added_at) 
                  VALUES ('$row[ID]', '$row[company_code]', '$row[assigned_to]', '$row[location_n]', '$row[model_description]', '$row[serial_number]', '$row[added_at]')";

        // Execute the query
        if (mysqli_query($conn, $query)) {
            // Delete the data from the original table
            $query = "DELETE FROM client WHERE ID = '$id'";
            if (mysqli_query($conn, $query)) {
                $_SESSION['success'] = "Record has been archived successfully";
            } else {
                $_SESSION['error'] = "Error archiving data: " . mysqli_error($conn);
            }
        } else {
            $_SESSION['error'] = "Error inserting data into archive table: " . mysqli_error($conn);
        }
    } else {
        $_SESSION['error'] = "Data not found.";
    }

    header("location: index.php");
?>