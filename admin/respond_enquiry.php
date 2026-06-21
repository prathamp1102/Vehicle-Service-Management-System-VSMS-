<?php
include("admin_header.php");
include("../config/database.php");

if (isset($_GET['enquiry_id'])) {
    $enquiry_id = $_GET['enquiry_id'];
    $query = "SELECT * FROM enquiry WHERE enquiry_id = '$enquiry_id'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $user_id = $row['user_id'];
        $enquiry = $row['enquiry'];
        $description = $row['description'];
        $response = $row['response'] ?? '';
    } else {
        echo "<script>alert('Invalid Enquiry ID.'); window.location.href='../user/new_enquiry.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('No Enquiry ID provided.'); window.location.href='../user/new_enquiry.php';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = mysqli_real_escape_string($conn, $_POST["response"]);
    $update_query = "UPDATE enquiry SET response = '$response', status = 'Responded' WHERE enquiry_id = '$enquiry_id'";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Response submitted successfully!'); window.location.href='responded_enquiry.php';</script>";
    } else {
        echo "<script>alert('Error submitting response.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respond to Enquiry | VSMS</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Respond to Enquiry</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Enquiry Details</h5>
            <p><strong>User ID:</strong> <?php echo $user_id; ?></p>
            <p><strong>Enquiry Type:</strong> <?php echo $enquiry; ?></p>
            <p><strong>Description:</strong> <?php echo $description; ?></p>

            <form method="POST">
                <div class="mb-3">
                    <label for="response" class="form-label"><strong>Response:</strong></label>
                    <textarea class="form-control" id="response" name="response" rows="4" required><?php echo $response; ?></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit Response</button>
                <a href="../user/new_enquiry.php" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>