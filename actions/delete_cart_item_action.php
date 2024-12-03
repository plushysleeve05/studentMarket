<?php
session_start();

include_once '../controllers/cart_controller.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $customer_id = $_SESSION['customer_id'] ?? null;

    if ($product_id && $customer_id) {
        // Remove product from cart
        $success = removeProductFromCartController($customer_id, $product_id);

        if ($success) {
            echo json_encode(['success' => true, 'message' => 'Product removed successfully']);
        } else {
            error_log("Failed to remove product from cart: product_id = $product_id");
            echo json_encode(['success' => false, 'message' => 'Failed to remove product from cart.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid product ID or customer session.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
