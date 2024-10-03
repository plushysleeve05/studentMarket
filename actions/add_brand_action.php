<?php

// Include the brand controller to handle CRUD logic
include("../controllers/brand_controller.php");

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $brandName = $_POST["brand"];

    // Call the addBrandController to add the brand
    addBrandController();
}
