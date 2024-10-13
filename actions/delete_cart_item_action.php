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

// Get the product ID from the form submission
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Call the controller to remove the product from the cart
    $result = removeProductFromCartController($customer_id, $product_id);

    if ($result) {
        // Redirect back to the cart page
        header('Location: ../view/view_cart.php');
        exit();
    } else {
        echo "Error removing item from cart.";
    }
} else {
    echo "Invalid input.";
}
?>