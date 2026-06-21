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

.sidebar {
        width: 250px;
        background-color: #2c3e50;
        color: white;
        height: 100vh;
        padding-top: 20px;
        position: fixed;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

.sidebar h2 {
    text-align: center;
    margin-bottom: 20px;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    padding: 15px;
    text-align: center;
}

.sidebar ul li a {
    color: white;
    text-decoration: none;
    display: block;
}

.sidebar ul li:hover {
    background: #1a252f;
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

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.sidebar {
    width: 250px;
    height: 100vh;
    background-color: #2c2f36;
    color: white;
    padding: 15px;
    position: fixed;
}

.sidebar h2 {
    text-align: center;
    margin-bottom: 20px;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    padding: 10px;
}

.sidebar ul li a {
    text-decoration: none;
    color: white;
    display: block;
    padding: 8px;
    transition: 0.3s;
}

.sidebar ul li a:hover {
    background-color: #007bff;
    border-radius: 5px;
}

.dropdown-content {
    display: none;
    background-color: #1c1e24;
    margin-top: 5px;
    padding-left: 15px;
}

.dropdown-content li a {
    font-size: 14px;
}

.show {
    display: block;
}

.dropdown-btn {
    cursor: pointer;
}

.profile-img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-bottom: 10px;
        border: 2px solid white;
        -align: center;
    }

</style>
</head>
<body>

<div class="sidebar">
    <h2>VSMS | Admin</h2>
    <a href="admin_profile.php"><img src="../img/profile.png" alt="Profile" class="profile-img"></a>
    <ul>
        <li><a href="admin_index.php">Dashboard</a></li>

        <li class="dropdown">
            <a href="#" class="dropdown-btn">Mechanics ▼</a>
            <ul class="dropdown-content">
                <li><a href="add_mechanics.php">Add Mechanic</a></li>
                <li><a href="manage_mechanics.php">Manage Mechanics</a></li>
            </ul>
        </li>

        <li class="dropdown">
            <a href="#" class="dropdown-btn">Vehicle Category ▼</a>
            <ul class="dropdown-content">
                <li><a href="add_vehicle_category.php">Add Category</a></li>
                <li><a href="manage_vehicle_category.php">Manage Categories</a></li>
            </ul>
        </li>

        <li class="dropdown">
            <a href="#" class="dropdown-btn">Service Request ▼</a>
            <ul class="dropdown-content">
                <li><a href="../user/new_service_request.php">New Requests</a></li>
                <li><a href="reject_service_request.php">Rejected Requests</a></li>
            </ul>
        </li>

        <li class="dropdown">
            <a href="#" class="dropdown-btn">Servicing ▼</a>
            <ul class="dropdown-content">
                <li><a href="pending_service.php">Pending Service</a></li>
                <li><a href="completed_service.php">Completed Services</a></li>
            </ul>
        </li>

        <li class="dropdown">
            <a href="#" class="dropdown-btn">Customer Enquiry ▼</a>
            <ul class="dropdown-content">
                <li><a href="../user/new_enquiry.php">New Enquiries</a></li>
                <li><a href="responded_enquiry.php">Responded Enquiries</a></li>
            </ul>
        </li>

        <li><a href="enquiry_search.php">Enquiry Search</a></li>
        <li><a href="service_search.php">Service Search</a></li>
    </ul>
</div>

<script>
    document.querySelectorAll(".dropdown-btn").forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            this.nextElementSibling.classList.toggle("show");
        });
    });

    window.onclick = function(event) {
        if (!event.target.matches('.dropdown-btn')) {
            document.querySelectorAll(".dropdown-content").forEach(menu => {
                menu.classList.remove("show");
            });
        }
    }
</script>

