<?php
// Include the product controller
include("../controllers/product_controller.php");

// Start the session to access vendor information
session_start();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    addProductController();
}
