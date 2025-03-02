<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Wellness</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>Mental Wellness</h1>
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
        <h2>Mental Wellness Activities</h2>
        <button onclick="suggestActivity()">Suggest Activity</button>
        <div id="activity-suggestion"></div>
    </div>
    <div class="footer">
        <p>&copy; 2024 AI Fitness Website</p>
    </div>
    <script src="script.js"></script>
    <script>
        function suggestActivity() {
            fetch('get_wellness_activity.php')
                .then(response => response.text())
                .then(activity => {
                    document.getElementById('activity-suggestion').innerHTML = '<p>' + activity + '</p>';
                });
        }
    </script>
</body>
</html>