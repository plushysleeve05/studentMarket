<?php
include_once '../classes/product_class.php';

$product = new Product();

// Add Product Controller
function addProductController()
{
    global $product;
    if (isset($_POST['product_title']) && isset($_POST['product_price']) && isset($_POST['product_cat']) && isset($_POST['product_brand'])) {
        $title = $_POST['product_title'];
        $price = $_POST['product_price'];
        $desc = isset($_POST['product_desc']) ? $_POST['product_desc'] : NULL;
        $keywords = isset($_POST['product_keywords']) ? $_POST['product_keywords'] : NULL;
        $cat = $_POST['product_cat'];
        $brand = $_POST['product_brand'];

        // Handle file upload for product image
        $image = NULL;
        if (isset($_FILES['product_image']['name']) && $_FILES['product_image']['error'] == 0) {
            $image = 'uploads/' . basename($_FILES['product_image']['name']);
            move_uploaded_file($_FILES['product_image']['tmp_name'], $image);
        }

        if ($product->addProduct($cat, $brand, $title, $price, $desc, $image, $keywords)) {
            header("Location: ../view/add_products.php?message=success");
        } else {
            header("Location: ../view/add_products.php?message=error");
        }
    }
}

function deleteProductById($product_id)
{
    // Create an instance of the Product class
    $product = new Product();

    // Call the deleteProduct function from the Product class
    $result = $product->deleteProduct($product_id);

    // Return the result (true if deletion was successful, false otherwise)
    return $result;
}
