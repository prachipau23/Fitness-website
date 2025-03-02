<?php
include 'config.php';
$sql = "SELECT description FROM wellness_programs ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['description'];
} else {
    echo "No activities found.";
}
?>