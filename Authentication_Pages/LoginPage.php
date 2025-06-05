<?php
    session_start();
    require_once 'config.php';

    // Admin credentials (for verification before database check)
    $adminEmail = 'admin@gmail.com';
    $adminPassword = 'Rainbow1!';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize and validate inputs
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];

        // Check if email and password are provided
        if (empty($email) || empty($password)) {
            echo "<script>alert('Email and password are required!');</script>";
            exit;
        }

        // Check for admin credentials first
        if ($email === $adminEmail && $password === $adminPassword) {
            // Verify against database
            $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

           

            if ($result->num_rows > 0) {
                $admin = $result->fetch_assoc();
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['admin_email'] = $admin['email'];
                header("Location: ../AdminDashboard_Pages/AdminDashboardPage.php");
                exit;
                
            }
            // If database check fails, continue to regular user check
        }

        // Regular user authentication
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password_hash'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['time_date'] = $user['created_at'];
                header("Location: ../UserDashboard_Pages/UserProfilePage.php");
                exit;
            } else {
                echo "<script>alert('Invalid password!');</script>";
            }
        } else {
            echo "<script>alert('No user found with that email!');</script>";
        }

        $stmt->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login | UniFormity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <style>
        
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #EAEFEF;
        }
        .half-page {
            display: flex;
            height: 100vh;
        }
        .login-image {
            background-image: url('../Images/School.jpg');
            background-size: cover;
            background-position: center;
            flex: 1;
            height: 100%;
        }

        .login-form-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            background-color: #EAEFEF;
        }
        
        .login-form {
            width: 100%;
            max-width: 400px;
            background-color: #B8CFCE;
            border: 1px solid #7F8CAA;
        }
        .form-title {
            font-weight: bold;
            margin-bottom: 1rem;
            text-align: center;
            color: #333446;
        }
        .btn-primary {
            background-color: #333446;
            border-color: #333446;
        }
        .btn-primary:hover {
            background-color: #7F8CAA;
            border-color: #7F8CAA;
        }
        a {
            color: #333446;
        }
        a:hover {
            color: #7F8CAA;
        }
        .form-label {
            color: #333446;
        }
    </style>
</head>
<body>

<div class="half-page">
    <!-- Left: Image -->
    <div class="login-image"></div>

    <!-- Right: Login Form -->
    <div class="login-form-container">
        <form class="login-form shadow p-4 rounded bg-white" method="post" action="LoginPage.php">
            <h2 class="form-title">Welcome Back</h2>

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required />
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required />
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" />
                <label class="form-check-label" for="remember">Remember me</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>

            <p class="mt-3 text-center small">
                Don’t have an account? <a href="./RegisterPage.php">Register here</a>
            </p>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>