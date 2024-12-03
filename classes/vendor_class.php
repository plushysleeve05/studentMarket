<?php
include_once '../settings/db_class.php';

class Vendor
{
    private $db;

    public function __construct()
    {
        $this->db = new db_connection();
    }

    // Method to create a new vendor
    public function createVendor($name, $email, $password, $contact, $address, $image, $joinDate, $status)
    {
        $conn = $this->db->db_conn();

        if ($conn === false) {
            die("Database connection error");
        }

        $query = "INSERT INTO vendor (vendor_name, vendor_email, vendor_password, vendor_contact, vendor_address, vendor_image, join_date, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            // Hash password before storing in DB
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt->bind_param("ssssssss", $name, $email, $hashedPassword, $contact, $address, $image, $joinDate, $status);
            if ($stmt->execute()) {
                return "Vendor registered successfully!";
            } else {
                return "Execution failed: " . $stmt->error;
            }
        } else {
            return "Prepare statement failed: " . $conn->error;
        }
    }

    // Method to get a vendor by email
    public function getVendorByEmail($email)
    {
        $conn = $this->db->db_conn();

        if ($conn === false) {
            die("Database connection error");
        }

        $query = "SELECT * FROM vendor WHERE vendor_email = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc(); // Return vendor as an associative array
            } else {
                return null; // No vendor found
            }
        } else {
            die("Prepare statement failed: " . $conn->error);
        }
    }

    // Method to get products by vendor ID
    public function getVendorProducts($vendorId)
    {
        $conn = $this->db->db_conn();

        if ($conn === false) {
            die("Database connection error");
        }

        $query = "SELECT * FROM products WHERE vendor_id = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $vendorId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result) {
                return $result->fetch_all(MYSQLI_ASSOC); // Fetch all products for this vendor as an associative array
            } else {
                return []; // Return an empty array if no products found
            }
        } else {
            die("Prepare statement failed: " . $conn->error);
        }
    }

    public function getVendorById($vendorId)
    {
        $conn = $this->db->db_conn();  // Get the MySQLi connection

        if ($conn === false) {
            die("Database connection error");
        }

        $query = "SELECT * FROM vendor WHERE vendor_id = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $vendorId);  // Bind the vendor ID parameter
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc();  // Fetch vendor details as an associative array
            } else {
                return null;  // Return null if no vendor is found
            }
        } else {
            die("Prepare statement failed: " . $conn->error);
        }
    }

    public function getProductsByVendor($vendorId)
    {
        $conn = $this->db->db_conn();  // Get the MySQLi connection

        if ($conn === false) {
            die("Database connection error");
        }

        $query = "SELECT * FROM products WHERE vendor_id = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $vendorId);  // Bind the vendor ID parameter
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result) {
                return $result->fetch_all(MYSQLI_ASSOC);  // Fetch all products as an associative array
            } else {
                return [];  // Return an empty array if the query fails
            }
        } else {
            die("Prepare statement failed: " . $conn->error);
        }
    }

}
