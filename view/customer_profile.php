<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/customer_profile.css">
</head>


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
                <a href="cart.php" class="cart-button">
                    <img src="../images/cart.svg" alt="Cart" />
                </a>
                <a href="view/signup.php" class="account-button">
                    <img src="../images/profile2.svg" alt="Account" />
                </a>
            </div>
            <div class="right-div"></div>
        </nav>



        <div class="user-details-container">
            <!-- Account Strip -->
            <div class="account-strip">
                <div class="account-info">
                    <h2>Personal Information</h2>
                    <p>Manage your personal information, including phone numbers and email addresses.</p>
                </div>
                <div class="signout-button">
                    <a href="logout.php" class="btn-signout">Sign Out</a>
                </div>
            </div>

            <div class="user-info-container">
                <!-- sider bar menu -->
                <div class="left-sidebar">
                    <!-- user profile section(image and name) -->
                    <div class="user-profile">
                        <img src="../images/profile2.svg" alt="Profile" class="profile-image" />
                        <h3 class="profile-name">John Doe</h3>
                        <div class="user-email">name@email.com</div>
                    </div>

                    <!-- navigation links to other profile section -->
                    <nav class="sidebar-menu">
                        <ul>
                            <li><a href="customer_profile.php?section=personal_information" class="menu-item">Personal Information</a></li>
                            <li><a href="customer_profile.php?section=order_history" class="menu-item">Order History</a></li>
                            <li><a href="customer_profile.php?section=gift_cards" class="menu-item">Gift Cards</a></li>
                        </ul>
                    </nav>
                </div>



                <!-- Section Details 1 -->
                <div class="section-details" id="personal_information" style="display: block;">
                    <h3>Personal Student Information</h3>
                    <p>Manage your personal information, including phone numbers and email address where you can be contacted</p>
                </div>

                <div class="section-details" id="order_history" style="display: none;">
                    <!-- Order history content -->
                </div>

            </div>

        </div>

        <!-- Contact Section -->
        <footer class="contact-section">
            <h2>Contact Us</h2>
            <p>Email: info@studentmarketplace.com | Phone: +223 552 567 973</p>
            <div class="social-icons">
                <a href="#"><img src="images/facebook-icon.svg" alt="Facebook"></a>
                <a href="#"><img src="images/twitter-icon.svg" alt="Twitter"></a>
                <a href="#"><img src="images/instagram-icon.svg" alt="Instagram"></a>
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