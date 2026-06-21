<?php
include("admin_header.php");
include("../config/database.php");

// Fetch only completed services
$query = "SELECT * FROM services WHERE admin_status = 'Completed'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed Service Requests | VSMS Admin</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .content-container {
            margin-left: 280px; /* Adjust this based on your sidebar width */
            padding: 20px;
            max-width: 90%; /* Increase form width */
        }
        .table {
            width: 100%; /* Ensure table spans full width */
            margin-top: 20px;
        }
        @media (max-width: 768px) {
            .content-container {
                margin-left: 0; /* Remove margin for smaller screens */
                max-width: 100%;
                padding: 10px;
            }
        }

        header {
            background: #ffffff;
            padding: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="content-container">
    <header>
        <h2>Completed Service Requests</h2>
    </header>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Service ID</th>
                        <th>User ID</th>
                        <th>Vehicle Name</th>
                        <th>Service Date</th>
                        <th>Final Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($service = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $service['service_id']; ?></td>
                            <td><?php echo $service['user_id']; ?></td>
                            <td><?php echo $service['vehicle_name']; ?></td>
                            <td><?php echo $service['service_date']; ?></td>
                            <td><?php echo "₹" . number_format($service['final_amount'], 2); ?></td>
                            <td>
                                <a href="view_completed_service.php?id=<?php echo $service['service_id']; ?>" class="btn btn-info">View</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
