<?php
include("admin_header.php");
include("../config/database.php");

$mechanics = null; // Prevent undefined variable issues

// Get mechanic_id safely from POST or GET
if (!empty($_REQUEST['mechanic_id']) && is_numeric($_REQUEST['mechanic_id'])) {
    $mechanic_id = (int) $_REQUEST['mechanic_id']; // Convert to integer
} else {
    echo "<script>alert('Invalid request!'); window.location.href='manage_mechanics.php';</script>";
    exit;
}

// Fetch mechanic details before updating
$sql = "SELECT * FROM mechanics WHERE mechanic_id = $id";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $mechanics = mysqli_fetch_assoc($result);
} else {
    echo "<script>alert('Mechanic not found!'); window.location.href='manage_mechanics.php';</script>";
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["mechanic_name"]);
    $contact = mysqli_real_escape_string($conn, $_POST["mechanic_contact"]);
    $email = mysqli_real_escape_string($conn, $_POST["mechanic_email"]);
    $address = mysqli_real_escape_string($conn, $_POST["mechanic_address"]);

    $update_sql = "UPDATE mechanics SET name='$name', contact='$contact', email='$email', address='$address' WHERE mechanic_id=$mechanic_id";

    if (mysqli_query($conn, $update_sql)) {
        echo "<script>alert('Mechanic updated successfully!'); window.location.href='manage_mechanics.php';</script>";
        exit;
    } else {
        echo "Error updating mechanic: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mechanic</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="content">
    <header>
        <h2>Edit Mechanic</h2>
    </header>

    <section class="dashboard">
        <h3>Update Mechanic Details</h3>
        <form method="POST" class="mechanic-form">
            <input type="hidden" name="mechanic_id" value="<?= htmlspecialchars($mechanic_id) ?>">

            <div class="mb-3">
                <label class="form-label">Mechanic Name</label>
                <input type="text" class="form-control" name="mechanic_name" 
                       value="<?= htmlspecialchars($mechanic["name"]) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mechanic Contact Number</label>
                <input type="text" class="form-control" name="mechanic_contact" 
                       value="<?= htmlspecialchars($mechanic["contact"]) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mechanic Email</label>
                <input type="email" class="form-control" name="mechanic_email" 
                       value="<?= htmlspecialchars($mechanic["email"]) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mechanic Address</label>
                <input type="text" class="form-control" name="mechanic_address" 
                       value="<?= htmlspecialchars($mechanic["address"]) ?>" required>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </section>
</div>

</body>
</html>
