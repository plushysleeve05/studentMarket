<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Dashboard</title>
    <link rel="stylesheet" href="../css/vendor_dashboard.css">
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
                    <h2>Welcome, Vendor Name</h2>
                    <p>Manage your products, view sales, and add new products.</p>
                </div>
                <div id="signout-button" class="signout-button">
                    <a href="../actions/logout.php" class="btn-signout">Sign Out</a>
                </div>
            </div>

            <div class="user-info-container">
                <!-- Sidebar Menu -->
                <div id="left-sidebar" class="left-sidebar">
                    <div id="user-profile" class="user-profile">
                        <img src="../images/vendor_default.png" alt="Profile Picture" class="profile-image">
                        <h3 id="profile-name" class="profile-name">Vendor Name</h3>
                        <div id="user-email" class="user-email">vendor@example.com</div>
                    </div>

                    <nav id="sidebar-menu" class="sidebar-menu">
                        <ul>
                            <li><a href="#" class="menu-item" id="my-products-link" onclick="showSection('my-products-section')">My Products</a></li>
                            <li><a href="#" class="menu-item" id="add-product-link" onclick="showSection('add-product-section')">Add New Product</a></li>
                        </ul>
                    </nav>
                </div>

                <!-- Main Content Area Right of Sidebar -->
                <div id="right-content-container" class="right-content-container">


                    <!-- My Products Section -->
                    <div id="my-products-section" class="section" style="display: block;">
                        <h3>My Products</h3>
                        <div class="product-grid">
                            <!-- Product Card Example -->
                            <div class="product-card">
                                <div class="product-image">
                                    <img src="../images/product_placeholder.svg" alt="Product Image">
                                </div>
                                <div class="product-details">
                                    <h4 class="product-name">Product Name</h4>
                                    <p class="product-price">GHS 50.00</p>
                                    <p class="quantity-section">Stock: 10</p>
                                    <p class="category-section">Category: Electronics</p>
                                    <p class="brand-section">Brand: Apple</p>
                                    <div class="action-buttons">
                                        <button class="edit-product-button">Edit</button>
                                        <button class="delete-product-button">Delete</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Repeat for more products -->
                        </div>
                    </div>

                    <!-- Add Product Section -->
                    <div id="add-product-section" class="section" style="display: none;">
                        <div class="add-product-form-container wide-form">
                            <h3 class="form-title">Add New Product</h3>
                            <form action="../actions/add_product_action.php" method="POST" enctype="multipart/form-data" class="add-product-form">
                                <input type="hidden" name="vendor_id" value="<?php echo $_SESSION['vendor_id']; ?>">

                                <div class="form-group">
                                    <label for="product_title">Product Name</label>
                                    <input type="text" name="product_title" id="product_title" placeholder="Enter product name" required>
                                </div>

                                <div class="form-group">
                                    <label for="product_cat">Category</label>
                                    <select name="product_cat" id="product_cat" required>
                                        <option value="">Select a category</option>
                                        <option value="Electronics">Electronics</option>
                                        <option value="Fashion">Fashion</option>
                                        <option value="Books">Books</option>
                                        <!-- Add more categories as needed -->
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="product_brand">Brand</label>
                                    <input type="text" name="product_brand" id="product_brand" placeholder="Enter brand name" required>
                                </div>

                                <div class="form-group">
                                    <label for="product_price">Price (GHS)</label>
                                    <input type="number" step="0.01" name="product_price" id="product_price" placeholder="Enter price" required>
                                </div>

                                <div class="form-group">
                                    <label for="stock">Stock Quantity</label>
                                    <input type="number" name="stock" id="stock" placeholder="Enter available quantity" required>
                                </div>

                                <div class="form-group">
                                    <label for="product_desc">Description</label>
                                    <textarea name="product_desc" id="product_desc" rows="4" placeholder="Enter product description" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="product_keywords">Keywords</label>
                                    <input type="text" name="product_keywords" id="product_keywords" placeholder="Enter keywords for search (e.g., electronics, phone)" required>
                                </div>

                                <div class="form-group">
                                    <label for="product_image">Image</label>
                                    <input type="file" name="product_image" id="product_image" required>
                                </div>

                                <button type="submit" class="add-product-button">Add Product</button>
                            </form>
                        </div>


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

    <script>
        // JavaScript to toggle between sections
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => section.style.display = 'none');

            document.getElementById(sectionId).style.display = 'block';
        }
    </script>
</body>

</html>