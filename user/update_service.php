<?php
include("../config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = mysqli_real_escape_string($conn, $_POST['service_id']);
    $admin_remark = mysqli_real_escape_string($conn, $_POST['admin_remark']);
    $service_by = mysqli_real_escape_string($conn, $_POST['service_by']);
    $service_charge = floatval($_POST['service_charge']);
    $parts_charge = floatval($_POST['parts_charge']);
    $total_charge = $service_charge + $parts_charge;
    $gst = $total_charge * 0.18; // 18% GST
    $final_amount = $total_charge + $gst;
    $admin_status = mysqli_real_escape_string($conn, $_POST['admin_status']);

    // Check if service exists
    $check_query = "SELECT * FROM services WHERE service_id = '$service_id'";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) == 0) {
        echo "<script>alert('Invalid Service ID!'); window.location.href='../admin/pending_service.php';</script>";
        exit();
    }

    // Update the service record
    $update_query = "UPDATE services SET 
        admin_remark = '$admin_remark',
        service_by = '$service_by',
        service_charge = '$service_charge',
        parts_charge = '$parts_charge',
        total_charge = '$total_charge',
        gst = '$gst',
        final_amount = '$final_amount',
        admin_status = '$admin_status'
        WHERE service_id = '$service_id'";

    if (mysqli_query($conn, $update_query)) {
        // Redirect based on status
        if ($admin_status === "Completed") {
            echo "<script>alert('Service marked as completed!'); window.location.href='../admin/completed_service.php';</script>";
        } else {
            echo "<script>alert('Service updated successfully!'); window.location.href='../admin/pending_service.php';</script>";
        }
    } else {
        echo "<script>alert('Error updating service: " . mysqli_error($conn) . "'); window.location.href='../admin/pending_service.php';</script>";
    }
}
?>
