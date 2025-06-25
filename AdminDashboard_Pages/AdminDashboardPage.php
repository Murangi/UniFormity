<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .page-header {
            padding: 2rem;
            background-image: url('../Images/AdiminDashboardPageImage.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
        }

        .page-header h1 {
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 2rem auto;
        }

        .card-link {
            text-decoration: none;
            color: inherit;
        }

        .dashboard-card {
            transition: transform 0.2s ease-in-out;
            height: 100%;
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

        /* Equal height cards in row */
        .dashboard-row {
            display: flex;
            flex-wrap: wrap;
        }
        
        /* Enhanced Stats Container */
        .stats-container {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .stats-container:hover {
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
            transform: translateY(-3px);
        }
        
        .stat-card {
            text-align: center;
            padding: 1.5rem 1rem;
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        
        .stat-number {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 2;
            color: #2c3e50;
        }
        
        .stat-label {
            color: #6c757d;
            font-size: 1rem;
            font-weight: 500;
            position: relative;
            z-index: 2;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .stat-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 2.5rem;
            opacity: 0.1;
            color: #0d6efd;
            z-index: 1;
        }
        
        .trend-indicator {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-top: 0.5rem;
        }
        
        .trend-up {
            background-color: rgba(40, 167, 69, 0.15);
            color: #28a745;
        }
        
        .trend-down {
            background-color: rgba(220, 53, 69, 0.15);
            color: #dc3545;
        }
        
        .stat-divider {
            height: 80px;
            width: 1px;
            background: rgba(0, 0, 0, 0.1);
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .stat-divider {
                display: none;
            }
            
            .stat-card {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>

<div class="page-header">
    <h1>Admin Dashboard</h1>
    <p class="lead">Welcome, <??> Manage the platform with the tools below.</p>
</div>

<div class="position-absolute top-0 end-0 mt-3 me-3">
    <a href="../index.php" class="btn btn-light btn-sm">Home</a>
</div>

<div class="container dashboard-container">
    
    <div class="row g-4 dashboard-row">
        <!-- Manage Listings Card -->
        <div class="col-lg-4 col-md-6">
            <a href="./ManageListingsPage.php" class="card-link">
                <div class="card dashboard-card p-4 text-center shadow-sm">
                    <i class="bi bi-box-seam dashboard-icon"></i>
                    <h4 class="card-title">Manage Listings</h4>
                    <p class="card-text">Edit, approve, or remove listed items</p>
                </div>
            </a>
        </div>

        <!-- Manage Users Card -->
        <div class="col-lg-4 col-md-6">
            <a href="./ManageUsersPage.php" class="card-link">
                <div class="card dashboard-card p-4 text-center shadow-sm">
                    <i class="bi bi-people dashboard-icon"></i>
                    <h4 class="card-title">Manage Users</h4>
                    <p class="card-text">View, modify, or delete user accounts</p>
                </div>
            </a>
        </div>

        <!-- User Messages Card -->
        <div class="col-lg-4 col-md-6">
            <a href="./UserMessages.php" class="card-link">
                <div class="card dashboard-card p-4 text-center shadow-sm">
                    <i class="bi bi-chat-dots dashboard-icon"></i>
                    <h4 class="card-title">User Messages</h4>
                    <p class="card-text">Manage user inquiries and conversations</p>
                </div>
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>