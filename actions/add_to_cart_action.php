<?php
session_start();

// Check if the customer is logged in
if (!isset($_SESSION['customer_id'])) {
    header('Location: ../views/login.php');
    exit();
}

// Get the customer ID and product ID
$customer_id = $_SESSION['customer_id'];
$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;

if ($product_id) {
    // Include the cart controller
    include_once '../controllers/cart_controller.php';

    // Use the controller to add the product to the cart
    if (addProductToCartController($customer_id, $product_id)) {
        // Redirect back to the products page with a success message
        header('Location: ../view/view_cart.php?message=Product added to cart successfully');
    } else {
        // Redirect back to the products page with an error message
        header('Location: ../view/view_products.php?error=Failed to add product to cart');
    }
}
