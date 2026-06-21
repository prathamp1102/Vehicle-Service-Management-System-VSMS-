<?php
include("admin_header.php");
include("../config/database.php");

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM mechanics WHERE mechanic_id = $delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Mechanic deleted successfully!'); window.location.href='manage_mechanics.php';</script>";
    } else {
        echo "<script>alert('Error deleting mechanic.');</script>";
    }
}

// Fetch all mechanics
$sql = "SELECT * FROM mechanics";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Mechanics | VSMS Admin</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .table img {
            width: 50px;
            height: 50px;
            border-radius: 5px;
        }

    </style>
</head>
<body>

<div class="content">
    <header>
        <h2>Manage Mechanics</h2>
    </header>

    <section class="table-container">
        <h3>Mechanics List</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row["mechanic_id"] ?></td>
                        <td><img src="../<?= $row["image"] ?>" alt="Mechanic"></td>
                        <td><?= $row["name"] ?></td>
                        <td><?= $row["contact"] ?></td>
                        <td><?= $row["email"] ?></td>
                        <td><?= $row["address"] ?></td>
                        <td>
                            <a href="edit_mechanic.php?id=<?= $row["mechanic_id"] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="../?delete_id=<?= $row["mechanic_id"] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</div>

</body>
</html>
