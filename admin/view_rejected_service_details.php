<?php
include("admin_header.php");
include("../config/database.php");

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if service_id is provided in POST request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['service_id']) && !empty($_POST['service_id'])) {
    $service_id = mysqli_real_escape_string($conn, $_POST['service_id']);

    // Fetch service details
    $query = "SELECT * FROM services WHERE service_id = '$service_id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $service = mysqli_fetch_assoc($result);

    if (!$service) {
        echo "<script>alert('Invalid Service ID!'); window.location.href='reject_service_request.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('No service ID provided! Please try again.'); window.location.href='reject_service_request.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Request Details | VSMS Admin</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
    /* Ensure the main container aligns properly */
.container {
    margin-left: 280px; /* Adjust this based on sidebar width */
    padding: 20px;
}

/* Card styling to match rejected requests table */
.card {
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

/* Table styling */
.table {
    width: 100%;
    border-collapse: collapse;
}

.table th {
    font-weight: normal;
    padding: 10px;
}

.table td {
    padding: 10px;
    border-bottom: 1px solid #dee2e6;
}

/* Status badge styling */
.badge-rejected {
    background-color: #dc3545;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
}

/* Ensure responsiveness */
@media (max-width: 768px) {
    .container {
        margin-left: 0;
        padding: 10px;
    }
}

</style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2>Rejected Service Request Details</h2>
        <table class="table">
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
            <tr><th>Status</th><td><span class="badge-rejected">Rejected</span></td></tr>
        </table>
    </div>
</div>


</body>
</html>
