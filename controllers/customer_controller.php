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

    // Verify the password and customer details
    if ($existingCustomer && password_verify($password, $existingCustomer['customer_pass'])) {
        session_start();
        $_SESSION['customer_id'] = $existingCustomer['customer_id'];
        return true; // Login successful
    } else {
        return false; // Login failed
    }
}

// Get Customer by ID Controller
function getCustomerByIDController($customer_id)
{
    global $customer;
    return $customer->getCustomerByID($customer_id);
}

// Update Customer Controller
function updateCustomerController($customer_id, $name, $email, $country, $city, $contact, $image)
{
    global $customer;
    return $customer->updateCustomer($customer_id, $name, $email, $country, $city, $contact, $image);
}

// Delete Customer Controller
function deleteCustomerController($customer_id)
{
    global $customer;
    return $customer->deleteCustomer($customer_id);
}
