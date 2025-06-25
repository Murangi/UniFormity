<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $fullname = trim(filter_input(INPUT_POST, 'fullName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $phone_number = trim(filter_input(INPUT_POST, 'phone_number', FILTER_SANITIZE_NUMBER_INT));
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $time_date = date('Y-m-d H:i:s');

    // Save to session
    $_SESSION['fullname'] = $fullname;
    $_SESSION['email'] = $email;
    $_SESSION['phone_number'] = $phone_number;
    $_SESSION['time_date'] = $time_date;

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
        exit;
    }

    // Check password strength
    $error = "";
    if (strlen($password) < 8) {
        $error = "Password must be at least 8 characters long!";
    } elseif (!preg_match('/[a-z]/', $password)) {
        $error = "Password must include at least one lowercase letter!";
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $error = "Password must include at least one uppercase letter!";
    } elseif (!preg_match('/[0-9]/', $password)) {
        $error = "Password must include at least one number!";
    } elseif (!preg_match('/[!@#$%^&*()_\-=+{};:,<.>?]/', $password)) {
        $error = "Password must include at least one special character (e.g., !@#$%^&*).";
    }

    if (!empty($error)) {
        echo "<script>alert('$error'); window.history.back();</script>";
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $sql = "INSERT INTO users (fullname, email, password_hash, phone_number, created_at) VALUES ('$fullname', '$email', '$hashedPassword', '$phone_number', '$time_date')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Registration successful!');</script>";
        header("Location: LoginPage.php");
        exit;
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Register | UniFormity</title>
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

        .register-image {
            background-image: url('../Images/School.jpg');
            background-size: cover;
            background-position: center;
            flex: 1;
            height: 100%;
        }

        .register-form-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            background-color: #EAEFEF;
        }

        .register-form {
            width: 100%;
            max-width: 450px;
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
        .password-requirements {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 0.25rem;
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
    <div class="register-image"></div>

    <!-- Right: Register Form -->
    <div class="register-form-container">
        <form class="register-form shadow p-4 rounded bg-white" method="post" action="RegisterPage.php" onsubmit="return validateForm()">
            <h2 class="form-title">Create Your Account</h2>

            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullName" name="fullName" placeholder="John Doe" required />
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required />
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone_number" name="phone_number" required />
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required />
                <div class="password-requirements">
                    Must be at least 8 characters with:
                    <ul class="mb-0">
                        <li>Upper & lowercase letters</li>
                        <li>A number</li>
                        <li>A special character (!@#$%^&*)</li>
                    </ul>
                </div>
            </div>

            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required />
            </div>

            <button type="submit" class="btn btn-primary w-100">Register</button>
            <p class="mt-3 text-center small">
                Already have an account? <a href="./LoginPage.php">Login here</a>
            </p>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<script>
    function validateForm() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const errors = [];

        // Password match check
        if (password !== confirmPassword) {
            errors.push("Passwords do not match");
        }

        // Password strength check
        if (password.length < 8) {
            errors.push("Password must be at least 8 characters long");
        }
        if (!/[a-z]/.test(password)) {
            errors.push("Password must include a lowercase letter");
        }
        if (!/[A-Z]/.test(password)) {
            errors.push("Password must include an uppercase letter");
        }
        if (!/[0-9]/.test(password)) {
            errors.push("Password must include a number");
        }
        if (!/[!@#$%^&*()_\-=+{};:,<.>?]/.test(password)) {
            errors.push("Password must include a special character (!@#$%^&*)");
        }

        // Show errors if any
        if (errors.length > 0) {
            alert("Please fix the following:\n\n" + errors.join("\n"));
            return false;
        }
        
        return true;
    }
</script>
</body>
</html>
