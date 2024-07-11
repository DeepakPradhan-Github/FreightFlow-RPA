<?php
// fetch_job_details.php

// Database connection
$servername = "92.205.100.199";
$username = "rpa_user";
$password = "rpa_user@123";
$dbname = "rpa_db";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = intval($_POST['job_id']);

    // Fetch job details from the database
    $sql = "SELECT * FROM quotation_enquiry WHERE job_id = $job_id";
    $result = $conn->query($sql);

    // if ($result->num_rows > 0) {
    //     // Convert the result to JSON and print it
    //     $job_details = $result->fetch_assoc();
    //     echo json_encode($job_details);
    // } else {
    //     echo "No job found with ID " . $job_id;
    // }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        echo json_encode($rows);
    } else {
        echo json_encode([]);
    }
}



$conn->close();
?>
