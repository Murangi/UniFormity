<?php
// filepath: c:\xampp\htdocs\UniFormity_Website\UserDashboard_Pages\UpdateListingPage.php
session_start();
require_once '../Authentication_Pages/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../Authentication_Pages/LoginPage.php");
    exit;
}

if (!isset($_GET['listing_id'])) {
    echo "No listing selected.";
    exit;
}

$listing_id = intval($_GET['listing_id']);
$user_id = $_SESSION['user_id'];

// Fetch listing data
$stmt = $conn->prepare("SELECT * FROM listings WHERE Product_id = ? AND user_id = ?");
$stmt->bind_param("ii", $listing_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$listing = $result->fetch_assoc();

if (!$listing) {
    echo "Listing not found or you do not have permission to edit this listing.";
    exit;
}

// Handle update form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category = trim($_POST['category']);
    $price = floatval($_POST['price']);
    $ItemCondition = trim($_POST['ItemCondition']);
    $school = trim($_POST['school']);

    $update_stmt = $conn->prepare("UPDATE listings SET title=?, description=?, category=?, price=?, ItemCondition=?, school=? WHERE Product_id=? AND user_id=?");
    $update_stmt->bind_param("ssssssii", $title, $description, $category, $price, $ItemCondition, $school, $listing_id, $user_id);

    if ($update_stmt->execute()) {
        header("Location: MyListingsPage.php");
        exit;
    } else {
        echo "<script>alert('Error updating listing.');</script>";
    }
    $update_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Update Listing | UniFormity</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: #f5f7fa;
        }
        .update-listing-container {
            max-width: 500px;
            margin: 2rem auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(51,52,70,0.08);
            padding: 2rem 2.5rem;
        }
        @media (max-width: 576px) {
            .update-listing-container {
                padding: 1rem 0.5rem;
                margin: 1rem 0.25rem;
            }
            h2 {
                font-size: 1.5rem;
            }
            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }
    </style>
</head>
<body>
<div class="update-listing-container">
    <h2 class="mb-4 text-center">Update Listing</h2>
    <form method="POST" autocomplete="off">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($listing['title']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3" required><?= htmlspecialchars($listing['description']) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control" value="<?= htmlspecialchars($listing['category']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" step="0.01" name="price" class="form-control" value="<?= htmlspecialchars($listing['price']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Condition</label>
            <input type="text" name="ItemCondition" class="form-control" value="<?= htmlspecialchars($listing['ItemCondition']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">School</label>
            <input type="text" name="school" class="form-control" value="<?= htmlspecialchars($listing['school']) ?>" required>
        </div>
        <div class="d-flex flex-column flex-sm-row gap-2">
            <button type="submit" class="btn btn-primary">Update Listing</button>
            <a href="MyListingsPage.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>