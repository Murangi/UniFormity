<?php
    session_start();
    require_once '../Authentication_Pages/config.php';

    if (!isset($_SESSION['cart_items'])) {
        $_SESSION['cart_items'] = [];
    }

    //Handle removing from cart regardless of request method
    if (isset($_GET['remove']) && is_numeric($_GET['remove'])) {
        $remove_id = intval($_GET['remove']);
        $_SESSION['cart_items'] = array_filter($_SESSION['cart_items'], function ($item) use ($remove_id) {
            return $item['id'] !== $remove_id;
        });
        $_SESSION['cart_items'] = array_values($_SESSION['cart_items']); // Re-index
        header('Location: ReviewCartPage.php'); // Redirect to prevent multiple removals on refresh
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['listing_id'])) {
        $listing_id = intval($_POST['listing_id']);

        // Check if already in cart
        foreach ($_SESSION['cart_items'] as $item) {
            if ($item['id'] === $listing_id) {
                header('Location: ReviewCartPage.php');
                exit;
            }
        }

        $stmt = $conn->prepare("
            SELECT l.*, u.fullname AS seller_name
            FROM listings l
            JOIN users u ON l.user_id = u.id
            WHERE l.Product_id = ?
        ");

        $stmt->bind_param("i", $listing_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $_SESSION['cart_items'][] = [
                'id' => $row['Product_id'],
                'name' => $row['title'],
                'seller' => $row['seller_name'],
                'condition' => $row['ItemCondition'],
                'price' => $row['price'],
                'image' => $row['image_path']
            ];
        }

        $stmt->close();
        $conn->close();

        header('Location: ReviewCartPage.php'); // Always redirect after POST
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 0.5rem;
        }
        .card {
            margin-bottom: 1rem;
        }
        .total-price {
            font-weight: bold;
            font-size: 1.2rem;
        }
    </style>
</head>
<body class="bg-light">

<div class="container my-5">
    <h2 class="mb-4 text-center">Review Your Cart</h2>

    <div class="card shadow-sm p-4">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Seller</th>
                    <th>Condition</th>
                    <th class="text-end">Price</th>
                </tr>
                </thead>
                <tbody>
                <!-- Start product row loop -->
                <?php
                $total = 0;
                foreach ($_SESSION['cart_items'] as $item) {
                    $total += $item['price'];
                    echo '<tr>';
                    echo '<td><img src="' . $item['image'] . '" class="product-img" alt="Product"></td>';
                    echo '<td>' . htmlspecialchars($item['name']) . '</td>';
                    echo '<td>' . htmlspecialchars($item['seller']) . '</td>';
                    echo '<td>' . htmlspecialchars($item['condition']) . '</td>';
                    echo '<td class="text-end">R' . number_format($item['price'], 2) . '</td>';
                    echo '<td class="text-end"><a href="?remove=' . $item['id'] . '" class="btn btn-sm btn-outline-danger">Remove</a></td>';
                    echo '</tr>';
                }
                ?>
                <!-- End product row loop -->
                </tbody>
            </table>
        </div>

        <!-- Total and Button -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="total-price">Total: R<?= number_format($total, 2) ?></div>
            <form action="PurchasePage.php">
                <button type="submit" class="btn btn-secondary btn-lg">Proceed to Checkout</button>
            </form>
            
        </div>
    </div>
</div>

</body>
</html>
