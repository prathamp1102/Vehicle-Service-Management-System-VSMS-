<?php
include("../config/database.php");

if (isset($_GET['id'])) {
    $service_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Check if the service request exists
    $check_query = "SELECT * FROM services WHERE service_id = '$service_id'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Update the status to "Approved"
        $query = "UPDATE services SET status = 'Approved' WHERE service_id = '$service_id'";
        
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Service request approved successfully!'); window.location.href='pending_service.php';</script>";
        } else {
            echo "<script>alert('Error approving request: " . mysqli_error($conn) . "'); window.location.href='../user/new_service_request.php';</script>";
        }
    } else {
        echo "<script>alert('Service request not found!'); window.location.href='../user/new_service_request.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href='../user/new_service_request.php';</script>";
}
?>
