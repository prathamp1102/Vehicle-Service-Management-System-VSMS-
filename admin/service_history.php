<?php
session_start();
include("../config/database.php");
include("../includes/header.php");

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id']; 
$query = "SELECT * FROM services WHERE user_id = '$user_id' ORDER BY service_date DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service History</title>
    <link rel="stylesheet" href="../styles.css"> <!-- Link external CSS -->
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

body {
    background-color: #f4f4f4;
    padding: 20px;
}

.container {
    max-width: 1000px;
    margin: auto;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

th, td {
    padding: 10px;
    text-align: center;
    border: 1px solid #ddd;
}

th {
    background-color:rgb(240, 14, 14);
    color: white;
}

.view-btn {
    background-color: #007bff;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    text-decoration: none;
}

.print-btn {
    display: block;
    width: 150px;
    margin: 20px auto;
    background-color: #28a745;
    color: white;
    padding: 12px;
    border-radius: 5px;
    text-align: center;
    cursor: pointer;
}
</style>
</head>
<body>

<div class="container">
    <h2>Service History</h2>
    
    <?php if(mysqli_num_rows($result) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Service ID</th>
                <th>Vehicle Name</th>
                <th>Model</th>
                <th>Brand</th>
                <th>Service Date</th>
                <th>Service Time</th>
                <th>Delivery Type</th>
                <th>Status</th>
                <th>Total Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['service_id']; ?></td>
                <td><?php echo $row['vehicle_name']; ?></td>
                <td><?php echo $row['vehicle_model']; ?></td>
                <td><?php echo $row['vehicle_brand']; ?></td>
                <td><?php echo $row['service_date']; ?></td>
                <td><?php echo $row['service_time']; ?></td>
                <td><?php echo $row['delivery_type']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['final_amount']; ?></td>
                <td>
                    <a href="../user/service_details.php?id=<?php echo $row['service_id']; ?>" class="view-btn">View</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>No service history found.</p>
    <?php endif; ?>
    
    <button onclick="window.print()" class="print-btn">Print</button>
</div>

</body>
</html>
