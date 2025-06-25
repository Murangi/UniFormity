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
    $sender_fullname = $_SESSION['fullname'];
    $recipient_fullname = trim($_POST['recipient']);
    $subject = $_POST['subject'];
    $message_body = $_POST['message'];

    // Basic validation
    if (empty($recipient_fullname) || empty($subject) || empty($message_body)) {
        $_SESSION['message_error'] = "All fields are required.";
        header('Location: MessagesPage.php');
        exit;
    }

    try {
        // Case-insensitive recipient lookup
        $check_stmt = $conn->prepare("SELECT fullname FROM users WHERE LOWER(fullname) = LOWER(?)");
        $check_stmt->bind_param("s", $recipient_fullname);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows === 0) {
            $_SESSION['message_error'] = "Recipient does not exist.";
            header('Location: MessagesPage.php');
            exit;
        }

        // Insert message into database (use correct table name)
        $stmt = $conn->prepare("INSERT INTO messages (sender_fullname, recipient_fullname, subject, message_body) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $sender_fullname, $recipient_fullname, $subject, $message_body);

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
                <label for="recipient" class="form-label">To (Recipient Username)</label>
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
