<?php
// landing/index page

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/index-styles.css">
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
				<img src="images/STMarketPlace.svg" alt="Logo" class="nav-logo" />


				<!-- Search Bar -->
				<form action="search.php" method="get" class="search-bar">
					<input type="text" name="query" placeholder="Search...">
					<button type="submit"><img src="/images/search.png" alt=""></button>
				</form>

				<!-- Cart and Account Buttons -->
				<div class="nav-icons">
					<a href="cart.php" class="cart-button">
						<img src="cart-icon.png" alt="Cart" /> <!-- Replace with actual cart icon -->
					</a>
					<a href="account.php" class="account-button">
						<img src="account-icon.png" alt="Account" /> <!-- Replace with actual account icon -->
					</a>
				</div>
				<div class="right-div"></div>
			</nav>
			<nav class="n-two">
				<div class="left-div"></div>
				<!-- Navigation Links -->
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="products.php">Products</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
				<div class="right-div"></div>
			</nav>
			<!-- hero section -->
			<div class="hero-sec-container">
				<div class="hero-text">
					<!-- <h1>Welcome to stMARKET</h1>
					<p>Discover the best products at the best prices JUST FOR STUDENTS!</p>
					<a href="products.php" class="hero-button">Shop Now</a> -->
				</div>
			</div>

			<br><br>

			<!-- banner -->
			<div class="banner-section">
				<div class="banner-container flex-container">
					<div class="banner-cards flex-items">
						<div class="text-content">
							<span>student prices!</span>
						</div>
					</div>
					<div class="banner-cards flex-items">
						<!-- Additional banner cards can go here -->
					</div>
					<div class="banner-cards flex-items">
						<!-- Additional banner cards can go here -->
					</div>
				</div>
			</div>

			<br>

			<!-- featured categroies section -->
			<h2 class="ft-text">Featured Categories </h2>
			<div class="featured-categories">
				<!-- <p class="subt">BEST DEALS! our top grossing products</p> -->
				<div class="carousel-wrapper">
					<div class="categories-card-container">
						<div class="categories-card cc1"></div>
						<div class="categories-card cc1"></div>
						<div class="categories-card cc1"></div>
						<div class="categories-card cc1"></div>
						<div class="categories-card cc1"></div>
						<div class="categories-card cc1"></div>
					</div>
				</div>
			</div>



		</div>

	</div>


</body>
<script>
	// JavaScript to Remove Preloader After Page Load
	window.addEventListener('load', function() {
		const preloader = document.getElementById('preloader');
		preloader.style.opacity = '0';
		setTimeout(() => {
			preloader.style.display = 'none';
		}, 1000); // Delay to allow for a fade-out effect
	});
</script>

</html>