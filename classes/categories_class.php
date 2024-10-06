<?php
include_once '../settings/db_class.php'; 



class Category
{
    private $db;

    public function __construct()
    {
        $this->db = new db_connection();  // Use the db_connection class
    }

    // Fetch all categories to populate the dropdown
    public function getAllCategories()
    {
        $sql = "SELECT cat_id, cat_name FROM categories";  // Assuming your categories table has category_id and category_name
        return $this->db->db_fetch_all($sql);
    }

    // Add a new category to the database
    public function addCategory($name)
    {
        $conn = $this->db->db_conn();
        if ($conn === false) {
            die("Database connection error");
        }

        $query = "INSERT INTO categories (cat_name) VALUES (?)";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("s", $name); // Bind category name
            return $stmt->execute();
        } else {
            die("Prepare statement failed: " . $conn->error);
        }
    }

    // Delete a category from the database by ID
    public function deleteCategory($id)
    {
        $conn = $this->db->db_conn();
        if ($conn === false) {
            die("Database connection error");
        }

        $query = "DELETE FROM categories WHERE cat_id = ?";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("i", $id); // Bind category ID
            return $stmt->execute();
        } else {
            die("Prepare statement failed: " . $conn->error);
        }
    }
}
