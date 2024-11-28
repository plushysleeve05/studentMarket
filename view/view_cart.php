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
                <!-- logo placeholder -->
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
                <!-- Cart and Account Buttons -->
                <div class="nav-icons">
                    <a href="view/signup.php" class="account-button">
                        <img src="../images/profile2.svg" alt="Account" />
                    </a>
                </div>
                <div class="right-div"></div>
            </nav>

            <div class="login-banner">
                <div class="banner-content">
                    <h1>Shopping Cart</h1>
                    <p>Home - Shopping Cart</p>
                </div>
            </div>

            <!-- main cart table -->
            <div class="cart-page-container">
                <!-- Cart Table Section -->
                <div class="cart-items-section">
                    <h2>Shopping Cart</h2>
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><img src="../images/food1.jpg" alt="Product Image"></td>
                                <td>Product Name</td>
                                <td>$29.00 USD</td>
                                <td>
                                    <div class="quantity-section">
                                        <button type="button" class="quantity-button minus">-</button>
                                        <input type="number" class="quantity-input" value="1" min="1">
                                        <button type="button" class="quantity-button plus">+</button>
                                    </div>
                                </td>

                                <td>$29.00 USD</td>
                            </tr>

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
                        <p>$29.00 USD</p>
                        <small>Taxes and shipping calculated at checkout</small>
                    </div>
                    <button class="checkout-button">Check Out</button>
                </div>
            </div>

            <!-- end of cart table -->


            <!-- start of footer -->
            <!-- Contact Section -->
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
            <!-- end of footer -->


        </div>
    </div>

    <script>
        // JavaScript to Remove Preloader After Page Load
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            preloader.style.opacity = '0';
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 3000);
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Select all quantity buttons
            const minusButtons = document.querySelectorAll(".quantity-button.minus");
            const plusButtons = document.querySelectorAll(".quantity-button.plus");

            // Function to decrease quantity
            minusButtons.forEach(button => {
                button.addEventListener("click", () => {
                    const quantityInput = button.nextElementSibling; // The input is next to the minus button
                    let currentValue = parseInt(quantityInput.value);

                    if (currentValue > parseInt(quantityInput.min)) {
                        quantityInput.value = currentValue - 1;
                    }
                });
            });

            // Function to increase quantity
            plusButtons.forEach(button => {
                button.addEventListener("click", () => {
                    const quantityInput = button.previousElementSibling; // The input is previous to the plus button
                    let currentValue = parseInt(quantityInput.value);

                    quantityInput.value = currentValue + 1;
                });
            });
        });
    </script>




</body>

</html>