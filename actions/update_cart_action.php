<?php
session_start(); // Start the session

// Include necessary files
include_once '../controllers/cart_controller.php';
include_once '../controllers/product_controller.php';

// Check if the customer is logged in
if (!isset($_SESSION['customer_id'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to update the cart.']);
    exit();
}

$customer_id = $_SESSION['customer_id'];
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : null;
$new_quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : null;

if ($product_id && $new_quantity !== null) {
    // Get the current quantity of the product in the cart
    $cart_item = getCartItemByCustomerAndProductController($customer_id, $product_id);
    if (!$cart_item) {
        echo json_encode(['success' => false, 'message' => 'Product not found in cart.']);
        exit();
    }
    $current_quantity = $cart_item['qty'];

    // Update the stock in the database
    $quantity_difference = $new_quantity - $current_quantity;

    if ($quantity_difference !== 0) {
        $product = getProductByIdController($product_id);
        if ($product) {
            $new_stock = $product['stock'] - $quantity_difference;
            if ($new_stock >= 0) {
                // Update the stock in the products table
                updateProductStockController($product_id, $new_stock);

                // Update the quantity in the cart
                if (updateProductQuantityInCartController($customer_id, $product_id, $new_quantity)) {
                    echo json_encode(['success' => true, 'message' => 'Cart updated successfully.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update cart.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Insufficient stock available.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Product not found.']);
        }
    } else {
        echo json_encode(['success' => true, 'message' => 'No changes made.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid product ID or quantity.']);
}
