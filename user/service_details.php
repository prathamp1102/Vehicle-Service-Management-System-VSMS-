<?php
session_start();
include("../config/database.php");

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Check if service ID is provided in the URL
if (!isset($_GET['id'])) {
    die("Service ID is required.");
}

$service_id = $_GET['id'];
$query = "SELECT * FROM services WHERE service_id = '$service_id'";
$result = mysqli_query($conn, $query);
$service = mysqli_fetch_assoc($result);

if (!$service) {
    die("Service not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Details</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        body {
            background-color: #f4f4f4;
            padding: 20px;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 800px;
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
        }

        td, th {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            color: black;
        }

        .back-btn, .print-btn {
            display: block;
            width: 150px;
            margin: 20px auto;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            transition: 0.3s;
        }

        .back-btn {
            background-color: #007bff;
        }

        .back-btn:hover {
            background-color: #0056b3;
        }

        .print-btn {
            background-color: #28a745;
        }

        .print-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Service Details</h2>
    
    <table>
        <tr><th>Service ID</th><td><?php echo $service['service_id']; ?></td></tr>
        <tr><th>User ID</th><td><?php echo $service['user_id']; ?></td></tr>
        <tr><th>Category</th><td><?php echo $service['category']; ?></td></tr>
        <tr><th>Vehicle Name</th><td><?php echo $service['vehicle_name']; ?></td></tr>
        <tr><th>Vehicle Model</th><td><?php echo $service['vehicle_model']; ?></td></tr>
        <tr><th>Vehicle Brand</th><td><?php echo $service['vehicle_brand']; ?></td></tr>
        <tr><th>Vehicle RC</th><td><?php echo $service['vehicle_rc']; ?></td></tr>
        <tr><th>Service Date</th><td><?php echo $service['service_date']; ?></td></tr>
        <tr><th>Service Time</th><td><?php echo $service['service_time']; ?></td></tr>
        <tr><th>Delivery Type</th><td><?php echo $service['delivery_type']; ?></td></tr>
        <tr><th>Pickup Address</th><td><?php echo $service['pickup_address']; ?></td></tr>
        <tr><th>Status</th><td><?php echo $service['status']; ?></td></tr>
        <tr><th>Admin Remarks</th><td><?php echo $service['admin_remark']; ?></td></tr>
        <tr><th>Service By</th><td><?php echo $service['service_by']; ?></td></tr>
        <tr><th>Service Charge</th><td><?php echo $service['service_charge']; ?></td></tr>
        <tr><th>Parts Charge</th><td><?php echo $service['parts_charge']; ?></td></tr>
        <tr><th>Total Charge</th><td><?php echo $service['total_charge']; ?></td></tr>
        <tr><th>GST</th><td><?php echo $service['gst']; ?></td></tr>
        <tr><th>Final Amount</th><td><?php echo $service['final_amount']; ?></td></tr>
        <tr><th>Admin Status</th><td><?php echo $service['admin_status']; ?></td></tr>
    </table>
    
    <a href="../admin/service_history.php" class="back-btn">Back to History</a>
    <button onclick="window.print()" class="print-btn">Print</button>
</div>

</body>
</html>
