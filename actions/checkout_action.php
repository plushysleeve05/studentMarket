<?php
session_start();

include_once '../classes/order_class.php';
include_once '../controllers/cart_controller.php';

if (!isset($_SESSION['customer_id'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to proceed with checkout.']);
    exit();
}

$customer_id = $_SESSION['customer_id'];
$invoice_no = uniqid();
$order_date = date('Y-m-d H:i:s');
$status = "Pending";

// Create an order
$order = new Order();
$orderId = $order->createOrder($customer_id, $invoice_no, $order_date, $status);

if (!$orderId) {
    echo json_encode(['success' => false, 'message' => 'Failed to create order.']);
    exit();
}

// Fetch all cart items for this customer
$cartItems = getCartItemsByCustomerController($customer_id);

if (!$cartItems || count($cartItems) === 0) {
    echo json_encode(['success' => false, 'message' => 'Your cart is empty.']);
    exit();
}

// Add each cart item to the order details
foreach ($cartItems as $item) {
    $product_id = $item['p_id'];
    $qty = $item['qty'];
    if (!$order->addOrderDetails($orderId, $product_id, $qty)) {
        echo json_encode(['success' => false, 'message' => 'Failed to add item to order details.']);
        exit();
    }
}

// Clear the cart after the order has been created successfully
clearCartController($customer_id);

echo json_encode(['success' => true, 'message' => 'Order successfully placed.', 'order_id' => $orderId]);
