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
        <nav class="navigation">
            <div class="left-div"></div>
            <img src="../images/STMarketPlace2.svg" alt="Logo" class="nav-logo" />
            <nav class="n-two">
                <div class="left-div"></div>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="view_products.php">Products</a></li>
                    <!-- <li><a href="about.php">About</a></li> -->
                    <!-- <li><a href="customer_profile.php#contact-section">Contact</a></li> -->
                </ul>
                <div class="right-div"></div>
            </nav>
            <form action="search.php" method="get" class="search-bar">
                <input type="text" name="query" placeholder="Search...">
            </form>
            <div class="nav-icons">
                <div class="cart-button" id="open-cart-button">
                    <img src="../images/cart.svg" alt="Cart" />
                </div>
            </div>
            <div class="right-div"></div>
        </nav>

        <!-- Main Content -->
        <div id="user-details-container" class="user-details-container">
            <div id="account-strip" class="account-strip">
                <div id="account-info" class="account-info">
                    <h2>Welcome, <?php echo htmlspecialchars($customerData['customer_name']); ?></h2>
                    <p>Manage your personal information, orders, and more.</p>
                </div>
                <div id="signout-button" class="signout-button">
                    <a href="../actions/logout.php" class="btn-signout">Sign Out</a>
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
                    <!-- Personal Information Section -->
                    <div id="personal_information-section" style="display: block;">
                        <h3>Personal Information</h3>
                        <p>Manage your personal information, including phone numbers and email addresses.</p>
                        <div class="info-cards">
                            <div class="info-card">
                                <h4>Name</h4>
                                <p><?php echo htmlspecialchars($customerData['customer_name']); ?></p>
                                <a href="#" class="edit-info">Edit</a>
                            </div>
                            <div class="info-card">
                                <h4>Email</h4>
                                <p><?php echo htmlspecialchars($customerData['customer_email']); ?></p>
                                <a href="#" class="edit-info">Edit</a>
                            </div>
                            <div class="info-card">
                                <h4>Country</h4>
                                <p><?php echo htmlspecialchars($customerData['customer_country']); ?></p>
                                <a href="#" class="edit-info">Edit</a>
                            </div>
                            <div class="info-card">
                                <h4>City</h4>
                                <p><?php echo htmlspecialchars($customerData['customer_city']); ?></p>
                                <a href="#" class="edit-info">Edit</a>
                            </div>
                            <div class="info-card">
                                <h4>Contact</h4>
                                <p><?php echo htmlspecialchars($customerData['customer_contact']); ?></p>
                                <a href="#" class="edit-info">Edit</a>
                            </div>
                        </div>
                    </div>

                    <!-- Order History Section -->
                    <div id="order_history-section" style="display: none;">
                        <h3>Order History</h3>
                        <p>View and track your previous orders below.</p>
                        <table class="order-table">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Item</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#1234</td>
                                    <td>Wireless Headphones</td>
                                    <td>2024-11-15</td>
                                    <td>Delivered</td>
                                    <td><a href="#" class="track-order">Track Order</a></td>
                                </tr>
                                <tr>
                                    <td>#1235</td>
                                    <td>Smart Watch</td>
                                    <td>2024-11-18</td>
                                    <td>In Transit</td>
                                    <td><a href="#" class="track-order">Track Order</a></td>
                                </tr>
                                <tr>
                                    <td>#1236</td>
                                    <td>Bluetooth Speaker</td>
                                    <td>2024-11-20</td>
                                    <td>Cancelled</td>
                                    <td><a href="#" class="track-order">Track Order</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <!-- Gift Cards Section -->
                    <div id="gift_cards-section" style="display: none;">
                        <h3>Gift Cards</h3>
                        <p>You currently have no gift cards available.</p>
                        <button class="redeem-button">Redeem Gift Card</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <div class="contact-section">
                <h2>Contact Us</h2>
                <p>Email: info@studentmarketplace.com <br>Phone: +233 55 256 7973</p>
                <div class="social-icons">
                    <a href="#"><img src="../images/icons8-facebook.svg" alt="Facebook"></a>
                    <a href="#"><img src="../images/icons8-twitter.svg" alt="Twitter"></a>
                    <a href="#"><img src="../images/icons8-instagram.svg" alt="Instagram"></a>
                </div>
            </div>
        </footer>
    </div>

    <script src="../js/customer_profile.js" defer></script>
</body>

</html>