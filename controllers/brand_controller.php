<?php
// Include the Brand class
include_once '../classes/brand_class.php';

// Instantiate the Brand class
$brand = new Brand();

// Add a new brand (Create)
function addBrandController()
{
    global $brand;
    if (isset($_POST['brand'])) {
        $brandName = $_POST['brand'];
        if ($brand->addBrand($brandName)) {
            header("Location: ../view/view_brands.php");
        } else {
            header("Location: ../view/view_brands.php?error=Failed to add brand");
        }
    }
}

// Delete a brand (Delete)
function deleteBrandController()
{
    global $brand;
    if (isset($_POST['brand_id'])) {
        $brandId = $_POST['brand_id'];
        if ($brand->deleteBrand($brandId)) {
            header("Location: ../view/view_brands.php");
        } else {
            header("Location: ../view/view_brands.php?error=Failed to delete brand");
        }
    }
}

// View all brands (Read)
function viewBrandsController()
{
    global $brand;
    return $brand->getBrands();  // Returns an array of all brands
}
