<?php
include_once '../controllers/vendor_controller.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['vendor_email'];
    $password = $_POST['vendor_pass']; // Plain password

    // Authenticate the vendor using the function
    if (authenticateVendorController($email, $password)) {
        header("Location: ../view/vendor_dashboard.php"); // Redirect to vendor dashboard on successful login
        exit();
    } else {
        echo "<script>alert('Invalid email or password!');</script>";
    }

    // Debugging: Check current session values
    error_log("Session after attempting login: " . print_r($_SESSION, true));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Login</title>
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
                    <h1>Vendor - Login</h1>
                    <p>Access vendor features and manage your products by logging in.</p>
                </div>
            </div>

            <!-- form section -->
            <div class="auth-container">
                <form action="../actions/vendor_login_action.php" method="POST">
                    <h2>Vendor Login</h2>
                    <p class="banner-cnt-subtext">Please enter your vendor account details</p><br><br>
                    <label for="vendor_email">Email</label>
                    <input type="email" name="vendor_email" required>

                    <label for="vendor_pass">Password</label>
                    <input type="password" name="vendor_password" required>

                    <button type="submit">Login</button>
                    <a class="forgot-password" href="vendor_signup.php">Forgot Password?</a>
                </form>

                <div class="signup-container">
                    <p>Don't have a vendor account? <a href="vendor_signup.php">Sign up</a></p>
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