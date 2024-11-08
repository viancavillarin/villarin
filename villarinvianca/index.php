<?php
require_once 'core/models.php';
require_once 'core/handleForms.php';

// Fetch data from database
$rackets = getAllRackets($pdo);
$shoes = getAllShoes($pdo);
$strings = getAllStrings($pdo);

// Handle form submissions (Insert operations)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Insert new racket
    if (isset($_POST['insertRacket'])) {
        $model = $_POST['model'];
        $price = $_POST['price'];
        $brand = $_POST['brand'];
        $type = $_POST['type'];
        addRacket($model, $price, $brand, $type);
    }

    // Insert new shoe
    if (isset($_POST['insertShoe'])) {
        $model = $_POST['model'];
        $size = $_POST['size'];
        $color = $_POST['color'];
        $price = $_POST['price'];
        addShoe($model, $size, $color, $price);
    }

    // Insert new string
    if (isset($_POST['insertString'])) {
        $model = $_POST['model'];
        $price = $_POST['price'];
        $brand = $_POST['brand'];
        addString($model, $price, $brand);
    }
}

// Function to handle delete actions
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Delete racket
    if ($action == 'deleteRacket' && isset($_GET['id'])) {
        $racket_id = $_GET['id'];
        deleteRacket($racket_id);
    }

    // Delete shoe
    if ($action == 'deleteShoe' && isset($_GET['id'])) {
        $shoe_id = $_GET['id'];
        deleteShoe($shoe_id);
    }

    // Delete string
    if ($action == 'deleteString' && isset($_GET['id'])) {
        $string_id = $_GET['id'];
        deleteString($string_id);
    }
}
?>

<?php
// Include the necessary files for database configuration and models
require_once 'core/dbConfig.php';  // Ensure correct path to dbConfig.php
require_once 'core/models.php';     // Ensure correct path to models.php

// Fetch all rackets from the database using the getAllRackets function
$rackets = getAllRackets($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badminton Store - Rackets</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link your stylesheet -->
</head>
<body>
    <div class="container">
        <h1>Badminton Rackets</h1>
        <table>
            <thead>
                <tr>
                    <th>Model</th>
                    <th>Price</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the fetched rackets and display them in the table
                if ($rackets) {
                    foreach ($rackets as $racket) {
                        echo "<tr>";
                        echo "<td>{$racket['model_name']}</td>";
                        echo "<td>{$racket['price']}</td>";
                        echo "<td>{$racket['description']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No rackets available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badminton Store PH</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Badminton Store PH</h1>

    <!-- Insert New Racket Form -->
    <h2>Add New Racket</h2>
    <form action="index.php" method="POST">
        <input type="text" name="model" placeholder="Racket Model" required>
        <input type="number" name="price" placeholder="Price" required>
        <input type="text" name="brand" placeholder="Brand" required>
        <input type="text" name="type" placeholder="Type (e.g., Power, Control)" required>
        <button type="submit" name="insertRacket">Add Racket</button>
    </form>

    <!-- Rackets table -->
    <h3>Rackets</h3>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Model</th>
                <th>Price</th>
                <th>Brand</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rackets as $racket): ?>
                <tr>
                    <td><?php echo htmlspecialchars($racket['racket_id']); ?></td>
                    <td><?php echo htmlspecialchars($racket['model']); ?></td>
                    <td><?php echo number_format($racket['price'], 2); ?></td>
                    <td><?php echo htmlspecialchars($racket['brand']); ?></td>
                    <td><?php echo htmlspecialchars($racket['type']); ?></td>
                    <td>
                        <a href="editRacket.php?id=<?php echo $racket['racket_id']; ?>">Edit</a> |
                        <a href="index.php?action=deleteRacket&id=<?php echo $racket['racket_id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Insert New Shoe Form -->
    <h2>Add New Shoe</h2>
    <form action="index.php" method="POST">
        <input type="text" name="model" placeholder="Shoe Model" required>
        <input type="text" name="size" placeholder="Size" required>
        <input type="text" name="color" placeholder="Color" required>
        <input type="number" name="price" placeholder="Price" required>
        <button type="submit" name="insertShoe">Add Shoe</button>
    </form>

    <!-- Shoes table -->
    <h3>Shoes</h3>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Model</th>
                <th>Size</th>
                <th>Color</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($shoes as $shoe): ?>
                <tr>
                    <td><?php echo htmlspecialchars($shoe['shoe_id']); ?></td>
                    <td><?php echo htmlspecialchars($shoe['model']); ?></td>
                    <td><?php echo htmlspecialchars($shoe['size']); ?></td>
                    <td><?php echo htmlspecialchars($shoe['color']); ?></td>
                    <td><?php echo number_format($shoe['price'], 2); ?></td>
                    <td>
                        <a href="editShoe.php?id=<?php echo $shoe['shoe_id']; ?>">Edit</a> |
                        <a href="index.php?action=deleteShoe&id=<?php echo $shoe['shoe_id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Insert New String Form -->
    <h2>Add New String</h2>
    <form action="index.php" method="POST">
        <input type="text" name="model" placeholder="String Model" required>
        <input type="number" name="price" placeholder="Price" required>
        <input type="text" name="brand" placeholder="Brand" required>
        <button type="submit" name="insertString">Add String</button>
    </form>

    <!-- Strings table -->
    <h3>Strings</h3>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Model</th>
                <th>Price</th>
                <th>Brand</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($strings as $string): ?>
                <tr>
                    <td><?php echo htmlspecialchars($string['string_id']); ?></td>
                    <td><?php echo htmlspecialchars($string['model']); ?></td>
                    <td><?php echo number_format($string['price'], 2); ?></td>
                    <td><?php echo htmlspecialchars($string['brand']); ?></td>
                    <td>
                        <a href="editString.php?id=<?php echo $string['string_id']; ?>">Edit</a> |
                        <a href="index.php?action=deleteString&id=<?php echo $string['string_id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
