<?php $base = (strpos($_SERVER['PHP_SELF'], '/admin/') !== false || strpos($_SERVER['PHP_SELF'], '/user/') !== false) ? '../' : ''; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>VSMS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="<?php echo $base; ?>img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Ubuntu:wght@400;500&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo $base; ?>lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?php echo $base; ?>lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo $base; ?>lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo $base; ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?php echo $base; ?>css/style.css" rel="stylesheet">
    <style>
            .logo{
                width: 130px;
                height: 130px;
                margin-left: -45%;
            }

    </style>
</head>    
    <!-- Topbar Start -->
    <div class="container-fluid bg-light p-0">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-map-marker-alt text-primary me-2"></small>
                    <small>12 street, VALSAD, INDIA</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center py-3">
                    <small class="far fa-clock text-primary me-2"></small>
                    <small>Mon - Fri : 09.00 AM - 09.00 PM</small>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-phone-alt text-primary me-2"></small>
                    <small>
                        +917202854200, +919558963099</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn btn-sm-square bg-white text-primary me-1" href="<?php echo $base; ?>"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-1" href="<?php echo $base; ?>"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-1" href="<?php echo $base; ?>"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-0" href="<?php echo $base; ?>"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="<?php echo $base; ?>index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <img class="logo" src="<?php echo $base; ?>img/vsmslogofinal.png" alt="image">
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="<?php echo $base; ?>index.php" class="nav-item nav-link active">Home</a>
                <a href="<?php echo $base; ?>about.php" class="nav-item nav-link">About</a>
                <div class="nav-item dropdown">
                    <a href="<?php echo $base; ?>service.php" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Services</a>
                    <div class="dropdown-menu fade-up m-0">
                        <a href="<?php echo $base; ?>service.php" class="dropdown-item">Service Request Form</a>
                        <a href="<?php echo $base; ?>admin/service_history.php" class="dropdown-item">Service History</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Enquiry</a>
                    <div class="dropdown-menu fade-up m-0">
                        <a href="<?php echo $base; ?>user/enquiry.php" class="dropdown-item">Enquiry Form</a>
                        <a href="<?php echo $base; ?>admin/enquiry_history.php" class="dropdown-item">Enquiry History</a>
                    </div>
                </div>
                <a href="<?php echo $base; ?>contact.php" class="nav-item nav-link">Contact</a>
                <?PHP
                    if(!isset($_SESSION['username'])){ ?>
                        <a href="<?php echo $base; ?>registration.php" class="nav-item nav-link">SignUp</a><?php
                    }else{?>
                        <a href="<?php echo $base; ?>logout.php" class="nav-item nav-link">Logout</a>
                        <a href="<?php echo $base; ?>user/account.php" class="nav-item nav-link" style="margin-top:-2%;"><i  class="bi bi-person fs-2" title="Your Profile"></i></a><?php
                    }
                ?>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->