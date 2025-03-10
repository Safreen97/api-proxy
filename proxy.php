<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Target URL (your InfinityFree API)
$api_url = "https://ltaattendance.wuaze.com/fetch_employee_API.php"; 

// Fetch data
$response = file_get_contents($api_url);

// Return the response
echo $response;
?>
