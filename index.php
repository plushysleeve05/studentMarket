<?php
session_start(); // Start the session

include 'view/cart_drawer.html';
include 'controllers/categories_controller.php';
include_once 'controllers/product_controller.php';

// Get all categories using the controller function
$categories = getAllCategoriesController();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/index-styles.css">
	<link rel="stylesheet" href="css/cart_drawer_styles.css">

	<title>stMARKET</title>
</head>
<script>
	document.documentElement.style.scrollBehavior = 'smooth';
</script>

<body>
	<!-- HTML for Preloader -->
	<!-- <div id="preloader" style="display: flex; align-items: center; justify-content: center; height: 100vh; width: 100vw; position: fixed; top: 0; left: 0; background-color: #ffffff; z-index: 3000;">
		<img src="images/mainbg.svg" alt="">
	</div> -->

	<div class="main-container">
		<!-- main page below -->
		<div class="middle-div">
			<nav class="navigation">
				<div class="left-div"></div>
				<!-- logo placeholder -->
				<img src="images/STMarketPlace2.svg" alt="Logo" class="nav-logo" />
				<nav class="n-two">
					<div class="left-div"></div>
					<!-- Navigation Links -->
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="view/view_products.php">Products</a></li>
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
					<div class="cart-button" id="open-cart-button">
						<img src="images/cart.svg" alt="Cart" />
					</div>
					<div class="number-of-items-in-cart"></div>
					<?php if (isset($_SESSION['customer_id'])): ?>
						<a href="view/account.php" class="account-button">
							<img src="images/profile2.svg" alt="Account" />
						</a>
						<span class="username-display"><?php echo htmlspecialchars($_SESSION['customer_name']); ?></span>
						<a href="actions/logout.php" class="logout-button">Logout</a>
					<?php else: ?>
						<a href="view/login.php" class="account-button">
							<img src="images/profile2.svg" alt="Login" />
						</a>
					<?php endif; ?>
				</div>
				<div class="right-div"></div>
			</nav>


			<!-- hero section -->
			<div class="hero-sec-container">
				<div class="hero-text">
					<h1 class="catchphrase">Buy, Sell, and Save – Just for Students!</h1>
				</div>
				<div class="hero-buttons">
					<a href="view/view_products.php" class="hero-button">Shop Now</a>
					<a href="view/signup.php" class="hero-button-secondary">Join the community</a>
				</div>
			</div>

			<br><br>

			<!-- banner -->
			<div class="banner-section">
				<div class="banner-container flex-container">
					<div class="banner-cards flex-items f1" onclick="window.location.href='view/view_products.php'">
						<div class="text-content">
							<h2>Get the best deals on electronics</h2>
							<p>Get the best deals on electronics</p>
						</div>
					</div>
					<div class="banner-cards flex-items f2" onclick="window.location.href='view/view_products.php'">
						<div class="text-content">
							<h2>Get the best deals on electronics</h2>
							<p>Get the best deals on electronics</p>
						</div>
					</div>
					<div class="banner-cards flex-items f3" onclick="window.location.href='view/view_products.php'">
						<div class="text-content">
							<h2>Get the best deals on electronics</h2>
							<p>Get the best deals on electronics</p>
						</div>
					</div>
				</div>
			</div>

			<!-- featured categories section -->
			<h2 class="ft-text">Featured Categories</h2>
			<div class="featured-categories">
				<div class="carousel-wrapper">
					<div class="categories-card-container">

						<?php
						// Loop through the categories and display them
						foreach ($categories as $category) {
							echo '
                <div class="categories-card">
                    <div class="card-content">
                        <div class="card-image">
                            <img src="../images/default-category.png" alt="' . htmlspecialchars($category['cat_name']) . '">
                        </div>
                        <h3 class="category-title">' . htmlspecialchars($category['cat_name']) . '</h3>
                        <p class="category-items">30+ Items</p> <!-- Placeholder, replace with actual item count if available -->
                        <span class="category-offer">MIN 20% OFF</span> <!-- Placeholder, you can make this dynamic -->
                    </div>
                </div>';
						}
						?>

					</div>
				</div>
			</div>




			<!-- Benefits Section -->
			<section class="benefits-section">
				<!-- <h2 class="ft-text">Why Choose ST-Marketplace?</h2><br><br> -->
				<div class="benefits-container">
					<div class="benefit">
						<img src="images/discount.svg" alt="Discount">
						<h4>Exclusive Student Discounts</h4>
						<p>Access to the best deals designed especially for students.</p>
					</div>
					<div class="benefit">
						<img src="images/credit-card-protection.svg" alt="Secure">
						<h4>Secure Payments</h4>
						<p>Secure and easy payment options for peace of mind.</p>
					</div>
				</div>
			</section>

			<!-- Latest Products Section -->
			<section class="latest-products">
				<h2 class="ft-text">Latest Listings</h2><br>
				<div class="products-grid">
					<?php
					// include_once(dirname(__DIR__). '/controllers/product_controller.php');
					$products = getAllProductsController();

					// Check if there are products available
					if ($products && count($products) > 0) {
						// Display the first 8 products (or fewer if less than 8 available)
						$count = 0;
						foreach ($products as $product) {
							if ($count >= 8) {
								break;
							}
					?>
							<div class="product-card">
								<div class="product-card-image">
									<img src="<?php echo htmlspecialchars($product['product_image']); ?>" alt="<?php echo htmlspecialchars($product['product_title']); ?>">
								</div>
								<div class="product-card-content">
									<h3 class="product-name"><?php echo htmlspecialchars($product['product_title']); ?></h3>
									<p class="product-price">
										<span class="new-price">$<?php echo number_format($product['product_price'], 2); ?></span>
									</p>
									<button class="add-to-cart-button">Add to Cart</button>
								</div>
							</div>
					<?php
							$count++;
						}
					} else {
						echo "<p>No products available at the moment.</p>";
					}
					?>
				</div>
			</section>



			<!-- Call to Action Banner Section -->
			<section class="cta-banner">
				<div class="cta-content">
					<h2>Ready to Save on Your Next Purchase?</h2>
					<p>Join our community to get exclusive offers and updates.</p>
					<a href="view/signup.php" class="cta-button">Sign Up Now</a>
				</div>
			</section>

			<!-- Blog Section -->
			<section class="blog-section">
				<h2>Student Tips & Insights</h2>
				<div class="blog-posts">
					<div class="blog-post">
						<img src="images/bg1.jpg" alt="Blog Post"><br>
						<h3>5 Ways to Save Money on Campus</h3>
						<p>Discover useful tips for saving money during your university years...</p>
						<a href="https://www.forbes.com/sites/enochomololu/2023/09/03/7-money-saving-hacks-for-college-students-budgeting-tips-and-tricks/" class="read-more">Read More</a>
					</div>
					<div class="blog-post">
						<img src="images/9838595.jpg" alt="Blog Post"><br>
						<h3>How to Find the Best Internships</h3>
						<p>Learn strategies to secure internships that align with your career goals...</p>
						<a href="https://tallo.com/internships-apprenticeships/how-to-find-internship/" class="read-more">Read More</a>
					</div>
				</div>
			</section>

			<!-- Newsletter Section -->


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
	<script src="js/cart_drawer.js"></script>
</body>

</html>