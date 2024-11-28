<!-- <?php
        include_once '../controllers/customer_controller.php';
        session_start();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['customer_name'];
            $email = $_POST['customer_email'];
            $password = $_POST['customer_pass'];
            $country = $_POST['customer_country'];
            $city = $_POST['customer_city'];
            $contact = $_POST['customer_contact'];
            $image = 'default.png'; // Optional image handling
            $role = 'customer'; // Default role

            // Register the customer using the function
            $result = registerCustomerController($name, $email, $password, $country, $city, $contact, $image, $role);

            // Check if the registration was successful
            if ($result === "Customer registered successfully!") {
                $_SESSION['customer_id'] = getCustomerByIDController($email)['customer_id']; // Save customer ID to session
                header("Location: ../view/login.php"); // Redirect after successful signup
                exit();
            } else {
                // Display error message
                echo "<script>alert('$result');</script>";
            }
        }
        ?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
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
                    <h1>Account - Sign Up</h1>
                    <p>Join the community. </p>
                </div>
            </div>

            <div class="auth-container">
                <form action="signup.php" method="POST">
                    <h2>Sign Up</h2>

                    <label for="customer_name">Name</label>
                    <input type="text" name="customer_name" placeholder="Enter your full name" required>

                    <label for="customer_email">Email</label>
                    <input type="email" name="customer_email" placeholder="Enter your email address" required>

                    <label for="customer_pass">Password</label>
                    <input type="password" name="customer_pass" placeholder="Enter your password" required>

                    <label for="customer_country">Country</label>
                    <input type="text" name="customer_country" placeholder="Enter your country" required>

                    <label for="customer_city">City</label>
                    <input type="text" name="customer_city" placeholder="Enter your city" required>

                    <label for="customer_contact">Contact</label>
                    <input type="text" name="customer_contact" placeholder="Enter your contact number" required>

                    <button type="submit">CREATE </button>
                    
                </form>

                <div class="signup-container">
                    <p>Already have an account? <a href="login.php">Login</a></p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>