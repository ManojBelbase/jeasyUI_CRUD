<?php
include('./db.php');

// Fetch data from the database
$query = "SELECT firstname, lastname, phone, email FROM jeasytable";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=users_data.xls");
    
    echo "First Name\tLast Name\tPhone\tEmail\n"; // Header row
    
    while ($row = $result->fetch_assoc()) {
        echo "{$row['firstname']}\t{$row['lastname']}\t{$row['phone']}\t{$row['email']}\n";
    }
} else {
    echo "No data available";
}

$conn->close();
?>
?>