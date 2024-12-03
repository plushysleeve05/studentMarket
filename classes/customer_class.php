<?php
include '../settings/db_class.php';

class Customer
{
    private $db;

    // Constructor to initialize the database connection
    public function __construct()
    {
        // Instantiate db_connection class
        $this->db = new db_connection();
    }

    // Method to add a new customer to the database
    public function addCustomer($name, $email, $password, $country, $city, $contact, $image, $role)
    {
        // SQL query to insert customer into the database
        $sql = "INSERT INTO customer (customer_name, customer_email, customer_pass, customer_country, customer_city, customer_contact, customer_image, user_role) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare the query
        $stmt = $this->db->db_conn()->prepare($sql);
        if (!$stmt) {
            error_log("Prepare failed: " . $this->db->db_conn()->error);
            return false;
        }

        // Bind the parameters
        $stmt->bind_param('ssssssss', $name, $email, $password, $country, $city, $contact, $image, $role);

        // Execute the statement and return the result
        if (!$stmt->execute()) {
            error_log("Execute failed: " . $stmt->error);
            return false;
        }

        return true;
    }

    // Method to get customer by email for login purposes
    public function getCustomerByEmail($email)
    {
        // SQL query to get customer details by email
        $sql = "SELECT * FROM customer WHERE customer_email = ?";

        // Prepare the query
        $stmt = $this->db->db_conn()->prepare($sql);
        if (!$stmt) {
            error_log("Prepare failed: " . $this->db->db_conn()->error);
            return false;
        }

        $stmt->bind_param('s', $email);
        if (!$stmt->execute()) {
            error_log("Execute failed: " . $stmt->error);
            return false;
        }

        // Get the result
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            error_log("No user found with email: " . $email);
            return false;
        }

        // Fetch the record
        return $result->fetch_assoc();
    }

    // Method to update customer details
    public function updateCustomerDetails($customerId, $name, $email, $country, $city, $contact)
    {
        $conn = $this->db->db_conn();

        if ($conn === false) {
            die("Database connection error");
        }

        $query = "UPDATE customer SET customer_name = ?, customer_email = ?, customer_country = ?, customer_city = ?, customer_contact = ? WHERE customer_id = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("sssssi", $name, $email, $country, $city, $contact, $customerId);
            return $stmt->execute();  // Execute and return true if successful
        } else {
            die("Prepare statement failed: " . $conn->error);
        }
    }

}
