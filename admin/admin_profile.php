<?php
session_start();
include("../config/database.php"); // Include your database connection file

// Check if admin is logged in and get their ID
if (!isset($_SESSION['admin_id'])) {
    die("Error: Admin not logged in!");
}

$admin_id = $_SESSION['admin_id'];

// Fetch admin details from the database
$sql = "SELECT * FROM admin_mast WHERE admin_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $admin = $result->fetch_assoc();
} else {
    die("Admin not found!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        .profile-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .profile-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .profile-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .profile-form label {
            text-align: left;
            font-weight: bold;
            color: #555;
        }

        .profile-form input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .profile-form button {
            padding: 10px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .profile-form button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<div class="profile-container">
    
    <h2>Admin Profile</h2>
    <form class="profile-form" action="../user/update_profile.php" method="POST">
        <input type="hidden" name="admin_id" value="<?php echo $admin['admin_id']; ?>">

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($admin['name']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($admin['email']); ?>" required>

        <button type="submit">Update Profile</button>
    </form>
</div>

</body>
</html>
