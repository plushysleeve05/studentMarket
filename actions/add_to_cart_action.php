<?php
session_start(); // Start the session

// Check if the customer is logged in
if (!isset($_SESSION['customer_id'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to add items to the cart.']);
    exit();
}

include_once 'controllers/cart_controller.php';

$customer_id = $_SESSION['customer_id'];
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : null;

if ($product_id) {
    // Call the controller to add the product to the cart
    $success = addProductToCartController($customer_id, $product_id);
    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Product added to cart successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add product to cart.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid product ID.']);
}
