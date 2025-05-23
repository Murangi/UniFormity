<?php
  session_start();
  require_once '../Authentication_Pages/config.php';

  //if the user submits their listings
  if(isset($_POST['submit'])) {

      $title = $_POST['title'];
      $description = $_POST['description'];
      $category = $_POST['category'];
      $price = $_POST['price'];
      $ItemCondition = $_POST['ItemCondition'];
      $school = $_POST['school'];
      $user_id = $_SESSION['user_id'];
      $DateLising = date('Y-m-d H:i:s');

      // Handle file upload
      $image_path = "";
      if ($_FILES['image']['error'] == 0) {
          $target_dir = "/uploads/";
          $filename = uniqid() . '_' . basename($_FILES["image"]["name"]);
          $image_path = $target_dir . $filename;
          $full_path = $_SERVER['DOCUMENT_ROOT'] . $image_path;
          if (!is_dir($_SERVER['DOCUMENT_ROOT'] . $target_dir)) {
              mkdir($_SERVER['DOCUMENT_ROOT'] . $target_dir, 0777, true);
          }
          move_uploaded_file($_FILES["image"]["tmp_name"], $full_path);
      }

      // Insert listing  Product_id	title	 description	category	price	 ItemCondition	school	image_path	user_id	 created_at
      // $sql = "INSERT INTO listings (title, description, category, price, ItemCondition, school, image_path, user_id, created_at)
      //         VALUES ($title, $description, $category, $price, $ItemCondition, $school, $image_path, $user_id, $DateLising)";

      // Use prepared statement
      $stmt = $conn->prepare("INSERT INTO listings (title, description, category, price, ItemCondition, school, image_path, user_id, created_at)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("sssdsssis", $title, $description, $category, $price, $ItemCondition, $school, $image_path, $user_id, $DateLising);

      if ($stmt->execute()) {
            //echo "<script>alert('Upload successful!');</script>";
            header("Location: ./MyListingsPage.php");
            exit;
      } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
      }

      $stmt->close();
    }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add Listing | UniFormity</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    .half-page {
      display: flex;
      min-height: 100vh;
      overflow: hidden;
      flex-direction: row;
    }

    .listing-image {
      flex: 1;
      background-image: url('../Images/Classroom.jpg'); /* Adjust path as needed */
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .listing-form-container {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 3rem 2rem;
      overflow-y: auto;
    }

    .listing-form {
      width: 100%;
      max-width: 500px;
      background-color: white;
      padding: 2rem;
      border-radius: 0.5rem;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-title {
      font-weight: bold;
      margin-bottom: 1.5rem;
      text-align: center;
    }

    .btn-custom {
      width: 100%;
    }

    @media (max-width: 768px) {
      .half-page {
        flex-direction: column;
      }
      .listing-image {
        height: 200px;
      }
      .listing-form-container {
        align-items: center;
      }
    }
  </style>
</head>
<body>

<div class="half-page">
  <!-- Left: Background Image Only -->
  <div class="listing-image"></div>

  <!-- Right: Add Listing Form -->
  <div class="listing-form-container">
    <form class="listing-form" method="POST" action="AddNewListingPage.php" enctype="multipart/form-data">
      <h2 class="form-title">Add Your Listing</h2>

      <!-- Title -->
      <div class="mb-3">
        <label for="title" class="form-label">Title of the Item</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="e.g. Navy Blue Blazer" required />
      </div>

      <!-- Description -->
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Provide a brief description of the item" required></textarea>
      </div>

      <!-- Category -->
      <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-select" id="category" name="category" required>
          <option value="" disabled selected>Select Category</option>
          <option value="Textbook">Textbook</option>
          <option value="Study_Guide">Study Guide</option>
          <option value="Stationary">Stationary</option>
          <option value="Uniform">Uniform</option>
          <option value="Shoes">Shoes</option>
          <option value="Other">Other</option>
        </select>
      </div>

      <!-- Price -->
      <div class="mb-3">
        <label for="price" class="form-label">Price (ZAR)</label>
        <input type="number" class="form-control" id="price" name="price" placeholder="e.g. 100" required />
      </div>

      <!-- Condition -->
      <div class="mb-3">
        <label for="ItemCondition" class="form-label">Condition</label>
        <select class="form-select" id="ItemCondition" name="ItemCondition" required>
          <option value="" disabled selected>Select Condition</option>
          <option value="New">New</option>
          <option value="Like New">Like New</option>
          <option value="Used">Used</option>
        </select>
      </div>

      <!-- School -->
      <div class="mb-3">
        <label for="school" class="form-label">School Name</label>
        <input type="text" class="form-control" id="school" name="school" placeholder="e.g. Louis Trichardt High School" required />
      </div>

      <!-- Image Upload -->
      <div class="mb-3">
        <label for="image" class="form-label">Upload Image</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*" required />
      </div>

      <!-- Hidden User ID -->
      <!-- <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" /> -->
 
      <!-- Submit -->
      <button type="submit" name="submit" class="btn btn-primary btn-custom" >Add Listing</button>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
