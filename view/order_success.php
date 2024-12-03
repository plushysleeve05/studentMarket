<?php
session_start();

// Include necessary configurations and controllers
include_once '../controllers/order_controller.php';

// Check if the transaction reference is set in the URL
if (!isset($_GET['reference'])) {
    echo "No transaction reference found.";
    exit();
}

$reference = $_GET['reference']; // Get the reference from the URL

// Verify the transaction using Paystack API
$url = "https://api.paystack.co/transaction/verify/" . rawurlencode($reference);

// Initiate cURL to verify the transaction
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer sk_test_a9b2fa55484b1f2d5b5f8c5125da5c598dadd5e9", // Replace with your Paystack secret key
]);

$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($httpcode !== 200) {
    echo "Failed to verify transaction.";
    exit();
}

curl_close($ch);

// Decode response from Paystack
$result = json_decode($response, true);

// Get result status
$success = $result['status'] && $result['data']['status'] == 'success';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="../css/order_confirmation.css"> <!-- Link to your existing stylesheet for consistency -->
    <style>
        body {
            background-color: #f4f7f6;
            font-family: "Arial", sans-serif;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .main-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .header-banner {
            background-color: #65a551;
            color: #ffffff;
            padding: 40px 20px;
            border-radius: 10px 10px 0 0;
        }

        .header-banner h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .content-container {
            padding: 30px 20px;
            color: #4b6043;
        }

        .content-container h2 {
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        .content-container p {
            font-size: 1.2rem;
            margin: 10px 0;
        }

        .btn-container {
            margin-top: 30px;
        }

        .action-button {
            display: inline-block;
            padding: 15px 30px;
            background-color: #65a551;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .action-button:hover {
            background-color: #36582b;
        }

        .order-details {
            margin: 20px 0;
            font-size: 1.2rem;
        }

        .error-message {
            color: #d9534f;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="header-banner">
            <h1>Order Confirmation</h1>
        </div>
        <div class="content-container">
            <?php if ($success): ?>
                <?php
                // Payment was successful
                $customerId = $_SESSION['customer_id'];
                $amount = $result['data']['amount'] / 100; // Amount in GHS (divide by 100 to convert from Kobo)
                $currency = $result['data']['currency'];
                $paymentDate = date("Y-m-d H:i:s");

                // Retrieve the latest unpaid order for the customer
                $latestOrder = getLatestUnpaidOrderController($customerId);

                if ($latestOrder) {
                    $orderId = $latestOrder['order_id'];

                    // Mark the order as paid in the database
                    if (markOrderAsPaidController($orderId)) {
                        // Save payment record
                        if (savePaymentController($amount, $customerId, $orderId, $currency, $paymentDate)) {
                            echo "<h2>Payment Successful!</h2>";
                            echo "<p>Thank you for your payment of GHS " . number_format($amount, 2) . ".</p>";
                            echo "<p>Your order ID is: " . htmlspecialchars($orderId) . "</p>";
                            echo "<div class='btn-container'><a href='view_products.php' class='action-button'>Continue Shopping</a></div>";
                        } else {
                            echo "<h2 class='error-message'>Error</h2>";
                            echo "<p>Payment successful, but unable to save payment details. Please contact support.</p>";
                            echo "<div class='btn-container'><a href='view_products.php' class='action-button'>Go Back to Products</a></div>";
                        }
                    } else {
                        echo "<h2 class='error-message'>Error</h2>";
                        echo "<p>Unable to update order status. Please contact support.</p>";
                        echo "<div class='btn-container'><a href='view_products.php' class='action-button'>Go Back to Products</a></div>";
                    }
                } else {
                    echo "<h2 class='error-message'>Order Not Found</h2>";
                    echo "<p>No unpaid order found for your account.</p>";
                    echo "<div class='btn-container'><a href='view_products.php' class='action-button'>Continue Shopping</a></div>";
                }
                ?>
            <?php else: ?>
                <h2 class='error-message'>Payment Failed</h2>
                <p>Transaction reference: <?php echo htmlspecialchars($reference); ?>. Please try again or contact support.</p>
                <div class='btn-container'><a href='view_products.php' class='action-button'>Go Back to Products</a></div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>