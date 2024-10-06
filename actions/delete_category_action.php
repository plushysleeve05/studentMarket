<?php
// Include the category controller
include("../controllers/categories_controller.php");

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoryId = $_POST['category_id'];
    if (deleteCategoryController($categoryId)) {
        header("Location: ../views/view_categories.php");
    } else {
        header("Location: ../views/view_categories.php?message=error");
    }
}
