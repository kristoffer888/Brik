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

//    $sql = "SELECT d.student_id, d.student_location_id, d.placed_at from student_timestamps d where placed_at = (select max(d1.placed_at) from student_timestamps d1 where d1.student_id = d.student_id);";
    $sql = "SELECT * FROM students_locations AS first WHERE first.placed_at = (SELECT MAX(second.placed_at) from students_locations AS second WHERE second.student_id = first.student_id)";
    $response = array();

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
//            $user->id = $row["id"];
//            $user->student_id = $row["student_id"];
//            $user->student_state_id = $row["student_location_id"];
//            $user->placed_at = $row["placed_at"];
//            $user->removed_at = $row["removed_at"];
//            array_push($response, $user);
//            $user = NULL;
            
            $response[] = $row;
        }
    }
    print_r(json_encode($response));
    