<?php
include("admin_header.php");
include("../config/database.php");

// Fetch total registered users
$user_result = $conn->query("SELECT COUNT(*) AS total_users FROM user_mast");
$registered_users = $user_result->fetch_assoc()['total_users'];

// Fetch total enquiries
$enquiry_result = $conn->query("SELECT COUNT(*) AS total_enquiries FROM enquiry");
$total_enquiries = $enquiry_result->fetch_assoc()['total_enquiries'];

// Fetch total mechanics
$mechanics_result = $conn->query("SELECT COUNT(*) AS total_mechanics FROM mechanics");
$total_mechanics = $mechanics_result->fetch_assoc()['total_mechanics'];

// Fetch service requests breakdown from the 'services' table using admin_status
$service_result = $conn->query("
    SELECT 
        COUNT(*) AS total_service_requests,
        SUM(CASE WHEN COALESCE(status, '') = 'Pending' THEN 1 ELSE 0 END) AS new_service_requests,
        SUM(CASE WHEN COALESCE(status, '') = 'Rejected' THEN 1 ELSE 0 END) AS rejected_service_requests,
        SUM(CASE WHEN COALESCE(status, '') = 'Approved' THEN 1 ELSE 0 END) AS approved_services,
        SUM(CASE WHEN COALESCE(admin_status, '') = 'Completed' THEN 1 ELSE 0 END) AS completed_services
    FROM services
");

$service_data = $service_result->fetch_assoc();

$total_service_requests = $service_data['total_service_requests'];
$new_service_requests = $service_data['new_service_requests'];
$rejected_service_requests = $service_data['rejected_service_requests'];
$approved_services = $service_data['approved_services'];
$completed_services = $service_data['completed_services'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VSMS Admin Dashboard</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #f8f9fa;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
            width: calc(100% - 260px);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #ffffff;
            padding: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .dashboard {
            margin-top: 20px;
        }

        .dashboard h3 {
            margin-bottom: 15px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card p {
            font-size: 14px;
            color: gray;
        }

        .card h4 {
            font-size: 24px;
            color: #3498db;
        }
    </style>
</head>
<body>

<div class="content">
    <header>
        <h2>Admin Dashboard</h2>
    </header>

    <section class="dashboard">
        <h3>Account Overview</h3>
        <div class="dashboard-grid">
            <div class="card">
                <p>Total Registered Users</p>
                <h4><?php echo $registered_users; ?></h4>
            </div>
            <div class="card">
                <p>Total Enquiries</p>
                <h4><?php echo $total_enquiries; ?></h4>
            </div>
            <div class="card">
                <p>Total Mechanics</p>
                <h4><?php echo $total_mechanics; ?></h4>
            </div>
            <div class="card">
                <p>Total Service Requests</p>
                <h4><?php echo $total_service_requests; ?></h4>
            </div>
            <div class="card">
                <p>New Service Requests</p>
                <h4><?php echo $new_service_requests; ?></h4>
            </div>
            <div class="card">
                <p>Rejected Service Requests</p>
                <h4><?php echo $rejected_service_requests; ?></h4>
            </div>
            <div class="card">
                <p>Approved Services</p>
                <h4><?php echo $approved_services; ?></h4>
            </div>
            <div class="card">
                <p>Completed Services</p>
                <h4><?php echo $completed_services; ?></h4>
            </div>
        </div>
    </section>
</div>

</body>
</html>
