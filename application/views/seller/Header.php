<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="e-fashion Online Fahion Design">
    <meta name="author" content="unicoder">
    <title>e-fashion - Designer</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/logo.jpg'); ?>">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Advent+Pro:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--  CSS Style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/animate.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/webfonts/flaticon/flaticon.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/template.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/category/category-two.css'); ?>" id="color-change">

</head>

<body>
    <div id="page_wrapper">
        <!-- Header Section Start -->
        <header class="default-header bg-extra primary-bg-right nav-on-top">
            <div class="main-nav">
                <div class="extra-logo-image"><img src="<?php echo base_url('assets/images/logo/logo.jpg'); ?>" alt=""></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <nav class="navbar navbar-expand-lg nav-white nav-primary-hover">
                                <a class="navbar-brand d-none" href="#"><img class="nav-logo" src="<?php echo base_url('assets/images/logo/logo.jpg'); ?>" alt="Image not found !"></a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
									<span class="navbar-toggler-icon flaticon-menu flat-small text-white"></span>
								</button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav">

                                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>">Home</a> </li>
                                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('about'); ?>">About</a> </li>
                                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('contact'); ?>">Contact</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('gallery'); ?>">Gallery</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('s/balance'); ?>">Balance</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('s/orders'); ?>">Orders</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('s/requests'); ?>">Customer Requests</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('logout'); ?>">Logout</a></li>

                                        <a class="d-none" id="ajax_url" href=""><?php echo base_url(); ?></a>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="position-absolute nav-right-side d-lg-flex align-items-center d-none">
                    <nav class="navbar navbar-expand-lg nav-dark">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('s/inbox'); ?>">Inbox</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('s/setting'); ?>">Settings</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="d-flex">

                        <div class="cart-view position-relative ml-4">
                            <a href="<?php echo base_url('profile'); ?>" class="top-quantity">
                                <i class="flaticon-user text-dark"></i>
                                <!-- <span class="text-white"></span> -->
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header Section End -->


