<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion e-connect - Admin</title>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">

</head>

<body>
    <header>
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Fashion E-connect</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav ml-auto">

                        <!-- <li class="nav-item mr-2">
                            <a class="nav-link" href="<?php //echo base_url('b'); ?>"><b>Profile</b></a>
                        </li> -->
                        <a class="d-none" id="ajax_url" href=""><?php echo base_url(); ?></a>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('logout'); ?>">
                                <button class="btn btn-sm btn-warning" >logout</button>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

    </header>