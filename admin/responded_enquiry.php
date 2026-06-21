<?php
include("admin_header.php");
include("../config/database.php");

// Ensure delete_id is set before using it
if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    $delete_id = mysqli_real_escape_string($conn, $_GET['delete_id']);

    // Check if the enquiry ID exists before deleting
    $check_query = mysqli_query($conn, "SELECT * FROM enquiry WHERE enquiry_id='$delete_id'");
    if (mysqli_num_rows($check_query) > 0) {
        $delete_query = "DELETE FROM enquiry WHERE enquiry_id='$delete_id'";
        if (mysqli_query($conn, $delete_query)) {
            echo "<script>alert('Enquiry deleted successfully!'); window.location.href='responded_enquiry.php';</script>";
        } else {
            echo "<script>alert('Error deleting enquiry.');</script>";
        }
    } else {
        echo "<script>alert('Error: Enquiry ID not found.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responded Enquiries | VSMS</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="content">
    <header>
        <h2>Responded Enquiries</h2>
    </header>

    <section class="dashboard">
        <h3>List of Responded Enquiries</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Enquiry</th>
                    <th>Description</th>
                    <th>Response</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                // Fetch only enquiries that have been responded to
                $result = mysqli_query($conn, "SELECT * FROM enquiry WHERE status='Responded' ORDER BY enquiry_id DESC");

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $enquiry_id = isset($row['enquiry_id']) ? $row['enquiry_id'] : 'N/A';
                        $user_id = isset($row['user_id']) ? $row['user_id'] : 'N/A';
                        $enquiry = isset($row['enquiry']) ? $row['enquiry'] : 'N/A';
                        $description = isset($row['description']) ? $row['description'] : 'N/A';
                        $admin_response = isset($row['response']) ? $row['response'] : 'No response yet';  // FIXED ERROR

                        echo "<tr>
                            <td>{$enquiry_id}</td>
                            <td>{$user_id}</td>
                            <td>{$enquiry}</td>
                            <td>{$description}</td>
                            <td>{$admin_response}</td>
                            <td>
                                <a href='../?delete_id={$enquiry_id}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No responded enquiries available.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
</div>

</body>
</html>
