<?php
include("admin_header.php");
include("../config/database.php");

// Debugging: Ensure database connection is working
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch only approved service requests that are NOT completed
$query = "SELECT * FROM services WHERE status = 'Approved' AND (admin_status IS NULL OR admin_status != 'Completed')";
$result = mysqli_query($conn, $query);

// Debugging: Check if query executed correctly
if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}

// Debugging: Check if any data is fetched
if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('No pending approved services found!');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Service Requests | VSMS Admin</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .content {
            margin-left: 250px; /* Adjust for left-side header spacing */
            padding: 20px;
        }
        .dashboard {
            width: 95%; /* Increase width */
            margin: auto;
        }
    </style>
</head>
<body>

<div class="content">
    <header>
        <h2>Servicing</h2>
    </header>

    <section class="dashboard">
        <h3>Pending Services</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Service ID</th>
                    <th>User ID</th>
                    <th>Category</th>
                    <th>Vehicle Name</th>
                    <th>Vehicle Model</th>
                    <th>Vehicle Brand</th>
                    <th>Vehicle RC</th>
                    <th>Service Date</th>
                    <th>Service Time</th>
                    <th>Delivery Type</th>
                    <th>Pickup Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['service_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['category']); ?></td>
                        <td><?php echo htmlspecialchars($row['vehicle_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['vehicle_model']); ?></td>
                        <td><?php echo htmlspecialchars($row['vehicle_brand']); ?></td>
                        <td><?php echo htmlspecialchars($row['vehicle_rc']); ?></td>
                        <td><?php echo htmlspecialchars($row['service_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['service_time']); ?></td>
                        <td><?php echo htmlspecialchars($row['delivery_type']); ?></td>
                        <td><?php echo htmlspecialchars($row['pickup_address']); ?></td>
                        <td>
                            <a href="view_pending_request.php?id=<?php echo urlencode($row['service_id']); ?>" class="btn btn-info btn-sm">View Details</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</div>

</body>
</html>
