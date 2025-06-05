<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>User Messages | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .page-header {
            padding: 2rem;
            background-image: url('../Images/Corporate.jpg');
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

        .message-card {
            margin-bottom: 1.5rem;
            background-color: white;
            border: none;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            position: relative;
        }

        .unread-indicator {
            position: absolute;
            right: 1rem;
            top: 1rem;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #ff6b6b;
        }

        .message-meta {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .message-content {
            margin: 1rem 0;
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="page-header">
    <h1>User Messages</h1>
    <p class="lead">Manage and respond to user inquiries and conversations</p>
</div>

<div class="container">
    <!-- Example Message Card -->
    <div class="card message-card p-3">
        <div class="unread-indicator"></div>
        <div class="card-body">
            <div class="message-meta">
                From: <strong>john.doe@example.com</strong><br>
                Subject: <strong>Question about textbook condition</strong><br>
                Received: 2024-03-15 14:30
            </div>
            
            <div class="message-content">
                <p>"Hello, I'm interested in the Grade 12 Mathematics textbook. Could you confirm if all pages are intact and if there's any writing inside?"</p>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div class="message-status">
                    <span class="badge bg-warning">Unread</span>
                    <span class="text-muted ms-2">Last replied: 2024-03-15 15:00</span>
                </div>
                <div class="action-buttons">
                    <button class="btn btn-success btn-sm">Reply</button>
                    <button class="btn btn-secondary btn-sm">Mark as Read</button>
                    <button class="btn btn-danger btn-sm">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Message Card Example -->
    <div class="card message-card p-3">
        <div class="card-body">
            <div class="message-meta">
                From: <strong>sarah.smith@example.com</strong><br>
                Subject: <strong>Uniform size inquiry</strong><br>
                Received: 2024-03-14 09:15
            </div>
            
            <div class="message-content">
                <p>"Hi, could you let me know if the blazer listed as size M would fit a 165cm tall student? Thank you!"</p>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div class="message-status">
                    <span class="badge bg-success">Read</span>
                    <span class="text-muted ms-2">Last replied: 2024-03-14 10:30</span>
                </div>
                <div class="action-buttons">
                    <button class="btn btn-success btn-sm">Reply</button>
                    <button class="btn btn-secondary btn-sm">Mark Unread</button>
                    <button class="btn btn-danger btn-sm">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
