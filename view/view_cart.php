<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../css/cart-style.css">
</head>

<body>
    <div class="main-container">
        <!-- main page below -->
        <div class="middle-div">
            <nav class="navigation">
                <div class="left-div"></div>
                <!-- Logo -->
                <img src="../images/STMarketPlace2.svg" alt="Logo" class="nav-logo" />
                <nav class="n-two">
                    <div class="left-div"></div>
                    <!-- Navigation Links -->
                    <ul>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="products.php">Products</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                    <div class="right-div"></div>
                </nav>
                <!-- Search Bar -->
                <form action="search.php" method="get" class="search-bar">
                    <input type="text" name="query" placeholder="Search...">
                </form>
                <!-- Cart, Account, and Logout Button -->
                <div class="nav-icons">
                    <!-- Cart Button -->
                    <div class="cart-button" id="open-cart-button">
                        <img src="../images/cart.svg" alt="Cart" />
                    </div>
                    <?php if (isset($_SESSION['customer_id'])): ?>
                        <!-- If customer is logged in, show profile and logout button -->
                        <a href="account.php" class="account-button">
                            <img src="../images/profile2.svg" alt="Account" />
                        </a>
                        <span class="username-display"><?php echo htmlspecialchars($_SESSION['customer_name']); ?></span>
                        <a href="../actions/logout.php" class="logout-button">Logout</a>
                    <?php else: ?>
                        <!-- If not logged in, show login button -->
                        <a href="login.php" class="account-button">
                            <img src="../images/profile2.svg" alt="Login" />
                        </a>
                    <?php endif; ?>
                </div>
                <div class="right-div"></div>
            </nav>

            <div class="login-banner">
                <div class="banner-content">
                    <h1>Shopping Cart</h1>
                    <p>Home - Shopping Cart</p>
                </div>
            </div>

            <!-- Main cart table -->
            <div class="cart-page-container">
                <!-- Cart Table Section -->
                <div class="cart-items-section">
                    <h2>Shopping Cart</h2>
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Product</th>
                                <th>Price (GHS)</th>
                                <th>Quantity</th>
                                <th>Total (GHS)</th>
                            </tr>
                        </thead>
                        <tbody id="cart-items">
                            <!-- Cart items will be injected here via JavaScript -->
                        </tbody>
                    </table>
                    <button class="return-to-store-button" onclick="window.location.href='view_products.php'">Return to Store</button>
                </div>

                <!-- Cart Summary Sidebar -->
                <div class="cart-summary-section">
                    <div class="shipping-estimate">
                        <h3>Summary</h3>
                    </div>
                    <div class="cart-subtotal">
                        <h3>Subtotal</h3>
                        <p id="cart-subtotal">GHS 0.00</p>
                        <small>Taxes and shipping calculated at checkout</small>
                    </div>
                    <button class="checkout-button">Check Out</button>
                </div>
            </div>
            <!-- end of cart table -->

            <!-- Footer -->
            <footer class="main-footer">
                <!-- Contact Section -->
                <div class="contact-section">
                    <h2>Contact Us</h2><br>
                    <p>Email: info@studentmarketplace.com <br>| Phone: +233 55 256 7973 </p>
                    <div class="social-icons">
                        <a href="#"><img src="images/icons8-facebook.svg" alt="Facebook"></a>
                        <a href="#"><img src="images/icons8-twitter.svg" alt="Twitter"></a>
                        <a href="#"><img src="images/icons8-instagram.svg" alt="Instagram"></a>
                    </div>
                </div>
                <!-- Newsletter Section -->
                <section class="newsletter-section">
                    <h2>Stay Updated!</h2>
                    <p>Subscribe to our newsletter for the latest deals and updates.</p>
                    <form action="subscribe.php" method="post">
                        <input type="email" name="email" placeholder="Enter your email" required><br>
                        <button type="submit">Subscribe</button>
                    </form>
                </section>
                <!-- Quick Links Section -->
                <section class="quick-links-section">
                    <h2>Quick Links</h2>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">FAQs</a></li>
                    </ul>
                </section>
            </footer>
            <!-- End of Footer -->

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            loadCartItems();

            function loadCartItems() {
                fetch('../actions/fetch_cart_items.php')
                    .then(response => response.json())
                    .then(data => {
                        console.log('Cart items data:', data); // Debugging line

                        const cartItemsContainer = document.getElementById("cart-items");
                        cartItemsContainer.innerHTML = '';

                        if (data.success && data.cart_items && data.cart_items.length > 0) {
                            let subtotal = 0;

                            data.cart_items.forEach(item => {
                                const itemTotal = item.product_price * item.qty;
                                subtotal += itemTotal;

                                cartItemsContainer.innerHTML += `
                                    <tr class="cart-item" data-product-id="${item.p_id}">
                                        <td><img src="${item.product_image}" alt="${item.product_title}"></td>
                                        <td>${item.product_title}</td>
                                        <td>GHS ${item.product_price.toFixed(2)}</td>
                                        <td>${item.qty}</td>
                                        <td>GHS ${itemTotal.toFixed(2)}</td>
                                    </tr>
                                `;
                            });

                            document.getElementById("cart-subtotal").textContent = `GHS ${subtotal.toFixed(2)}`;
                        } else {
                            console.warn(data.message || 'No items found in cart.');
                            cartItemsContainer.innerHTML = `<tr><td colspan="5">${data.message || 'Your cart is empty.'}</td></tr>`;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching cart items:', error);
                    });
            }
        });
    </script>
    <script>
        document.querySelector('.checkout-button').addEventListener('click', () => {
            fetch('../actions/checkout_action.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        window.location.href = `order_confirmation.php?order_id=${data.order_id}`;
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Checkout failed:', error);
                    alert('Checkout failed. Please try again.');
                });
        });
    </script>

</body>

</html>