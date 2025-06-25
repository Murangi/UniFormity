<?php
session_start();
require_once '../Authentication_Pages/config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Authentication_Pages/index.php");
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    // Fetch purchase history with item details
    $stmt = $conn->prepare("
        SELECT 
            o.order_id AS order_id,
            o.created_at AS order_date,
            o.total_amount,
            oi.product_id,
            oi.price_each,
            l.title AS product_name,
            u.fullname AS seller_name,
            l.ItemCondition AS product_condition
        FROM orders o
        JOIN order_items oi ON o.order_id = oi.order_id
        JOIN listings l ON oi.product_id = l.Product_id
        JOIN users u ON oi.seller_id = u.id
        WHERE o.user_id = ?
        ORDER BY o.created_at DESC
    ");
    
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $purchases = $result->fetch_all(MYSQLI_ASSOC);
    
} catch (Exception $e) {
    die("Error fetching purchase history: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Purchase History | UniFormity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        /* Keep existing styles */
        html, body { height: 100%; margin: 0; padding: 0; overflow: hidden; }
        .half-page { display: flex; height: 100vh; }
        .history-image { background-image: url('../Images/PurchaseHistoryPageImage.jpg'); background-size: cover; background-position: center; flex: 1; }
        .history-container { flex: 1; overflow-y: auto; padding: 2rem; background-color: #f5f7fa; }
        .history-title { font-weight: bold; text-align: center; margin-bottom: 1.5rem; }
        .history-card { margin-bottom: 1rem; box-shadow: 0 0 10px rgba(0, 0, 0, 0.05); }
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
    
    <div class="history-image"></div>

    <div class="history-container">
        <h2 class="history-title">My Purchase History</h2>

        <?php if(empty($purchases)): ?>
            <div class="alert alert-info">No purchases found. Your purchase history will appear here.</div>
        <?php else: ?>
            <?php 
            $current_order = null;
            foreach ($purchases as $purchase): 
                if ($current_order != $purchase['order_id']): 
                    $current_order = $purchase['order_id'];
            ?>
                    <div class="card history-card mb-4">
                        <div class="card-header bg-light d-flex justify-content-between">
                            <span>Order #<?= htmlspecialchars($purchase['order_id']) ?></span>
                            <span class="text-muted">
                                <?= date('d M Y', strtotime($purchase['order_date'])) ?>
                            </span>
                        </div>
                        <div class="card-body">
            <?php endif; ?>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h5 class="card-title mb-1"><?= htmlspecialchars($purchase['product_name']) ?></h5>
                                    <p class="card-text text-muted small mb-0">
                                        Condition: <?= htmlspecialchars($purchase['product_condition']) ?> | 
                                        Seller: <?= htmlspecialchars($purchase['seller_name']) ?>
                                    </p>
                                </div>
                                <span class="text-success">R<?= number_format($purchase['price_each'], 2) ?></span>
                            </div>

            <?php 
                // Check if next item is from same order
                $next_key = array_search($purchase, $purchases) + 1;
                if (!isset($purchases[$next_key]) || $purchases[$next_key]['order_id'] != $current_order): 
            ?>
                            <hr class="mt-4">
                            <div class="d-flex justify-content-between align-items-center pt-2">
                                <strong>Order Total:</strong>
                                <span class="text-success h5 mb-0">
                                    R<?= number_format($purchase['total_amount'], 2) ?>
                                </span>
                            </div>
                        </div>
                    </div>
            <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
