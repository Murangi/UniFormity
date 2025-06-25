<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Listings | UniFormity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .half-page {
            display: flex;
            height: 100vh;
        }

        .listings-image {
            background-image: url('../Images/ListingPageImage.jpg'); /* Replace with your own school-themed image */
            background-size: cover;
            background-position: center;
            flex: 1;
        }

        .listings-container {
            flex: 1;
            overflow-y: auto;
            padding: 2rem;
            background-color: #f8f9fa;
        }

        .listings-title {
            font-weight: bold;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .listing-card {
            margin-bottom: 1rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 1024px) {
            .listing-image {
                display: none !important;
            }
            .listing-form-container {
                flex: 1 1 100%;
                max-width: 100vw;
                padding: 2rem 1rem;
                align-items: center;
                justify-content: center;
            }
            .half-page {
                flex-direction: column;
                min-height: 100vh;
            }
            }
            @media (max-width: 768px) {
            .listing-form {
                max-width: 100vw;
                padding: 1rem;
            }
        }

    </style>
</head>
<body>

<div class="half-page">

    <div class="position-absolute top-0 end-0 mt-3 me-3">
      <a href="./UserProfilePage.php" class="btn btn-light btn-sm">Back to Profile</a>
    </div>
    <!-- Left: Image -->
    <div class="listings-image"></div>

    <!-- Right: Listings Content -->
    <div class="listings-container">
        <h2 class="listings-title">My Listings</h2>

        <?php
            session_start();
            require_once '../Authentication_Pages/config.php';

            if (!isset($_SESSION['user_id'])) {
                echo "User not logged in.";
                exit;
            }

            $user_id = $_SESSION['user_id'];

            // Prepare and execute the SQL statement
            $stmt = $conn->prepare("SELECT * FROM listings WHERE user_id = ? ORDER BY created_at DESC");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if any listings exist
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Echo each listing in card format
                    echo '
                    <div class="card listing-card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">' . htmlspecialchars($row['title']) . '</h5>
                            <p class="card-text">' . htmlspecialchars($row['description']) . '</p>
                            <p class="text-muted">Price: R' . htmlspecialchars($row['price']) . '</p>
                            <form method="GET" action="UpdateListingPage.php" style="display:inline;">
                                <input type="hidden" name="listing_id" value="' . intval($row['Product_id']) . '">
                                <button type="submit" class="btn btn-sm btn-outline-primary me-2">Update</button>
                            </form>
                            <form method="POST" action="MyListingsPage.php" onsubmit="return confirm(\'Are you sure you want to delete this listing?\');" style="display:inline;">
                                <input type="hidden" name="listing_id" value="' . intval($row['Product_id']) . '">
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    </div>';
                }
            } else {
                echo "<p>No listings found.</p>";
            }

            $stmt->close();

        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
    // Handle deletion of listings
    if(isset($_POST['listing_id'])) {
        $listing_id = $_POST['listing_id'];

        $statement = $conn->prepare("DELETE FROM listings WHERE Product_id = ?");
        $statement->bind_param("i", $listing_id);

        if ($statement->execute()) {
            echo "<script>alert('Listing deleted successfully.');</script>";
            echo "<script>window.location.href = 'MyListingsPage.php';</script>";
        } else {
            echo "<script>alert('Error deleting listing.');</script>";
        }

        $statement->close();
        $conn->close();
    }
?>
