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

<body>
	<div class="main-container">
		<!-- main page below -->
		<div class="middle-div">
			<nav class="navigation">
				<div class="left-div"></div>

				<!-- logo placeholder -->
				<img src="logo.png" alt="Logo" />


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



		</div>

	</div>


</body>

</html>