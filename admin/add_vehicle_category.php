<?php
include("admin_header.php");
include("../config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = trim($_POST["category_name"]);

    // Validate input
    if (!empty($category_name)) {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO vehicle_categories (category_name) VALUES (?)");
        $stmt->bind_param("s", $category_name);

        if ($stmt->execute()) {
            echo "<script>alert('Vehicle category added successfully!'); window.location.href='manage_vehicle_category.php';</script>";
        } else {
            echo "<script>alert('Error adding category.');</script>";
        }
        
        $stmt->close();
    } else {
        echo "<script>alert('Please enter a category name.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle Category | VSMS Admin</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
            width: calc(100% - 260px);
        }

        header {
            background: #ffffff;
            padding: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .dashboard {
            margin-top: 20px;
            padding-left: 30%;
        }

        .dashboard h3 {
            margin-bottom: 15px;
            padding-left: 15%;
        }

        .category-form {
            max-width: 500px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="content">
    <header>
        <h2>Add Vehicle Category</h2>
    </header>

    <section class="dashboard">
        <h3>Enter Category Details</h3>
        <form method="POST" action="../" class="category-form">
            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input type="text" class="form-control" name="category_name" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
    </section>
</div>

</body>
</html>
