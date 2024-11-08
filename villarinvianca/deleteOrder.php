<?php

require_once 'core/models.php';

// Check if order ID is passed via the URL
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    
    // Call the function to delete the order
    deleteOrder($order_id);
    
    // Redirect to the main page (index.php) after deletion
    header("Location: index.php");
    exit;
} else {
    // If no order ID is provided, redirect to the main page
    header("Location: index.php");
    exit;
}

?>
