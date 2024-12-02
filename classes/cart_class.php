<?php
include_once '../settings/db_class.php';

class Cart
{
    private $db;

    public function __construct()
    {
        $this->db = new db_connection();
    }

    // Add a product to the cart for a logged-in customer
    public function addToCart($customer_id, $product_id)
    {
        // Check stock availability
        $sqlStock = "SELECT stock FROM products WHERE product_id = ?";
        $stmtStock = $this->db->db_conn()->prepare($sqlStock);
        $stmtStock->bind_param('i', $product_id);
        $stmtStock->execute();
        $resultStock = $stmtStock->get_result();
        $product = $resultStock->fetch_assoc();

        if (!$product || $product['stock'] <= 0) {
            return false; // Out of stock
        }

        // Check if the product already exists in the cart
        $sqlCheck = "SELECT qty FROM cart WHERE c_id = ? AND p_id = ?";
        $stmtCheck = $this->db->db_conn()->prepare($sqlCheck);
        $stmtCheck->bind_param('ii', $customer_id, $product_id);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();
        $existingCartItem = $resultCheck->fetch_assoc();

        if ($existingCartItem) {
            // If the product is in the cart, update the quantity (validate against stock)
            $newQty = $existingCartItem['qty'] + 1;
            if ($newQty > $product['stock']) {
                return false; // Exceeds available stock
            }

            $sqlUpdate = "UPDATE cart SET qty = ? WHERE c_id = ? AND p_id = ?";
            $stmtUpdate = $this->db->db_conn()->prepare($sqlUpdate);
            $stmtUpdate->bind_param('iii', $newQty, $customer_id, $product_id);
            return $stmtUpdate->execute();
        } else {
            // If the product is not in the cart, add it
            $sqlInsert = "INSERT INTO cart (p_id, c_id, qty) VALUES (?, ?, 1)";
            $stmtInsert = $this->db->db_conn()->prepare($sqlInsert);
            $stmtInsert->bind_param('ii', $product_id, $customer_id);
            return $stmtInsert->execute();
        }
    }


    // Get cart items by customer ID
    public function getCartByCustomer($customer_id)
    {
        $sql = "SELECT cart.*, 
               products.product_title, 
               products.product_price, 
               (products.product_price * cart.qty) AS total_price 
        FROM cart 
        JOIN products ON cart.p_id = products.product_id 
        WHERE cart.c_id = ?";

        $stmt = $this->db->db_conn()->prepare($sql);
        $stmt->bind_param('i', $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Remove product from cart
    public function removeFromCart($customer_id, $product_id)
    {
        $sql = "DELETE FROM cart WHERE c_id = ? AND p_id = ?";
        $stmt = $this->db->db_conn()->prepare($sql);
        $stmt->bind_param('ii', $customer_id, $product_id);
        return $stmt->execute();
    }

    // Update product quantity in the cart
    public function updateCartQuantity($customer_id, $product_id, $quantity)
    {
        $sql = "UPDATE cart SET qty = ? WHERE c_id = ? AND p_id = ?";
        $stmt = $this->db->db_conn()->prepare($sql);
        $stmt->bind_param('iii', $quantity, $customer_id, $product_id);
        return $stmt->execute();
    }

    // Method to clear the cart for a specific customer
    public function clearCartByCustomer($customerId)
    {
        $conn = $this->db->db_conn();  // Assuming $this->db is an instance of db_connection

        if ($conn === false) {
            die("Database connection error");
        }

        $query = "DELETE FROM cart WHERE customer_id = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $customerId);
            return $stmt->execute();
        } else {
            die("Prepare statement failed: " . $conn->error);
        }
    }

    // Calculate Total Cart Value
    public function calculateCartTotal($customer_id)
    {
        $sql = "SELECT SUM(products.product_price * cart.qty) AS total 
            FROM cart 
            JOIN products ON cart.p_id = products.product_id 
            WHERE cart.c_id = ?";
        $stmt = $this->db->db_conn()->prepare($sql);
        $stmt->bind_param('i', $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'] ?? 0;
    }

    public function clearCart($customer_id)
    {
        $sql = "DELETE FROM cart WHERE c_id = ?";
        $stmt = $this->db->db_conn()->prepare($sql);
        $stmt->bind_param('i', $customer_id);
        return $stmt->execute();
    }

    
}
