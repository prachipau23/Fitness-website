<?php
include 'config.php';

// Check if the database connection was successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Diet Plan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>AI Diet Plan Generator</h1>
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
        <h2>Select Your Dietary Preference</h2>
        <form method="post">
            <select name="diet_type">
                <option value="veg">Vegetarian</option>
                <option value="non-veg">Non-Vegetarian</option>
                <option value="vegan">Vegan</option>
                <option value="jain">Jain</option>
            </select>
            <button type="submit" name="generate_diet">Generate Diet Plan</button>
        </form>

        <?php
        if (isset($_POST['generate_diet'])) {
            $diet_type = $_POST['diet_type'];

            $sql = "SELECT * FROM diet_plans WHERE type = ? ORDER BY RAND() LIMIT 1";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $diet_type);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        echo "<h3>Your Diet Plan:</h3>";
                        echo "<p><strong>Meal:</strong> " . htmlspecialchars($row['meal_name']) . "</p>";
                        echo "<p><strong>Ingredients:</strong> " . htmlspecialchars($row['ingredients']) . "</p>";
                        echo "<p><strong>Recipe:</strong> " . htmlspecialchars($row['recipe']) . "</p>";
                        echo "<p><strong>Calories:</strong> " . htmlspecialchars($row['calories']) . "</p>";
                    } else {
                        echo "<p>No diet plan found for your preference.</p>";
                    }
                } else {
                    echo "<p>Error executing query: " . mysqli_error($conn) . "</p>";
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "<p>Error preparing statement: " . mysqli_error($conn) . "</p>";
            }
        }
        ?>
    </div>
    <div class="footer">
        <p>&copy; 2024 AI Fitness Website</p>
    </div>
    <script src="script.js"></script>
</body>
</html>