<?php
include("../admin/admin_header.php");
include("../config/database.php");

// Handle new enquiry submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = trim($_POST["user_id"]);
    $enquiry = trim($_POST["enquiry"]);
    $description = trim($_POST["description"]);

    if (!empty($user_id) && !empty($enquiry) && !empty($description)) {
        $query = "INSERT INTO enquiry (user_id, enquiry, description, status) VALUES ('$user_id', '$enquiry', '$description', 'pending')";
        
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Enquiry submitted successfully!'); window.location.href='new_enquiry.php';</script>";
        } else {
            echo "<script>alert('Error submitting enquiry.');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all fields.');</script>";
    }
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM enquiry WHERE enquiry_id='$delete_id'";
    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Enquiry deleted successfully!'); window.location.href='new_enquiry.php';</script>";
    } else {
        echo "<script>alert('Error deleting enquiry.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Customer Enquiries | VSMS</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="content">
    <header>
        <h2>Manage Customer Enquiries</h2>
    </header>

    <section class="dashboard">
        <h3>New Enquiry</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Enquiry</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Fetch only pending enquiries
                    $result = mysqli_query($conn, "SELECT * FROM enquiry WHERE status = 'pending' ORDER BY enquiry_id DESC");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$row['enquiry_id']}</td>
                            <td>{$row['user_id']}</td>
                            <td>{$row['enquiry']}</td>
                            <td>{$row['description']}</td>
                            <td>
                                <a href='../admin/respond_enquiry.php?enquiry_id={$row['enquiry_id']}' class='btn btn-primary btn-sm'>Respond</a>
                                <a href='../?delete_id={$row['enquiry_id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
                        </tr>";
                    }                
                ?>
            </tbody>
        </table>
    </section>
</div>

</body>
</html>
