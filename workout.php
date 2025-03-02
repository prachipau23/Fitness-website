<?php
include 'config.php'; // Ensure database connection is properly set up

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Enable detailed SQL error reporting

// Check if the form was submitted
if (isset($_POST['generate_workout'])) {
    // Ensure database connection is established
    if (!$conn) {
        die("<p style='color:red;'>Database connection error: " . mysqli_connect_error() . "</p>");
    }

    // Get and sanitize user input
    $workout_type = $_POST['workout_type'] ?? ''; // Prevent undefined errors

    if (!empty($workout_type)) {
        // Use Prepared Statement to prevent SQL Injection
        $stmt = $conn->prepare("SELECT * FROM workouts WHERE type = ? ORDER BY RAND() LIMIT 1");
        $stmt->bind_param("s", $workout_type); 
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch workout plan
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $workout_plan = "
                <div class='workout-result'>
                    <h3>Your Workout Plan:</h3>
                    <p><strong>Exercise:</strong> " . htmlspecialchars($row['exercise']) . "</p>
                    <p><strong>Sets:</strong> " . htmlspecialchars($row['sets']) . "</p>
                    <p><strong>Reps:</strong> " . htmlspecialchars($row['reps']) . "</p>
                    <p><strong>Duration:</strong> " . htmlspecialchars($row['duration']) . "</p>
                </div>";
        } else {
            $workout_plan = "<p style='color: red;'>No workout plan found for your selection.</p>";
        }

        $stmt->close();
    } else {
        $workout_plan = "<p style='color: red;'>Please select a workout type.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Workout Plan</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container { max-width: 600px; margin: auto; text-align: center; }
        .workout-result { background: #f4f4f4; padding: 15px; border-radius: 10px; margin-top: 20px; }
        .workout-result p { margin: 5px 0; }
    </style>
</head>
<body>
    <div class="header">
        <h1>AI Workout Plan Generator</h1>
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
        <h2>Select Your Workout Type</h2>
        <form method="post">
            <select name="workout_type">
                <option value="">-- Select Workout Type --</option>
                <option value="pilates">Pilates</option>
                <option value="yoga">Yoga</option>
                <option value="strength">Strength Training</option>
                <option value="cardio">Cardio</option>
                <option value="abs">Abs</option>
                <option value="chest">Chest</option>
                <option value="back">Back</option>
                <option value="bicep">Bicep</option>
                <option value="tricep">Tricep</option>
                <option value="glutes">Glutes</option>
                <option value="core">Core</option>
                <option value="pelvic">Pelvic</option>
                <option value="pcos">PCOS</option>
            </select>
            <button type="submit" name="generate_workout">Generate Workout Plan</button>
        </form>

        <?php if (!empty($workout_plan)) echo $workout_plan; ?>
    </div>
    <div class="footer">
        <p>&copy; 2024 AI Fitness Website</p>
    </div>
    <script src="script.js"></script>
</body>
</html>
