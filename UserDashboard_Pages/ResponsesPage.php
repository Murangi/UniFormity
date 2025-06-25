<?php
session_start();
require_once '../Authentication_Pages/config.php'; // Ensure this contains your DB connection

if (!isset($_SESSION['fullname'], $_SESSION['email'])) {
    header("Location: ../Authentication_Pages/index.php");
    exit;
}

$messages = [];
$error = null;

try {
    // Get database connection from config
    global $conn;
    
    // Fetch messages for logged-in user
    $stmt = $conn->prepare("
        SELECT m.subject, m.message_body, m.created_at, m.read_status, 
               u.fullname AS sender_name 
        FROM Messages m
        JOIN users u ON m.sender_email = u.email
        WHERE m.recipient_email = ?
        ORDER BY m.created_at DESC
    ");
    $stmt->bind_param("s", $_SESSION['email']);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $messages[] = [
            'sender' => $row['sender_name'],
            'content' => $row['message_body'],
            'subject' => $row['subject'],
            'timestamp' => time_ago($row['created_at']),
            'read' => (bool)$row['read_status']
        ];
    }
    $stmt->close();

} catch (Exception $e) {
    $error = "Error loading messages: " . $e->getMessage();
}

// Function to format timestamp
function time_ago($timestamp) {
    $current_time = new DateTime();
    $message_time = new DateTime($timestamp);
    $interval = $current_time->diff($message_time);

    if ($interval->y >= 1) return $interval->y . " year" . ($interval->y > 1 ? "s" : "") . " ago";
    if ($interval->m >= 1) return $interval->m . " month" . ($interval->m > 1 ? "s" : "") . " ago";
    if ($interval->d >= 1) return $interval->d . " day" . ($interval->d > 1 ? "s" : "") . " ago";
    if ($interval->h >= 1) return $interval->h . " hour" . ($interval->h > 1 ? "s" : "") . " ago";
    if ($interval->i >= 1) return $interval->i . " minute" . ($interval->i > 1 ? "s" : "") . " ago";
    return "Just now";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages | UniFormity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .message-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 15px;
        }
        .message-card {
            transition: all 0.2s;
            border-left: 4px solid transparent;
        }
        .message-card.unread {
            background-color: #f8f9fa;
            border-left-color: #0d6efd;
        }
        .message-card:hover {
            transform: translateX(5px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .message-preview {
            color: #6c757d;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body>

    

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Messages</h1>
            <a href="./UserProfilePage.php" class="btn btn-outline-primary">Back to Profile</a>
        </div>

        <div class="message-container">
            <?php foreach ($messages as $message): ?>
                <div class="card message-card mb-3 <?= $message['read'] ? '' : 'unread' ?>">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h5 class="card-title mb-1"><?= htmlspecialchars($message['sender']) ?></h5>
                                <p class="message-preview mb-0">
                                    <?= htmlspecialchars($message['content']) ?>
                                </p>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <small class="text-muted"><?= $message['timestamp'] ?></small>
                                <?php if(!$message['read']): ?>
                                    <span class="badge bg-primary ms-2">New</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>