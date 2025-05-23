<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Uniformity</title>
    <link rel="stylesheet" href="../CSS/StyleSheet.css" type="text/css">



    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>

<!-- Header (Navigation Bar) -->
<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <div class="col-md-3 mb-2 mb-md-0">
            <h1 class="pb-2">UniFormity</h1>
        </div>
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="" class="nav-link px-2 link-secondary">Home</a></li>
            <li><a href="./BrowseListingsPage.php" class="nav-link px-2">Browse Listings</a></li>
        </ul>
        <div class="col-md-3 text-end">
            <a href="../Authentication_Pages/LoginPage.php">
                <button type="button" class="btn btn-outline-primary me-2">Login</button>
            </a>
            <a href="../Authentication_Pages/RegisterPage.php">
                <button type="button" class="btn btn-primary">Register</button>
            </a>
        </div>
    </header>
</div>

<!-- Hero Section -->
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
            <h1 class="pb-2 border-bottom">From One Desk to Another</h1>
            <p class="lead hero-description">Connecting families through quality, second-hand school essentials. Buy, sell, and give school uniforms and materials a second chance. Affordable, sustainable, and just a few clicks away.</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start hero-buttons">
                <a href="./BrowseListingsPage.php" class="btn btn-primary btn-lg px-4 me-md-2"> Purchase Item</a>
                <a href="../Authentication_Pages/LoginPage.php" class="btn btn-primary btn-lg px-4 me-md-2"> Sell Item</a>
            </div>
        </div>
    </div>
</div>



<!-- Benefits Section -->
<div class="container px-4 py-5" id="custom-cards">
    <h2 class="pb-2 border-bottom">What Makes Us Different?</h2>

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
            <h2 class="pb-2 border-bottom">About UniFormity</h2>
            <p class="text-muted fs-6">
                At <strong>UniFormity</strong>, we're passionate about sustainability and affordability.
                Our mission is to connect families through the exchange of second-hand school essentials—
                from uniforms and textbooks to stationery. We believe that every child deserves access to quality education materials
                without placing unnecessary financial burdens on their families.
            </p>
            <p class="text-muted fs-6">
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
    <h2 class="pb-2 border-bottom">How UniFormity Works?</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        <div class="feature col">

            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 rounded-circle p-3 text-white">
                <svg class="bi bi-cloud-arrow-up" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="1em" height="1em">
                    <path fill-rule="evenodd" d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708z"/>
                    <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383"/>
                </svg>
            </div>

            <h3 class="fs-2 text-body-emphasis">1. List Your Items</h3>
            <p>Upload photos and details of the school uniforms or learning materials you want to sell or donate — it's quick and easy.</p>

        </div>
        <div class="feature col">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 rounded-circle p-3 text-white">
                <svg class="bi bi-bag" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="1em" height="1em">
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                </svg>
            </div>

            <h3 class="fs-2 text-body-emphasis">2. Connect with Buyers</h3>
            <p>Local parents and students browse the listings and contact you directly through our safe and secure platform.</p>

        </div>
        <div class="feature col">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 rounded-circle p-3 text-white">
                <svg class="bi bi-truck" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="1em" height="1em">
                    <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
                </svg>
            </div>

            <h3 class="fs-2 text-body-emphasis">3. Meet Up or Deliver</h3>
            <p>Agree on a time and place to exchange — save money, reduce waste, and help another family in your community.</p>

        </div>
    </div>
</div>


<!-- Featured Listings Section -->
<section class="container my-5">
    <div >
        <h2 class="pb-2 border-bottom">Featured Listings</h2>
        <p class="text-muted">Explore some of our highlighted second-hand items</p>
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
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
                            <h5>School Uniform</h5>
                            <p>Gently-used uniforms available in various sizes and colors.</p>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="../Images/Textbook.jpg" class="d-block w-100" alt="Textbooks">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
                            <h5>Textbooks</h5>
                            <p>Affordable academic resources across various grades and subjects.</p>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="../Images/Stationary.jpg" class="d-block w-100" alt="Stationery">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
                            <h5>Stationery Sets</h5>
                            <p>All the essentials for your child’s classroom success.</p>
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
<!--Links going to different pages-->
<!--Copyright Info: " c 2025 Uniformity all rights reserved" -->
<div class="container">
    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li>
            <li class="nav-item"><a href="./BrowseListingsPage.html" class="nav-link px-2 text-body-secondary">Listings</a></li>
            <li class="nav-item"><a href="./FAQPage.html" class="nav-link px-2 text-body-secondary">FAQs</a></li>
            <li class="nav-item"><a href="./ContactUsPage.html" class="nav-link px-2 text-body-secondary">Contact Us</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
        </ul>
        <p class="text-center text-body-secondary">© 2025 UniFormity, Inc</p>
    </footer>
</div>

<!-- Bootstrap Bundle JS (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>

</body>
</html>