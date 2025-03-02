<?php
include 'config.php';
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
?>

<?php
include 'config.php';

if (isset($_GET['action']) && $_GET['action'] == 'getProducts') {
    $sql = "SELECT id, name, price, image_url FROM shop_items";
    $result = $conn->query($sql);

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'price' => $row['price'],
            'image' => $row['image_url']
        ];
    }
    echo json_encode($products);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Shop</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="header">
        <h1>Fitness Shop</h1>
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
        <h2>Fitness Products</h2>
        <div class="product-grid">
            <?php
            $sql = "SELECT id, name, price, image_url FROM shop_items"; // No description included
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product'>";
                    echo "<img src='" . $row['image_url'] . "' alt='" . $row['name'] . "'>";
                    echo "<h3>" . $row['name'] . "</h3>";
                    echo "<p>Price: $" . $row['price'] . "</p>";
                    echo "<form method='post' action='cart.php'>";
                    echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
                    echo "<button type='submit' name='add_to_cart'>Add to Cart</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<p>No products found.</p>";
            }
            ?>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 AI Fitness Website</p>
    </div>

    <script src="script.js"></script>

</body>
</html>