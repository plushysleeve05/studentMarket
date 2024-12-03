<?php
session_start();  // Start the session
// Print out all the session variables for debugging purposes
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
// Include necessary controllers
include_once realpath('../controllers/order_controller.php');

// Check if customer is logged in
if (!isset($_SESSION['customer_id'])) {
    echo "You need to be logged in to view your order.";
    exit();
}

// Get the latest order for the logged-in customer
$customerId = $_SESSION['customer_id'];
$latestOrder = viewLatestOrderForCustomerController($customerId);

if ($latestOrder) {
    $orderId = $latestOrder['order_id'];
    $orderDetails = viewOrderDetailsController($orderId);
} else {
    echo "No recent orders found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="../css/login.css">
    <!-- <link rel="stylesheet" href="../css/order_confirmation.css"> -->
    <style>
        /* CSS for Paystack "Pay Now" button */

        #pay-now-button {
            background-color: #65a551;
            /* Green color matching your site's color palette */
            color: #ffffff;
            /* White text color */
            border: none;
            /* No border */
            padding: 15px 30px;
            /* Padding for better spacing */
            border-radius: 5px;
            /* Rounded corners */
            font-size: 1.2rem;
            /* Font size for readability */
            font-weight: bold;
            /* Make the button text bold */
            cursor: pointer;
            /* Show pointer cursor on hover */
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            /* Smooth hover transition */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Subtle shadow for a lifted effect */
            margin-top: 20px;
            /* Margin to separate from other elements */
        }

        /* Hover effect for button */
        #pay-now-button:hover {
            background-color: #36582b;
            /* Darker shade of green for hover effect */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            /* More pronounced shadow on hover */
            transform: translateY(-2px);
            /* Slight lift effect */
        }

        /* Button focused state (for accessibility) */
        #pay-now-button:focus {
            outline: none;
            /* Remove default outline */
            box-shadow: 0 0 0 4px rgba(101, 165, 81, 0.5);
            /* Add a subtle focus ring for accessibility */
        }

        body {
            background-color: #f4f7f6;
            /* Matches the overall background of your site */
            font-family: "Arial", sans-serif;
        }

        .main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .middle-div {
            flex-grow: 1;
        }

        /* Navigation */
        .navigation {
            z-index: 1000;
            background-color: #ffffff;
            width: 100%;
            top: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            height: 9vh;
            /* position: sticky; */
        }

        /* Styles for the n-two nav */
        .n-two {
            width: 80%;
            display: flex;
            justify-content: left;
            align-items: center;
            height: auto;
            margin: 0;
            padding: 0;
            position: sticky;
        }

        .n-two ul {
            list-style-type: none;
            display: flex;
            gap: 40px;
            margin: 0;
            padding: 0;
        }

        .n-two ul li {
            display: inline-block;
        }

        .n-two ul li a {
            text-decoration: none;
            color: #4b6043;
            font-size: 16px;
            font-weight: bold;
            padding: 5px 10px;
            transition: color 0.3s ease;
        }

        .n-two ul li a:hover {
            color: #65a551;
        }

        /* Navigation Logo */
        .nav-logo {
            height: 200px;
            width: auto;
            object-fit: contain;
            background-color: none;
        }

        /* Search Bar Styling */
        .search-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 10vh;
            color: white;
            width: 80%;
        }

        .search-bar input {
            width: 80%;
            height: 45px;
            border-radius: 25px;
            border: none;
            padding: 0 20px;
            font-size: 1.2rem;
            outline: none;
        }

        .nav-icons {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        .nav-icons img {
            height: 120px;
        }



        .login-banner {
            background-image: url("../images/mainbg.svg");
            background-size: cover;
            text-align: center;
            padding: 60px 20px;
            color: #ffffff;
            background-color: rgba(0, 0, 0, 0.6);
            margin-bottom: 40px;
        }

        .login-banner h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #4b6043;
        }

        .receipt-container {
            width: 60%;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .receipt-title {
            font-size: 2rem;
            color: #4b6043;
            text-align: center;
            margin-bottom: 20px;
        }

        .receipt-details {
            color: #36582b;
        }

        .receipt-table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        .receipt-table th,
        .receipt-table td {
            border-bottom: 1px solid #dddddd;
            padding: 15px;
            text-align: left;
            font-size: 1rem;
        }

        .receipt-table th {
            background-color: #65a551;
            color: #ffffff;
            font-weight: bold;
        }

        .receipt-total {
            text-align: right;
            font-size: 1.2rem;
            margin-top: 20px;
        }

        .receipt-total p {
            color: #4b6043;
            font-weight: bold;
        }

        .pay-now-button {
            background-color: #65a551;
            color: #ffffff;
            border: none;
            padding: 15px 30px;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .pay-now-button:hover {
            background-color: #36582b;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="middle-div">
            <!-- Navigation -->
            <nav class="navigation">
                <div class="left-div"></div>
                <!-- logo placeholder -->
                <img src="../images/STMarketPlace2.svg" alt="Logo" class="nav-logo" />
                <nav class="n-two">
                    <div class="left-div"></div>
                    <!-- Navigation Links -->
                    <ul>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="view_products.php">Products</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                    <div class="right-div"></div>
                </nav>
                <!-- Search Bar -->
                <form action="search.php" method="get" class="search-bar">
                    <input type="text" name="query" placeholder="Search...">
                </form>
                <!-- Cart, Account, and Logout Button -->
                <div class="nav-icons">
                    <div class="cart-button" id="open-cart-button">
                        <img src="../images/cart.svg" alt="Cart" />
                    </div>
                    <?php if (isset($_SESSION['customer_id'])): ?>
                        <a href="view/account.php" class="account-button">
                            <img src="../images/profile2.svg" alt="Account" />
                        </a>
                        <span class="username-display"><?php echo htmlspecialchars($_SESSION['customer_name']); ?></span>
                        <a href="actions/logout.php" class="logout-button">Logout</a>
                    <?php else: ?>
                        <a href="view/login.php" class="account-button">
                            <img src="images/profile2.svg" alt="Login" />
                        </a>
                    <?php endif; ?>
                </div>
                <div class="right-div"></div>
            </nav>

            <!-- Order Confirmation Banner -->
            <div class="login-banner">
                <div class="banner-content">
                    <h1>Order Confirmation</h1>
                    <p>Order Details for Your Recent Purchase</p>
                </div>
            </div>

            <!-- Receipt Container -->
            <div class="receipt-container">
                <h2 class="receipt-title">Order Receipt</h2>
                <div class="receipt-details">
                    <p><strong>Order ID:</strong> <?php echo htmlspecialchars($orderId); ?></p>
                    <p><strong>Order Date:</strong> <?php echo htmlspecialchars($latestOrder['order_date']); ?></p>
                    <hr>
                    <table class="receipt-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price (GHS)</th>
                                <th>Total (GHS)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $subtotal = 0;
                            foreach ($orderDetails as $detail):
                                $total = $detail['qty'] * $detail['product_price'];
                                $subtotal += $total;
                            ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($detail['product_title']); ?></td>
                                    <td><?php echo htmlspecialchars($detail['qty']); ?></td>
                                    <td>GHS <?php echo number_format($detail['product_price'], 2); ?></td>
                                    <td>GHS <?php echo number_format($total, 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <hr>
                    <div class="receipt-total">
                        <p><strong>Subtotal:</strong> GHS <?php echo number_format($subtotal, 2); ?></p>
                    </div>

                    <button id="pay-now-button">Pay Now</button>



                    <p style="text-align: center; margin-top: 20px;"><strong>Thank you for shopping with us!</strong></p>
                </div>
            </div><br><br>
        </div>
    </div>
    ] <script src="https://js.paystack.co/v2/inline.js"></script>
    <script>
        document.getElementById('pay-now-button').addEventListener('click', function() {
            // Assuming that your PHP session is correctly set and these values are available
            let customerEmail = '<?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ""; ?>';
            let orderAmount = '<?php echo $subtotal; ?>';

            // Ensure that the order amount is converted to an integer
            orderAmount = parseInt(orderAmount) * 100; // Convert Cedis to Kobo (Paystack expects amount in the smallest currency unit)

            // Check if required session values are available
            if (customerEmail && orderAmount > 0) {
                let handler = PaystackPop.setup({
                    key: 'pk_test_4d65e464b12acc518d51931b9b5634e99d4d7f68', // Replace with your Paystack public key
                    email: customerEmail,
                    amount: orderAmount, // Amount in Kobo (converted from Cedis)
                    currency: 'GHS', // Use GHS for Ghanaian Cedis
                    ref: 'studentPay' + Math.floor((Math.random() * 1000000000) + 1), // Unique reference for each transaction
                    onClose: function() {
                        alert('Payment window closed');
                    },
                    callback: function(response) {
                        // Payment was successful, handle success response
                        alert('Payment successful! Transaction reference: ' + response.reference);

                        // Optionally, send a request to the server to confirm and record the payment
                        window.location.href = 'order_success.php?reference=' + response.reference;
                    }
                });

                handler.openIframe(); // Open Paystack payment modal
            } else {
                alert('Unable to process payment. Please ensure you are logged in and the order amount is correct.');
            }
        });
    </script>


</body>

</html>