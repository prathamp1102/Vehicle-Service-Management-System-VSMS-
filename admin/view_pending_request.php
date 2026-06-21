<?php
include("admin_header.php");
include("../config/database.php");

// Check if service ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $service_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch service details
    $query = "SELECT * FROM services WHERE service_id = '$service_id'";
    $result = mysqli_query($conn, $query);
    $service = mysqli_fetch_assoc($result);

    if (!$service) {
        echo "<script>alert('Invalid Service ID!'); window.location.href='../approved_service_requests.php';</script>";
        exit();
    }

    // Fetch mechanics data
    $mechanics_query = "SELECT mechanic_id, name FROM mechanics";
    $mechanics_result = mysqli_query($conn, $mechanics_query);
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
    <title>Service Request Details | VSMS Admin</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .container {
    margin-left: 250px; /* Adjust this value based on your header width */
    padding: 20px;
}

@media (max-width: 768px) {
    .container {
        margin-left: 0;
        padding: 10px;
    }
}
</style>
    <script>
        function calculateCharges() {
            let serviceCharge = parseFloat(document.getElementById('service_charge').value) || 0;
            let partsCharge = parseFloat(document.getElementById('parts_charge').value) || 0;
            let totalCharge = serviceCharge + partsCharge;
            let gst = totalCharge * 0.18; // Assuming GST is 18%
            let finalAmount = totalCharge + gst;

            document.getElementById('total_charge').value = totalCharge.toFixed(2);
            document.getElementById('gst').value = gst.toFixed(2);
            document.getElementById('final_amount').value = finalAmount.toFixed(2);
        }
    </script>
</head>
<body>

<div class="container">
    <div class="card mt-5">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Service Request Details</h2>
            <form action="../user/update_service.php" method="POST">
                <table class="table table-bordered">
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
                    <tr><th>Admin Remark</th><td><textarea class="form-control" name="admin_remark" required></textarea></td></tr>
                    
                    <!-- Dynamically fetched service providers from mechanics table -->
                    <tr><th>Service By</th>
                        <td>
                            <select class="form-control" name="service_by" required>
                                <option value="">Select Service Provider</option>
                                <?php while ($mechanic = mysqli_fetch_assoc($mechanics_result)): ?>
                                    <option value="<?php echo $mechanic['mechanic_id']; ?>">
                                        <?php echo $mechanic['name']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </td>
                    </tr>

                    <tr><th>Service Charge</th><td><input type="number" class="form-control" name="service_charge" id="service_charge" oninput="calculateCharges()" required></td></tr>
                    <tr><th>Parts Charge</th><td><input type="number" class="form-control" name="parts_charge" id="parts_charge" oninput="calculateCharges()" required></td></tr>
                    <tr><th>Total Charge</th><td><input type="text" class="form-control" id="total_charge" readonly></td></tr>
                    <tr><th>GST (18%)</th><td><input type="text" class="form-control" id="gst" readonly></td></tr>
                    <tr><th>Final Amount</th><td><input type="text" class="form-control" id="final_amount" readonly></td></tr>
                    
                    <tr><th>Admin Status</th>
                        <td>
                            <select class="form-control" name="admin_status" required>
                                <option value="Pending">Pending</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </td>
                    </tr>
                </table>

                <div class="text-center mt-3">
                    <input type="hidden" name="service_id" value="<?php echo $service['service_id']; ?>">
                    <button type="submit" class="btn btn-primary">Update Service</button>
                    <a href="pending_service.php" class="btn btn-secondary">Back to List</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
