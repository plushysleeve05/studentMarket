<?php
include_once '../classes/customer_class.php';

$customer = new Customer();

// Register Customer Controller
function registerCustomerController($name, $email, $password, $country, $city, $contact, $image, $role)
{
    global $customer;

    // Check if the customer already exists by email
    $existingCustomer = $customer->getCustomerByEmail($email);

    if ($existingCustomer) {
        // Return error message if customer already exists
        return "Email already registered!";
    } else {
        // Hash the password before storing
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Add new customer
        if ($customer->addCustomer($name, $email, $hashedPassword, $country, $city, $contact, $image, $role)) {
            return "Customer registered successfully!";
        } else {
            return "Error in customer registration!";
        }
    }
}

// Authenticate Customer Controller (Login)
function authenticateCustomerController($email, $password)
{
    global $customer;

    // Get customer data by email
    $existingCustomer = $customer->getCustomerByEmail($email);

    if ($existingCustomer) {
        // Verify the password and customer details
        if (password_verify($password, $existingCustomer['customer_pass'])) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['customer_id'] = $existingCustomer['customer_id'];
            $_SESSION['customer_name'] = $existingCustomer['customer_name']; // Store name for display
            $_SESSION['user_email'] = $existingCustomer['customer_email'];  // Store email if needed

            // Debugging session details
            error_log("Login successful. Session data: " . print_r($_SESSION, true));

            return true; // Login successful
        } else {
            error_log("Password verification failed for email: " . $email);
            return false; // Password incorrect
        }
    } else {
        error_log("No customer found with email: " . $email);
        return false; // Email not found
    }
}
