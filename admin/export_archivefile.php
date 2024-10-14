<?php
// Include your database connection file
include "connection.php";

// Query to retrieve archived data from the database
$query = "SELECT * FROM tbl_archive";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
  // Check if there are any rows in the result
  if (mysqli_num_rows($result) > 0) {
    // Create a header for the Excel file
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=archived_data-" . date('Y-m-d') . ".xls");

    // Create a table header
    echo "
      <table border='1'>
        <tr>
          <th>Company Code</th>
          <th>Assigned To</th>
          <th>Location</th>
          <th>Model Description</th>
          <th>Serial Number</th>
          <th>Added At</th>
        </tr>
    ";

    // Loop through each row and display the data
    while ($row = mysqli_fetch_assoc($result)) {
      echo "
        <tr>
          <td>" . $row['company_code'] . "</td>
          <td>" . $row['assigned_to'] . "</td>
          <td>" . $row['location_n'] . "</td>
          <td>" . $row['model_description'] . "</td>
          <td>" . $row['serial_number'] . "</td>
          <td>" . $row['added_at'] . "</td>
        </tr>
      ";
    }

    // Close the table
    echo "</table>";
  } else {
    echo "No archived data found.";
  }
} else {
  echo "Error retrieving archived data: " . mysqli_error($conn);
}
?>