<?php
// Include the ProductController class
include_once '../controllers/product_controller.php';

// Check if the product ID is set in the POST request
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];  // Get the product ID from the POST request

    // Create an instance of the ProductController class
    $productController = new Product();

    // Call the deleteProductById function
    $result = $productController->deleteProduct($product_id);

    // Check the result and redirect accordingly
    if ($result) {
        // Redirect with a success message
        header("Location: ../view/view_products.php?success=Product deleted successfully");
    } else {
        // Redirect with an error message if deletion failed
        header("Location: ../view/view_products.php?error=Failed to delete product");
    }
} else {
    // Redirect with an error message if no product ID is provided
    header("Location: ../view/view_products.php?error=No product selected for deletion");
}
