<?php
include("admin_header.php");
include("../config/database.php");

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM enquiry WHERE enquiry_id='$delete_id'";
    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Enquiry deleted successfully!'); window.location.href='enquiry_search.php';</script>";
    } else {
        echo "<script>alert('Error deleting enquiry.');</script>";
    }
}

$search_query = "";
if (isset($_POST['search'])) {
    $search_query = trim($_POST['search_query']);
    $result = mysqli_query($conn, "SELECT * FROM enquiry WHERE user_id LIKE '%$search_query%' OR enquiry LIKE '%$search_query%' OR description LIKE '%$search_query%' ORDER BY enquiry_id DESC");
} else {
    $result = mysqli_query($conn, "SELECT * FROM enquiry ORDER BY enquiry_id DESC");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquiry Search | VSMS</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="content">
    <header>
        <h2>Search Enquiries</h2>
    </header>

    <section class="dashboard">
        <h3>Search Enquiries</h3>
        <form method="POST" action="../" class="mb-3">
            <input type="text" name="search_query" class="form-control" placeholder="Enter keyword..." value="<?php echo htmlspecialchars($search_query); ?>">
            <button type="submit" name="search" class="btn btn-primary mt-2">Search</button>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Enquiry</th>
                    <th>Description</th>
                    <th>Response</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['enquiry_id']}</td>
                        <td>{$row['user_id']}</td>
                        <td>{$row['enquiry']}</td>
                        <td>{$row['description']}</td>
                        <td>{$row['response']}</td>
                        <td>{$row['status']}</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
</div>

</body>
</html>
