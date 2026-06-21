<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #000;
        }
        .dashboard-card {
            background: linear-gradient(135deg, #dc3545, #ff6b81);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3);
        }
        .dashboard-card h4 {
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .dashboard-card span {
            font-size: 35px;
            font-weight: bold;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center text-danger">WELCOME BACK TO VSMS USER PANEL!</h2>
        <div class="row mt-4 g-4">
            <div class="col-md-3">
                <div class="dashboard-card">
                    <h4>Total Service Requests</h4>
                    <span>0</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card">
                    <h4>New Service Requests</h4>
                    <span>0</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card">
                    <h4>Rejected Service Requests</h4>
                    <span>0</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card">
                    <h4>Completed Services</h4>
                    <span>0</span>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
