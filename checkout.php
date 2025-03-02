<?php
include 'config.php';
session_start();

if (empty($_SESSION['cart'])) {
    header("Location: shop.php");
    exit();
}

$total = 0;
foreach ($_SESSION['cart'] as $product_id) {
    $sql = "SELECT price FROM shop_items WHERE id = $product_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total += $row['price'];
    }
}

if (isset($_POST['place_order'])) {
    // Process payment and order details
    // For demonstration, we'll just display a confirmation message
    echo "<p>Order placed successfully! Total: $" . $total . "</p>";
    unset($_SESSION['cart']); // Clear the cart
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>Checkout</h1>
    </div>
    <div class="nav">
        <a href="index.php">Home</a>
        <a href="diet.php">Diet</a>
        <a href="workout.php">Workouts</a>
        <a href="shop.php">Shop</a>
        <a href="wellness.php">Wellness</a>
        <button onclick="toggleTheme()">Toggle Theme</button>
    </div>
    <div class="container">
        <h2>Billing Details</h2>
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" required><br><br>
            <label for="address">Address:</label>
            <textarea name="address" required></textarea><br><br>
            <label for="payment">Payment Details:</label>
            <input type="text" name="payment" required><br><br>
            <h3>Order Summary</h3>
            <?php
            foreach ($_SESSION['cart'] as $product_id) {
                $sql = "SELECT name, price FROM shop_items WHERE id = $product_id";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<p>" . $row['name'] . " - $" . $row['price'] . "</p>";
                }
            }
            echo "<h3>Total: $" . $total . "</h3>";
            ?>
            <button type="submit" name="place_order">Place Order</button>
        </form>
    </div>
    <div class="footer">
        <p>&copy; 2024 AI Fitness Website</p>
    </div>
    <script src="script.js"></script>
</body>
</html>