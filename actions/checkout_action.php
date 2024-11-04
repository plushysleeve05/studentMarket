<?php
session_start();

// Check if the customer is logged in
if (!isset($_SESSION['customer_id'])) {
    header('Location: ../views/login.php');
    exit();
}

$customer_id = $_SESSION['customer_id'];

// Include necessary classes
include_once '../classes/order_class.php';
include_once '../classes/cart_class.php';

// Instantiate Order and Cart classes
$order = new Order();
$cart = new Cart();

// Step 1: Create a new order
$invoiceNo = "INV" . uniqid();  // Generate a unique invoice number
$orderDate = date('Y-m-d H:i:s');
$status = "pending";

// Insert the new order into the orders table
$orderId = $order->createOrder($customer_id, $invoiceNo, $orderDate, $status);

if ($orderId) {
    // Step 2: Get the cart items for the customer
    $cartItems = $cart->getCartByCustomer($customer_id);

    // Step 3: Add each cart item to the orderdetails table
    foreach ($cartItems as $item) {
        $order->addOrderDetails($orderId, $item['p_id'], $item['qty']);
    }

    // Step 4: Clear the cart after transferring items to the order
    // $cart->clearCartByCustomer($customer_id);

    // Step 5: Redirect to the order confirmation page with the new order ID
    header("Location: ../view/order_confirmation.php?order_id=" . $orderId);
    exit();
} else {
    echo "Failed to create order. Please try again.";
}
