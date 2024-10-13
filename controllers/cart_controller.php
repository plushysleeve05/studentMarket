<?php
include_once '../classes/cart_class.php';

$cart = new Cart();

// Add Product to Cart Controller
function addProductToCartController($customer_id, $product_id)
{
    global $cart;

    // Check if the customer ID and product ID are valid
    if ($customer_id && $product_id) {
        // Call the model's addToCart method to add the product to the cart
        return $cart->addToCart($customer_id, $product_id);
    }

    // Return false if there is any issue
    return false;
}

// Get Cart Items by Customer ID Controller
function getCartItemsByCustomerController($customer_id)
{
    global $cart;

    // Fetch the cart items using the model
    return $cart->getCartByCustomer($customer_id);
}

// Remove a product from the cart
function removeProductFromCartController($customer_id, $product_id)
{
    global $cart;

    // Call the model to remove the product from the cart
    return $cart->removeFromCart($customer_id, $product_id);
}

// Update the quantity of a product in the cart
function updateProductQuantityInCartController($customer_id, $product_id, $quantity)
{
    global $cart;

    // Validate the quantity
    if ($quantity > 0) {
        // Call the model to update the product quantity
        return $cart->updateCartQuantity($customer_id, $product_id, $quantity);
    }

    // If quantity is 0 or invalid, remove the product from the cart
    return removeProductFromCartController($customer_id, $product_id);
}
