<?php include '../view/cart_drawer.html'; ?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link rel="stylesheet" href="../css/products-styles.css">
    <link rel="stylesheet" href="../css/cart_drawer_styles.css">

</head>

<body>
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
                    <div id="open-cart-button" class="cart-button">
                        <img src="../images/cart.svg" alt="Cart" />
                    </div>
                    <a href="view/signup.php" class="account-button">
                        <img src="../images/profile2.svg" alt="Account" />
                    </a>
                </div>
                <div class="right-div"></div>
            </nav>

            <div class="login-banner">
                <div class="banner-content">
                    <h1>Product - name of category being displayed shoyld go here</h1>
                    <p>small fact</p>
                </div>
            </div>

            <div class="product-page-container">
                <!-- Sidebar for filters and categories -->
                <div class="sidebar">
                    <!-- Categories Checklist -->
                    <h3>Categories</h3>
                    <form id="category-filter-form">
                        <div class="filter-category">
                            <input type="checkbox" id="creamy-pasta" name="category" value="Creamy Pasta">
                            <label for="creamy-pasta">Creamy Pasta (15)</label>
                        </div>
                        <div class="filter-category">
                            <input type="checkbox" id="croissant" name="category" value="Croissant">
                            <label for="croissant">Croissant (12)</label>
                        </div>
                        <div class="filter-category">
                            <input type="checkbox" id="diamond-rings" name="category" value="Diamond Rings">
                            <label for="diamond-rings">Diamond Rings (9)</label>
                        </div>
                        <div class="filter-category">
                            <input type="checkbox" id="disc-brake-sw" name="category" value="Disc Brack SW">
                            <label for="disc-brake-sw">Disc Brack SW (15)</label>
                        </div>
                        <div class="filter-category">
                            <input type="checkbox" id="dog-food" name="category" value="Dog Food">
                            <label for="dog-food">Dog Food (20)</label>
                        </div>
                        <div class="filter-category">
                            <input type="checkbox" id="donuts" name="category" value="Donuts">
                            <label for="donuts">Donuts (12)</label>
                        </div>
                        <div class="filter-category">
                            <input type="checkbox" id="double-bed" name="category" value="Double Bed">
                            <label for="double-bed">Double Bed (15)</label>
                        </div>
                        <div class="filter-category">
                            <input type="checkbox" id="dressing" name="category" value="Dressing">
                            <label for="dressing">Dressing (15)</label>
                        </div>
                    </form>

                    <h3>Price Range</h3>
                    <form id="price-range-filter-form">
                        <label for="price-min">Min:</label>
                        <input type="number" id="price-min" name="price-min" min="0" placeholder="0">
                        <label for="price-max">Max:</label>
                        <input type="number" id="price-max" name="price-max" min="0" placeholder="1000">
                        <button type="button" id="apply-price-filter">Apply</button>
                    </form>


                    <!-- Size Checklist -->
                    <h3>Filter</h3>
                    <p>22 products</p>
                    <h3>Size</h3>
                    <form id="size-filter-form">
                        <div class="filter-size">
                            <input type="checkbox" id="size-small" name="size" value="Small">
                            <label for="size-small">Small</label>
                        </div>
                        <div class="filter-size">
                            <input type="checkbox" id="size-medium" name="size" value="Medium">
                            <label for="size-medium">Medium</label>
                        </div>
                        <div class="filter-size">
                            <input type="checkbox" id="size-large" name="size" value="Large">
                            <label for="size-large">Large</label>
                        </div>
                    </form>


                    <h3>Availability</h3>
                    <form id="availability-filter-form">
                        <div class="filter-availability">
                            <input type="checkbox" id="in-stock" name="availability" value="In Stock">
                            <label for="in-stock">In Stock</label>
                        </div>
                        <div class="filter-availability">
                            <input type="checkbox" id="out-of-stock" name="availability" value="Out of Stock">
                            <label for="out-of-stock">Out of Stock</label>
                        </div>
                    </form>

                </div>


                <!-- Product listings on the right -->
                <div class="product-listings">
                    <div class="product-header">
                        <h2>Name of chosen categories</h2>
                        <div class="sort-options">
                            <span>Sort by:</span>
                            <select>
                                <option value="alphabetically">Alphabetically, A-Z</option>
                                <option value="price-asc">Price: Low to High</option>
                                <option value="price-desc">Price: High to Low</option>
                            </select>
                        </div>
                    </div>

                    <div class="products-grid">
                        <!-- Example of Product Listings -->
                        <div class="product-card">
                            <div class="product-card-image">
                                <img src="../images/1.svg" alt="Sample Product">
                                <!-- <span class="discount-tag">50% OFF</span> -->
                            </div>
                            <div class="product-card-content">
                                <h3 class="product-name">100% Organic Lemon</h3>
                                <p class="product-price">
                                    <span class="new-price">$22.00</span>
                                </p>
                                <div class="quantity-section">
                                    <button class="quantity-button minus">-</button>
                                    <input type="number" class="quantity-input" value="1" min="1">
                                    <button class="quantity-button plus">+</button>
                                </div>
                                <button class="add-to-cart-button">Add to Cart</button>
                            </div>
                        </div>
                    </div>


                </div>
            </div>







            <!-- Contact Section -->
            <footer class="contact-section">
                <h2>Contact Us</h2>
                <p>Email: info@studentmarketplace.com | Phone: +123 456 789</p>
                <div class="social-icons">
                    <a href="#"><img src="images/facebook-icon.svg" alt="Facebook"></a>
                    <a href="#"><img src="images/twitter-icon.svg" alt="Twitter"></a>
                    <a href="#"><img src="images/instagram-icon.svg" alt="Instagram"></a>
                </div>
            </footer>
        </div>
    </div>
    <script src="../js/cart_drawer.js"></script>
</body>

</html>