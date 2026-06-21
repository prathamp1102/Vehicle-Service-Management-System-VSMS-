<?php
include("admin_header.php");
include("../config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["mechanic_name"];
    $contact = $_POST["mechanic_contact"];
    $email = $_POST["mechanic_email"];
    $address = $_POST["mechanic_address"];

    // Ensure file upload
    if (isset($_FILES["mechanic_image"]) && $_FILES["mechanic_image"]["error"] == 0) {
        
        $target_dir = __DIR__ . "/uploads/"; // Use absolute path
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // Create directory if not exists
        }

        $image_name = time() . "_" . basename($_FILES["mechanic_image"]["name"]);
        $target_file = $target_dir . $image_name;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image
        $check = getimagesize($_FILES["mechanic_image"]["tmp_name"]);
        if ($check === false) {
            echo "<script>alert('File is not an image.');</script>";
            $uploadOk = 0;
        }

        // Allow only specific file formats
        if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            echo "<script>alert('Only JPG, JPEG, PNG & GIF files are allowed.');</script>";
            $uploadOk = 0;
        }

        // Move uploaded file if valid
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["mechanic_image"]["tmp_name"], $target_file)) {
                // Save relative path in the database
                $relative_path = "uploads/" . $image_name;

                // Use prepared statements to prevent SQL injection
                $stmt = $conn->prepare("INSERT INTO mechanics (name, contact, email, address, image) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $name, $contact, $email, $address, $relative_path);

                if ($stmt->execute()) {
                    echo "<script>alert('Mechanic added successfully!');</script>";
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "<script>alert('Error uploading image.');</script>";
            }
        }
    } else {
        echo "<script>alert('Please upload an image.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Mechanic | VSMS Admin</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
}

.content {
    margin-left: 260px;
    padding: 20px;
    width: calc(100% - 260px);
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #ffffff;
    padding: 15px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

.profile {
    display: flex;
    align-items: center;
    gap: 10px;
}

.profile img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
}

.dashboard {
    margin-top: 20px;
    padding-left: 30%;
}

.dashboard h3 {
    margin-bottom: 15px;
    padding-left: 15%;
}

.mechanic-form {
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
        <h2>Add Mechanic</h2>
    </header>

    <section class="dashboard">
        <h3>Enter Mechanic Details</h3>
        <form method="POST" action="../" enctype="multipart/form-data" class="mechanic-form">
            <div class="mb-3">
                <label class="form-label">Mechanic Name</label>
                <input type="text" class="form-control" name="mechanic_name" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mechanic Contact Number</label>
                <input type="text" class="form-control" name="mechanic_contact" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mechanic Email</label>
                <input type="email" class="form-control" name="mechanic_email" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mechanic Address</label>
                <input type="text" class="form-control" name="mechanic_address" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Upload Mechanic Image</label>
                <input type="file" class="form-control" name="mechanic_image" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Mechanic</button>
        </form>
    </section>
</div>

</body>
</html>
