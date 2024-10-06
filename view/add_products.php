<?php
// Include the product controller to get the brands and categories
include_once '../controllers/product_controller.php';
include_once '../controllers/categories_controller.php';
include_once '../classes/product_class.php';

// Get all brands
$brands = $product->getAllBrands();

// Get all categories
$categories = $category->getAllCategories();

$products = $product->getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="../css/products-styles.css">
    <!-- SweetAlert CSS and JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="container">
        <h2>Add Product</h2>
        <form action="../actions/add_product_action.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="product_title" placeholder="Product Title" class="input-field" required>
            <input type="number" step="0.01" name="product_price" placeholder="Product Price" class="input-field" required>
            <textarea name="product_desc" placeholder="Product Description" class="input-field"></textarea>
            <input type="file" name="product_image" class="input-field">
            <input type="text" name="product_keywords" placeholder="Product Keywords" class="input-field">

            <!-- Dynamically populate the categories dropdown -->
            <select name="product_cat" class="input-field" required>
                <option value="" disabled selected>Select Category</option>
                <?php if (!empty($categories)) : ?>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?php echo $category['cat_id']; ?>"><?php echo $category['cat_name']; ?></option>
                    <?php endforeach; ?>
                <?php else : ?>
                    <option value="">No categories available</option>
                <?php endif; ?>
            </select>

            <!-- Dynamically populate the brands dropdown -->
            <select name="product_brand" class="input-field" required>
                <option value="" disabled selected>Select Brand</option>
                <?php if (!empty($brands)) : ?>
                    <?php foreach ($brands as $brand) : ?>
                        <option value="<?php echo $brand['brand_id']; ?>"><?php echo $brand['brand_name']; ?></option>
                    <?php endforeach; ?>
                <?php else : ?>
                    <option value="">No brands available</option>
                <?php endif; ?>
            </select>

            <button type="submit" class="submit-btn">Add Product</button>
        </form>
        <br><br>

        <button type="button" class="submit-btn" onclick="window.location.href='view_products.php'">View Products</button>
    </div>

    <!-- SweetAlert Success/Error Alerts -->
    <script>
        function submitForm() {
            // Display SweetAlert success message on form submission
            Swal.fire({
                icon: 'success',
                title: 'Processing',
                text: 'Please wait while the product is being added.',
                showConfirmButton: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading(); // Show loading icon
                }
            });

            // Simulate form submission with a slight delay
            setTimeout(function() {
                document.getElementById("productForm").submit();
            }, 1000);

            return false; // Prevent default form submission
        }
    </script>

</body>

</html>