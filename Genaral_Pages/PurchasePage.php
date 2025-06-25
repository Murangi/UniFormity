<?php
session_start();
require_once '../Authentication_Pages/config.php';

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    $_SESSION['login_redirect'] = "Please log in to complete your purchase";
    header("Location: ../Authentication_Pages/LoginPage.php");
    exit;
}

if (!isset($_SESSION['cart_items']) || empty($_SESSION['cart_items'])) {
    header("Location: ReviewCartPage.php");
    exit;
}

$total = 0;
$shipping = 30; // flat shipping rate
foreach ($_SESSION['cart_items'] as $item) {
    $total += $item['price'];
}
$grand_total = $total + $shipping;

// Handle POST submission (order confirmation)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get user input
    $full_name = $_POST['name'];
    $email = $_POST['email'];
    $shipping_address = $_POST['address'];
    $payment_method = $_POST['paymentMethod'];
    
    // Get user_id from session if available (assuming user is logged in)
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    
    try {
        // Begin transaction
        $conn->begin_transaction();
        
        // Insert into orders table
        $order_stmt = $conn->prepare("
            INSERT INTO orders (user_id, full_name, email, shipping_address, payment_method, total_amount, status, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, 'Pending', NOW())
        ");
        $order_stmt->bind_param("issssd", $user_id, $full_name, $email, $shipping_address, $payment_method, $grand_total);
        $order_stmt->execute();
        $order_id = $conn->insert_id;
        $order_stmt->close();
        
        // Insert order items
        $item_stmt = $conn->prepare("
            INSERT INTO order_items (order_id, product_id, price_each, seller_id)
            VALUES (?, ?, ?, (SELECT user_id FROM listings WHERE Product_id = ?))
        ");
        
        foreach ($_SESSION['cart_items'] as $item) {
            $item_stmt->bind_param("iidi", $order_id, $item['id'], $item['price'], $item['id']);
            $item_stmt->execute();
        }
        $item_stmt->close();
        
        // If payment is EFT, insert EFT details
        if ($payment_method === 'eft') {
            $bank_name = $_POST['bankName'];
            $account_holder = $_POST['accountName'];
            $reference = $_POST['reference'];
            
            $eft_stmt = $conn->prepare("
                INSERT INTO eft_details (order_id, bank_name, account_holder, reference)
                VALUES (?, ?, ?, ?)
            ");
            $eft_stmt->bind_param("isss", $order_id, $bank_name, $account_holder, $reference);
            $eft_stmt->execute();
            $eft_stmt->close();
        }
        
        // Commit transaction
        $conn->commit();
        
        // Clear cart
        unset($_SESSION['cart_items']);
        
        // Redirect to success page
        header("Location: OrderSuccessPage.php?order_id=".$order_id);
        exit;
        
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        die("Error processing order: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Confirm Purchase | UniFormity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        body {
            background: linear-gradient(to right, #e3f2fd, #ffffff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem;
        }

        .purchase-card {
            max-width: 1000px;
            margin: auto;
            border-radius: 12px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        .purchase-header {
            background-color: #0d6efd;
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .item-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 10px;
        }

        .summary-box {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 1rem;
        }

        .btn-purchase {
            font-weight: 600;
            padding: 0.75rem;
        }

        .eft-section {
            display: none;
            background-color: #eef3fc;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-top: 1rem;
            border: 1px solid #b6d4fe;
        }

        @media (max-width: 768px) {
            body {
                padding: 0.5rem;
            }
            .purchase-card {
                max-width: 100%;
                border-radius: 0;
                box-shadow: none;
                margin: 0;
            }
            .purchase-header {
                padding: 1.2rem 0.5rem;
                font-size: 1rem;
            }
            .item-image {
                width: 40px;
                height: 40px;
                margin-right: 6px;
            }
            .summary-box {
                padding: 0.5rem;
                font-size: 0.98rem;
            }
            .btn-purchase {
                font-size: 1rem;
                padding: 0.7rem;
            }
            .list-group-item {
                font-size: 0.98rem;
                padding: 0.5rem 0.5rem;
            }
            h5, .form-label {
                font-size: 1rem;
            }
            .p-4 {
                padding: 1rem !important;
            }
        }
        @media (max-width: 480px) {
            .purchase-header h2 {
                font-size: 1.2rem;
            }
            .purchase-header p {
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>

<div class="card purchase-card">
    <div class="purchase-header">
        <h2>Confirm Your Purchase</h2>
        <p>Please review your order and enter your details to complete your purchase.</p>
    </div>

    <div class="p-4">
        <form method="POST">
            <!-- Items Overview -->
            <h5 class="mb-3">Items in Your Cart</h5>
            <ul class="list-group mb-4">
                <?php foreach ($_SESSION['cart_items'] as $item): ?>
                    <li class="list-group-item d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <img src="<?= htmlspecialchars($item['image']) ?>" class="item-image" alt="Product">
                            <div>
                                <strong><?= htmlspecialchars($item['name']) ?></strong><br>
                                <small>Seller: <?= htmlspecialchars($item['seller']) ?> | Condition: <?= htmlspecialchars($item['condition']) ?></small>
                            </div>
                        </div>
                        <span class="text-success fw-semibold">R<?= number_format($item['price'], 2) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- User Info -->
            <h5>Your Information</h5>
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Shipping Address</label>
                <input type="text" name="address" class="form-control" required>
            </div>

            <!-- Payment Options -->
            <h5>Payment Method</h5>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="paymentMethod" id="cod" value="cod" checked>
                <label class="form-check-label" for="cod">Cash on Delivery</label>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="paymentMethod" id="eft" value="eft">
                <label class="form-check-label" for="eft">EFT / Direct Deposit</label>
            </div>

            <!-- EFT Section -->
            <div id="eftDetails" class="eft-section">
                <label class="form-label">Bank Name</label>
                <input type="text" name="bankName" class="form-control mb-2" placeholder="e.g. FNB, Capitec">

                <label class="form-label">Account Holder Name</label>
                <input type="text" name="accountName" class="form-control mb-2">

                <label class="form-label">Reference Number</label>
                <input type="text" name="reference" class="form-control">
            </div>

            <!-- Order Summary -->
            <h5 class="mt-4">Order Summary</h5>
            <ul class="list-group summary-box mb-3">
                <li class="list-group-item d-flex justify-content-between">
                    <span>Subtotal</span><span>R<?= number_format($total, 2) ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Shipping</span><span>R<?= number_format($shipping, 2) ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <strong>Total</strong><strong>R<?= number_format($grand_total, 2) ?></strong>
                </li>
            </ul>

            <button type="submit" class="btn btn-primary btn-purchase w-100">Place Order</button>
        </form>
    </div>
</div>

<script>
    const eftRadio = document.getElementById('eft');
    const codRadio = document.getElementById('cod');
    const eftDetails = document.getElementById('eftDetails');

    function toggleEFT() {
        eftDetails.style.display = eftRadio.checked ? 'block' : 'none';
    }

    eftRadio.addEventListener('change', toggleEFT);
    codRadio.addEventListener('change', toggleEFT);
    window.addEventListener('DOMContentLoaded', toggleEFT);
</script>

</body>
</html>
