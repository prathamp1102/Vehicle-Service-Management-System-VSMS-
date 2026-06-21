<?php
session_start();
include("../config/database.php");

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Unauthorized access!'); window.location='../login.php';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $email = $conn->real_escape_string($_POST['email']);
    $phno = $conn->real_escape_string($_POST['phno']);

    $sql = "UPDATE user_mast SET fullname='$fullname', email='$email', phno='$phno' WHERE user_id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Profile updated successfully!'); window.location='account.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
