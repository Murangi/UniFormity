<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Manage Listings | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .page-header {
            padding: 2rem;
            background-image: url('../Images/ManageListingsPageImage.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
        } 

        .page-header h1,
        .page-header p {
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
        }

        .container {
            max-width: 1200px;
            margin-top: 2rem;
        }

        .listing-card {
            margin-bottom: 1.5rem;
            background-color: white;
            border: none;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        .listing-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .action-buttons button {
            margin-right: 0.5rem;
        }
        
        .card-body {
            display: flex;
            flex-direction: column;
        }
        
        .listing-details {
            display: flex;
            gap: 20px;
        }
        
        .listing-text {
            flex: 1;
        }
        
        @media (max-width: 768px) {
            .listing-details {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<div class="page-header">
    <h1>Manage Listings</h1>
    <p class="lead">Review and remove listings submitted by users</p>
</div>

<div class="container">

    <?php
        // Check if the user is logged in as an admin
        session_start();
        require_once '../Authentication_Pages/config.php';

        if (!isset($_SESSION['admin_id'])) {
            echo "User not logged in.";
            exit;
        }

        // Query to get listings with user information
        $statement = $conn->prepare("
            SELECT l.*, u.fullname 
            FROM listings l
            JOIN users u ON l.user_id = u.id
            ORDER BY l.created_at DESC
        ");

        $statement->execute();
        $result = $statement->get_result();

        // Check if any listings exist
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Use the image_path from listings table or a placeholder
                $imagePath = !empty($row['image_path']) ? '../' . $row['image_path'] : '../Images/placeholder-image.jpg';
                
                // Echo each listing in card format with user's fullname
                echo '
                <div class="card listing-card p-3">
                    <div class="card-body">
                        <div class="listing-details">
                            <div class="listing-image-container">
                                <img src="' . htmlspecialchars($imagePath) . '" alt="Listing Image" class="listing-image">
                            </div>
                            <div class="listing-text">
                                <h5 class="card-title">' . htmlspecialchars($row['title']) . '</h5>
                                <p class="card-text">
                                    Listed by: <strong>' . htmlspecialchars($row['fullname']) . '</strong><br/>
                                    Price: R' . htmlspecialchars($row['price']) . '<br/>
                                    Condition: ' . htmlspecialchars($row['ItemCondition']) . '<br/>
                                    Description: ' . htmlspecialchars($row['description']) . '
                                </p>
                                <div class="action-buttons">
                                    <form method="POST" action="ManageListingsPage.php" onsubmit="return confirm(\'Are you sure you want to delete this listing?\');" style="display:inline;">
                                        <input type="hidden" name="listing_id" value="' . intval($row['Product_id']) . '">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo "<p>No listings found.</p>";
        }

    ?>
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
            echo "<script>window.location.href = 'ManageListingsPage.php';</script>";
        } else {
            echo "<script>alert('Error deleting listing.');</script>";
        }

        $statement->close();
        $conn->close();
    }
?>