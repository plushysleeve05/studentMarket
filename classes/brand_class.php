<?php
class Brand
{
    private $db;

    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }

    // Add a brand to the database
    public function addBrand($name, $description, $logo)
    {
        $sql = "INSERT INTO brands (name, description, logo) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $description, $logo]);
    }

    // Fetch all brands
    public function getAllBrands()
    {
        $sql = "SELECT * FROM brands";
        return $this->db->query($sql)->fetchAll();
    }
}
