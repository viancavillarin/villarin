<?php

require_once 'core/models.php';

// Check if payment ID is passed via the URL
if (isset($_GET['id'])) {
    $payment_id = $_GET['id'];
    
    // Call the function to delete the payment
    deletePayment($payment_id);
    
    // Redirect to the main page (index.php) after deletion
    header("Location: index.php");
    exit;
} else {
    // If no payment ID is provided, redirect to the main page
    header("Location: index.php");
    exit;
}

?>
