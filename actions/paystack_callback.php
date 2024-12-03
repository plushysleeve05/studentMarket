<?php
// Include necessary files
include_once realpath('../controllers/order_controller.php');

// Paystack secret key
$secretKey = "sk_test_a9b2fa55484b1f2d5b5f8c5125da5c598dadd5e9";

// Get the reference from the request (Paystack will include this in the callback URL)
$reference = isset($_GET['reference']) ? $_GET['reference'] : null;
$orderId = isset($_GET['order_id']) ? $_GET['order_id'] : null;

if ($reference && $orderId) {
    // Verify the transaction
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.paystack.co/transaction/verify/$reference");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $secretKey"
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    // Decode the response
    $responseData = json_decode($response, true);

    if ($responseData['status'] && $responseData['data']['status'] === 'success') {
        // Payment is successful
        // You can update your database to mark the order as paid
        $orderStatus = 'Paid';
        updateOrderStatusController($orderId, $orderStatus);

        echo "Payment successful. Your order has been confirmed.";
    } else {
        echo "Payment verification failed. Please contact support.";
    }
} else {
    echo "Invalid request.";
}
