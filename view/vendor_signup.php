<?php
include_once '../controllers/vendor_controller.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form input values
    $name = $_POST['vendor_name'];
    $email = $_POST['vendor_email'];
    $password = $_POST['vendor_password'];
    $contact = $_POST['vendor_contact'];
    $address = $_POST['vendor_address'];
    $image = 'default_vendor.png'; // Default image for vendor profile
    $joinDate = date("Y-m-d"); // Current date
    $status = 'Pending'; // Default status for new vendors

    // Register the vendor using the function
    $result = registerVendorController($name, $email, $password, $contact, $address, $image, $joinDate, $status);

    // Check if the registration was successful
    if ($result === "Vendor registered successfully!") {
        // After successful registration, get the new vendor by email
        $newVendor = getVendorByEmailController($email);

        // Save vendor information to the session
        $_SESSION['vendor_id'] = $newVendor['vendor_id'];
        $_SESSION['vendor_name'] = $newVendor['vendor_name'];
        $_SESSION['vendor_email'] = $newVendor['vendor_email'];

        // Redirect to vendor dashboard after successful signup
        header("Location: ../view/vendor_dashboard.php");
        exit();
    } else {
        // Display error message if registration fails
        echo "<script>alert('$result');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Signup</title>
    <link rel="stylesheet" href="../css/signup.css">
</head>

<body>
    <div class="main-container">
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
                    <a href="account.php" class="account-button">
                        <img src="../images/profile2.svg" alt="Account" />
                    </a>
                </div>
                <div class="right-div"></div>
            </nav>

            <div class="login-banner">
                <div class="banner-content">
                    <h1>Vendor - Sign Up</h1>
                    <p>Join our platform to sell your products to a wider audience.</p>
                </div>
            </div>

            <div class="auth-container">
                <form action="../actions/vendor_signup_action.php" method="POST">
                    <h2>Sign Up as a Vendor</h2>

                    <label for="vendor_name">Name</label>
                    <input type="text" name="vendor_name" placeholder="Enter your full name" required>

                    <label for="vendor_email">Email</label>
                    <input type="email" name="vendor_email" placeholder="Enter your email address" required>

                    <label for="vendor_password">Password</label>
                    <input type="password" name="vendor_password" placeholder="Enter your password" required>

                    <label for="vendor_contact">Contact</label>
                    <input type="text" name="vendor_contact" placeholder="Enter your contact number" required>

                    <label for="vendor_address">Address</label>
                    <input type="text" name="vendor_address" placeholder="Enter your address" required>

                    <button type="submit">CREATE</button>
                </form>

                <div class="signup-container">
                    <p>Already have an account? <a href="vendor_login.php">Login</a></p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>