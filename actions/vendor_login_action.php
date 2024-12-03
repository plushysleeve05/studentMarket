<?php
session_start();
include_once '../controllers/vendor_controller.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['vendor_email'];
    $password = $_POST['vendor_pass'];

    // Get vendor details using the email
    $vendorData = getVendorByEmailController($email);

    if ($vendorData) {
        // Verify the hashed password
        if (password_verify($password, $vendorData['vendor_password'])) {
            // Password is correct, set session variables
            $_SESSION['vendor_id'] = $vendorData['vendor_id'];
            $_SESSION['vendor_name'] = $vendorData['vendor_name'];
            $_SESSION['vendor_email'] = $vendorData['vendor_email'];

            // Redirect to vendor dashboard page after successful login
            header("Location: ../view/vendor_dashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid email or password!');</script>";
        }
    } else {
        echo "<script>alert('Vendor not found!');</script>";
    }
}

// Debugging: Check current session values
error_log("Session after attempting login: " . print_r($_SESSION, true));
