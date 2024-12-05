<?php
include("db.php");

$term = isset($_REQUEST['term']) ? $_REQUEST['term'] : '';
$sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 'firstname';  // Default sorting by 'firstname'
$order = isset($_REQUEST['order']) ? $_REQUEST['order'] : 'asc';       // Default order 'asc'

// SQL query with sorting based on the received parameters
$sql = "SELECT * FROM jeasytable WHERE firstname LIKE '%$term%' ORDER BY $sort $order";
$result = $conn->query($sql);

$rows = array();
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

echo json_encode($rows);
?>
