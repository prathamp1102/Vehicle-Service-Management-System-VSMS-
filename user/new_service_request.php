<?php
include("../admin/admin_header.php");
include("../config/database.php");

// Fetch service requests
$query = "SELECT * FROM services WHERE status NOT IN ('Rejected', 'Approved')";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Service Requests | VSMS Admin</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="content">
    <header>
        <h2>Service Requests</h2>
    </header>

    <section class="dashboard">
        <h3>New Requests</h3>
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['service_id']; ?></td>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo $row['vehicle_name']; ?></td>
                        <td><?php echo $row['vehicle_model']; ?></td>
                        <td><?php echo $row['vehicle_brand']; ?></td>
                        <td><?php echo $row['vehicle_rc']; ?></td>
                        <td><?php echo $row['service_date']; ?></td>
                        <td><?php echo $row['service_time']; ?></td>
                        <td><?php echo $row['delivery_type']; ?></td>
                        <td><?php echo $row['pickup_address']; ?></td>
                        <td>
                            <a href="../admin/approve_service_request.php?id=<?php echo $row['service_id']; ?>" class="btn btn-success btn-sm">Approve</a>
                            <a href="../admin/reject_service.php?id=<?php echo $row['service_id']; ?>" class="btn btn-dark btn-sm" onclick="return confirm('Are you sure you want to reject this request?');">Reject</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</div>

</body>
</html>
