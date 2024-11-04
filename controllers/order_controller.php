<?php
// Include the Order class
include_once '../classes/order_class.php';

// Instantiate the Order class
$order = new Order();

// Add a new order (Create)
function addOrderController()
{
    global $order;
    if (isset($_POST['customer_id']) && isset($_POST['invoice_no']) && isset($_POST['order_date']) && isset($_POST['status'])) {
        $customerId = $_POST['customer_id'];
        $invoiceNo = $_POST['invoice_no'];
        $orderDate = $_POST['order_date'];
        $status = $_POST['status'];

        if ($orderId = $order->createOrder($customerId, $invoiceNo, $orderDate, $status)) {
            header("Location: ../view/view_orders.php?order_id=$orderId");
        } else {
            header("Location: ../view/view_orders.php?error=Failed to add order");
        }
    }
}

// Delete an order (Delete)
function deleteOrderController()
{
    global $order;
    if (isset($_POST['order_id'])) {
        $orderId = $_POST['order_id'];
        if ($order->deleteOrder($orderId)) {
            header("Location: ../view/view_orders.php");
        } else {
            header("Location: ../view/view_orders.php?error=Failed to delete order");
        }
    }
}

// View all orders (Read)
function viewOrdersController()
{
    global $order;
    return $order->getOrders();  // Returns an array of all orders
}

// View order details by order ID (Read specific order details)
function viewOrderDetailsController($orderId)
{
    global $order;
    return $order->getOrderDetails($orderId);  // Returns an array of order items for a specific order
}
?>
