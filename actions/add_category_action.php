<?php
// Include the category controller
include("../controllers/categories_controller.php");

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    addCategoryController();
}
