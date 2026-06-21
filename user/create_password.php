<?php
session_start();
include("../config/database.php");

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in first!'); window.location='../login.php';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Fetch user details
    $sql = "SELECT pass FROM user_mast WHERE user_id = '$user_id'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    if (!$user || !password_verify($current_password, $user['pass'])) {
        echo "<script>alert('Current password is incorrect!'); window.location='create_password.php';</script>";
        exit;
    }

    if ($new_password !== $confirm_password) {
        echo "<script>alert('New passwords do not match!'); window.location='create_password.php';</script>";
        exit;
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $update_sql = "UPDATE user_mast SET pass='$hashed_password' WHERE user_id='$user_id'";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Password updated successfully!'); window.location='account.php';</script>";
    } else {
        echo "Error updating password: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { max-width: 400px; margin: auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
    </style>
</head>
<body>
    <?php include("../includes/header.php"); ?>

    <div class="container">
        <h2 class="text-center">Change Password</h2>
        <form action="change_password.php" method="POST">
            <div class="form-group">
                <label>Current Password:</label>
                <input type="password" name="current_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>New Password:</label>
                <input type="password" name="new_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Confirm New Password:</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning w-100">Update Password</button>
        </form>
        <a href="account.php" class="btn btn-secondary w-100 mt-2">Back to Profile</a>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>
</html>
