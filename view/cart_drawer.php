<?php
        include(realpath(__DIR__ . '/../controllers/cart_controller.php'));
        // if user is logged in, store the customer id
        if (isset($_SESSION['customer_id'])) {
            $customer_id = $_SESSION['customer_id'];
        } else {
            $customer_id = null;
        }

// Fetch cart items for the logged-in customer
$cart_items = getCartItemsByCustomerController($customer_id);
?>

<!-- Overlay Div -->
<div id="cart-overlay" class="cart-overlay"></div>

<div id="cart-drawer" class="cart-drawer">
    <div class="cart-header">
        <h2>My Shopping Cart</h2>
        <button id="close-cart-button" class="close-cart">&times;</button>
    </div><br><br>
    <div class="cart-content">
        <!-- Cart Items - Dynamic Content -->
        <?php
        include_once realpath(__DIR__ . '/../controllers/cart_controller.php');
        $customer_id = $_SESSION['customer_id'] ?? null;

        if ($customer_id) {
            $cartItems = getCartItemsByCustomerController($customer_id);
            if ($cartItems && count($cartItems) > 0) {
                foreach ($cartItems as $item) {
                    echo '<div class="cart-item" data-product-id="' . htmlspecialchars($item['p_id']) . '">';
                    // echo '    <img src="' . htmlspecialchars($item['product_image']) . '" alt="' . htmlspecialchars($item['product_title']) . '" class="cart-item-image">';
                    echo '    <div class="cart-item-details">';
                    echo '        <h4>' . htmlspecialchars($item['product_title']) . '</h4>';
                    echo '        <p>$' . number_format($item['product_price'], 2) . '</p>';
                    echo '        <div class="quantity-container">';
                    echo '            <button class="quantity-button minus" data-product-id="' . htmlspecialchars($item['p_id']) . '">-</button>';
                    echo '            <input type="number" value="' . $item['qty'] . '" class="quantity-input" min="1" data-product-id="' . htmlspecialchars($item['p_id']) . '">';
                    echo '            <button class="quantity-button plus" data-product-id="' . htmlspecialchars($item['p_id']) . '">+</button>';
                    echo '        </div>';
                    echo '        <button class="remove-from-cart-button" data-product-id="' . htmlspecialchars($item['p_id']) . '">Remove</button>';
                    echo '    </div>';
                    echo '</div>';
                }
            } else {
                echo '<p>Your cart is empty.</p>';
            }
        } else {
            echo '<p>Please log in to view your cart.</p>';
        }
        ?>
    </div>
    <!-- Order Summary -->
    <div class="cart-footer">
        <textarea placeholder="Order special instructions"></textarea>
        <div class="subtotal">
            <p>Subtotal:</p>
            <p id="cart-drawer-subtotal">$0.00 USD</p>
        </div>
        <div class="terms">
            <input type="checkbox" id="terms-checkbox">
            <label for="terms-checkbox">I have read and agree with the <a href="#">terms & condition</a>.</label>
        </div>
        <div class="cart-actions">
            <button class="view-cart-button" onclick="window.location.href='view_cart.php'">View Cart</button>
            <button class="checkout-button">Checkout</button>
        </div>
    </div>
</div>
<!-- <script src="../js/cart_drawer.js"></script> -->