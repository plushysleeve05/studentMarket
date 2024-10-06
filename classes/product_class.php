<?php
include_once '../settings/db_class.php';  // Include the db_connection class

class Product
{
    private $db;  // This will be an instance of db_connection

    public function __construct()
    {
        $this->db = new db_connection();  // Initialize db_connection class
    }

    // Fetch all brands to display in dropdown

    public function getAllProducts()
    {
        $sql = "SELECT * FROM products";
        return $this->db->db_fetch_all($sql);
    }

    public function getAllBrands()
    {
        $sql = "SELECT brand_id, brand_name FROM brands";  // Assuming your brands table has brand_id and brand_name
        return $this->db->db_fetch_all($sql);
    }

    // Add a new product to the database
    public function addProduct($cat, $brand, $title, $price, $desc, $image, $keywords)
    {
        $conn = $this->db->db_conn();
        if ($conn === false) {
            die("Database connection error");
        }

        $query = "INSERT INTO products (product_cat, product_brand, product_title, product_price, product_desc, product_image, product_keywords) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("iisdsss", $cat, $brand, $title, $price, $desc, $image, $keywords); // Bind values
            return $stmt->execute();
        } else {
            die("Prepare statement failed: " . $conn->error);
        }
    }
}
