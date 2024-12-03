<?php
include_once '../classes/vendor_class.php';
include_once '../controllers/vendor_controller.php';

session_start();

if (!isset($_SESSION['vendor_id'])) {
    // Redirect to login page if not authenticated
    header("Location: vendor_login.php");
    exit;
}

$vendor = new Vendor();
$vendorData = $vendor->getVendorById($_SESSION['vendor_id']); // Fetch vendor data using session vendor ID

if (!$vendorData) {
    echo "Error fetching vendor data or vendor not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Profile</title>
    <link rel="stylesheet" href="../css/vendor_profile.css">
    <style>
        /* Navigation Logo */
        .nav-logo {
            height: 200px;
            width: auto;
            object-fit: contain;
            background-color: none;
        }

        /* Search Bar Styling */
        .search-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 10vh;
            color: white;
            width: 80%;
        }

        .search-bar input {
            width: 80%;
            height: 45px;
            border-radius: 25px;
            border: none;
            padding: 0 20px;
            font-size: 1.2rem;
            outline: none;
        }

        .nav-icons {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        .nav-icons img {
            height: 120px;
        }

        .navigation {
            z-index: 1000;
            background-color: #ffffff;
            width: 100%;
            top: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            height: 9vh;
            /* position: sticky; */
        }

        /* Styles for the n-two nav */
        .n-two {
            width: 80%;
            display: flex;
            justify-content: left;
            align-items: center;
            height: auto;
            margin: 0;
            padding: 0;
            position: sticky;
        }

        .n-two ul {
            list-style-type: none;
            display: flex;
            gap: 40px;
            margin: 0;
            padding: 0;
        }

        .n-two ul li {
            display: inline-block;
        }

        .n-two ul li a {
            text-decoration: none;
            color: #4b6043;
            font-size: 16px;
            font-weight: bold;
            padding: 5px 10px;
            transition: color 0.3s ease;
        }

        .n-two ul li a:hover {
            color: #65a551;
        }


        body {
            font-family: "Arial", sans-serif;
            background-color: #f4f7f6;
            color: #4b6043;
            line-height: 1.5;
            width: 80vw;
            justify-self: center;
        }

        .main-container {
            margin: 0 auto;
            width: 80%;
            padding: 20px;
        }

        .navigation {
            background-color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .nav-logo {
            height: 100px;
        }

        /* Account Info Strip */
        .account-strip {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #65a551;
            color: #ffffff;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .btn-signout {
            background-color: #ffffff;
            color: #4b6043;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        /* Sidebar */
        .left-sidebar {
            width: 30%;
            float: left;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
        }

        .user-profile img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .sidebar-menu ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar-menu li {
            margin: 10px 0;
        }

        .menu-item {
            text-decoration: none;
            color: #4b6043;
        }

        /* Personal Information Section */
        .section-details {
            width: 65%;
            float: right;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
        }

        .info-card {
            padding: 15px;
            background-color: #f4f7f6;
            border: 1px solid #dddddd;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .info-card h4 {
            margin-bottom: 5px;
            color: #36582b;
        }

        .info-card input[type="text"],
        .info-card input[type="email"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .update-profile-button {
            display: block;
            margin: 20px 0;
            padding: 15px;
            background-color: #65a551;
            color: #ffffff;
            text-align: center;
            text-decoration: none;
            border-radius: 10px;
            cursor: pointer;
        }

        /* Footer Styling */
        .main-footer {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 40px;
            background-color: #6da54c57;
            height: 40vh;
        }

        .main-footer h2 {
            margin: 0 0 0px 0px;
            font-size: 30px;
        }

        /* Contact Section Styling */
        .contact-section {
            flex: 1 1 300px;
            padding: 20px;
            text-align: center;
        }

        .contact-section .social-icons {
            margin-top: 20px;
        }

        .contact-section .social-icons a {
            margin: 0 10px;
            display: inline-block;
        }

        .contact-section .social-icons img {
            width: 40px;
        }

        /* Newsletter Section Styling */
        .newsletter-section {
            flex: 1 1 300px;
            padding: 20px;
            text-align: center;
        }

        .newsletter-section form {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .newsletter-section input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 200px;
        }

        .newsletter-section button {
            background-color: #65a551;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }

        /* Quick Links Section Styling */
        .quick-links-section {
            flex: 1 1 200px;
            padding: 20px;
            text-align: center;
        }

        .quick-links-section ul {
            list-style: none;
        }

        .quick-links-section ul li {
            margin: 10px 0;
        }

        .quick-links-section ul li a {
            color: #4b6043;
            text-decoration: none;
            font-weight: bold;
        }

        .quick-links-section ul li a:hover {
            color: #36582b;
        }
    </style>
</head>

<body>
    <div id="main-container">
        <!-- Navigation Bar -->
        <nav class="navigation">
            <img src="../images/STMarketPlace2.svg" alt="Logo" class="nav-logo" />
            <nav class="n-two">
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="view_products.php">Products</a></li>
                </ul>
            </nav>
            <form action="search.php" method="get" class="search-bar">
                <input type="text" name="query" placeholder="Search...">
            </form>

        </nav>

        <!-- Main Content -->
        <div id="vendor-details-container" class="vendor-details-container">
            <div id="account-strip" class="account-strip">
                <div id="account-info" class="account-info">
                    <h2>Welcome, <?php echo htmlspecialchars($vendorData['vendor_name']); ?></h2>
                    <p>Manage your profile and products here.</p>
                </div>
                <div id="signout-button" class="signout-button">
                    <a href="../actions/logout.php" class="btn-signout">Sign Out</a>
                </div>
            </div>

            <div id="user-info-container" class="user-info-container">
                <!-- Sidebar Menu -->
                <div id="left-sidebar" class="left-sidebar">
                    <div id="user-profile" class="user-profile">
                        <img src="../images/<?php echo htmlspecialchars($vendorData['vendor_image']); ?>" alt="Profile Picture" class="profile-image">
                        <h3 id="profile-name" class="profile-name"><?php echo htmlspecialchars($vendorData['vendor_name']); ?></h3>
                        <div id="user-email" class="user-email"><?php echo htmlspecialchars($vendorData['vendor_email']); ?></div>
                    </div>

                    <nav id="sidebar-menu" class="sidebar-menu">
                        <ul>
                            <li><a href="vendor_profile.php?section=personal_information" class="menu-item" id="personal-info-link">Personal Information</a></li>
                            <li><a href="vendor_dashboard.php" class="menu-item" id="product-management-link">Manage Products</a></li>
                        </ul>
                    </nav>
                </div>

                <!-- Section Details -->
                <div id="section-details" class="section-details">
                    <!-- Personal Information Section -->
                    <div id="personal_information-section" style="display: block;">
                        <h3>Personal Information</h3>
                        <p>Manage your personal information, including phone numbers and email addresses.</p>

                        <!-- Form to Edit Personal Information -->
                        <form action="../actions/update_vendor_profile.php" method="POST">
                            <div class="info-card">
                                <h4>Name</h4>
                                <input type="text" name="vendor_name" value="<?php echo htmlspecialchars($vendorData['vendor_name']); ?>" required>
                            </div>
                            <div class="info-card">
                                <h4>Email</h4>
                                <input type="email" name="vendor_email" value="<?php echo htmlspecialchars($vendorData['vendor_email']); ?>" required>
                            </div>
                            <div class="info-card">
                                <h4>Contact</h4>
                                <input type="text" name="vendor_contact" value="<?php echo htmlspecialchars($vendorData['vendor_contact']); ?>">
                            </div>
                            <button type="submit" class="update-profile-button" name="update_vendor">Update Profile</button>
                        </form>
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

    <script src="../js/vendor_profile.js" defer></script>
</body>

</html>