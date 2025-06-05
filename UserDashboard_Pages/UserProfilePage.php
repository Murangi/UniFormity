<?php
  session_start();
  if (!isset($_SESSION['fullname'], $_SESSION['email'], $_SESSION['time_date'])) {
      header("Location: ../Authentication_Pages/LoginPage.php");
      exit;
  }
  $firstname = substr($_SESSION['fullname'], 0, strpos($_SESSION['fullname'], ' '));
  $MonthJoined = date('F', strtotime($_SESSION['time_date']));
  $YearJoined = date('Y', strtotime($_SESSION['time_date']));

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../Genaral_Pages/LandingPage.php");
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Profile | UniFormity</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    :root {
      --dark-navy: #333446;
      --slate-blue: #7F8CAA;
      --light-teal: #B8CFCE;
      --pale-grey: #EAEFEF;
    }
    
    body {
      background-color: var(--pale-grey);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: var(--dark-navy);
    }

    .page-header {
      padding: 3rem 1rem;
      background: linear-gradient(rgba(51, 52, 70, 0.85), rgba(51, 52, 70, 0.9)), 
                  url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="%23333446"/><path d="M0 50 L100 50 M50 0 L50 100" stroke="%237F8CAA" stroke-width="1" stroke-opacity="0.2"/></svg>');
      background-size: cover;
      background-position: center;
      color: white;
      text-align: center;
      position: relative;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .page-header::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, var(--slate-blue), var(--light-teal));
    }

    .page-header h1 {
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
      margin-bottom: 0.5rem;
      font-weight: 600;
      letter-spacing: 0.5px;
    }

    .page-header .lead {
      font-weight: 300;
      opacity: 0.9;
      max-width: 500px;
      margin: 0 auto;
    }

    .avatar {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid white;
      margin: 0 auto 1.5rem;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .dashboard-container {
      max-width: 1200px;
      margin: 2rem auto;
      padding: 0 1.5rem;
    }

    .card-link {
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .card-link:hover {
      transform: translateY(-3px);
    }

    .dashboard-card {
      transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
      height: 100%;
      background: white;
      border: none;
      border-radius: 12px;
      overflow: hidden;
      position: relative;
      box-shadow: 0 6px 16px rgba(51, 52, 70, 0.08);
      border-top: 4px solid var(--light-teal);
    }

    .dashboard-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 24px rgba(51, 52, 70, 0.15);
    }

    .dashboard-icon {
      font-size: 2.2rem;
      margin-bottom: 1rem;
      color: var(--slate-blue);
      background: linear-gradient(135deg, var(--light-teal), var(--slate-blue));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      transition: all 0.3s ease;
    }

    .dashboard-card:hover .dashboard-icon {
      transform: scale(1.1);
    }

    .dashboard-card .card-title {
      color: var(--dark-navy);
      font-weight: 600;
      margin-bottom: 0.75rem;
      font-size: 1.2rem;
    }

    .dashboard-card .card-text {
      color: var(--slate-blue);
      font-weight: 400;
      line-height: 1.6;
    }

    /* Button styling */
    .btn-light {
      background-color: var(--slate-blue);
      color: white;
      border: none;
      border-radius: 30px;
      padding: 0.5rem 1.25rem;
      font-weight: 500;
      transition: all 0.3s ease;
      box-shadow: 0 4px 8px rgba(51, 52, 70, 0.2);
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .btn-light:hover {
      background-color: var(--light-teal);
      color: var(--dark-navy);
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(51, 52, 70, 0.25);
    }

    .btn-danger {
      background: linear-gradient(135deg, #dc3545, #c82333);
      color: white;
      border: none;
      border-radius: 30px;
      padding: 0.5rem 1.25rem;
      font-weight: 500;
      transition: all 0.3s ease;
      box-shadow: 0 4px 8px rgba(51, 52, 70, 0.2);
    }

    .btn-danger:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(51, 52, 70, 0.25);
    }

    /* User info card */
    .user-info-card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 6px 16px rgba(51, 52, 70, 0.08);
      border-left: 4px solid var(--light-teal);
      padding: 2rem;
      margin-bottom: 2rem;
    }

    .user-info-card h4 {
      color: var(--dark-navy);
      font-weight: 600;
      margin-bottom: 1.5rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid rgba(127, 140, 170, 0.2);
    }

    .info-item {
      margin-bottom: 1rem;
      display: flex;
      align-items: flex-start;
    }

    .info-label {
      font-weight: 600;
      color: var(--dark-navy);
      min-width: 120px;
    }

    .info-value {
      color: var(--slate-blue);
      flex: 1;
    }

    /* Action cards grid */
    .action-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 1.5rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      .page-header {
        padding: 2rem 1rem;
      }
      
      .action-grid {
        grid-template-columns: 1fr;
      }
    }

    /* Decorative elements */
    .blob {
      position: absolute;
      opacity: 0.05;
      z-index: 0;
      border-radius: 50%;
    }
    
    .blob-1 {
      width: 200px;
      height: 200px;
      background: radial-gradient(circle, var(--slate-blue), transparent);
      top: -50px;
      right: -50px;
    }
    
    .blob-2 {
      width: 150px;
      height: 150px;
      background: radial-gradient(circle, var(--light-teal), transparent);
      bottom: -30px;
      left: -30px;
    }
  </style>
</head>
<body>

  <div class="page-header position-relative">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    
    <div class="position-absolute top-0 end-0 mt-3 me-3 d-flex gap-2">
      <a href="../Genaral_Pages/LandingPage.php" class="btn btn-light btn-sm">
        <i class="bi bi-house-door"></i> Home
      </a>
      <a href="../Genaral_Pages/BrowseListingsPage.php" class="btn btn-light btn-sm">
        <i class="bi bi-cart"></i> Purchase
      </a>
    </div>
    
    <img src="../Images/MaleAvatar.jpg" alt="User Avatar" class="avatar" />
    <h1><?php echo htmlspecialchars($firstname); ?></h1>
    <p class="lead"><?php echo htmlspecialchars($_SESSION['email']); ?></p>

    <form method="POST" class="mt-3">
      <button type="submit" name="logout" class="btn btn-danger btn-sm">
        <i class="bi bi-box-arrow-right"></i> Logout
      </button>
    </form>
  </div>

  <div class="container dashboard-container">
    <!-- User Info Card -->
    <div class="row mb-4">
      <div class="col-12">
        <div class="user-info-card">
          <h4>User Information</h4>
          <div class="info-item">
            <div class="info-label">Username:</div>
            <div class="info-value"><?php echo htmlspecialchars($firstname); ?></div>
          </div>
          <div class="info-item">
            <div class="info-label">Email:</div>
            <div class="info-value"><?php echo htmlspecialchars($_SESSION['email']); ?></div>
          </div>
          <div class="info-item">
            <div class="info-label">Joined:</div>
            <div class="info-value"><?php echo "{$MonthJoined} {$YearJoined}"; ?></div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Action Cards -->
    <div class="action-grid">
      <a href="./AddNewListingPage.php" class="card-link">
        <div class="card dashboard-card p-4 text-center">
          <i class="bi bi-plus-circle dashboard-icon"></i>
          <div class="card-body">
            <h5 class="card-title">Add Listing</h5>
            <p class="card-text">Create a new item for sale</p>
          </div>
        </div>
      </a>

      <a href="./MessagesPage.php" class="card-link">
        <div class="card dashboard-card p-4 text-center">
          <i class="bi bi-chat-dots dashboard-icon"></i>
          <div class="card-body">
            <h5 class="card-title">Messages</h5>
            <p class="card-text">Chat with buyers/sellers</p>
          </div>
        </div>
      </a>

      <a href="./MyListingsPage.php" class="card-link">
        <div class="card dashboard-card p-4 text-center">
          <i class="bi bi-box dashboard-icon"></i>
          <div class="card-body">
            <h5 class="card-title">My Listings</h5>
            <p class="card-text">View and manage your posts</p>
          </div>
        </div>
      </a>

      <a href="./PurchaseHistoryPage.php" class="card-link">
        <div class="card dashboard-card p-4 text-center">
          <i class="bi bi-receipt dashboard-icon"></i>
          <div class="card-body">
            <h5 class="card-title">Purchase History</h5>
            <p class="card-text">See what you've bought</p>
          </div>
        </div>
      </a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
