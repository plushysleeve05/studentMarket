<?php
require_once '../settings/db_class.php'; // Assuming db_connection is stored here

class BrandController
{
    private $db;

    public function __construct()
    {
        // Initialize the database connection
        $this->db = new db_connection();
    }

    /**
     * Add a brand to the database.
     * 
     * @param string $brand_name
     * @return bool
     */
    public function addBrand($brand_name)
    {
        // Escape the brand name to prevent SQL injection
        $escaped_brand_name = mysqli_real_escape_string($this->db->db_conn(), $brand_name);

        // SQL query to insert the brand
        $sql = "INSERT INTO brands (brand_name) VALUES ('$escaped_brand_name')";

        // Execute the query using db_query
        return $this->db->db_query($sql);
    }
}
