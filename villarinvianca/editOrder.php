<?php

require_once 'core/models.php';

// Check if order ID is passed via the URL
if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    $order = getOrderById($order_id);  // Fetch order details by ID
} else {
    // If no ID is passed, redirect to the main page
    header("Location: index.php");
    exit;
}

// Handle form submission (POST request)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];
    $order_date = $_POST['order_date'];
    $status = $_POST['status'];

    // Call the function to update the order details in the DB
    updateOrder($order_id, $customer_id, $product_id, $quantity, $total_price, $order_date, $status);

    // Redirect after successful update
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Order</title>
</head>
<body>
    <h1>Edit Order</h1>
    <form action="editOrder.php?id=<?php echo $order['order_id']; ?>" method="POST">
        <label for="customer_id">Customer</label>
        <select name="customer_id" required>
            <!-- Assuming you have a function to fetch all customers -->
            <?php 
            $customers = getAllCustomers(); 
            foreach ($customers as $customer) {
                echo "<option value='{$customer['customer_id']}' " . ($order['customer_id'] == $customer['customer_id'] ? 'selected' : '') . ">{$customer['first_name']} {$customer['last_name']}</option>";
            }
            ?>
        </select>

        <label for="product_id">Product</label>
        <select name="product_id" required>
            <!-- Assuming you have a function to fetch all products -->
            <?php 
            $products = getAllProducts(); 
            foreach ($products as $product) {
                echo "<option value='{$product['product_id']}' " . ($order['product_id'] == $product['product_id'] ? 'selected' : '') . ">{$product['name']}</option>";
            }
            ?>
        </select>

        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" value="<?php echo htmlspecialchars($order['quantity']); ?>" required>

        <label for="total_price">Total Price</label>
        <input type="number" name="total_price" value="<?php echo htmlspecialchars($order['total_price']); ?>" required>

        <label for="order_date">Order Date</label>
        <input type="date" name="order_date" value="<?php echo htmlspecialchars($order['order_date']); ?>" required>

        <label for="status">Status</label>
        <select name="status" required>
            <option value="pending" <?php echo $order['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
            <option value="shipped" <?php echo $order['status'] == 'shipped' ? 'selected' : ''; ?>>Shipped</option>
            <option value="delivered" <?php echo $order['status'] == 'delivered' ? 'selected' : ''; ?>>Delivered</option>
            <option value="cancelled" <?php echo $order['status'] == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
        </select>

        <button type="submit">Update Order</button>
    </form>
</body>
</html>
