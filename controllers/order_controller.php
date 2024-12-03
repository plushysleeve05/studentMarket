<?php
// Include the Order class
include_once realpath('../classes/order_class.php');

$order = new Order();

function markOrderAsPaidController($orderId)
{
    global $order;
    return $order->markOrderAsPaid($orderId);
}

function addOrderController($customerId, $invoiceNo, $orderDate, $status)
{
    global $order;
    return $order->createOrder($customerId, $invoiceNo, $orderDate, $status);
}

function deleteOrderController($orderId)
{
    global $order;
    return $order->deleteOrder($orderId);
}

function viewOrdersController()
{
    global $order;
    return $order->getOrders();
}

function viewOrderDetailsController($orderId)
{
    global $order;
    return $order->getOrderDetails($orderId);
}

function viewLatestOrderForCustomerController($customerId)
{
    global $order;
    return $order->getLatestOrderForCustomer($customerId);
}

function savePaymentController($amount, $customerId, $orderId, $currency, $paymentDate)
{
    global $order;
    return $order->savePayment($amount, $customerId, $orderId, $currency, $paymentDate);
}

function getLatestUnpaidOrderController($customerId)
{
    global $order;
    return $order->getLatestUnpaidOrder($customerId);
}

// View orders for a specific customer (Read)
function viewOrdersByCustomerController($customerId)
{
    global $order;
    return $order->getOrdersByCustomerId($customerId);  // Returns an array of all orders for a specific customer
}
