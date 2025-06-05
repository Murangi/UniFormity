<?php
session_start();
require_once '../Authentication_Pages/config.php';

// Redirect to login if user is not authenticated
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

// Validate form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender_email = $_SESSION['email'];
    $recipient_email = $_POST['recipient'];
    $subject = $_POST['subject'];
    $message_body = $_POST['message'];

    // Basic validation
    if (empty($recipient_email) || empty($subject) || empty($message_body)) {
        $_SESSION['message_error'] = "All fields are required.";
        header('Location: MessagesPage.php');
        exit;
    }

    try {
        // Check if recipient exists
        $check_stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $check_stmt->bind_param("s", $recipient_email);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows === 0) {
            $_SESSION['message_error'] = "Recipient does not exist.";
            header('Location: MessagesPage.php');
            exit;
        }

        // Insert message into database
        $stmt = $conn->prepare("INSERT INTO Messages (sender_email, recipient_email, subject, message_body) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $sender_email, $recipient_email, $subject, $message_body);

        if ($stmt->execute()) {
            $_SESSION['message_success'] = "Message sent successfully!";
        } else {
            $_SESSION['message_error'] = "Error sending message: " . $stmt->error;
        }

        $stmt->close();
        $check_stmt->close();
        
    } catch (Exception $e) {
        $_SESSION['message_error'] = "Database error: " . $e->getMessage();
    }
    
    header('Location: UserProfilePage.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Messages | UniFormity</title>
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

        .message-image {
            background-image: url('../Images/Message.jpg'); /* Change this to your preferred image */
            background-size: cover;
            background-position: center;
            flex: 1;
        }

        .message-form-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .message-form {
            width: 100%;
            max-width: 500px;
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            font-weight: bold;
            margin-bottom: 1.5rem;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="half-page">
    <!-- Left: Image -->
    <div class="message-image"></div>

     <div class="position-absolute top-0 end-0 mt-3 me-3">
      <a href="./UserProfilePage.php" class="btn btn-light btn-sm">Back to Profile</a>
      <a href="./ResponsesPage.php" class="btn btn-light btn-sm ms-2">Messages</a>
    </div>

    <!-- Right: Messaging Form -->
    <div class="message-form-container">
        <form class="message-form" method="POST" action="MessagesPage.php">
            <h2 class="form-title">Send a Message</h2>

            <div class="mb-3">
                <label for="recipient" class="form-label">To (Recipient Username or Email)</label>
                <input type="text" class="form-control" id="recipient" name="recipient" required>
            </div>

            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">Send</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
