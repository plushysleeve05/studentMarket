<?php
// Include the product controller
include("../controllers/product_controller.php");

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    addProductController();
}
