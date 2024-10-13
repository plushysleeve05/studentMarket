<?php
include_once '../controllers/customer_controller.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['customer_email'];
    $password = $_POST['customer_pass']; // Plain password

    // Authenticate the customer using the function
    if (authenticateCustomerController($email, $password)) {
        header("Location: ../view/view_products.php"); // Redirect to dashboard on successful login
        exit();
    } else {
        echo "<script>alert('Invalid email or password!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login-signup.css">
</head>

<body>
    <div class="auth-container">
        <form action="login.php" method="POST">
            <h2>Login</h2>
            <label for="customer_email">Email</label>
            <input type="email" name="customer_email" required>

            <label for="customer_pass">Password</label>
            <input type="password" name="customer_pass" required>

            <button type="submit">Login</button>
            <p>Don't have an account? <a href="signup.php">Sign up</a></p>
        </form>
    </div>
</body>

</html>