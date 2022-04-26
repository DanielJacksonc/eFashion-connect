

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script>
	<script src="<?php echo base_url() . 'assets/js/seller.js'; ?> "></script>

</body>
</html>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion e-connect - Designer</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() . '/assets/css/msg.css'; ?>">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

</head>

<body>
    <header>
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="<?php echo base_url(); ?>">Fashion E-connect</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item mr-1">
                            <a class="nav-link" href="<?php echo base_url(). 's/inbox' ?>"><b>Inbox</b></a>
                        </li>

                        <!-- <li class="nav-item mr-1">
                            <a class="nav-link" href="login"><b>Notifications</b></a>
                        </li> -->

                        <li class="nav-item mr-1">
                            <a class="nav-link" href="<?php echo base_url('s/balance');?>"><b>Balance</b></a>
                        </li>

                        <li class="nav-item mr-1">
                            <a class="nav-link" href="<?php echo base_url(). 's/orders' ?>"><b>Orders</b></a>
                        </li>

                        <li class="nav-item mr-1">
                            <a class="nav-link" href="<?php echo base_url(). 's/requests' ?>"><b>Buyer Requests</b></a>
                        </li>

                        <!-- <li class="nav-item mr-1">
                            <a class="nav-link" href="signup"><b>Switch to Buyer</b></a>
                        </li> -->

                        <li class="nav-item mr-2">
                            <a class="nav-link" href="<?php echo base_url() ?>s/setting"><b>Settings</b></a>
                        </li>

                        <li class="nav-item mr-2">
                            <a class="nav-link" href="<?php echo base_url() ?>s"><b>Profile</b></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url() . 'logout' ; ?>">
                                <button class="btn btn-sm btn-warning" >logout</button>
                            </a>
                        </li>
                        <a class="d-none" id="ajax_url" href=""><?php echo base_url(); ?></a>
                    </ul>
                </div>
            </nav>
        </div>

    </header>


