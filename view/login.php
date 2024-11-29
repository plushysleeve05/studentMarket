<?php
include_once '../controllers/customer_controller.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['customer_email'];
    $password = $_POST['customer_pass']; // Plain password

    // Authenticate the customer using the function
    if (authenticateCustomerController($email, $password)) {
        header("Location: ../view/view_products.php"); // Redirect to products page on successful login
        exit();
    } else {
        echo "<script>alert('Invalid email or password!');</script>";
    }
}

// Debugging: Check current session values
error_log("Session after attempting login: " . print_r($_SESSION, true));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
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
                        <li><a href="view_products.php">Products</a></li>
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
                    <a href="cart.php" class="cart-button">
                        <img src="../images/cart.svg" alt="Cart" />
                    </a>
                    <a href="view/signup.php" class="account-button">
                        <img src="../images/profile2.svg" alt="Account" />
                    </a>
                </div>
                <div class="right-div"></div>
            </nav>

            <div class="login-banner">
                <div class="banner-content">
                    <h1>Account - Login</h1>
                    <p>Access exclusive student discounts and offers by logging in.</p>
                </div>
            </div>

            <!-- form section -->
            <div class="auth-container">
                <form action="login.php" method="POST">
                    <h2>Login Account</h2>
                    <p class="banner-cnt-subtext">please enter your account details</p><br><br>
                    <label for="customer_email">Email</label>
                    <input type="email" name="customer_email" required>

                    <label for="customer_pass">Password</label>
                    <input type="password" name="customer_pass" required>

                    <button type="submit">Login</button>
                    <a class="forgot-password" href="signup.php">Forgot Password?</a>
                </form>

                <div class="signup-container">
                    <p>Don't have an account? <a href="signup.php">Sign up</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript to Remove Preloader After Page Load
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            preloader.style.opacity = '0';
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 1000);
        });
    </script>
</body>

</html>