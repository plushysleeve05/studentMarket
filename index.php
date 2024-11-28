<?php include 'view/cart_drawer.html'; ?>

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
	<div id="preloader" style="display: flex; align-items: center; justify-content: center; height: 100vh; width: 100vw; position: fixed; top: 0; left: 0; background-color: #ffffff; z-index: 1000;">
		<p>Loading...</p>
	</div>

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
				<!-- Cart and Account Buttons -->
				<div class="nav-icons">
					<div class="cart-button" id="open-cart-button">
						<img src="images/cart.svg" alt="Cart" />
</div>
					<a href="view/signup.php" class="account-button">
						<img src="images/profile2.svg" alt="Account" />
					</a>
				</div>
				<div class="right-div"></div>
			</nav>

			<!-- hero section -->
			<div class="hero-sec-container">
				<div class="hero-text">
					<h1 class="catchphrase">Buy, Sell, and Save – Just for Students!</h1>
				</div>
				<div class="hero-buttons">
					<a href="products.php" class="hero-button">Shop Now</a>
					<a href="view/signup.php" class="hero-button-secondary">Join the community</a>
				</div>
			</div>

			<br><br>

			<!-- banner -->
			<div class="banner-section">
				<div class="banner-container flex-container">
					<div class="banner-cards flex-items f1">
						<div class="text-content">
							<h2>Get the best deals on electronics</h2>
							<p>Get the best deals on electronics</p>
						</div>
					</div>
					<div class="banner-cards flex-items f2 ">
						<div class="text-content">
							<h2>Get the best deals on electronics</h2>
							<p>Get the best deals on electronics</p>
						</div>
					</div>
					<div class="banner-cards flex-items f3">
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
						<div class="categories-card">
							<div class="card-content">
								<div class="card-image">
									<img src="images/1.svg" alt="Electronics">
								</div>
								<h3 class="category-title">Electronics</h3>
								<p class="category-items">28+ Items</p>
								<span class="category-offer">MIN 20% OFF</span>
							</div>
						</div>

						<div class="categories-card">
							<div class="card-content">
								<div class="card-image">
									<img src="/images/bg1.jpg" alt="#">
								</div>
								<h3 class="category-title">Furniture</h3>
								<p class="category-items">30+ Items</p>
								<span class="category-offer">MIN 30% OFF</span>
							</div>
						</div>
						<div class="categories-card">
							<div class="card-content">
								<div class="card-image">
									<img src="images/3.svg" alt="Furniture">
								</div>
								<h3 class="category-title">Furniture</h3>
								<p class="category-items">30+ Items</p>
								<span class="category-offer">MIN 30% OFF</span>
							</div>
						</div>
						<div class="categories-card">
							<div class="card-content">
								<div class="card-image">
									<img src="images/furniture.png" alt="Furniture">
								</div>
								<h3 class="category-title">Furniture</h3>
								<p class="category-items">30+ Items</p>
								<span class="category-offer">MIN 30% OFF</span>
							</div>
						</div>
						<div class="categories-card">
							<div class="card-content">
								<div class="card-image">
									<img src="images/furniture.png" alt="Furniture">
								</div>
								<h3 class="category-title">Furniture</h3>
								<p class="category-items">30+ Items</p>
								<span class="category-offer">MIN 30% OFF</span>
							</div>
						</div>
						<div class="categories-card">
							<div class="card-content">
								<div class="card-image">
									<img src="images/furniture.png" alt="Furniture">
								</div>
								<h3 class="category-title">Furniture</h3>
								<p class="category-items">30+ Items</p>
								<span class="category-offer">MIN 30% OFF</span>
							</div>
						</div>
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
					<div class="product-card">
						<div class="product-card-image">
							<img src="images/bg1.jpg" alt="Product Name">
						</div>
						<div class="product-card-content">
							<h3 class="product-name">Product Name</h3>
							<p class="product-price">
								<span class="new-price">$199.99</span>
							</p>
							<button class="add-to-cart-button">Add to Cart</button>
						</div>
					</div>
					<div class="product-card">
						<div class="product-card-image">
							<img src="images/9838595.jpg" alt="Product Name">
						</div>
						<div class="product-card-content">
							<h3 class="product-name">Product Name</h3>
							<p class="product-price">
								<span class="new-price">$249.99</span>
							</p>
							<button class="add-to-cart-button">Add to Cart</button>
						</div>
					</div>
					<div class="product-card">
						<div class="product-card-image">
							<img src="images/9838595.jpg" alt="Product Name">
						</div>
						<div class="product-card-content">
							<h3 class="product-name">Product Name</h3>
							<p class="product-price">
								<span class="new-price">$249.99</span>
							</p>
							<button class="add-to-cart-button">Add to Cart</button>
						</div>
					</div>
					<div class="product-card">
						<div class="product-card-image">
							<img src="images/9838595.jpg" alt="Product Name">
						</div>
						<div class="product-card-content">
							<h3 class="product-name">Product Name</h3>
							<p class="product-price">
								<span class="new-price">$249.99</span>
							</p>
							<button class="add-to-cart-button">Add to Cart</button>
						</div>
					</div>
					<div class="product-card">
						<div class="product-card-image">
							<img src="images/9838595.jpg" alt="Product Name">
						</div>
						<div class="product-card-content">
							<h3 class="product-name">Product Name</h3>
							<p class="product-price">
								<span class="new-price">$249.99</span>
							</p>
							<button class="add-to-cart-button">Add to Cart</button>
						</div>
					</div>
					<div class="product-card">
						<div class="product-card-image">
							<img src="images/9838595.jpg" alt="Product Name">
						</div>
						<div class="product-card-content">
							<h3 class="product-name">Product Name</h3>
							<p class="product-price">
								<span class="new-price">$249.99</span>
							</p>
							<button class="add-to-cart-button">Add to Cart</button>
						</div>
					</div>
					<div class="product-card">
						<div class="product-card-image">
							<img src="images/9838595.jpg" alt="Product Name">
						</div>
						<div class="product-card-content">
							<h3 class="product-name">Product Name</h3>
							<p class="product-price">
								<span class="new-price">$249.99</span>
							</p>
							<button class="add-to-cart-button">Add to Cart</button>
						</div>
					</div>
					<div class="product-card">
						<div class="product-card-image">
							<img src="images/9838595.jpg" alt="Product Name">
						</div>
						<div class="product-card-content">
							<h3 class="product-name">Product Name</h3>
							<p class="product-price">
								<span class="new-price">$249.99</span>
							</p>
							<button class="add-to-cart-button">Add to Cart</button>
						</div>
					</div>
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
						<a href="blog1.php" class="read-more">Read More</a>
					</div>
					<div class="blog-post">
						<img src="images/9838595.jpg" alt="Blog Post"><br>
						<h3>How to Find the Best Internships</h3>
						<p>Learn strategies to secure internships that align with your career goals...</p>
						<a href="blog2.php" class="read-more">Read More</a>
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

	<!-- <script>
		// Dynamic Content for Featured Categories and Latest Products
		document.addEventListener('DOMContentLoaded', function() {
			loadFeaturedCategories();
			loadLatestProducts();
		});

		const categoriesData = [{
				name: 'Electronics',
				items: '28+ Items',
				offer: 'MIN 20% OFF',
				image: 'images/1.svg'
			},
			{
				name: 'Furniture',
				items: '30+ Items',
				offer: 'MIN 30% OFF',
				image: 'images/furniture.png'
			},
			{
				name: 'Smart Watches',
				items: '24+ Items',
				offer: 'MIN 15% OFF',
				image: 'images/2.svg'
			}
		];

		const productsData = [{
				name: 'Product 1',
				price: '$199.99',
				image: 'images/product1.jpg'
			},
			{
				name: 'Product 2',
				price: '$249.99',
				image: 'images/product2.jpg'
			}
		];

		function loadFeaturedCategories() {
			const container = document.querySelector('.categories-card-container');
			container.innerHTML = '';
			categoriesData.forEach(category => {
				const card = `
                    <div class="categories-card">
                        <div class="card-content">
                            <div class="card-image">
                                <img src="${category.image}" alt="${category.name}">
                            </div>
                            <h3 class="category-title">${category.name}</h3>
                            <p class="category-items">${category.items}</p>
                            <span class="category-offer">${category.offer}</span>
                        </div>
                    </div>`;
				container.innerHTML += card;
			});
		}

		function loadLatestProducts() {
			const container = document.querySelector('.products-grid');
			container.innerHTML = '';
			productsData.forEach(product => {
				const productCard = `
                    <div class="product-card">
                        <img src="${product.image}" alt="${product.name}">
                        <h3>${product.name}</h3>
                        <p>${product.price}</p>
                        <a href="#" class="add-to-cart-button">Add to Cart</a>
                    </div>`;
				container.innerHTML += productCard;
			});
		}
	</script> -->
	<script>
		// Scroll-triggered animations
		document.addEventListener('DOMContentLoaded', function() {
			const elementsToAnimate = document.querySelectorAll(
				'.flex-items, .featured-categories, .categories-card, .testimonials-section, .benefits-section, .latest-products, .cta-banner, .blog-section, .newsletter-section, .contact-section'
			);

			function handleScroll() {
				elementsToAnimate.forEach((element) => {
					const rect = element.getBoundingClientRect();
					if (rect.top < window.innerHeight - 100) {
						element.style.opacity = '1';
						element.style.transform = 'translateY(0)';
					}
				});
			}

			window.addEventListener('scroll', handleScroll);
			handleScroll(); // Initial check on page load
		});
	</script>
	<script src="js/cart_drawer.js"></script>
</body>

</html>