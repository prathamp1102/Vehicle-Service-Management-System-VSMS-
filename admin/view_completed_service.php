<?php
include("admin_header.php");
include("../config/database.php");

// Check if service ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $service_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch completed service details
    $query = "SELECT * FROM services WHERE service_id = '$service_id' AND admin_status = 'Completed'";
    $result = mysqli_query($conn, $query);
    $service = mysqli_fetch_assoc($result);

    if (!$service) {
        echo "<script>alert('Invalid or Incomplete Service ID!'); window.location.href='../approved_service_requests.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('No service ID provided!'); window.location.href='../approved_service_requests.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed Service Details | VSMS Admin</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* General Page Styling */
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }

        /* Centered Card */
        .content-container {
            margin: auto;
            max-width: 800px;
            padding: 20px;
        }

        .card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-left: 5px solid #28a745;
        }

        /* Table Styling */
        .table {
            width: 100%;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead {
            background: #343a40;
            color: white;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
            transition: 0.3s;
        }

        /* Badges for Status */
        .status-badge {
            padding: 5px 10px;
            font-size: 14px;
            border-radius: 5px;
        }

        /* Button Styling */
        .btn-secondary {
            background-color: #6c757d;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            transition: 0.3s;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .content-container {
                max-width: 100%;
                padding: 10px;
            }

            .card {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="content-container">
        <div class="card">
            <h2 class="card-title text-center mb-4 text-success">Completed Service Details</h2>
            <table class="table table-bordered">
                <tr><th>Service ID</th><td><?php echo htmlspecialchars($service['service_id']); ?></td></tr>
                <tr><th>User ID</th><td><?php echo htmlspecialchars($service['user_id']); ?></td></tr>
                <tr><th>Vehicle Name</th><td><?php echo htmlspecialchars($service['vehicle_name']); ?></td></tr>
                <tr><th>Vehicle Model</th><td><?php echo htmlspecialchars($service['vehicle_model']); ?></td></tr>
                <tr><th>Vehicle Brand</th><td><?php echo htmlspecialchars($service['vehicle_brand']); ?></td></tr>
                <tr><th>Service Date</th><td><?php echo htmlspecialchars($service['service_date']); ?></td></tr>
                <tr><th>Service Charge</th><td><strong>₹<?php echo number_format($service['service_charge'], 2); ?></strong></td></tr>
                <tr><th>Parts Charge</th><td><strong>₹<?php echo number_format($service['parts_charge'], 2); ?></strong></td></tr>
                <tr><th>Total Charge</th><td><strong>₹<?php echo number_format($service['total_charge'], 2); ?></strong></td></tr>
                <tr><th>GST (18%)</th><td><strong>₹<?php echo number_format($service['gst'], 2); ?></strong></td></tr>
                <tr><th>Final Amount</th><td style="color: #28a745;"><strong>₹<?php echo number_format($service['final_amount'], 2); ?></strong></td></tr>
                <tr><th>Admin Remark</th><td><?php echo htmlspecialchars($service['admin_remark']); ?></td></tr>
                <tr><th>Service By</th><td><?php echo htmlspecialchars($service['service_by']); ?></td></tr>
                <tr>
                    <th>Status</th>
                    <td><span class="status-badge bg-success text-white"><?php echo htmlspecialchars($service['admin_status']); ?></span></td>
                </tr>
            </table>
            <div class="text-center mt-3">
                <a href="completed_service.php" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
