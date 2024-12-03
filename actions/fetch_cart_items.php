<?php
session_start(); // Start the session

header('Content-Type: application/json'); 

// Include necessary controllers
include_once '../controllers/cart_controller.php';

// Check if the customer is logged in
if (!isset($_SESSION['customer_id'])) {
    echo json_encode(['success' => false, 'message' => 'User is not logged in.']);
    exit();
}

$customer_id = $_SESSION['customer_id'];

// Fetch cart items for the logged-in customer
$cart_items = getCartItemsByCustomerController($customer_id);

// // displpay the fetched cart items
// echo json_encode(['success' => true, 'cart_items' => $cart_items]);

// Check if there are items in the cart
if ($cart_items && count($cart_items) > 0) {
    // Prepare response with the cart items
    $response = [
        'success' => true,
        'cart_items' => $cart_items
    ];
} else {
    // If no items in the cart
    $response = [
        'success' => false,
        'message' => 'Your cart is empty.'
    ];
}

// Output the response as JSON
echo json_encode($response);
