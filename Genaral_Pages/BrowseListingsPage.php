<?php
    session_start();
    require_once '../Authentication_Pages/config.php';

    if(isset($_POST['listing_id'])) {
        $listing_id = $_POST['listing_id'];
        $_SESSION['listing_id'] = $listing_id;
        header("Location: ItemDetailPage.php?listing_id=" . $listing_id);
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Listings | UniFormity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-dark: #333446;
            --primary-medium: #7F8CAA;
            --primary-light: #B8CFCE;
            --background-light: #EAEFEF;
            --text-light: #f8f9fa;
        }
        
        body {
            background-color: var(--background-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

              /* Enhanced Navigation */
        .navbar {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #2a2c3d 100%);
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            padding: 15px 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--text-light) !important;
            letter-spacing: 1px;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
        }
        
        .brand-icon {
            background: var(--primary-light);
            color: var(--primary-dark);
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        
        .nav-link {
            color: var(--text-light) !important;
            font-weight: 500;
            padding: 8px 15px !important;
            margin: 0 5px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        
        .section-title {
            color: var(--primary-dark);
            border-bottom: 2px solid var(--primary-light);
            padding-bottom: 10px;
            margin-bottom: 25px;
            font-weight: 600;
        }
        
        .category-card {
            transition: transform 0.3s ease;
        }
        
        .category-card:hover {
            transform: translateY(-5px);
        }
        
        .category-card .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        .category-card .card:hover {
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        
        .category-card .card-img-top {
            height: 120px;
            object-fit: cover;
        }
        
        .category-card .card-body {
            background-color: white;
            padding: 15px;
        }
        
        .category-card .card-text {
            color: var(--primary-dark);
            font-weight: 500;
            margin: 0;
        }
        
        .listing-card {
            transition: transform 0.3s ease;
            border: none;
            border-radius: 10px;
            overflow: hidden;
            height: 100%;
        }
        
        .listing-card:hover {
            transform: translateY(-5px);
        }
        
        .listing-card .card-img-top {
            height: 200px;
            object-fit: cover;
            background-color: #f5f7fa;
        }
        
        .listing-card .card-body {
            background-color: white;
            padding: 20px;
        }
        
        .listing-card .card-title {
            color: var(--primary-dark);
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .listing-card .card-text {
            color: #555;
            font-size: 0.9rem;
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .condition-price {
            background-color: var(--background-light);
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            margin-bottom: 15px;
            color: var(--primary-medium);
            font-weight: 500;
        }
        
        .btn-view {
            background-color: var(--primary-medium);
            color: white;
            border: none;
            padding: 6px 15px;
            border-radius: 5px;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        
        .btn-view:hover {
            background-color: var(--primary-dark);
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
        
        .container-main {
            padding-top: 30px;
            padding-bottom: 30px;
        }
        
        .category-icon {
            font-size: 2rem;
            color: var(--primary-medium);
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <div class="brand-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                UniFormity
            </a>
            
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Home</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container container-main">
        <!-- Categories Section -->
        <h3 class="section-title">Featured Categories</h3>
        <div class="row mb-5">
            <div class="col-6 col-md-2 mb-4 category-card">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="category-icon">
                            <i class="fas fa-tshirt"></i>
                        </div>
                        <p class="card-text">Uniforms</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-2 mb-4 category-card">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="category-icon">
                            <i class="fas fa-shoe-prints"></i>
                        </div>
                        <p class="card-text">Shoes</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-2 mb-4 category-card">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="category-icon">
                            <i class="fas fa-pencil-alt"></i>
                        </div>
                        <p class="card-text">Stationery</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-2 mb-4 category-card">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="category-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <p class="card-text">Bags</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-2 mb-4 category-card">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="category-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <p class="card-text">Books</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-2 mb-4 category-card">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="category-icon">
                            <i class="fas fa-glasses"></i>
                        </div>
                        <p class="card-text">Accessories</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Listings Section -->
        <h3 class="section-title" id="listings">Available Listings</h3>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php
                $statement = $conn->prepare("SELECT * FROM listings ORDER BY created_at DESC");

                if ($statement) {
                    $statement->execute();
                    $result = $statement->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '
                            <div class="col mb-4">
                                <div class="card listing-card h-100 shadow-sm">
                                    <img src="' . htmlspecialchars($row['image_path']) . '" class="card-img-top" alt="' . htmlspecialchars($row['title']) . '">
                                    <div class="card-body">
                                        <h5 class="card-title">' . htmlspecialchars($row['title']) . '</h5>
                                        <p class="card-text">' . htmlspecialchars($row['description']) . '</p>
                                        <div class="condition-price">
                                            <span>Condition: ' . htmlspecialchars($row['ItemCondition']) . '</span><br>
                                            <span>Price: R' . htmlspecialchars($row['price']) . '</span>
                                        </div>
                                        <form method="POST" action="BrowseListingsPage.php">
                                            <input type="hidden" name="listing_id" value="' . intval($row['Product_id']) . '">
                                            <button type="submit" class="btn btn-view">View Details</button>
                                        </form>
                                    </div>
                                </div>
                            </div>';
                        }
                    } else {
                        echo '<div class="col-12"><div class="alert alert-info text-center">No listings found. Check back later!</div></div>';
                    }

                    $statement->close();
                } else {
                    echo '<div class="col-12"><div class="alert alert-danger text-center">Failed to load listings. Please try again later.</div></div>';
                }

                $conn->close();
            ?>
        </div>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>