<?php
session_start();

// Check if the customer is logged in
if (!isset($_SESSION['customer_id'])) {
    header('Location: ../views/login.php');
    exit();
}

$customer_id = $_SESSION['customer_id'];

// Include the cart controller
include_once '../controllers/cart_controller.php';

// Get the product ID and the new quantity from the form submission
if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Call the controller to update the cart quantity
    $result = updateProductQuantityInCartController($customer_id, $product_id, $quantity);

    if ($result) {
        // Redirect back to the cart page
        header('Location: ../view/view_cart.php');
        exit();
    } else {
        echo "Error updating cart quantity.";
    }
} else {
    echo "Invalid input.";
}
?>