<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Manage Users | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .page-header {
            padding: 2rem;
            background-image: url('../Images/MangeUsersPageImage.jpg');
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

        .user-card {
            margin-bottom: 1.5rem;
            background-color: white;
            border: none;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .action-buttons button {
            margin-right: 0.5rem;
        }

        .user-card .card-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-card img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-info {
            flex: 1;
            margin-left: 15px;
        }
        
        .user-details {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 10px;
            width: 100%;
        }
        
        .detail-item {
            margin-bottom: 5px;
        }
        
        .detail-label {
            font-weight: bold;
            color: #666;
        }
    </style>
</head>
<body>

<div class="page-header">
    <h1>Manage Users</h1>
    <p class="lead">View, block or delete user accounts</p>
</div>

<div class="container">

    <?php
        session_start();
        require_once '../Authentication_Pages/config.php';

        if (!isset($_SESSION['admin_id'])) {
            echo "User not logged in.";
            exit;
        }

        // Query to get all users
        $statement = $conn->prepare("
            SELECT id, fullname, email, phone_number, created_at 
            FROM users
            ORDER BY created_at DESC
        ");

        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="card user-card p-3">
                    <div class="card-body">
                        <div class="d-flex">
                            <img src="../Images/Avatar.jpg" alt="User Avatar">
                            <div class="user-info">
                                <div class="user-details">
                                    <div class="detail-item">
                                        <span class="detail-label">ID:</span> ' . htmlspecialchars($row['id']) . '
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Name:</span> ' . htmlspecialchars($row['fullname']) . '
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Email:</span> ' . htmlspecialchars($row['email']) . '
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Phone:</span> ' . htmlspecialchars($row['phone_number']) . '
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Joined:</span> ' . htmlspecialchars($row['created_at']) . '
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="action-buttons">
                            <form method="POST" action="ManageUsersPage.php" onsubmit="return confirm(\'Are you sure you want to delete this user?\');" style="display:inline;">
                                    <input type="hidden" name="user_id" value="' . intval($row['id']) . '">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo "<p>No users found.</p>";
        }

        
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
    // Handle deletion of users
    if(isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];

        $statement = $conn->prepare("DELETE FROM users WHERE id = ?");
        $statement->bind_param("i", $user_id);

        if ($statement->execute()) {
            echo "<script>alert('User deleted successfully.');</script>";
            echo "<script>window.location.href = 'ManageUsersPage.php';</script>";
        } else {
            echo "<script>alert('Error deleting user.');</script>";
        }

        $statement->close();
        $conn->close();
    }
?>
