<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Website</title>
    <link rel="stylesheet" href="style.css">
    <!-- Adding link to a slider library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
    <!-- Additional styles that work with your existing theme -->
    <style>
        /* Shop slider styles */
        .shop-slider-section {
            padding: 4rem 0;
            background-color: var(--bg-light);
        }
        
        .shop-slider-section h2 {
            margin-bottom: 2rem;
            color: var(--primary);
        }
        
        .product-item {
            padding: 1rem;
            text-align: center;
            border: 1px solid var(--accent);
            border-radius: 5px;
            margin: 0 5px;
            background-color: var(--bg-light);
        }
        
        .product-image {
            height: 200px;
            margin-bottom: 1rem;
            overflow: hidden;
            border-radius: 5px;
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }
        
        .product-image img:hover {
            transform: scale(1.05);
        }
        
        .product-price {
            font-weight: bold;
            color: var(--primary);
            margin-bottom: 1rem;
        }
        
        /* Services section styles */
        .services-section {
            padding: 4rem 0;
            background-color: var(--secondary);
        }
        
        .services-section h2 {
            text-align: center;
            margin-bottom: 3rem;
            color: var(--text-light);
        }
        
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .service-card {
            background-color: var(--bg-light);
            border: 1px solid var(--accent);
            border-radius: 5px;
            padding: 2rem;
            text-align: center;
            transition: transform 0.3s;
        }
        
        .service-card:hover {
            transform: translateY(-10px);
        }
        
        .service-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background-color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .service-icon img {
            width: 40px;
            height: 40px;
            filter: invert(1);
        }
        
        .service-card h3 {
            margin-bottom: 1rem;
            color: var(--primary);
        }
        
        .service-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            margin-top: 1rem;
            position: relative;
        }
        
        .service-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -3px;
            left: 0;
            background-color: var(--accent);
            transition: width 0.3s;
        }
        
        .service-link:hover:after {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Fitness Website</h1>
    </div>
    <div class="nav">
        <a href="index.php">Home</a>
        <a href="diet.php">Diet</a>
        <a href="workout.php">Workouts</a>
        <a href="shop.php">Shop</a>
        <a href="wellness.php">Wellness</a>
        <button onclick="toggleTheme()">Toggle Theme</button>
    </div>

    <!-- Hero section with background video (using your existing hero styles) -->
    <div class="hero">
        <video autoplay loop muted playsinline>
            <source src="assets/fitness-video.mp4" type="video/mp4">
            <!-- Fallback image if video doesn't load -->
            <img src="fitness-banner.jpg" alt="Fitness Banner">
        </video>
        <div class="hero-content">
            <h2 style="color: bisque;">Achieve Your Fitness Goals</h2>
            <p style="color: bisque;">Get personalized diet and workout plans with our expert assistant.</p>
            <button style="background-color: black; color: bisque;" class="container button" onclick="window.location.href='diet.php'">Generate Your Fitness Plan</button>
        </div>
    </div>

    <div class="shop-slider-section">
    <h2>Featured Products</h2>
    <div class="shop-slider-container">
        <div id="shop-slider" class="my-slider">
            <!-- Products will be dynamically loaded here -->
        </div>
    </div>
    <div id="custom-controls" class="slider-buttons">
        <button class="prev-btn">⬅ Prev</button>
        <button class="next-btn">Next ➡</button>
    </div>
</div>



    <!-- Services Section -->
    <div class="services-section">
        <div class="container">
            <h2>Our AI-Powered Services</h2>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <img src="diet-icon.svg" alt="Diet Plan">
                    </div>
                    <h3>Personalized Diet Plans</h3>
                    <p>Our AI analyzes your body composition, goals, and food preferences to create customized meal plans.</p>
                    <a href="diet.php" class="service-link">Learn More</a>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <img src="workout-icon.svg" alt="Workout Plan">
                    </div>
                    <h3>Expert Workout Routines</h3>
                    <p>Get professionally designed workout programs tailored to your fitness level and available equipment.</p>
                    <a href="workout.php" class="service-link">Learn More</a>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <img src="progress-icon.svg" alt="Progress Tracking">
                    </div>
                    <h3>Progress Tracking</h3>
                    <p>Track your fitness journey with detailed metrics and AI-powered insights for continuous improvement.</p>
                    <a href="wellness.php" class="service-link">Learn More</a>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 AI Fitness Website</p>
    </div>

    <!-- Adding tiny-slider JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>
    <!-- Original script file -->
    <script src="script.js"></script>
    <!-- Additional script for new features -->
    <script>
        // Load shop products for the slider
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch products from shop.php
            fetch('shop.php?action=getProducts')
                .then(response => response.json())
                .then(products => {
                    const sliderContainer = document.getElementById('shop-slider');
                    
                    // Create slider items
                    products.forEach(product => {
                        const productItem = document.createElement('div');
                        productItem.className = 'product-item';
                        productItem.innerHTML = `
                            <div class="product-image">
                                <img src="${product.image}" alt="${product.name}">
                            </div>
                            <h3>${product.name}</h3>
                            <p class="product-price">$${product.price}</p>
                            <button class="product button">Add to Cart</button>
                        `;
                        sliderContainer.appendChild(productItem);
                    });
                    
                    // Initialize tiny slider
                    const slider = tns({
                        container: '#shop-slider',
                        items: 4,
                        slideBy: 1,
                        autoplay: true,
                        controls: true,
                        nav: false,
                        autoplayButtonOutput: false,
                        responsive: {
                            320: {
                                items: 1
                            },
                            640: {
                                items: 2
                            },
                            768: {
                                items: 3
                            },
                            1024: {
                                items: 4
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('Error loading products:', error);
                    document.getElementById('shop-slider').innerHTML = '<p>Failed to load products. Please try again later.</p>';
                });
        });
    </script>
</body>
</html>