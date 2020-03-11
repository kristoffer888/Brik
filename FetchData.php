<?php

$servername = "localhost";
$username = "infotavle.itd-sk";
$password = "OVSZY0Jt";
$db = "brik";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM students_locations AS first WHERE first.placed_at = (SELECT MAX(second.placed_at) from students_locations AS second WHERE second.student_id = first.student_id)";
$response = array();

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
}
print_r(json_encode($response));
