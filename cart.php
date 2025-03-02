<?php
include 'config.php';
session_start();

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $_SESSION['cart'][] = $product_id;
}

if (isset($_POST['remove_from_cart'])) {
    $product_id = $_POST['product_id'];
    $key = array_search($product_id, $_SESSION['cart']);
    if ($key !== false) {
        unset($_SESSION['cart'][$key]);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>Shopping Cart</h1>
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
        <h2>Your Cart</h2>
        <?php
        if (!empty($_SESSION['cart'])) {
            $total = 0;
            foreach ($_SESSION['cart'] as $product_id) {
                $sql = "SELECT * FROM shop_items WHERE id = $product_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<div class='cart-item'>";
                    echo "<h3>" . $row['name'] . "</h3>";
                    echo "<p>Price: $" . $row['price'] . "</p>";
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
                    echo "<button type='submit' name='remove_from_cart'>Remove</button>";
                    echo "</form>";
                    echo "</div>";
                    $total += $row['price'];
                }
            }
            echo "<h3>Total: $" . $total . "</h3>";
            echo "<a href='checkout.php' class='btn'>Proceed to Checkout</a>";
        } else {
            echo "<p>Your cart is empty.</p>";
        }
        ?>
    </div>
    <div class="footer">
        <p>&copy; 2024 AI Fitness Website</p>
    </div>
    <script src="script.js"></script>
</body>
</html>