<?php
include_once '../classes/vendor_class.php';

$vendor = new Vendor();

// Register a new vendor
function registerVendorController($name, $email, $password, $contact, $address, $image, $joinDate, $status)
{
    global $vendor;
    return $vendor->createVendor($name, $email, $password, $contact, $address, $image, $joinDate, $status);
}

// Get vendor by email
function getVendorByEmailController($email)
{
    global $vendor;
    return $vendor->getVendorByEmail($email);
}

// Get products by vendor ID
function getVendorProductsController($vendorId)
{
    global $vendor;
    return $vendor->getVendorProducts($vendorId);
}

function authenticateVendorController($email, $password)
{
    global $vendor;

    // Get the vendor details by email
    $vendorData = $vendor->getVendorByEmail($email);

    if ($vendorData) {
        // Verify if the password matches (assuming password is hashed)
        if (password_verify($password, $vendorData['vendor_password'])) {
            // Save vendor information in session
            $_SESSION['vendor_id'] = $vendorData['vendor_id'];
            $_SESSION['vendor_name'] = $vendorData['vendor_name'];
            $_SESSION['vendor_email'] = $vendorData['vendor_email'];

            return true;  // Authentication successful
        }
    }
    return false;  // Authentication failed
}

// Get vendor details by vendor ID
function getVendorByIdController($vendorId)
{
    global $vendor;
    return $vendor->getVendorById($vendorId);  // Calls the method from Vendor class
}

// Get all products by vendor ID
function viewProductsByVendorController($vendorId)
{
    global $vendor;
    return $vendor->getProductsByVendor($vendorId);  // Calls the method from Vendor class
}
