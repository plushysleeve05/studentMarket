<?php
include_once '../settings/db_class.php';  // Include the db_connection class

class Brand
{
    private $db;  // This will be an instance of db_connection

    public function __construct()
    {
        $this->db = new db_connection();  // Initialize db_connection class
    }

    // Add a new brand to the database
    public function addBrand($name)
    {
        $conn = $this->db->db_conn();  // Get the MySQLi connection

        if ($conn === false) {
            die("Database connection error");
        }

        $query = "INSERT INTO brands (brand_name) VALUES (?)";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("s", $name);  // Bind the brand name
            return $stmt->execute();        // Execute the statement
        } else {
            die("Prepare statement failed: " . $conn->error);  // Output error message
        }
    }

    // Delete a brand from the database by ID
    public function deleteBrand($id)
    {
        $conn = $this->db->db_conn();  // Get the MySQLi connection

        if ($conn === false) {
            die("Database connection error");
        }

        $query = "DELETE FROM brands WHERE brand_id = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $id);  // Bind the brand ID
            return $stmt->execute();      // Execute the statement
        } else {
            die("Prepare statement failed: " . $conn->error);  // Output error message
        }
    }

    // Get all brands from the database
    public function getBrands()
    {
        $conn = $this->db->db_conn();  // Get the MySQLi connection

        if ($conn === false) {
            die("Database connection error");
        }

        $query = "SELECT * FROM brands";
        $result = $conn->query($query);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);  // Fetch all brands as an associative array
        } else {
            return [];  // Return an empty array if the query fails
        }
    }
}
?>