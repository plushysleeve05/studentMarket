<?php
include_once realpath(__DIR__ . '/../settings/db_class.php');

class Cart
{
    private $db;

    public function __construct()
    {
        $this->db = new db_connection();
    }

    public function getCartItemsByCustomerId($customerId)
    {
        $conn = $this->db->db_conn();  // Get the MySQLi connection

        if ($conn === false) {
            die("Database connection error");
        }

        $query = "SELECT cart.product_id, cart.qty, products.product_name, products.price, products.product_image 
                  FROM cart 
                  JOIN products ON cart.product_id = products.product_id 
                  WHERE cart.customer_id = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $customerId);  // Bind the customer ID parameter
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result) {
                return $result->fetch_all(MYSQLI_ASSOC);  // Fetch all cart items as an associative array
            } else {
                return [];  // Return an empty array if the query fails
            }
        } else {
            die("Prepare statement failed: " . $conn->error);
        }
    }


    // Add a product to the cart for a logged-in customer
    public function addToCart($customer_id, $product_id, $quantity)
    {
        // Check stock availability
        $sqlStock = "SELECT stock FROM products WHERE product_id = ?";
        $stmtStock = $this->db->db_conn()->prepare($sqlStock);
        if (!$stmtStock) {
            error_log("Prepare failed for stock check: " . $this->db->db_conn()->error);
            return ['success' => false, 'message' => 'Internal error. Please try again later.'];
        }

        $stmtStock->bind_param('i', $product_id);
        $stmtStock->execute();
        $resultStock = $stmtStock->get_result();
        $product = $resultStock->fetch_assoc();

        if (!$product || $product['stock'] < $quantity) {
            return ['success' => false, 'message' => 'Product out of stock or insufficient quantity available.'];
        }

        // Check if the product already exists in the cart
        $sqlCheck = "SELECT qty FROM cart WHERE c_id = ? AND p_id = ?";
        $stmtCheck = $this->db->db_conn()->prepare($sqlCheck);
        if (!$stmtCheck) {
            error_log("Prepare failed for cart check: " . $this->db->db_conn()->error);
            return ['success' => false, 'message' => 'Internal error. Please try again later.'];
        }

        $stmtCheck->bind_param('ii', $customer_id, $product_id);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();
        $existingCartItem = $resultCheck->fetch_assoc();

        if ($existingCartItem) {
            // If the product is in the cart, update the quantity (validate against stock)
            $newQty = $existingCartItem['qty'] + $quantity;
            if ($newQty > $product['stock']) {
                return ['success' => false, 'message' => 'Cannot add more. Stock limit reached.'];
            }

            $sqlUpdate = "UPDATE cart SET qty = ? WHERE c_id = ? AND p_id = ?";
            $stmtUpdate = $this->db->db_conn()->prepare($sqlUpdate);
            if (!$stmtUpdate) {
                error_log("Prepare failed for cart update: " . $this->db->db_conn()->error);
                return ['success' => false, 'message' => 'Internal error. Please try again later.'];
            }

            $stmtUpdate->bind_param('iii', $newQty, $customer_id, $product_id);
            if ($stmtUpdate->execute()) {
                // Decrease stock after updating the cart
                $this->decreaseStock($product_id, $quantity);
                return ['success' => true, 'message' => 'Product quantity updated successfully in cart.'];
            } else {
                return ['success' => false, 'message' => 'Failed to update cart.'];
            }
        } else {
            // If the product is not in the cart, add it with the specified quantity
            $sqlInsert = "INSERT INTO cart (p_id, c_id, qty) VALUES (?, ?, ?)";
            $stmtInsert = $this->db->db_conn()->prepare($sqlInsert);
            if (!$stmtInsert) {
                error_log("Prepare failed for cart insert: " . $this->db->db_conn()->error);
                return ['success' => false, 'message' => 'Internal error. Please try again later.'];
            }

            $stmtInsert->bind_param('iii', $product_id, $customer_id, $quantity);
            if ($stmtInsert->execute()) {
                // Decrease stock after adding the product to the cart
                $this->decreaseStock($product_id, $quantity);
                return ['success' => true, 'message' => 'Product added to cart successfully.'];
            } else {
                return ['success' => false, 'message' => 'Failed to add product to cart.'];
            }
        }
    }


    // Method to decrease stock by a certain quantity
    private function decreaseStock($product_id, $quantity)
    {
        $sql = "UPDATE products SET stock = stock - ? WHERE product_id = ? AND stock >= ?";
        $stmt = $this->db->db_conn()->prepare($sql);
        if (!$stmt) {
            error_log("Prepare failed for decreasing stock: " . $this->db->db_conn()->error);
            return false;
        }

        $stmt->bind_param('iii', $quantity, $product_id, $quantity);
        return $stmt->execute();
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
    // Remove product from cart
    public function removeFromCart($customer_id, $product_id)
    {
        $sql = "DELETE FROM cart WHERE c_id = ? AND p_id = ?";
        $stmt = $this->db->db_conn()->prepare($sql);
        $stmt->bind_param('ii', $customer_id, $product_id);
        $result = $stmt->execute();

        if ($result) {
            // If cart removal is successful, update stock in products table
            $sqlUpdateStock = "UPDATE products SET stock = stock + 1 WHERE product_id = ?";
            $stmtUpdateStock = $this->db->db_conn()->prepare($sqlUpdateStock);
            $stmtUpdateStock->bind_param('i', $product_id);
            if (!$stmtUpdateStock->execute()) {
                error_log("Failed to update stock for product_id: $product_id");
                return false; // Return false if stock update fails
            }
            return true;
        }

        return false; // Return false if removal fails
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

    public function getCartItemByCustomerAndProduct($customer_id, $product_id)
    {
        $sql = "SELECT * FROM cart WHERE c_id = ? AND p_id = ?";
        $stmt = $this->db->db_conn()->prepare($sql);
        $stmt->bind_param('ii', $customer_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    
}
