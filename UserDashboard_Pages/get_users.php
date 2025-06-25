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
    $recipient_name = $_POST['recipient']; // Changed to recipient name
    $subject = $_POST['subject'];
    $message_body = $_POST['message'];

    // Basic validation
    if (empty($recipient_name) || empty($subject) || empty($message_body)) {
        $_SESSION['message_error'] = "All fields are required.";
        header('Location: MessagesPage.php');
        exit;
    }

    try {
        // Get sender's full name from database
        $sender_stmt = $conn->prepare("SELECT fullname FROM users WHERE email = ?");
        $sender_stmt->bind_param("s", $sender_email);
        $sender_stmt->execute();
        $sender_result = $sender_stmt->get_result();
        
        if ($sender_result->num_rows === 0) {
            $_SESSION['message_error'] = "User not found. Please log in again.";
            header('Location: MessagesPage.php');
            exit;
        }
        $sender_row = $sender_result->fetch_assoc();
        $sender_fullname = $sender_row['fullname'];

        // Check if recipient exists by full name
        $recipient_stmt = $conn->prepare("SELECT fullname FROM users WHERE fullname = ?");
        $recipient_stmt->bind_param("s", $recipient_name);
        $recipient_stmt->execute();
        $recipient_result = $recipient_stmt->get_result();

        if ($recipient_result->num_rows === 0) {
            $_SESSION['message_error'] = "Recipient does not exist.";
            header('Location: MessagesPage.php');
            exit;
        }
        $recipient_row = $recipient_result->fetch_assoc();
        $recipient_fullname = $recipient_row['fullname'];

        // Insert message into database using full names
        $stmt = $conn->prepare("INSERT INTO Messages (sender_fullname, recipient_fullname, subject, message_body) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $sender_fullname, $recipient_fullname, $subject, $message_body);

        if ($stmt->execute()) {
            $_SESSION['message_success'] = "Message sent successfully!";
        } else {
            $_SESSION['message_error'] = "Error sending message: " . $stmt->error;
        }

        // Close statements
        $sender_stmt->close();
        $recipient_stmt->close();
        $stmt->close();
        
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            background-image: url('../Images/Message.jpg');
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
        
        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            top: 100%;
            left: 0;
            right: 0;
            max-height: 200px;
            overflow-y: auto;
        }
        
        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff; 
            border-bottom: 1px solid #d4d4d4; 
        }
        
        .autocomplete-items div:hover {
            background-color: #e9e9e9; 
        }
        
        @media (max-width: 1024px) {
            .message-image {
                display: none !important;
            }
            .message-form-container {
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
            .message-form {
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

            <div class="mb-3 autocomplete">
                <label for="recipient" class="form-label">To (Recipient Full Name)</label>
                <input type="text" class="form-control" id="recipient" name="recipient" required placeholder="Start typing a name...">
                <div id="recipient-list" class="autocomplete-items"></div>
            </div>

            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-paper-plane me-2"></i>Send Message
            </button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const recipientInput = document.getElementById('recipient');
    const recipientList = document.getElementById('recipient-list');
    
    // Fetch user names for autocomplete
    recipientInput.addEventListener('input', function() {
        const query = this.value.trim();
        
        if (query.length < 2) {
            recipientList.innerHTML = '';
            return;
        }
        
        fetch(`get_users.php?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(users => {
                recipientList.innerHTML = '';
                users.forEach(user => {
                    const div = document.createElement('div');
                    div.textContent = user.fullname;
                    div.addEventListener('click', function() {
                        recipientInput.value = user.fullname;
                        recipientList.innerHTML = '';
                    });
                    recipientList.appendChild(div);
                });
            });
    });
    
    // Close autocomplete when clicking outside
    document.addEventListener('click', function(e) {
        if (e.target !== recipientInput) {
            recipientList.innerHTML = '';
        }
    });
});
</script>
</body>
</html>