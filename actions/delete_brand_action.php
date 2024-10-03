<?php
// Include the controller that handles the CRUD logic 
include("../controllers/brand_controller.php");

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $brandId = $_POST['brand_id'];

    // Call the deleteBrandController function with the brand ID
    deleteBrandController();
}
