<?php
session_start();
include('../config/database.php'); // Database connection

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: otp.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_password'])) {
    $new_password = trim($_POST['new_password']);
    $confirm_new_password = trim($_POST['confirm_new_password']);
    $email = $_SESSION['email']; // Get user email from session

    // Check if new password and confirm password match
    if ($new_password !== $confirm_new_password) {
        echo "<script>alert('New Password and Confirm Password do not match!');</script>";
    } elseif (strlen($new_password) < 4) {
        echo "<script>alert('Password must be at least 4 characters long!');</script>";
    } else {
        // Fetch the current hashed password from the database
        $query = "SELECT pass FROM user_mast WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update password in the database
            $update_query = "UPDATE user_mast SET pass = '$new_hashed_password' WHERE email = '$email'";
            if (mysqli_query($conn, $update_query)) {
                echo "<script>alert('Password changed successfully!'); window.location='../login.php';</script>";
                exit();
            } else {
                echo "<script>alert('Error updating password. Please try again!');</script>";
            }
        } else {
            echo "<script>alert('User not found!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="../stylereg.css">
    <style>
        body {
            background: url('img/login_bg5.png') no-repeat center center/cover;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .form_regi {
            display: flex;
            flex-direction: column;
            height: auto;
            width: 450px;
            align-items: center;
            margin: auto;
            margin-top: 5%;
            background-color: rgba(255, 253, 253, 0.77);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.25);
            border-radius: 15px;
            padding: 30px 20px;
        }
        .form_regi h1 {
            color: #ff3b3f;
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .box {
            padding: 12px;
            margin: 10px 0;
            width: 90%;
            border: 1px solid #ddd;
            border-radius: 25px;
            background-color: #f9f9f9;
            color: #333;
            font-size: 1rem;
            box-shadow: inset 0px 1px 3px rgba(0, 0, 0, 0.1);
            transition: border 0.3s, box-shadow 0.3s;
        }
        .box:focus {
            outline: none;
            border-color: #ff3b3f;
            box-shadow: 0px 0px 5px rgba(255, 59, 63, 0.5);
        }
        #submit {
            padding: 12px 20px;
            margin-top: 20px;
            width: 90%;
            background-color: #ff3b3f;
            color: #fff;
            border: none;
            outline: none;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s;
        }
        #submit:hover {
            background-color: #e22c2f;
            transform: translateY(-3px);
        }
        .d {
            margin-top: 10px;
            text-align: center;
        }
        .a {
            text-decoration: none;
            color: #ff3b3f;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        .a:hover {
            color: #e22c2f;
        }
    </style>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form_regi" method="POST">
        <h1>CHANGE PASSWORD</h1>
        <input type="password" name="new_password" class="box" placeholder="New Password" required>
        <input type="password" name="confirm_new_password" class="box" placeholder="Confirm New Password" required>
        
        <input type="submit" value="Change Password" id="submit" name="change_password"><br>
        <div class="d">
            <a href="../login.php" class="a">Back to Sign in</a>
        </div>
    </form>
</body>
</html>
