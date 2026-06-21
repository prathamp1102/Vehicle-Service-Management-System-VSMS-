<?php
include("admin_header.php");
include("../config/database.php");

$search_query = "";
if (isset($_POST['search'])) {
    $search_query = trim($_POST['search_query']);
    $query = "SELECT * FROM services WHERE user_id LIKE '%$search_query%' OR category LIKE '%$search_query%' OR vehicle_name LIKE '%$search_query%' OR vehicle_model LIKE '%$search_query%' OR vehicle_brand LIKE '%$search_query%' ORDER BY service_id DESC";
} else {
    $query = "SELECT * FROM services ORDER BY service_id DESC";
}
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Services | VSMS Admin</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="content">
    <header>
        <h2>Search Service Requests</h2>
    </header>

    <section class="dashboard">
        <h3>Search Services</h3>
        <form method="POST" action="../" class="mb-3">
            <input type="text" name="search_query" class="form-control" placeholder="Enter keyword..." value="<?php echo htmlspecialchars($search_query); ?>">
            <button type="submit" name="search" class="btn btn-primary mt-2">Search</button>
        </form>

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
                    <th>Status</th>
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
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</div>

</body>
</html>
