<?php
session_start(); // Start the session

// Check if the customer is logged in
if (!isset($_SESSION['customer_id'])) {
    // Respond with JSON indicating login is required
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'You must be logged in to add items to the cart.']);
    exit();
}

include_once '../controllers/cart_controller.php';

$customer_id = $_SESSION['customer_id'];
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : null;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1; // Get the quantity from the request

if ($product_id && $quantity > 0) {
    // Debugging: Log the incoming request
    error_log("Add to cart request: customer_id={$customer_id}, product_id={$product_id}, quantity={$quantity}");

    // Call the controller to add the product to the cart
    $result = addProductToCartController($customer_id, $product_id, $quantity);

    // Respond with JSON based on the result
    header('Content-Type: application/json');
    if ($result['success']) {
        echo json_encode(['success' => true, 'message' => $result['message']]);
    } else {
        echo json_encode(['success' => false, 'message' => $result['message']]);
    }
} else {
    // Invalid product ID or quantity received
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Invalid product ID or quantity.']);
}
