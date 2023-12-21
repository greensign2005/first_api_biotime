<?php
//echo 'here'; die();

/*Get Token */

// API endpoint URL
$apiUrl = "http://192.168.0.249:8080/jwt-api-token-auth/";

// Headers
$headers = array(
    "Content-Type: application/json",
);

// Data
$data = array(
    "username" => "superadmin",
    "password" => "]lX@iR;65)$7?_%",
);

// Initialize cURL session
$ch = curl_init($apiUrl);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response instead of outputting it
curl_setopt($ch, CURLOPT_POST, true); // Set the request type to POST
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Send the data as JSON
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set the headers

// Execute cURL session and store the result
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
}

// Close cURL session
curl_close($ch);

// Process the API response
if ($response) {
    // Parse and use the API response data
    $jsonData = json_decode($response, true);

    // Do something with the data
    //print_r($jsonData);
	$token=$jsonData['token'];
} else {
    echo 'Error: No response from the API.';
}

//echo ( $token); 

/* End of get Token */

/*Get Transaction */

$url2 = "http://192.168.0.249:8080/iclock/api/transactions/?&emp_code=4";
$token = $token;
$ch = curl_init($url2);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: JWT ' . $token,
]);

// Execute cURL session and get the response
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
}

// Close cURL session
curl_close($ch);

// Handle the response
if ($response) {
    $data = json_decode($response, true);
    // Handle the successful response
	echo '<pre/>';
    print_r($data);
} else {
    // Handle the error
    echo 'Error in making the request.';
}




?>