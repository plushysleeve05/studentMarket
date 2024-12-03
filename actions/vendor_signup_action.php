<?php
session_start();
include_once '../controllers/vendor_controller.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form input values from the signup form
    $name = $_POST['vendor_name'];
    $email = $_POST['vendor_email'];
    $password = $_POST['vendor_password'];
    $contact = $_POST['vendor_contact'];
    $address = $_POST['vendor_address'];
    $image = 'default.png'; // Optional image handling, set to default for now
    $joinDate = date("Y-m-d H:i:s"); // Current date and time
    $status = 'active'; // Default status is active

    // Register the vendor using the controller function
    $result = registerVendorController($name, $email, $password, $contact, $address, $image, $joinDate, $status);

    // Check if the registration was successful
    if ($result === "Vendor registered successfully!") {
        // After successful registration, get the new vendor by email
        $newVendor = getVendorByEmailController($email);

        // Save vendor information to the session
        $_SESSION['vendor_id'] = $newVendor['vendor_id'];
        $_SESSION['vendor_name'] = $newVendor['vendor_name'];
        $_SESSION['vendor_email'] = $newVendor['vendor_email'];

        // Redirect to vendor dashboard page after successful signup
        header("Location: ../view/vendor_dashboard.php");
        exit();
    } else {
        // Display error message if registration fails
        echo "<script>alert('$result');</script>";
    }
}
