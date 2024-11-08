<?php

require_once 'core/dbConfig.php';

// Handle the insertion of a store
if (isset($_POST['insertStore'])) {
    $store_name = $_POST['store_name'];
    $location = $_POST['location'];

    $stmt = $pdo->prepare("INSERT INTO Store (store_name, location) 
                            VALUES (:store_name, :location)");
    $stmt->bindParam(':store_name', $store_name);
    $stmt->bindParam(':location', $location);

    $stmt->execute();
    header("Location: index.php");
    exit();
}

// Handle the insertion of a product
if (isset($_POST['insertProduct'])) {
    $product_name = $_POST['product_name'];
    $product_type = $_POST['product_type']; // e.g., 'Badminton Racket', 'Badminton Shoes', etc.
    $price = $_POST['price'];
    $store_id = $_POST['store_id'];

    $stmt = $pdo->prepare("INSERT INTO Products (product_name, product_type, price, store_id) 
                            VALUES (:product_name, :product_type, :price, :store_id)");
    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':product_type', $product_type);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':store_id', $store_id);

    $stmt->execute();
    header("Location: index.php");
    exit();
}

// Handle the insertion of a customer
if (isset($_POST['insertCustomer'])) {
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $stmt = $pdo->prepare("INSERT INTO Customers (customer_name, email, phone) 
                            VALUES (:customer_name, :email, :phone)");
    $stmt->bindParam(':customer_name', $customer_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);

    $stmt->execute();
    header("Location: index.php");
    exit();
}

// Handle the insertion of an order
if (isset($_POST['insertOrder'])) {
    $customer_id = $_POST['customer_id'];
    $order_date = $_POST['order_date'];

    $stmt = $pdo->prepare("INSERT INTO Orders (customer_id, order_date) 
                            VALUES (:customer_id, :order_date)");
    $stmt->bindParam(':customer_id', $customer_id);
    $stmt->bindParam(':order_date', $order_date);

    $stmt->execute();
    header("Location: index.php");
    exit();
}

// Handle the insertion of order items
if (isset($_POST['insertOrderItem'])) {
    $order_id = $_POST['order_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $stmt = $pdo->prepare("INSERT INTO Order_Items (order_id, product_id, quantity) 
                            VALUES (:order_id, :product_id, :quantity)");
    $stmt->bindParam(':order_id', $order_id);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->bindParam(':quantity', $quantity);

    $stmt->execute();
    header("Location: index.php");
    exit();
}

// Handle the insertion of a payment
if (isset($_POST['insertPayment'])) {
    $order_id = $_POST['order_id'];
    $payment_date = $_POST['payment_date'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];

    $stmt = $pdo->prepare("INSERT INTO Payments (order_id, payment_date, amount, payment_method) 
                            VALUES (:order_id, :payment_date, :amount, :payment_method)");
    $stmt->bindParam(':order_id', $order_id);
    $stmt->bindParam(':payment_date', $payment_date);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':payment_method', $payment_method);

    $stmt->execute();
    header("Location: index.php");
    exit();
}

?>
