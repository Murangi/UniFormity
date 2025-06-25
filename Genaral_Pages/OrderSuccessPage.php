<?php
session_start();
require_once '../Authentication_Pages/config.php';

// Check if order ID exists
if (!isset($_GET['order_id'])) {
    header("Location: ReviewCartPage.php");
    exit;
}

$order_id = $_GET['order_id'];

// Fetch order details (placeholder - replace with actual database query)
// In production, you would query your database here
$order_details = [
    'order_id' => $order_id,
    'total_amount' => 0.00, // Replace with actual data
    'shipping_address' => '123 Campus Road', // Replace with actual data
    'payment_method' => 'EFT' // Replace with actual data
];

// Admin message placeholder
$admin_message = "Your order is being processed. We'll notify you once it ships. Contact support@uniformity.com for any queries.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation | UniFormity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .success-card {
            max-width: 800px;
            margin: 2rem auto;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .success-header {
            background: #28a745;
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 3rem;
            text-align: center;
        }
        .success-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
        }
        .message-box {
            background: white;
            padding: 2rem;
            border-radius: 0 0 15px 15px;
        }
        .admin-note {
            background: #e9f5ff;
            border-left: 4px solid #0d6efd;
            padding: 1.5rem;
            margin: 2rem 0;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="card success-card">
        <div class="success-header">
            <div class="success-icon">✓</div>
            <h1>Payment Successful!</h1>
            <p class="lead mt-2">Thank you for your purchase</p>
        </div>

        <div class="message-box">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="mb-4">Order Details</h3>
                    <p><strong>Order ID:</strong> #<?= htmlspecialchars($order_id) ?></p>
                    <p><strong>Payment Method:</strong> <?= htmlspecialchars($order_details['payment_method']) ?></p>
                    <p><strong>Shipping to:</strong> <?= htmlspecialchars($order_details['shipping_address']) ?></p>
                    
                    <div class="admin-note">
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0">
                                <span class="text-primary">📨</span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5>Message from UniFormity Team</h5>
                                <p class="mb-0"><?= nl2br(htmlspecialchars($admin_message)) ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5>What's Next?</h5>
                        <ul>
                            <li>You'll receive shipping confirmation within 2-3 business days</li>
                            <li>Track your order in your <a href="../UserDashboard_Pages/ResponsesPage.php">Messages page</a></li>
                            <li>Check your messages for seller updates</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Order Summary</h5>
                            <div class="small text-muted">Order #<?= htmlspecialchars($order_id) ?></div>
                            <hr>
                            <!-- Add actual order items here from database -->
                            <div class="d-flex justify-content-between">
                                <span>Total:</span>
                                <strong>R<?= number_format($order_details['total_amount'], 2) ?></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="../index.php" class="btn btn-success btn-lg px-5">Back to Home</a>
                <div class="mt-3">
                    <a href="../UserDashboard_Pages/ResponsesPage.php" class="text-decoration-none">
                        📩 View Messages
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>