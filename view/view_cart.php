<?php
session_start();

// Check if the customer is logged in
if (!isset($_SESSION['customer_id'])) {
    header('Location: ../views/login.php');
    exit();
}

$customer_id = $_SESSION['customer_id'];

// Include the cart model
include_once '../classes/cart_class.php';
$cart = new Cart();

// Get the cart items for the logged-in customer
$cartItems = $cart->getCartByCustomer($customer_id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="../css/cart-style.css">
</head>

<body>
    <div class="container">
        <h1>Your Cart</h1>

        <!-- Display the customer ID -->
        <p>Customer ID: <?php echo htmlspecialchars($customer_id); ?></p>

        <?php if (!empty($cartItems)): ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['product_title']); ?></td>
                            <td><?php echo number_format($item['product_price'], 2); ?></td>
                            <td>
                                <!-- Update form -->
                                <form action="../actions/update_cart_action.php" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($item['p_id']); ?>">
                                    <input type="number" name="quantity" value="<?php echo htmlspecialchars($item['qty']); ?>" min="1">
                                    <button type="submit">Update</button>
                                </form>
                            </td>
                            <td><?php echo number_format($item['product_price'] * $item['qty'], 2); ?></td>
                            <td>
                                <!-- Delete form -->
                                <form action="../actions/delete_cart_item_action.php" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($item['p_id']); ?>">
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Updated Proceed to Checkout button -->
            <form action="../actions/checkout_action.php" method="POST">
                <button type="submit" class="checkout-btn">Proceed to Checkout</button>
            </form>
        <?php else: ?>
            <p>Your cart is empty.</p>
            <button><a href="view_products.php">VIEW PRODUCTS</a></button>
        <?php endif; ?>
    </div>
</body>

</html>