<?php

require_once 'core/models.php';

// Check if payment ID is passed via URL
if (isset($_GET['id'])) {
    $payment_id = $_GET['id'];
    $payment = getPaymentById($payment_id);  // Fetch payment details by ID
    
    // If the payment doesn't exist, redirect or show an error
    if (!$payment) {
        header("Location: index.php");  // Redirect to the main page if payment not found
        exit;
    }

    // Get the current rental ID from the payment details
    $current_rental_id = $payment['rental_id'];
} else {
    // If no payment ID is passed, redirect to the main page
    header("Location: index.php");
    exit;
}

// Handle form submission for updating payment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $payment_date = $_POST['payment_date'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];

    // Update payment information in the database
    updatePayment($payment_id, $current_rental_id, $payment_date, $amount, $payment_method);

    // Redirect to the main page after updating the payment
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Payment</title>
    <link rel="stylesheet" href="style.css">  <!-- Assuming you have a CSS file -->
</head>
<body>
    <h1>Edit Payment</h1>

    <!-- Edit Payment Form -->
    <form action="editPayment.php?id=<?php echo $payment['payment_id']; ?>" method="POST">
        <!-- Rental ID (Hidden field or read-only) -->
        <label for="rental_id">Rental ID:</label>
        <input type="text" name="rental_id" value="<?php echo htmlspecialchars($current_rental_id); ?>" required readonly>
        <br><br>

        <!-- Payment Date -->
        <label for="payment_date">Payment Date:</label>
        <input type="date" name="payment_date" value="<?php echo htmlspecialchars($payment['payment_date']); ?>" required>
        <br><br>

        <!-- Amount -->
        <label for="amount">Amount:</label>
        <input type="number" name="amount" value="<?php echo htmlspecialchars($payment['amount']); ?>" required>
        <br><br>

        <!-- Payment Method -->
        <label for="payment_method">Payment Method:</label>
        <input type="text" name="payment_method" value="<?php echo htmlspecialchars($payment['payment_method']); ?>" required>
        <br><br>

        <!-- Submit Button -->
        <button type="submit">Update Payment</button>
    </form>
</body>
</html>
