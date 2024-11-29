<?php
include_once(dirname(__DIR__). '../settings/db_class.php') ;  // Include the db_connection class

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
        $sql = "SELECT p.*, c.cat_name FROM products p
            INNER JOIN categories c ON p.product_cat = c.cat_id";
        return $this->db->db_fetch_all($sql);
    }

    public function getAllBrands()
    {
        $sql = "SELECT brand_id, brand_name FROM brands";  // brands table has brand_id and brand_name
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

    public function deleteProduct($product_id)
    {
        // SQL query to delete the product
        $sql = "DELETE FROM products WHERE product_id = ?";

        // Prepare the SQL statement using the existing db connection
        $stmt = $this->db->db_conn()->prepare($sql);

        // Check if the prepared statement is valid
        if ($stmt) {
            // Bind the product ID to the query as an integer
            $stmt->bind_param("i", $product_id);

            // Execute the query
            if ($stmt->execute()) {
                // Check if any rows were affected (indicating successful deletion)
                return $stmt->affected_rows > 0;
            } else {
                // Log the error or handle the failed execution
                die("Execution failed: " . $stmt->error);
            }
        } else {
            // Log the error or handle the failed statement preparation
            die("Prepare statement failed: " . $this->db->db_conn()->error);
        }
    }

}
