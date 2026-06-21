<?php
session_start();
include("../includes/header.php");
include("../config/database.php"); // Include database connection

// Ensure user is logged in and session contains user_id
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    die("<script>alert('Error: User not logged in. Please login first.'); window.location.href='../login.php';</script>");
}

if (isset($_POST['submit'])) {
    $enquiry = mysqli_real_escape_string($conn, $_POST['enquiry']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $status = "Pending"; // Default status

    // Insert query
    $sql = "INSERT INTO enquiry (user_id, enquiry, description, status) 
            VALUES ('$user_id', '$enquiry', '$description', '$status')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Enquiry submitted successfully!'); window.location.href='enquiry.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquiry Form</title>
    <link rel="stylesheet" href="../style.css">
    <style>
/* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

/* Layout */
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f4f4f4;
    padding: 20px;
}

/* Main Content */
.content {
    width: 100%;
    max-width: 1100px; /* Limits max width */
    background-color: white;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    border-radius: 10px;
    padding: 40px;
}

/* Enquiry Form Styling */
.enquiry-form {
    background-color: #d40000;
    padding: 40px;
    border-radius: 10px;
    color: white;
    max-width: 800px; /* Sets a fixed max width */
    width: 100%;
    margin: auto;
}

/* Title */
.enquiry-form h2 {
    font-size: 28px;
    margin-bottom: 20px;
    font-weight: bold;
}

/* Form Grid */
.form-grid {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* Inputs and Select */
.form-grid select,
.form-grid textarea {
    width: 100%;
    padding: 14px;
    border-radius: 5px;
    border: none;
    font-size: 16px;
    background: white;
    color: black;
}

/* Input Focus */
.form-grid select:focus,
.form-grid textarea:focus {
    outline: 3px solid navy;
}

/* Textarea */
textarea {
    height: 120px;
    resize: none;
}

/* Submit Button */
button {
    width: 100%;
    background-color: navy;
    color: white;
    border: none;
    padding: 15px;
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
    border-radius: 5px;
    transition: background 0.3s ease-in-out;
}

button:hover {
    background-color: #002766;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .content {
        width: 95%;
        padding: 20px;
    }

    .enquiry-form {
        width: 100%;
        padding: 30px;
    }

    button {
        width: 100%;
    }
}


</style>
</head>
<body>

<div class="container">
    <div class="content">
        <div class="enquiry-form">
            <h2>ENQUIRY FORM</h2>
            <form action="../" method="POST">
                <div class="form-grid">
                    <select id="enquiry" name="enquiry" required>
                        <option value="">Select Enquiry Type</option>
                        <option value="service">Service Related Enquiry</option>
                        <option value="price">Price Related Enquiry</option>
                        <option value="parts">Parts Related Enquiry</option>
                        <option value="other">Other Enquiry</option>
                    </select>

                    <textarea id="description" name="description" placeholder="Enter your enquiry details..." required></textarea>
                </div>

                <button type="submit" name="submit">SUBMIT REQUEST</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
