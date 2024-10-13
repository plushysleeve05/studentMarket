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

        // Bind the parameters
        $stmt->bind_param('ssssssss', $name, $email, $password, $country, $city, $contact, $image, $role);

        // Execute the statement and return the result
        return $stmt->execute();
    }

    // Method to get customer by email for login purposes
    public function getCustomerByEmail($email)
    {
        // SQL query to get customer details by email
        $sql = "SELECT * FROM customer WHERE customer_email = ?";

        // Prepare the query
        $stmt = $this->db->db_conn()->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch the record
        return $result->fetch_assoc();
    }

    // Method to get customer by ID
    public function getCustomerByID($customer_id)
    {
        $sql = "SELECT * FROM customer WHERE customer_id = ?";

        // Prepare the query
        $stmt = $this->db->db_conn()->prepare($sql);
        $stmt->bind_param('i', $customer_id);
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch the record
        return $result->fetch_assoc();
    }

    // Method to update customer details
    public function updateCustomer($customer_id, $name, $email, $country, $city, $contact, $image)
    {
        $sql = "UPDATE customer SET customer_name = ?, customer_email = ?, customer_country = ?, customer_city = ?, customer_contact = ?, customer_image = ? WHERE customer_id = ?";

        // Prepare the query
        $stmt = $this->db->db_conn()->prepare($sql);
        $stmt->bind_param('ssssssi', $name, $email, $country, $city, $contact, $image, $customer_id);

        // Execute the statement and return the result
        return $stmt->execute();
    }

    // Method to delete a customer
    public function deleteCustomer($customer_id)
    {
        $sql = "DELETE FROM customer WHERE customer_id = ?";

        // Prepare the query
        $stmt = $this->db->db_conn()->prepare($sql);
        $stmt->bind_param('i', $customer_id);

        // Execute the statement and return the result
        return $stmt->execute();
    }
}
