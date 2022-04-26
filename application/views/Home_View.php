<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="e-fashion Online Fahion Design">
    <meta name="author" content="unicoder">
    <title>e-fashion - Online Fashion Design</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/logo.jpg'); ?>">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Advent+Pro:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600&amp;display=swap" rel="stylesheet">

    <!--  CSS Style -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/webfonts/flaticon/flaticon.css">
    <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/layerslider.css">
    <link rel="stylesheet" href="assets/css/template.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/category/category-one.css" id="color-change">

</head>

<body>
    <div id="page_wrapper">
        <!-- Header Section Start -->
        <header class="nav-split-simple nav-on-top fixed-bg-white">
            <div class="top-header sm-mx-none shadow-sm bg-white position-relative z-index-9">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="top-profile left">
								<form action="#">
									<ul class="d-flex">
										<li>
											<select name="curency" class="form-control selectpicker">
												<option>USD</option>
												<option>TK</option>
												<option>EUR</option>
												<option>RS</option>
											</select>
										</li>
										<li>
											<select name="service" class="form-control selectpicker">
												<option>Customer Service</option>
												<option>Design</option>
												<option>Cutting</option>
												<option>Repearing</option>
											</select>
										</li>
									</ul>
								</form>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="top-profile">
                                <ul class="d-flex justify-content-end">
                                    <li>
                                        <form action="#" class="position-relative">
                                            <input type="text" placeholder="Search.....">
                                            <button type="submit"><i class="flaticon-search flat-mini" aria-hidden="true"></i></button>
                                        </form>
                                    </li>
                                    <li><a href="<?php echo base_url('profile'); ?>" class="text-dark"><i class="flaticon-user flat-mini" aria-hidden="true"></i></a></li>
                                    <li>
                                        <div class="navbar-nav cart-view position-relative">
                                            <a href="#" class="top-quantity text-dark">
                                                <i class="flaticon-shopping-bag flat-mini"></i>
                                                <span class="text-secondary bg-primary">0</span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-nav py-lg-4">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <nav class="navbar navbar-expand-lg nav-line-active nav-dark nav-primary-hover">
                                <a class="navbar-brand" href="#"><img class="nav-logo" src="final_logo.jpg" alt="Image not found !"></a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon flaticon-menu flat-small text-primary"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav w-100">

                                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>">Home</a> </li>
                                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('about'); ?>">About</a> </li>
                                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('contact'); ?>">Contact</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('gallery'); ?>">Gallery</a></li>

                                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('login'); ?>">Login</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('signup'); ?>">Register</a> </li>

                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header Section End -->

        <!-- Slider HTML markup -->
		<div class="full-row p-0 overflow-hidden">
			<div id="slider" style="width:1200px; height:800px; margin:0 auto;margin-bottom: 0px;">
						
				<!-- Slide 1-->
				<div class="ls-slide" data-ls="bgsize:cover; bgposition:50% 50%; duration:10000; transition2d:3; timeshift:-500; deeplink:home; kenburnszoom:in; kenburnsrotate:0; kenburnsscale:1.2; parallaxevent:scroll; parallaxdurationmove:500;">
					<img width="1920" height="1080" src="assets/images/slider/1.png" class="ls-bg"  alt="" />
					<div style="width:100%; height:100%; background: rgba(53, 54, 80, .5); top:50%; left:50%;" class="ls-l" data-ls="easingin:easeOutQuint; durationout:400; parallaxlevel:0; position:fixed;"></div>
					<div style="width:440px; height:440px; background:transparent; border: 5px solid; border-color: rgba(255, 255, 255, 0.1); top:50%; left:50%;" class="ls-l" data-ls="delayin:1500; durationout:400; easingin:easeOutExpo; scalexin:0.8; parallaxlevel:0;"></div>
					<p style="font-weight:400; text-align:center; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); width:700px; font-size:60px; line-height:80px; color:#ffffff; top:260px; left:50%; white-space:normal;" class="ls-l higlight-font" data-ls="offsetyin:40; delayin:250; easingin:easeOutQuint; filterin:blur(10px); offsetyout:-200; durationout:400; parallax:true; parallaxlevel:3;">Never goes out of style</p>
					<p style="font-weight:500; text-align:center; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); width:700px; font-size:17px; text-transform: uppercase; line-height:50px; color:#ffffff; top:230px; left:50%; white-space:normal;" class="ls-l text-primary" data-ls="offsetyin:40; easingin:easeOutQuint; offsetyout:-200; durationout:400; parallax:true; parallaxlevel:4;">e-fashion</p>
					<p style="font-weight:400; text-align:center; width:400px; font-size:17px; text-transform: uppercase; line-height:30px; color:#ffffff; top:380px; left:50%; white-space:normal;" class="ls-l" data-ls="offsetyin:40; delayin:700; easingin:easeOutQuint; offsetyout:-250; durationout:400; parallax:true; parallaxlevel:2;"> WE HAVE YOUR CLOTHING TRADITION HERE WITH SPEED AND CONCEPT.</p>
					<!-- <a style="" class="ls-l ls-hide-phone" href="https://themeforest.net/item/bluebird-multipurpose-html-template/24782709" target="_self" data-ls="offsetyin:40; delayin:1200; easingin:easeOutQuint; offsetyout:-300; durationin:1500; durationout:400; hover:true; hoverdurationin:300; hoveropacity:1; hoverbgcolor:#c7a16a; hovercolor:#202430; parallax:false; parallaxlevel:1;">
						<p style="font-weight:600; text-align:center; cursor:pointer; padding-right:35px; padding-left:35px; font-size:16px; line-height:40px; top:490px; left:50%; color:#202430; border-radius:0px; border: 2px solid; border-color: #c7a16a; padding-top:5px; padding-bottom:5px; background:#c7a16a; white-space:nowrap;" class="higlight-font">Make An Appointment</p>
					</a> -->
				</div>
				
				<!-- Slide 2-->
				<div class="ls-slide" data-ls="bgsize:cover; bgposition:50% 50%; duration:10000; transition2d:3; timeshift:-500; deeplink:home; kenburnszoom:in; kenburnsrotate:0; kenburnsscale:1.2; parallaxevent:scroll; parallaxdurationmove:500;">
					<img width="1920" height="1080" src="assets/images/slider/2.png" class="ls-bg"  alt="" />
					<div style="width:100%; height:100%; background: rgba(53, 54, 80, .5); top:50%; left:50%;" class="ls-l" data-ls="easingin:easeOutQuint; durationout:400; parallaxlevel:0; position:fixed;"></div>
					<div style="width:440px; height:440px; background:transparent; border: 5px solid; border-color: rgba(255, 255, 255, 0.1); top:50%; left:50%;" class="ls-l" data-ls="delayin:1500; durationout:400; easingin:easeOutExpo; scalexin:0.8; parallaxlevel:0;"></div>
					<p style="font-weight:400; text-align:center; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); width:700px; font-size:60px; line-height:80px; color:#ffffff; top:260px; left:50%; white-space:normal;" class="ls-l higlight-font" data-ls="offsetyin:40; delayin:250; easingin:easeOutQuint; filterin:blur(10px); offsetyout:-200; durationout:400; parallax:true; parallaxlevel:3;">Never goes out of style</p>
					<p style="font-weight:500; text-align:center; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); width:700px; font-size:17px; text-transform: uppercase; line-height:50px; color:#ffffff; top:230px; left:50%; white-space:normal;" class="ls-l text-primary" data-ls="offsetyin:40; easingin:easeOutQuint; offsetyout:-200; durationout:400; parallax:true; parallaxlevel:4;">e-fashion</p>
					<p style="font-weight:400; text-align:center; width:400px; font-size:17px; text-transform: uppercase; line-height:30px; color:#ffffff; top:380px; left:50%; white-space:normal;" class="ls-l" data-ls="offsetyin:40; delayin:700; easingin:easeOutQuint; offsetyout:-250; durationout:400; parallax:true; parallaxlevel:2;"> WE HAVE YOUR CLOTHING TRADITION HERE WITH SPEED AND CONCEPT.</p>
					<!-- <a style="" class="ls-l ls-hide-phone" href="https://themeforest.net/item/bluebird-multipurpose-html-template/24782709" target="_self" data-ls="offsetyin:40; delayin:1200; easingin:easeOutQuint; offsetyout:-300; durationin:1500; durationout:400; hover:true; hoverdurationin:300; hoveropacity:1; hoverbgcolor:#c7a16a; hovercolor:#202430; parallax:false; parallaxlevel:1;">
						<p style="font-weight:600; text-align:center; cursor:pointer; padding-right:35px; padding-left:35px; font-size:16px; line-height:40px; top:490px; left:50%; color:#202430; border-radius:0px; border: 2px solid; border-color: #c7a16a; padding-top:5px; padding-bottom:5px; background:#c7a16a; white-space:nowrap;" class="higlight-font">Make An Appointment</p>
					</a> -->
				</div>
				
				<!-- Slide 3-->
				<div class="ls-slide" data-ls="bgsize:cover; bgposition:50% 50%; duration:10000; transition2d:3; timeshift:-500; deeplink:home; kenburnszoom:in; kenburnsrotate:0; kenburnsscale:1.2; parallaxevent:scroll; parallaxdurationmove:500;">
					<img width="1920" height="1080" src="assets/images/slider/3.png" class="ls-bg"  alt="" />
					<div style="width:100%; height:100%; background: rgba(53, 54, 80, .5); top:50%; left:50%;" class="ls-l" data-ls="easingin:easeOutQuint; durationout:400; parallaxlevel:0; position:fixed;"></div>
					<div style="width:440px; height:440px; background:transparent; border: 5px solid; border-color: rgba(255, 255, 255, 0.1); top:50%; left:50%;" class="ls-l" data-ls="delayin:1500; durationout:400; easingin:easeOutExpo; scalexin:0.8; parallaxlevel:0;"></div>
					<p style="font-weight:400; text-align:center; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); width:700px; font-size:60px; line-height:80px; color:#ffffff; top:260px; left:50%; white-space:normal;" class="ls-l higlight-font" data-ls="offsetyin:40; delayin:250; easingin:easeOutQuint; filterin:blur(10px); offsetyout:-200; durationout:400; parallax:true; parallaxlevel:3;">Never goes out of style</p>
					<p style="font-weight:500; text-align:center; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); width:700px; font-size:17px; text-transform: uppercase; line-height:50px; color:#ffffff; top:230px; left:50%; white-space:normal;" class="ls-l text-primary" data-ls="offsetyin:40; easingin:easeOutQuint; offsetyout:-200; durationout:400; parallax:true; parallaxlevel:4;">e-fashion</p>
					<p style="font-weight:400; text-align:center; width:400px; font-size:17px; text-transform: uppercase; line-height:30px; color:#ffffff; top:380px; left:50%; white-space:normal;" class="ls-l" data-ls="offsetyin:40; delayin:700; easingin:easeOutQuint; offsetyout:-250; durationout:400; parallax:true; parallaxlevel:2;"> WE HAVE YOUR CLOTHING TRADITION HERE WITH SPEED AND CONCEPT</p>
					<!-- <a style="" class="ls-l ls-hide-phone" href="https://themeforest.net/item/bluebird-multipurpose-html-template/24782709" target="_self" data-ls="offsetyin:40; delayin:1200; easingin:easeOutQuint; offsetyout:-300; durationin:1500; durationout:400; hover:true; hoverdurationin:300; hoveropacity:1; hoverbgcolor:#c7a16a; hovercolor:#202430; parallax:false; parallaxlevel:1;">
						<p style="font-weight:600; text-align:center; cursor:pointer; padding-right:35px; padding-left:35px; font-size:16px; line-height:40px; top:490px; left:50%; color:#202430; border-radius:0px; border: 2px solid; border-color: #c7a16a; padding-top:5px; padding-bottom:5px; background:#c7a16a; white-space:nowrap;" class="higlight-font">Make An Appointment</p>
					</a> -->
				</div>
			</div>
		</div>
		<!--Slider Section End-->

        <!-- Service Section Start -->
        <div class="full-row bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-xl-8 mx-auto text-center">
                        <h2 class="border-line mx-auto d-table mb-5">E-Fashion Services</h2>
                        <span class="mt-4 mb-5 sub-title">We create a fun ground for our expert designer to meet with our esteemed customers, to create an exceptional design all over the globe, with less charges, global delivery  as we maintain our credible standard.</span>
                    </div>
                </div>
                <div class="row row-cols-lg-4 row-cols-sm-2 row-cols-1">
                    <div class="col mb-sm-30">
                        <div class="text-center">
							<div class="frame1 box-100px position-relative mx-auto mb-5"><span class="flaticon-sewing-machine xy-center text-primary flat-medium position-absolute"></span></div>
							<h4 class="mb-4">Alteration</h4>
							<p>We give a global brand on your clothing type, your designer knows your culture and can alter your present outfit to be your desired outfit.</p>
                        </div>
                    </div>
                    <div class="col mb-sm-30">
                        <div class="text-center">
							<div class="frame1 box-100px position-relative mx-auto mb-5"><span class="flaticon-blazer xy-center text-primary flat-medium position-absolute"></span></div>
							<h4 class="mb-4">Styling</h4>
							<p>We are leading global styling company, never worry about the styles, we got you covered! just shout e-fashion.</p>
                        </div>
                    </div>
                    <div class="col mb-sm-30">
                        <div class="text-center">
							<div class="frame1 box-100px position-relative mx-auto mb-5"><span class="flaticon-security xy-center text-primary flat-medium position-absolute"></span></div>
							<h4 class="mb-4">Concierge</h4>
							<p>We extend to every other cloth design services, ranging from professional services, traditional outfit, and mono-cultural designs, just click next and we got you covered.</p>
                        </div>
                    </div>
                    <div class="col mb-sm-30">
                        <div class="text-center">
							<div class="frame1 box-100px position-relative mx-auto mb-5"><span class="flaticon-dress xy-center text-primary flat-medium position-absolute"></span></div>
							<h4 class="mb-4">Modeling</h4>
							<p>our styles are century conscious, we design for pro-models. are you a model? we have got you covered. choose from our pool of model designers and experience the our name in brand---EFASHION---</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service Section End -->

        <!-- Copyright Section Start -->
        <div class="copyright bg-dark py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <span>© 2022 All Rights Reserved e-fashion</span>
                        <span class="pl-3">Design By <span class="text-primary">E-Fashion</span></span>
                    </div>
                    <div class="col-md-4">
                        <ul class="line-menu sitemap list-color-general">
                            <li><a href="#">Sitemap</a></li>
                            <li><a href="#">Permission</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright Section End -->

        <!-- Scroll to top -->
        <a href="#" class="bg-primary text-white" id="scroll"><i class="fa fa-angle-up"></i></a>
        <!-- End Scroll To top -->
    </div>
    <!-- Wrapper End -->

    <!--===============================================================================================-->
    <!-- All Javascript Plugin File here -->
    <script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/greensock.js"></script>
	<script src="assets/js/layerslider.transitions.js"></script>
	<script src="assets/js/layerslider.kreaturamedia.jquery.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/jquery.fancybox.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/mixitup.min.js"></script>
	<script src="assets/js/paraxify.js"></script>
	<script src="assets/js/validate.js"></script>
    <script src="assets/js/custom.js"></script>
	<script>
	$(document).ready(function() {	

		$('#slider').layerSlider({
			sliderVersion: '6.0.0',
			type: 'fullwidth',
			pauseOnHover: 'disabled',
			responsiveUnder: 0,
			layersContainer: 1200,
			maxRatio: 1,
			parallaxScrollReverse: true,
			hideUnder: 0,
			hideOver: 100000,
			skin: 'numbers',
			showBarTimer: false,
			showCircleTimer: false,
			thumbnailNavigation: 'disabled',
			allowRestartOnResize: true,
			skinsPath: 'assets/skins/',
			height: 780
		});
		
	});
	</script>
</body>
</html>