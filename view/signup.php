<?php
include_once '../controllers/customer_controller.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['customer_name'];
    $email = $_POST['customer_email'];
    $password = $_POST['customer_pass'];
    $country = $_POST['customer_country'];
    $city = $_POST['customer_city'];
    $contact = $_POST['customer_contact'];
    $image = 'default.png'; // Optional image handling
    $role = 'customer'; // Default role

    // Register the customer using the function
    $result = registerCustomerController($name, $email, $password, $country, $city, $contact, $image, $role);

    // Check if the registration was successful
    if ($result === "Customer registered successfully!") {
        $_SESSION['customer_id'] = getCustomerByIDController($email)['customer_id']; // Save customer ID to session
        header("Location: ../view/login.php"); // Redirect after successful signup
        exit();
    } else {
        // Display error message
        echo "<script>alert('$result');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="../css/login-signup.css">
</head>

<body>
    <div class="auth-container">
        <form action="signup.php" method="POST">
            <h2>Create Account</h2>
            <label for="customer_name">Name</label>
            <input type="text" name="customer_name" required>

            <label for="customer_email">Email</label>
            <input type="email" name="customer_email" required>

            <label for="customer_pass">Password</label>
            <input type="password" name="customer_pass" required>

            <label for="customer_country">Country</label>
            <input type="text" name="customer_country" required>

            <label for="customer_city">City</label>
            <input type="text" name="customer_city" required>

            <label for="customer_contact">Contact</label>
            <input type="text" name="customer_contact" required>

            <button type="submit">Sign Up</button>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>

</html>