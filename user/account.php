<?php
session_start();
include("../config/database.php");

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in first!'); window.location='../login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$sql = "SELECT * FROM user_mast WHERE user_id = '$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if (!$user) {
    echo "<script>alert('User not found!'); window.location='../logout.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - User Management</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { max-width: 600px; margin: auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        .btn-primary { background: #ff6600; border: none; }
        .btn-primary:hover { background: #e65c00; }
    </style>
</head>
<body>
    <?php include("../includes/header.php"); ?>

    <div class="container">
        <h2 class="text-center">Your Profile</h2>
        <form action="update_profile.php" method="POST">
            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="fullname" class="form-control" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="form-group">
                <label>Phone Number:</label>
                <input type="text" name="phno" class="form-control" value="<?php echo htmlspecialchars($user['phno']); ?>">
            </div>
            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
            <button type="submit" class="btn btn-primary w-100">Update Profile</button>
        </form>

        <!-- Change Password Button -->
        <a href="create_password.php" class="btn btn-warning w-100 mt-2">Change Password</a>

        <!-- Logout Button -->
        <a href="../logout.php" class="btn btn-danger w-100 mt-2">Logout</a>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>
</html>
