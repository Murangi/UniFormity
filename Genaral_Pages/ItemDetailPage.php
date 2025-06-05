<?php
    session_start();
    require_once '../Authentication_Pages/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Details | UniFormity</title>
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
            padding-top: 80px;
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
        
        .nav-btn {
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none !important;
        }
        
        .btn-login {
            background: transparent;
            border: 2px solid var(--primary-light);
            color: var(--text-light);
        }
        
        .btn-login:hover {
            background: var(--primary-light);
            color: var(--primary-dark);
        }
        
        .btn-signup {
            background: var(--primary-light);
            color: var(--primary-dark);
            border: 2px solid var(--primary-light);
        }
        
        .btn-signup:hover {
            background: #c8e2e1;
            transform: translateY(-2px);
        }
        
        /* Product Detail Styles */
        .product-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 0;
        }
        
        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        
        .product-image-container {
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(145deg, #f8fafb, #eef2f5);
            padding: 20px;
        }
        
        .product-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .product-info {
            padding: 40px;
        }
        
        .product-title {
            color: var(--primary-dark);
            font-weight: 700;
            margin-bottom: 20px;
            font-size: 2.2rem;
        }
        
        .product-price {
            background: var(--background-light);
            padding: 15px 20px;
            border-radius: 10px;
            font-size: 1.8rem;
            color: var(--primary-medium);
            font-weight: 700;
            margin-bottom: 25px;
            display: inline-block;
        }
        
        .product-condition {
            background: var(--primary-light);
            color: var(--primary-dark);
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 25px;
        }
        
        .product-description {
            color: #555;
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 35px;
            padding-bottom: 25px;
            border-bottom: 1px solid #eee;
        }
        
        .btn-add-to-cart {
            background: linear-gradient(to right, var(--primary-medium), var(--primary-dark));
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-add-to-cart:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 15px rgba(127, 140, 170, 0.4);
        }
        
        .btn-add-to-cart i {
            margin-right: 10px;
            font-size: 1.3rem;
        }
        
        .detail-label {
            color: var(--primary-medium);
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .detail-value {
            color: var(--primary-dark);
            font-weight: 500;
            margin-bottom: 20px;
            font-size: 1.05rem;
        }
        
        .detail-section {
            margin-bottom: 30px;
        }
        
        .alert-container {
            max-width: 800px;
            margin: 30px auto;
        }
        
        .alert-box {
            background: white;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }
        
        .alert-icon {
            font-size: 3.5rem;
            color: var(--primary-light);
            margin-bottom: 20px;
        }
        
        @media (max-width: 992px) {
            .product-image-container {
                height: 400px;
            }
        }
        
        @media (max-width: 768px) {
            .product-image-container {
                height: 350px;
            }
            
            .product-info {
                padding: 30px;
            }
            
            .product-title {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- Enhanced Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="LandingPage.php">
                <div class="brand-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                UniFormity
            </a>
            
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="LandingPage.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="BrowseListingsPage.php">Browse Listings</a>
                </li>
            </ul>
            
            <div class="d-flex align-items-center">
                <a href="../Authentication_Pages/LoginPage.php" class="nav-btn btn-login me-2">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </a>
                <a href="../Authentication_Pages/RegisterPage.php" class="nav-btn btn-signup">
                    <i class="fas fa-user-plus me-2"></i>Sign-up
                </a>
            </div>
        </div>
    </nav>

    <div class="product-container">
        <?php
            if (!isset($_SESSION['listing_id'])) {
                echo '<div class="alert-container">
                        <div class="alert-box">
                            <div class="alert-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h3 class="mb-3">No Item Selected</h3>
                            <p class="text-muted mb-4">Please select an item from the browse listings page</p>
                            <a href="BrowseListingsPage.php" class="btn btn-primary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>Browse Listings
                            </a>
                        </div>
                    </div>';
            } else {
                $statement = $conn->prepare("SELECT * FROM listings WHERE Product_id = ?");
                if ($statement) {
                    $statement->bind_param("i", $_SESSION['listing_id']);
                    $statement->execute();
                    $result = $statement->get_result();
                    $row = $result->fetch_assoc();

                    if ($row) {
                        echo '
                        <div class="product-card">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="product-image-container">
                                        <img src="' . htmlspecialchars($row['image_path']) . '" alt="Product Image" class="product-image">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="product-info">
                                        <h1 class="product-title">' . htmlspecialchars($row['title']) . '</h1>
                                        
                                        <div class="detail-section">
                                            <div class="detail-label">Price</div>
                                            <div class="product-price">R' . htmlspecialchars($row['price']) . '</div>
                                        </div>
                                        
                                        <div class="detail-section">
                                            <div class="detail-label">Condition</div>
                                            <div class="product-condition">' . htmlspecialchars($row['ItemCondition']) . '</div>
                                        </div>
                                        
                                        <div class="detail-section">
                                            <div class="detail-label">Description</div>
                                            <p class="product-description">' . htmlspecialchars($row['description']) . '</p>
                                        </div>
                                        
                                        <form method="POST" action="ReviewCartPage.php">
                                            <input type="hidden" name="listing_id" value="' . intval($row['Product_id']) . '">
                                            <button type="submit" class="btn btn-add-to-cart">
                                                <i class="fas fa-shopping-cart"></i> Add To Cart
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    } else {
                        echo '<div class="alert-container">
                                <div class="alert-box">
                                    <div class="alert-icon">
                                        <i class="fas fa-times-circle"></i>
                                    </div>
                                    <h3 class="mb-3">Listing Not Found</h3>
                                    <p class="text-muted mb-4">The requested item could not be found in our system</p>
                                    <a href="BrowseListingsPage.php" class="btn btn-primary btn-lg">
                                        <i class="fas fa-arrow-left me-2"></i>Browse Listings
                                    </a>
                                </div>
                            </div>';
                    }
                    $statement->close();
                } else {
                    echo '<div class="alert-container">
                            <div class="alert-box">
                                <div class="alert-icon">
                                    <i class="fas fa-database"></i>
                                </div>
                                <h3 class="mb-3">Database Error</h3>
                                <p class="text-muted mb-4">We encountered an issue retrieving this item</p>
                                <a href="BrowseListingsPage.php" class="btn btn-primary btn-lg">
                                    <i class="fas fa-arrow-left me-2"></i>Browse Listings
                                </a>
                            </div>
                        </div>';
                }
            }
            $conn->close();
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add subtle animation to the product card
        document.addEventListener('DOMContentLoaded', function() {
            const productCard = document.querySelector('.product-card');
            
            if (productCard) {
                productCard.style.opacity = '0';
                productCard.style.transform = 'translateY(20px)';
                productCard.style.transition = 'opacity 0.7s ease, transform 0.7s ease';
                
                setTimeout(() => {
                    productCard.style.opacity = '1';
                    productCard.style.transform = 'translateY(0)';
                }, 100);
            }
            
            // Add animation to buttons
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(btn => {
                btn.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px)';
                });
                
                btn.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>