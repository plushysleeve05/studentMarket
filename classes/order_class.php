<?php
include_once '../settings/db_class.php';  // Include the db_connection class

class Order
{
    private $db;  // This will be an instance of db_connection

    public function __construct()
    {
        $this->db = new db_connection();  // Initialize db_connection class
    }

    // Method to create a new order
    public function createOrder($customerId, $invoiceNo, $orderDate, $status)
    {
        $conn = $this->db->db_conn();  // Get the MySQLi connection

        if ($conn === false) {
            die("Database connection error");
        }

        $query = "INSERT INTO orders (customer_id, invoice_no, order_date, order_status) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("isss", $customerId, $invoiceNo, $orderDate, $status);  // Bind parameters
            if ($stmt->execute()) {
                return $conn->insert_id;  // Return the ID of the newly created order
            } else {
                die("Execution failed: " . $stmt->error);
            }
        } else {
            die("Prepare statement failed: " . $conn->error);
        }
    }

    // Method to add items to the 'orderdetails' table
    public function addOrderDetails($orderId, $productId, $quantity)
    {
        $conn = $this->db->db_conn();  // Get the MySQLi connection

        if ($conn === false) {
            die("Database connection error");
        }

        $query = "INSERT INTO orderdetails (order_id, product_id, qty) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("iii", $orderId, $productId, $quantity);  // Bind parameters
            return $stmt->execute();  // Execute the statement and return true if successful
        } else {
            die("Prepare statement failed: " . $conn->error);
        }
    }

    // Method to delete an order by ID
    public function deleteOrder($orderId)
    {
        $conn = $this->db->db_conn();  // Get the MySQLi connection

        if ($conn === false) {
            die("Database connection error");
        }

        // First, delete order items associated with this order
        $deleteItemsQuery = "DELETE FROM orderdetails WHERE order_id = ?";
        $stmtItems = $conn->prepare($deleteItemsQuery);
        if ($stmtItems) {
            $stmtItems->bind_param("i", $orderId);
            $stmtItems->execute();
        } else {
            die("Prepare statement for deleting order items failed: " . $conn->error);
        }

        // Now delete the main order
        $query = "DELETE FROM orders WHERE order_id = ?";
        $stmtOrder = $conn->prepare($query);

        if ($stmtOrder) {
            $stmtOrder->bind_param("i", $orderId);
            if ($stmtOrder->execute()) {
                if ($stmtOrder->affected_rows > 0) {
                    return true;  // Deletion was successful
                } else {
                    return false;  // No rows were deleted (order ID doesn't exist)
                }
            } else {
                die("Execution failed: " . $stmtOrder->error);
            }
        } else {
            die("Prepare statement failed: " . $conn->error);
        }
    }

    // Method to get all orders
    public function getOrders()
    {
        $conn = $this->db->db_conn();  // Get the MySQLi connection

        if ($conn === false) {
            die("Database connection error");
        }

        $query = "SELECT * FROM orders";
        $result = $conn->query($query);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);  // Fetch all orders as an associative array
        } else {
            return [];  // Return an empty array if the query fails
        }
    }

    // Method to get order details for a specific order
    public function getOrderDetails($orderId)
    {
        $conn = $this->db->db_conn();  // Get the MySQLi connection

        if ($conn === false) {
            die("Database connection error");
        }

        $query = "SELECT products.product_name, orderdetails.qty, products.price 
                  FROM orderdetails 
                  JOIN products ON orderdetails.product_id = products.product_id 
                  WHERE orderdetails.order_id = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $orderId);  // Bind the order ID parameter
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result) {
                return $result->fetch_all(MYSQLI_ASSOC);  // Fetch all order items as an associative array
            } else {
                return [];  // Return an empty array if the query fails
            }
        } else {
            die("Prepare statement failed: " . $conn->error);
        }
    }
}
