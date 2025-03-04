<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
include('connection/connection.php');

if ($connection->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $connection->connect_error]));
}

$adminId = 12; // Set the admin_id directly to 12

$stmt = $connection->prepare("SELECT staff_id, name FROM admin WHERE admin_id = ?"); // Use a placeholder
$stmt->bind_param("i", $adminId); // Bind the integer value

if (!$stmt->execute()) { // Check for execution errors
    die(json_encode(["error" => "Query execution failed: " . $stmt->error]));
}

$result = $stmt->get_result();

if ($result === false) {
    die(json_encode(["error" => $connection->error]));
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $json_output = json_encode($row);
    if (json_last_error() !== JSON_ERROR_NONE) {
        die(json_encode(["error" => json_last_error_msg()]));
    }
    echo $json_output;
} else {
    echo json_encode([]);
}

$stmt->close();
$connection->close();
?>
