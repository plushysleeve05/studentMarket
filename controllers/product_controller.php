<?php
include_once(dirname(__DIR__) . '/classes/product_class.php');

$product = new Product();

// Add Product Controller
function addProductController()
{
    global $product;
    if (isset($_POST['product_title']) && isset($_POST['product_price']) && isset($_POST['product_cat']) && isset($_POST['product_brand']) && isset($_POST['stock'])) {

        $vendorId = $_SESSION['vendor_id'];  // Get vendor_id from session
        $title = $_POST['product_title'];
        $price = $_POST['product_price'];
        $desc = isset($_POST['product_desc']) ? $_POST['product_desc'] : NULL;
        $keywords = isset($_POST['product_keywords']) ? $_POST['product_keywords'] : NULL;
        $cat = $_POST['product_cat'];
        $brand = $_POST['product_brand'];
        $stock = $_POST['stock'];

        // Handle file upload for product image
        $image = NULL;
        if (isset($_FILES['product_image']['name']) && $_FILES['product_image']['error'] == 0) {
            $targetDir = "../images/products/";
            $image = $targetDir . basename($_FILES['product_image']['name']);
            move_uploaded_file($_FILES['product_image']['tmp_name'], $image);
        }

        // Call the addProduct function from Product class
        if ($product->addProduct($vendorId, $cat, $brand, $title, $price, $desc, $image, $keywords, $stock)) {
            header("Location: ../view/vendor_dashboard.php?message=success");
        } else {
            header("Location: ../view/vendor_dashboard.php?message=error");
        }
    }
}


// Get All Products Controller
function getAllProductsController()
{
    global $product;
    return $product->getAllProducts();
}

// Delete Product Controller
function deleteProductById($product_id)
{
    global $product;
    return $product->deleteProduct($product_id);
}
function updateProductStockController($product_id, $new_stock)
{
    global $product;
    return $product->updateProductStock($product_id, $new_stock);
}

function getProductByIdController($product_id)
{
    global $product;
    return $product->getProductById($product_id);
}
