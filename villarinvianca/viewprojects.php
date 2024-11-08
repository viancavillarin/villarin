<?php

require_once 'core/models.php';
require_once 'core/dbConfig.php';  

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $product = getProductById($product_id);
    $productDetails = getProductDetailsById($pdo, $product_id);
} else {
    echo "Product ID is required!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product Details - Badminton Store PH</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <!-- Navigation -->
        <nav>
            <a href="index.php" class="btn">Return to Home</a>
            <a href="addProduct.php" class="btn">Add New Product</a>
        </nav>

        <!-- Display Product Info -->
        <h1>Product Information</h1>
        <?php
        if ($product) {
            echo "<h2>Product: {$product['name']}</h2>";
            echo "<p>Category: {$product['category']}</p>";
            echo "<p>Price: PHP {$product['price']}</p>";
            echo "<p>Description: {$product['description']}</p>";
        } else {
            echo "<p>Product not found.</p>";
        }
        ?>

        <!-- Add a Product to Cart Form -->
        <h2>Add Product to Cart</h2>
        <form action="core/handleForms.php" method="POST">
            <p>
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" min="1" required>
            </p>
            <p>
                <label for="size">Size:</label>
                <select name="size" required>
                    <option value="Small">Small</option>
                    <option value="Medium">Medium</option>
                    <option value="Large">Large</option>
                </select>
            </p>
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <button type="submit" name="addToCartBtn" class="btn">Add to Cart</button>
        </form>

        <!-- Existing Product Details Table -->
        <h2>Existing Product Details</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($productDetails) {
                    foreach ($productDetails as $detail) {
                        echo "<tr>";
                        echo "<td>{$detail['product_id']}</td>";
                        echo "<td>{$detail['name']}</td>";
                        echo "<td>{$detail['category']}</td>";
                        echo "<td>PHP {$detail['price']}</td>";
                        echo "<td>{$detail['stock']}</td>";
                        echo "<td>
                                <a href=\"editProduct.php?product_id={$detail['product_id']}\" class=\"btn-edit\">Edit</a>
                                <a href=\"deleteProduct.php?product_id={$detail['product_id']}\" class=\"btn-delete\">Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan=\"6\">No product details found for this product.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
