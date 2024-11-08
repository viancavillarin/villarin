<?php

require_once 'core/models.php';

// Check if customer ID is passed via the URL
if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];
    
    // Call the function to delete the customer
    deleteCustomer($customer_id);
    
    // Redirect to the main page (index.php) after deletion
    header("Location: index.php");
    exit;
} else {
    // If no customer ID is provided, redirect to the main page
    header("Location: index.php");
    exit;
}

?>
