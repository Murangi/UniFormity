<?php
  session_start();
  if (!isset($_SESSION['fullname'], $_SESSION['email'], $_SESSION['time_date'])) {
      header("Location: ../Authentication_Pages/LoginPage.php");
      exit;
  }
  $firstname = substr($_SESSION['fullname'], 0, strpos($_SESSION['fullname'], ' '));
  $MonthJoined = date('F', strtotime($_SESSION['time_date']));
  $YearJoined = date('Y', strtotime($_SESSION['time_date']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Profile | UniFormity</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    body {
      background-color: #f8f9fa;
    }

    .page-header {
      padding: 2rem;
      background-image: url('../Images/UserBanner.jpg');
      background-size: cover;
      background-position: center;
      color: white;
      text-align: center;
    }

    .page-header h1 {
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
      margin-bottom: 0.5rem;
    }

    .avatar {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid white;
      margin-bottom: 1rem;
    }

    .dashboard-container {
      max-width: 1000px;
      margin: 2rem auto;
    }

    .card-link {
      text-decoration: none;
      color: inherit;
    }

    .dashboard-card {
      transition: transform 0.2s ease-in-out;
    }

    .dashboard-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .dashboard-icon {
      font-size: 2.5rem;
      margin-bottom: 1rem;
      color: #0d6efd;
    }
  </style>
</head>
<body>
  
  <div class="page-header">
    <img src="../Images/MaleAvatar.jpg" alt="User Avatar" class="avatar" />
    <h1><?php echo htmlspecialchars($firstname); ?></h1>
    <p class="lead"><?php echo htmlspecialchars($_SESSION['email']); ?></p>
  </div>

  <div class="container dashboard-container">
    <!-- User Info Card -->
    <div class="row mb-4">
      <div class="col-12">
        <div class="card p-4 shadow-sm">
          <h4 class="mb-3">User Information</h4>
          <p><strong>Username:</strong> <?php echo htmlspecialchars($firstname); ?></p>
          <!-- <p><strong>Location:</strong> Louis Trichardt, Limpopo</p> -->
          <p><strong>Joined:</strong><?php echo" {$MonthJoined} {$YearJoined}";?></p>
        </div>
      </div>
    </div>

    <!-- Action Cards -->
    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <a href="./AddNewListingPage.php" class="card-link">
          <div class="card dashboard-card p-4 text-center shadow-sm">
            <div class="dashboard-icon">➕</div>
            <h5 class="card-title">Add Listing</h5>
            <p class="card-text">Create a new item for sale.</p>
          </div>
        </a>
      </div>

      <div class="col-md-6 col-lg-3">
        <a href="./MessagesPage.php" class="card-link">
          <div class="card dashboard-card p-4 text-center shadow-sm">
            <div class="dashboard-icon">💬</div>
            <h5 class="card-title">Messages</h5>
            <p class="card-text">Chat with buyers/sellers.</p>
          </div>
        </a>
      </div>

      <div class="col-md-6 col-lg-3">
        <a href="./MyListingsPage.php" class="card-link">
          <div class="card dashboard-card p-4 text-center shadow-sm">
            <div class="dashboard-icon">📦</div>
            <h5 class="card-title">My Listings</h5>
            <p class="card-text">View and manage your posts.</p>
          </div>
        </a>
      </div>

      <div class="col-md-6 col-lg-3">
        <a href="./PurchaseHistoryPage.php" class="card-link">
          <div class="card dashboard-card p-4 text-center shadow-sm">
            <div class="dashboard-icon">🧾</div>
            <h5 class="card-title">Purchase History</h5>
            <p class="card-text">See what you've bought.</p>
          </div>
        </a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
