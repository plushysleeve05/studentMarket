<?php
include_once(dirname(__DIR__) . '/classes/categories_class.php');

$category = new Category();

// Add Category Controller
function addCategoryController()
{
    global $category;
    if (isset($_POST['cat_name'])) {
        $name = $_POST['cat_name'];
        if ($category->addCategory($name)) {
            header("Location: ../views/view_categories.php");
        } else {
            header("Location: ../views/view_categories.php");
        }
    }
}

// Fetch All Categories Controller
function getAllCategoriesController()
{
    global $category;
    return $category->getAllCategories();
}

// Delete Category Controller
function deleteCategoryController($id)
{
    global $category;
    return $category->deleteCategory($id);
}
