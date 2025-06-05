<?php
    session_start();

    // Redirect to login if not authenticated
    if (!isset($_SESSION['user_id'])) {
    // Allow viewing of homepage without login
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uniformity - Sustainable School Essentials Marketplace</title>
    <link rel="stylesheet" href="../CSS/StyleSheet.css" type="text/css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    
    <style>
        :root {
            --primary-dark: #333446;
            --primary-medium: #7F8CAA;
            --primary-light: #B8CFCE;
            --background-light: #EAEFEF;
            --accent: #5A6F8A;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            color: #333;
            background-color: #fff;
            line-height: 1.6;
        }
        
        h1, h2, h3, h4, h5 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: var(--primary-dark);
        }
        
        .border-bottom {
            border-bottom: 2px solid var(--primary-light) !important;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--background-light) 0%, #ffffff 100%);
            padding: 4rem 0;
        }
        
        .hero-title {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        
        .hero-description {
            font-size: 1.25rem;
            color: var(--primary-medium);
            margin-bottom: 2rem;
            max-width: 90%;
        }
        
        .card-cover {
            height: 300px;
            background-size: cover;
            background-position: center;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            transition: transform 0.3s ease;
        }
        
        .card-cover:hover {
            transform: translateY(-8px);
        }
        
        .card-text-container {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.5rem;
            background: rgba(51, 52, 70, 0.85);
            color: white;
        }
        
        .card-text-container h3 {
            color: white;
            font-size: 1.3rem;
            margin-bottom: 0;
        }
        
        .btn-primary {
            background-color: var(--primary-dark);
            border: none;
            padding: 0.8rem 1.8rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: var(--accent);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .btn-outline-primary {
            border-color: var(--primary-dark);
            color: var(--primary-dark);
            font-weight: 500;
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-dark);
            color: white;
        }
        
        .feature-icon {
            background-color: var(--primary-dark) !important;
        }
        
        .about-section {
            background-color: var(--background-light);
            border-radius: 16px;
            padding: 3rem;
        }
        
        .featured-listings h2 {
            margin-bottom: 1.5rem;
        }
        
        .carousel-caption {
            background: rgba(51, 52, 70, 0.8);
            border-radius: 8px;
            padding: 1rem 1.5rem;
        }
        
        footer {
            background-color: var(--primary-dark);
            color: white;
            padding: 2.5rem 0 1.5rem;
            margin-top: 3rem;
        }
        
        footer .nav-link {
            color: var(--background-light) !important;
            transition: color 0.2s;
        }
        
        footer .nav-link:hover {
            color: var(--primary-light) !important;
        }
        
        .logo-text {
            font-weight: 700;
            color: var(--primary-dark);
            letter-spacing: -0.5px;
        }
        
        .nav-link {
            font-weight: 500;
            color: var(--primary-dark);
            padding: 0.5rem 1rem !important;
            border-radius: 6px;
            transition: all 0.2s;
        }
        
        .nav-link:hover {
            background-color: rgba(184, 207, 206, 0.2);
            color: var(--accent);
        }
        
        .section-title {
            position: relative;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 4px;
            background: var(--primary-light);
            border-radius: 2px;
        }
        
        .feature {
            text-align: center;
            padding: 2rem 1.5rem;
            border-radius: 12px;
            transition: all 0.3s;
            height: 100%;
        }
        
        .feature:hover {
            background-color: rgba(234, 239, 239, 0.4);
            box-shadow: 0 8px 25px rgba(0,0,0,0.05);
        }
        
        .feature h3 {
            margin: 1.5rem 0 1rem;
        }
        
        .carousel-item img {
            border-radius: 12px;
            height: 450px;
            object-fit: cover;
        }
        
        .hero-buttons .btn {
            margin-right: 1rem;
            margin-bottom: 1rem;
            min-width: 180px;
        }
        
        /* Updated button styles for consistent sizing */
        .auth-buttons {
            display: flex;
            gap: 12px;
        }
        
        .auth-btn {
            min-width: 110px;
            text-align: center;
            padding: 8px 16px;
            font-size: 1rem;
            border-radius: 6px;
            transition: all 0.2s ease;
        }
        
        .btn-login {
            background: transparent;
            border: 2px solid var(--primary-dark);
            color: var(--primary-dark);
            font-weight: 500;
        }
        
        .btn-login:hover {
            background-color: var(--primary-dark);
            color: white;
        }
        
        .btn-register {
            background: var(--primary-dark);
            border: 2px solid var(--primary-dark);
            color: white;
            font-weight: 500;
        }
        
        .btn-register:hover {
            background: var(--accent);
            border-color: var(--accent);
        }
    </style>
</head>
<body>

<!-- Header (Navigation Bar) -->
<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
        <div class="col-md-3 mb-2 mb-md-0">
            <h1 class="logo-text pb-2">UniFormity</h1>
        </div>
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="" class="nav-link px-2 active">Home</a></li>
            <li><a href="./BrowseListingsPage.php" class="nav-link px-2">Browse Listings</a></li>
        </ul>
        <div class="col-md-3 text-end">
            <a href="./ReviewCartPage.php" class="me-3 position-relative">
                <!-- ... existing cart icon ... -->
            </a>
            
            <?php if(isset($_SESSION['user_id'])): ?>
                <!-- Profile Icon -->
                <a href="../UserDashboard_Pages/UserProfilePage.php" class="me-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                    </svg>
                </a>
            <?php else: ?>
                <!-- Login/Register Buttons with consistent sizing -->
                <div class="auth-buttons">
                    <a href="../Authentication_Pages/LoginPage.php">
                        <button class="auth-btn btn-login">Login</button>
                    </a>
                    <a href="../Authentication_Pages/RegisterPage.php">
                        <button class="auth-btn btn-register">Register</button>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </header>
</div>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container px-4 py-5">
        <div class="row align-items-center g-5 py-5">
            <!-- Carousel Card -->
            <div class="col-lg-6 order-lg-2">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="2500">
                                <img src="../Images/Textbooks.jpg" class="d-block w-100" alt="Textbooks">
                            </div>
                            <div class="carousel-item" data-bs-interval="2500">
                                <img src="../Images/SchoolUniform.jpg" class="d-block w-100" alt="School Uniform">
                            </div>
                            <div class="carousel-item" data-bs-interval="2500">
                                <img src="../Images/Stationary.jpg" class="d-block w-100" alt="Stationary">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Text Content -->
            <div class="col-lg-6 order-lg-1">
                <h1 class="hero-title pb-2">From One Desk to Another</h1>
                <p class="lead hero-description">Connecting families through quality, second-hand school essentials. Buy, sell, and give school uniforms and materials a second chance. Affordable, sustainable, and just a few clicks away.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start hero-buttons">
                    <a href="./BrowseListingsPage.php" class="btn btn-primary btn-lg px-4 me-md-2"> Purchase Item</a>
                    <a href="<?= isset($_SESSION['user_id']) ? '../UserDashboard_Pages/AddNewListingPage.php' : '../Authentication_Pages/LoginPage.php' ?>" class="btn btn-primary btn-lg px-4 me-md-2">Sell Item</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Benefits Section -->
<div class="container px-4 py-5" id="custom-cards">
    <h2 class="section-title pb-2">What Makes Us Different?</h2>

    <div class="row row-cols-1 row-cols-lg-3 g-4 py-5">
        <div class="col">
            <div class="card-cover shadow-lg" style="background-image: url('../Images/Saving.jpg');">
                <div class="card-text-container">
                    <h3>Save more while still providing the best for your child.</h3>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card-cover shadow-lg" style="background-image: url('../Images/GoingGreen.jpg');">
                <div class="card-text-container">
                    <h3>UniFormity promotes conscious consumption for a cleaner, greener future.</h3>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card-cover shadow-lg" style="background-image: url('../Images/family.jpg');">
                <div class="card-text-container">
                    <h3>Our platform empowers families to support each other through secure, local C2C exchanges.</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About Us Section -->
<section class="about-section container px-4 py-5">
    <div class="row g-5 align-items-center">
        <div class="col-lg-6">
            <h2 class="section-title pb-2">About UniFormity</h2>
            <p class="fs-6">
                At <strong>UniFormity</strong>, we're passionate about sustainability and affordability.
                Our mission is to connect families through the exchange of second-hand school essentials—
                from uniforms and textbooks to stationery. We believe that every child deserves access to quality education materials
                without placing unnecessary financial burdens on their families.
            </p>
            <p class="fs-6">
                Built on community and care, UniFormity turns unused items into new opportunities.
                Join us in making education more accessible, one exchange at a time.
            </p>
        </div>
        <div class="col-lg-6">
            <img src="../Images/Community.jpg" class="img-fluid rounded-4 shadow-sm" alt="About UniFormity" style="max-height: 520px; object-fit: cover; width: 100%;">
        </div>
    </div>
</section>

<!--How Uniformity Works-->
<!--3 simple steps-->
<div class="container px-4 py-5" id="featured-3">
    <h2 class="section-title pb-2">How UniFormity Works?</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        <div class="feature col">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 rounded-circle p-3 text-white">
                <svg class="bi bi-cloud-arrow-up" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="1em" height="1em">
                    <path fill-rule="evenodd" d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708z"/>
                    <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383"/>
                </svg>
            </div>
            <h3 class="fs-2">1. List Your Items</h3>
            <p>Upload photos and details of the school uniforms or learning materials you want to sell or donate — it's quick and easy.</p>
        </div>
        <div class="feature col">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 rounded-circle p-3 text-white">
                <svg class="bi bi-bag" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="1em" height="1em">
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                </svg>
            </div>
            <h3 class="fs-2">2. Connect with Buyers</h3>
            <p>Local parents and students browse the listings and contact you directly through our safe and secure platform.</p>
        </div>
        <div class="feature col">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 rounded-circle p-3 text-white">
                <svg class="bi bi-truck" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="1em" height="1em">
                    <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
                </svg>
            </div>
            <h3 class="fs-2">3. Meet Up or Deliver</h3>
            <p>Agree on a time and place to exchange — save money, reduce waste, and help another family in your community.</p>
        </div>
    </div>
</div>

<!-- Featured Listings Section -->
<section class="container my-5 featured-listings">
    <div>
        <h2 class="section-title pb-2">Featured Listings</h2>
        <p>Explore some of our highlighted second-hand items</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-12">
            <div id="carouselExampleCaptions" class="carousel slide shadow rounded-4 overflow-hidden" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../Images/SchoolUniform.jpg" class="d-block w-100" alt="School Uniform">
                        <div class="carousel-caption d-none d-md-block rounded-3 p-3">
                            <h5>School Uniform</h5>
                            <p>Gently-used uniforms available in various sizes and colors.</p>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="../Images/Textbook.jpg" class="d-block w-100" alt="Textbooks">
                        <div class="carousel-caption d-none d-md-block rounded-3 p-3">
                            <h5>Textbooks</h5>
                            <p>Affordable academic resources across various grades and subjects.</p>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="../Images/Stationary.jpg" class="d-block w-100" alt="Stationery">
                        <div class="carousel-caption d-none d-md-block rounded-3 p-3">
                            <h5>Stationery Sets</h5>
                            <p>All the essentials for your child's classroom success.</p>
                        </div>
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</section>

<!--Footer-->
<div class="container">
    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="#" class="nav-link px-2">Home</a></li>
            <li class="nav-item"><a href="./BrowseListingsPage.php" class="nav-link px-2">Listings</a></li>
            <li class="nav-item"><a href="./FAQPage.html" class="nav-link px-2">FAQs</a></li>
            <li class="nav-item"><a href="./ContactUsPage.php" class="nav-link px-2">Contact Us</a></li>
        </ul>
        <p class="text-center">© 2025 UniFormity, Inc</p>
    </footer>
</div>

<!-- Bootstrap Bundle JS (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>

</body>
</html>