<?php
include_once realpath('../settings/db_class.php');  // Include the db_connection class

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

        // Update the field names in the query to match your actual products table structure
        $query = "SELECT products.product_title, orderdetails.qty, products.product_price 
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


    // Method to get the latest order for a specific customer
    public function getLatestOrderForCustomer($customerId)
    {
        $conn = $this->db->db_conn();  // Get the MySQLi connection

        if ($conn === false) {
            die("Database connection error");
        }

        $query = "SELECT * FROM orders WHERE customer_id = ? ORDER BY order_date DESC, order_id DESC LIMIT 1";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $customerId);  // Bind the customer ID parameter
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc();  // Fetch the latest order as an associative array
            } else {
                return null;  // Return null if no order is found
            }
        } else {
            die("Prepare statement failed: " . $conn->error);
        }
    }

    public function markOrderAsPaid($orderId)
    {
        $conn = $this->db->db_conn();  // Get the MySQLi connection

        if ($conn === false) {
            die("Database connection error");
        }

        $query = "UPDATE orders SET order_status = 'Paid' WHERE order_id = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $orderId);
            return $stmt->execute();  // Execute the statement and return true if successful
        } else {
            die("Prepare statement failed: " . $conn->error);
        }
    }

    // Method to save payment information to the 'payment' table
    public function savePayment($amount, $customerId, $orderId, $currency, $paymentDate)
    {
        $conn = $this->db->db_conn();  // Get the MySQLi connection

        if ($conn === false) {
            die("Database connection error");
        }

        $query = "INSERT INTO payment (amt, customer_id, order_id, currency, payment_date) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("diiss", $amount, $customerId, $orderId, $currency, $paymentDate);  // Bind parameters
            if ($stmt->execute()) {
                return true;  // Payment record inserted successfully
            } else {
                die("Execution failed: " . $stmt->error);
            }
        } else {
            die("Prepare statement failed: " . $conn->error);
        }
    }

    // Method to get the latest unpaid order for a customer
    public function getLatestUnpaidOrder($customerId)
    {
        $conn = $this->db->db_conn();  // Get the MySQLi connection

        if ($conn === false) {
            die("Database connection error");
        }

        $query = "SELECT * FROM orders WHERE customer_id = ? AND order_status = 'pending' ORDER BY order_date DESC LIMIT 1";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $customerId);  // Bind customer ID
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc();  // Return the order as an associative array
            } else {
                return null;  // No unpaid order found
            }
        } else {
            die("Prepare statement failed: " . $conn->error);
        }
    }

    // Method to get all orders for a specific customer
    public function getOrdersByCustomerId($customerId)
    {
        $conn = $this->db->db_conn();  // Get the MySQLi connection

        if ($conn === false) {
            die("Database connection error");
        }

        $query = "SELECT * FROM orders WHERE customer_id = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $customerId);  // Bind the customer ID parameter
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result) {
                return $result->fetch_all(MYSQLI_ASSOC);  // Fetch all orders as an associative array
            } else {
                return [];  // Return an empty array if the query fails
            }
        } else {
            die("Prepare statement failed: " . $conn->error);
        }
    }



    
}
