<?php
session_start();  // Start the session

// Include necessary files
include_once realpath('../controllers/order_controller.php');

// Check if the required POST data is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['amount'], $_POST['order_id'])) {
    // Get the required information from the form
    $email = $_POST['email'];
    $amount = $_POST['amount'];  // Amount should be in kobo (1 GHS = 100 kobo)
    $orderId = $_POST['order_id'];

    // Paystack secret key
    $secretKey = "YOUR_SECRET_KEY_HERE";

    // Initialize a cURL session
    $ch = curl_init();

    // Set up the fields for Paystack
    $fields = [
        'email' => $email,
        'amount' => $amount,
        'currency' => 'GHS',  // Ghana Cedi
        'reference' => "ORDER_" . uniqid(),  // Generate a unique reference
        'callback_url' => "http://localhost/studentMarket/actions/paystack_callback.php?order_id=$orderId"  // URL to handle after payment
    ];

    // Set up the headers for the cURL request
    $headers = [
        "Authorization: Bearer $secretKey",
        "Content-Type: application/json"
    ];

    // cURL options
    curl_setopt($ch, CURLOPT_URL, "https://api.paystack.co/transaction/initialize");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Execute the request
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo "cURL error: " . curl_error($ch);
        curl_close($ch);
        exit();
    }

    curl_close($ch);

    // Decode the response from Paystack
    $responseData = json_decode($response, true);

    // Redirect the user to Paystack payment page if successful
    if (isset($responseData['status']) && $responseData['status'] === true) {
        $authorizationUrl = $responseData['data']['authorization_url'];
        header("Location: $authorizationUrl");
        exit();
    } else {
        echo "Payment initialization failed: " . $responseData['message'];
        exit();
    }
} else {
    echo "Invalid request or missing data.";
    exit();
}
