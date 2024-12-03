<?php
include_once(realpath('../classes/cart_class.php')); // Correct the path to your Cart class file

$cart = new Cart(); // Instantiate the Cart object globally

// Add Product to Cart Controller
function addProductToCartController($customer_id, $product_id, $quantity = 1)
{
    global $cart;
    return $cart->addToCart($customer_id, $product_id, $quantity);
}

function getCartItemsByCustomerController($customer_id)
{
    global $cart;
    return $cart->getCartByCustomer($customer_id);
}

// Remove a product from the cart
function removeProductFromCartController($customer_id, $product_id)
{
    global $cart;

    // Remove the product from the cart and update the stock
    $result = $cart->removeFromCart($customer_id, $product_id);

    if (!$result) {
        error_log("Failed to remove product from cart and/or update stock for product_id = $product_id");
    }

    return $result;
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

// Calculate Total Cart Value
function calculateCartTotalController($customer_id)
{
    global $cart;

    // Fetch the cart items
    $cartItems = $cart->getCartByCustomer($customer_id);

    // Calculate the total
    $total = 0;
    foreach ($cartItems as $item) {
        $total += $item['product_price'] * $item['qty'];
    }

    return $total;
}

function clearCartController($customer_id)
{
    global $cart;
    return $cart->clearCart($customer_id);
}

function getCartItemByCustomerAndProductController($customer_id, $product_id)
{
    global $cart;
    return $cart->getCartItemByCustomerAndProduct($customer_id, $product_id);
}

// Get all items in the cart for a specific customer
function getCartItemsByCustomerId($customerId)
{
    global $cart;
    return $cart->getCartItemsByCustomerId($customerId);  // Return an array of cart items for the given customer ID
}

// Get the latest unpaid order for a customer
function getLatestUnpaidOrderController($customerId)
{
    global $order;
    return $order->getLatestUnpaidOrder($customerId);  // Returns the latest unpaid order for a specific customer
}
