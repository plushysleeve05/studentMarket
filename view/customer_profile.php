<?php
include_once '../classes/customer_class.php';
include_once '../controllers/customer_controller.php';

session_start();

if (!isset($_SESSION['customer_id'])) {
    // Redirect to login page if not authenticated
    header("Location: login.php");
    exit;
}

$customer = new Customer();
$customerData = $customer->getCustomerByEmail($_SESSION['user_email']); // Fetch customer data using session email

if (!$customerData) {
    echo "Error fetching customer data.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Profile</title>
    <link rel="stylesheet" href="../css/customer_profile.css">
</head>

<body>
    <div id="main-container">
        <!-- Navigation Bar -->
        <nav id="navigation" class="navigation">
            <img src="../images/STMarketPlace2.svg" alt="Logo" class="nav-logo" />
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <form action="search.php" method="get" id="search-bar" class="search-bar">
                <input type="text" name="query" placeholder="Search...">
            </form>
            <div id="nav-icons" class="nav-icons">
                <a href="cart.php" class="cart-button">
                    <img src="../images/cart.svg" alt="Cart">
                </a>
                <a href="view/signup.php" class="account-button">
                    <img src="../images/profile2.svg" alt="Account">
                </a>
            </div>
        </nav>

        <!-- Main Content -->
        <div id="user-details-container" class="user-details-container">
            <!-- Account Info Strip -->
            <div id="account-strip" class="account-strip">
                <div id="account-info" class="account-info">
                    <h2>Welcome, <?php echo htmlspecialchars($customerData['customer_name']); ?></h2>
                    <p>Manage your personal information, orders, and more.</p>
                </div>
                <div id="signout-button" class="signout-button">
                    <a href="logout.php" class="btn-signout">Sign Out</a>
                </div>
            </div>

            <div id="user-info-container" class="user-info-container">
                <!-- Sidebar Menu -->
                <div id="left-sidebar" class="left-sidebar">
                    <div id="user-profile" class="user-profile">
                        <img src="../images/<?php echo htmlspecialchars($customerData['customer_image']); ?>" alt="Profile Picture" class="profile-image">
                        <h3 id="profile-name" class="profile-name"><?php echo htmlspecialchars($customerData['customer_name']); ?></h3>
                        <div id="user-email" class="user-email"><?php echo htmlspecialchars($customerData['customer_email']); ?></div>
                    </div>

                    <!-- Sidebar Links -->
                    <nav id="sidebar-menu" class="sidebar-menu">
                        <ul>
                            <li><a href="customer_profile.php?section=personal_information" class="menu-item" id="personal-info-link">Personal Information</a></li>
                            <li><a href="customer_profile.php?section=order_history" class="menu-item" id="order-history-link">Order History</a></li>
                            <li><a href="customer_profile.php?section=gift_cards" class="menu-item" id="gift-cards-link">Gift Cards</a></li>
                        </ul>
                    </nav>
                </div>

                <!-- Section Details -->
                <div id="section-details" class="section-details">
                    <!-- Content dynamically loaded by JavaScript -->
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer id="contact-section" class="contact-section">
            <h2>Contact Us</h2>
            <p>Email: info@studentmarketplace.com | Phone: +223 552 567 973</p>
            <div id="social-icons" class="social-icons">
                <a href="#"><img src="../images/facebook-icon.svg" alt="Facebook"></a>
                <a href="#"><img src="../images/twitter-icon.svg" alt="Twitter"></a>
                <a href="#"><img src="../images/instagram-icon.svg" alt="Instagram"></a>
            </div>
        </footer>
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
    <script src="../js/customer_profile.js" defer></script>
</body>

</html>