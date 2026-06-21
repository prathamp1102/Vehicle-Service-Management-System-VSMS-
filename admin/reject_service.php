<?php
include("../config/database.php");

if (isset($_GET['id'])) {
    $service_id = $_GET['id'];

    // Update query to set the status as 'Rejected'
    $query = "UPDATE services SET status = 'Rejected' WHERE service_id = '$service_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Redirect back to manage service requests page
        header("Location: reject_service_request.php?msg=Rejected successfully");
        exit();
    } else {
        header("Location: ../user/new_service_request.php?msg=Error rejecting request");
        exit();
    }
}
?>
