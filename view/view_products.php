<?php
// Start the session
session_start();

// Check if customer is logged in
$customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : null;

// Include the product and brand controllers to retrieve the products and brands
include_once '../controllers/product_controller.php';
include_once '../controllers/brand_controller.php';
include_once '../controllers/categories_controller.php';

// Instantiate product, brand, and category classes
$product = new Product();
$brand = new Brand();
$category = new Category();

// Get all products
$products = $product->getAllProducts();

// Get all brands
$brands = $brand->getBrands();

// Get all categories
$categories = $category->getAllCategories();

// Initialize and populate the $brandMap
$brandMap = [];
if (!empty($brands)) {
    foreach ($brands as $brand) {
        $brandMap[$brand['brand_id']] = $brand['brand_name'];
    }
} else {
    echo "No brands found."; // Handle no brand case
}

// Initialize and populate the $categoryMap
$categoryMap = [];
if (!empty($categories)) {
    foreach ($categories as $cat) {
        $categoryMap[$cat['cat_id']] = $cat['cat_name'];
    }
} else {
    echo "No categories found."; // Handle no categories case
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link rel="stylesheet" href="../css/products-styles.css">
    <!-- SweetAlert CSS and JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">
        <h1>Product List</h1>

        <!-- Display the Customer ID if logged in -->
        <?php if ($customer_id): ?>
            <p>Logged in as Customer ID: <?php echo $customer_id; ?></p>
            <!-- Sign Out Button -->
            <form action="../views/logout.php" method="POST">
                <button type="submit" class="signout-btn">Sign Out</button>
            </form>
        <?php else: ?>
            <p>You are not logged in.</p>
        <?php endif; ?>

        <!-- Add Product Button -->
        <div class="add-product-section">
            <a href="add_products.php" class="add-product-btn">Add New Product</a>
        </div>

        <!-- Display Products in a Table -->
        <table class="product-table">
            <thead>
                <tr>
                    <th>Product Title</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)) : ?>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <td><?php echo $product['product_title']; ?></td>
                            <td><?php echo number_format($product['product_price'], 2); ?></td>
                            <td><?php echo $product['product_desc']; ?></td>

                            <!-- Display the brand name using the brandMap -->
                            <td><?php echo isset($brandMap[$product['product_brand']]) ? $brandMap[$product['product_brand']] : 'Unknown Brand'; ?></td>

                            <!-- Display category name, ensure 'cat_name' is fetched in your query -->
                            <td><?php echo isset($categoryMap[$product['product_cat']]) ? $categoryMap[$product['product_cat']] : 'Unknown Category'; ?></td>

                            <td>
                                <img src="../uploads/<?php echo $product['product_image']; ?>" alt="Product Image" class="product-image">
                            </td>
                            <td>
                                <!-- Delete Button with SweetAlert confirmation -->
                                <form action="../actions/delete_product_action.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>

                                <!-- Add to Cart Button -->
                                <form action="../actions/add_to_cart_action.php" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <button type="submit" class="cart-btn">Add to Cart</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7">No products available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- SweetAlert for delete confirmation -->
    <script>
        function confirmDelete(productId) {
            return Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    return true; // Submit the form if confirmed
                } else {
                    return false; // Prevent form submission
                }
            });
        }
    </script>
</body>

</html>