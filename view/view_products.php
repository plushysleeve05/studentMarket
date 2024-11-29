<?php
session_start(); // Start session to check login status
include '../view/cart_drawer.html';
include_once '../controllers/product_controller.php';
include_once '../controllers/categories_controller.php'; // Include categories controller to fetch categories

// Debugging: Print session data to the console
if (isset($_SESSION['customer_id'])) {
    error_log("Session ID is set. Customer ID: " . $_SESSION['customer_id']);
    error_log("Session Name: " . (isset($_SESSION['customer_name']) ? $_SESSION['customer_name'] : 'not set'));
} else {
    error_log("User is not logged in. Redirecting to login page.");
    header("Location: ../view/login.php");
    exit();
}

// Fetch categories from the database
$categories = getAllCategoriesController();

// Fetch all products from the database
$products = getAllProductsController();

// // Debugging: Print categories and products
// echo "<pre>";
// print_r($categories); // This will print all category fields to check if they are retrieved correctly
// print_r($products); // This will print all product fields to check if they are retrieved correctly
// echo "</pre>";
?>

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
        <div class="middle-div">
            <nav class="navigation">
                <div class="left-div"></div>
                <img src="../images/STMarketPlace2.svg" alt="Logo" class="nav-logo" />
                <nav class="n-two">
                    <div class="left-div"></div>
                    <ul>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="products.php">Products</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="contact.php">Contact</a></li>
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
                    <?php if (isset($_SESSION['customer_name'])): ?>
                        <a href="../view/customer_profile.php" class="logout-button"><?php echo htmlspecialchars($_SESSION['customer_name']); ?> - View Profile</a>
                    <?php else: ?>
                        <a href="../view/signup.php" class="account-button">
                            <img src="../images/profile2.svg" alt="Account" />
                        </a>
                    <?php endif; ?>
                </div>
                <div class="right-div"></div>
            </nav>

            <div class="login-banner">
                <div class="banner-content">
                    <h1 id="product-header">All Products</h1>
                    <p>Explore our range of products available for students</p>
                </div>
            </div>

            <div class="product-page-container">
                <!-- Sidebar for filters and categories -->
                <div class="sidebar">
                    <!-- Categories Checklist -->
                    <h3>Categories</h3>
                    <form id="category-filter-form">
                        <?php
                        // Loop through the categories and display them dynamically
                        if ($categories && count($categories) > 0) {
                            foreach ($categories as $category) {
                                echo '
                                <div class="filter-category">
                                    <input type="checkbox" class="category-checkbox" id="category-' . htmlspecialchars($category['cat_id']) . '" name="category[]" value="' . htmlspecialchars($category['cat_id']) . '">
                                    <label for="category-' . htmlspecialchars($category['cat_id']) . '">' . htmlspecialchars($category['cat_name']) . '</label>
                                </div>';
                            }
                        } else {
                            echo '<p>No categories available</p>';
                        }
                        ?>
                    </form>

                    <h3>Price Range</h3>
                    <form id="price-range-filter-form">
                        <label for="price-min">Min:</label>
                        <input type="number" id="price-min" name="price-min" min="0" placeholder="0">
                        <label for="price-max">Max:</label>
                        <input type="number" id="price-max" name="price-max" min="0" placeholder="1000">
                        <button type="button" id="apply-price-filter">Apply</button>
                    </form>
                </div>

                <!-- Product listings on the right -->
                <div class="product-listings">
                    <div class="product-header">
                        <h2 id="product-header-title">All Products</h2>
                        <div class="sort-options">
                            <span>Sort by:</span>
                            <select id="sort-products">
                                <option value="alphabetically">Alphabetically, A-Z</option>
                                <option value="price-asc">Price: Low to High</option>
                                <option value="price-desc">Price: High to Low</option>
                            </select>
                        </div>
                    </div>

                    <div class="products-grid" id="products-grid">
                        <?php
                        // Display products dynamically
                        if ($products && count($products) > 0) {
                            foreach ($products as $product) {
                                // Displaying each product card with necessary data attributes for filtering
                                echo '<div class="product-card" data-category="' . $product['product_cat'] . '" data-price="' . $product['product_price'] . '">';
                                echo '<div class="product-card-image">';
                                echo '<img src="' . htmlspecialchars($product['product_image']) . '" alt="' . htmlspecialchars($product['product_title']) . '">';
                                echo '</div>';
                                echo '<div class="product-card-content">';
                                echo '<h3 class="product-name">' . htmlspecialchars($product['product_title']) . '</h3>';
                                echo '<p class="product-category">' . htmlspecialchars($product['cat_name']) . '</p>'; // Display category name
                                echo '<p class="product-price"><span class="new-price">$' . number_format($product['product_price'], 2) . '</span></p>';
                                echo '<div class="quantity-section">';
                                echo '<button class="quantity-button minus">-</button>';
                                echo '<input type="number" class="quantity-input" value="1" min="1">';
                                echo '<button class="quantity-button plus">+</button>';
                                echo '</div>';
                                echo '<button class="add-to-cart-button">Add to Cart</button>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo "<p>No products found</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>

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

    <script src="../js/cart_drawer.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const categoryCheckboxes = document.querySelectorAll(".category-checkbox");
            const priceMinInput = document.getElementById("price-min");
            const priceMaxInput = document.getElementById("price-max");
            const applyPriceFilterButton = document.getElementById("apply-price-filter");
            const productsGrid = document.getElementById("products-grid");
            const productHeaderTitle = document.getElementById("product-header-title");

            function filterProducts() {
                const selectedCategories = Array.from(categoryCheckboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);

                const minPrice = parseFloat(priceMinInput.value) || 0;
                const maxPrice = parseFloat(priceMaxInput.value) || Infinity;

                let visibleProductCount = 0;

                productsGrid.querySelectorAll(".product-card").forEach(card => {
                    const productCategory = card.getAttribute("data-category");
                    const productPrice = parseFloat(card.getAttribute("data-price"));

                    const categoryMatch = selectedCategories.length === 0 || selectedCategories.includes(productCategory);
                    const priceMatch = productPrice >= minPrice && productPrice <= maxPrice;

                    if (categoryMatch && priceMatch) {
                        card.style.display = "flex"; // Display matching product
                        visibleProductCount++;
                    } else {
                        card.style.display = "none"; // Hide non-matching product
                    }
                });

                // Update header based on the filters
                if (selectedCategories.length > 0) {
                    productHeaderTitle.textContent = selectedCategories.join(", ");
                } else {
                    productHeaderTitle.textContent = "All Products";
                }

                // Optionally, show a message if no products match
                if (visibleProductCount === 0) {
                    productsGrid.innerHTML = "<p>No products found matching your criteria.</p>";
                }
            }

            // Event listeners for filtering
            categoryCheckboxes.forEach(checkbox => {
                checkbox.addEventListener("change", filterProducts);
            });

            applyPriceFilterButton.addEventListener("click", filterProducts);
        });
    </script>
</body>

</html>