<?php
session_start();
include("../includes/header.php");
include("../config/database.php"); // Ensure you have a working database connection

// Ensure user is logged in and session contains user_id
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    die("Error: User not logged in.");
}

// Corrected SQL query
$query = "SELECT * FROM enquiry WHERE user_id='$user_id'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Database Query Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquiry List</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        /* Table Styling */
        .table-container {
            width: 90%;
            margin: auto;
            margin-top: 30px;
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #d40000;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>

<div class="table-container">
    <h2>ENQUIRY HISTORY</h2>
    <table>
        <thead>
            <tr>
                <th>Enquiry ID</th>
                <th>User ID</th>
                <th>Enquiry Type</th>
                <th>Description</th>
                <th>Enquiry Date</th>
                <th>Admin Response</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['enquiry_id']}</td>
                        <td>{$row['user_id']}</td>
                        <td>{$row['enquiry']}</td>
                        <td>{$row['description']}</td>
                        <td>{$row['enquiry_date']}</td>
                        <td>" . (isset($row['response']) ? $row['response'] : 'No response yet') . "</td>
                        <td>{$row['status']}</td>
                    </tr>";
                }
                
            } else {
                echo "<tr><td colspan='7'>No enquiries found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
