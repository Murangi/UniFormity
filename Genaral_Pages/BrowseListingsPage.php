<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Browse Listings</title>
    <link rel="stylesheet" href="../CSS/StyleSheet.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>

<!--Search Bar-->

<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <div class="col-md-3 mb-2 mb-md-0">
            <h1 class="pb-2">UniFormity</h1>
        </div>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <a href="./SearchResultsPage.html" class="btn btn-outline-success">Search</a>
        </form>
    </header>
</div>


<div class="container mt-5">


    <!-- Categories -->
    <h3 class="mb-3 border-bottom">Featured Categories</h3>
    <div class="row mb-5">

        <div class="col-6 col-md-2 text-center category-card">
            <div class="card p-2">
                <img src="../Images/SchoolUniform2.jpg" class="card-img-top" alt="Uniforms">
                <div class="card-body p-1">
                    <p class="card-text small">Uniforms</p>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-2 text-center category-card">
            <div class="card p-2">
                <img src="../Images/Schoolshoes.jpg" class="card-img-top" alt="Shoes">
                <div class="card-body p-1">
                    <p class="card-text small">Shoes</p>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-2 text-center category-card">
            <div class="card p-2">
                <img src="../Images/Stationary2.jpg" class="card-img-top" alt="Stationery">
                <div class="card-body p-1">
                    <p class="card-text small">Stationery</p>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-2 text-center category-card">
            <div class="card p-2">
                <img src="../Images/Schoolbag.jpg" class="card-img-top" alt="Bags">
                <div class="card-body p-1">
                    <p class="card-text small">Bags</p>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-2 text-center category-card">
            <div class="card p-2">
                <img src="../Images/Schoolbooks.jpg" class="card-img-top" alt="Books">
                <div class="card-body p-1">
                    <p class="card-text small">Books</p>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-2 text-center category-card">
            <div class="card p-2">
                <img src="../Images/SchoolAccessories.jpg" class="card-img-top" alt="Accessories">
                <div class="card-body p-1">
                    <p class="card-text small">Accessories</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Listings -->
    <h3 class="mb-3 border-bottom" id="listings">Available Listings</h3>
    <!-- <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4"> -->
    

        <?php
            session_start();
            require_once '../Authentication_Pages/config.php';

            // Show listings from the database
            $statement = $conn->prepare("SELECT * FROM listings ORDER BY created_at DESC");

            if ($statement) {
                $statement->execute();
                $result = $statement->get_result();

                if ($result->num_rows > 0) {
                    
                    echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">';
                    while ($row = $result->fetch_assoc()) {
                        echo '
                        <div class="col">
                            <div class="card listing-card h-100 shadow-sm">
                                <img src="' . htmlspecialchars($row['image_path']) . '" class="card-img-top" alt="' . htmlspecialchars($row['title']) . '" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">' . htmlspecialchars($row['title']) . '</h5>
                                    <p class="card-text">' . htmlspecialchars($row['description']) . '</p>
                                    <p class="card-text text-muted">Condition: ' . htmlspecialchars($row['ItemCondition']) . ' | Price: R' . htmlspecialchars($row['price']) . '</p>
                                    <a href="#" class="btn btn-outline-primary btn-sm">View</a>
                                </div>
                            </div>
                        </div>';
                    }

                    echo '</div>'; // Close row
                } else {
                    echo "<p>No listings found.</p>";
                }

                $statement->close();
            } else {
                echo "<p>Failed to prepare statement.</p>";
            }

            $conn->close();
        ?>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

</body>
</html>