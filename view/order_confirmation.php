<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="../css/order-styles.css">
</head>

<body>
    <div class="container">
        <div class="confirmation-box">
            <h1>Thank you for your order!</h1>
            <p>Your order has been successfully placed.</p>

            <!-- Order Summary Section -->
            <div class="order-summary">
                <h2>Order Summary</h2>

                <?php
                // Include database connection file
                include_once '../settings/db_class.php';

                // Instantiate database connection
                $db = new db_connection();
                $conn = $db->db_conn();

                // Check if order_id is set in the URL
                if (isset($_GET['order_id'])) {
                    $orderId = $_GET['order_id'];

                    // Fetch order details from the orders table
                    $orderQuery = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
                    if (!$orderQuery) {
                        die("Prepare statement failed for order details: " . $conn->error);
                    }

                    $orderQuery->bind_param("i", $orderId);
                    $orderQuery->execute();
                    $orderResult = $orderQuery->get_result()->fetch_assoc();

                    // Check if the order exists
                    if ($orderResult) {
                        // Display basic order information
                        echo "<p><strong>Invoice No:</strong> " . htmlspecialchars($orderResult['invoice_no']) . "</p>";
                        echo "<p><strong>Order Date:</strong> " . htmlspecialchars($orderResult['order_date']) . "</p>";
                        echo "<p><strong>Status:</strong> " . htmlspecialchars($orderResult['order_status']) . "</p>";
                    } else {
                        echo "<p>Error: Order not found.</p>";
                        exit();
                    }

                    // Fetch order items from the orderdetails table and get prices from products
                    $itemsQuery = $conn->prepare("SELECT orderdetails.qty 
                                                  FROM orderdetails 
                                                  JOIN products ON orderdetails.product_id = products.product_id 
                                                  WHERE orderdetails.order_id = ?");
                    if (!$itemsQuery) {
                        die("Prepare statement failed for order items: " . $conn->error);
                    }

                    $itemsQuery->bind_param("i", $orderId);
                    $itemsQuery->execute();
                    $itemsResult = $itemsQuery->get_result();

                    // Display order items in a table
                ?>
                    <!-- <table>
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalAmount = 0;
                            while ($item = $itemsResult->fetch_assoc()) {
                                $itemTotal = $item['price'] * $item['qty'];
                                $totalAmount += $itemTotal;
                                echo "<tr>
                                        <td></td>
                                        <td>" . htmlspecialchars($item['qty']) . "</td>
                                        <td>$" . number_format($item['price'], 2) . "</td>
                                        <td>$" . number_format($itemTotal, 2) . "</td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="total-label">Grand Total:</td>
                                <td><?php echo "$" . number_format($totalAmount, 2); ?></td>
                            </tr>
                        </tfoot>
                    </table> -->
                <?php
                } else {
                    echo "<p>Error: Order ID not provided.</p>";
                }
                ?>
            </div>

            <?php if (isset($orderId)) { ?>
                <button class="payment-button" onclick="window.location.href='payment.php?order_id=<?php echo $orderId; ?>'">Proceed to Payment</button>
            <?php } ?>
        </div>
    </div>
</body>

</html>