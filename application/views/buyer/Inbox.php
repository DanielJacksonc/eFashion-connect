
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url() . '/assets/css/msg.css'; ?>">


<div class="full-row mt-0" style="background-image: url(<?php echo base_url('assets/bg/inbox.jpg') ; ?>)">
    <div class="container">
        <div class="messaging">

            <div class="inbox_msg">
                <div class="inbox_people">
                    <div class="headind_srch">
                        <div class="recent_heading">
                            <h4 class="text-white">Recent</h4>
                        </div>
                        
                    </div>
                    <div class="inbox_chat" style="background-color: #B2BEB5" id="chat_people">

                    <?php

                        foreach ( $people as $single ) {
                            ?>

                                <div class="chat_list"  style="cursor: pointer;" id="<?php echo $single['user_name'] ; ?>">
                                    <div class="chat_people">

                                    <div class="chat_img"> 
                                        <?php
                                            if ( $single['avtar'] == '' ) {?><i class="flaticon-user flat-mini text-dark"></i><?php
                                            }
                                            else {?><img id="<?php echo $single['user_name'] ; ?>-img" src="<?php echo base_url().'resource/avtar/' . $single['avtar']  ;?>" alt="<?php echo $single['user_name'] ; ?>" class="rounded-circle" height="32" width="55"><?php
                                            }
                                        ?>
                                    </div>

                                    <div class="chat_ib">
                                        <h5><?php echo $single['user_name'] ; ?></h5>
                                        <p id ="<?php echo $single['user_name'] ; ?>-msg"> <?php echo $single['msg'] ; ?></p>
                                    </div>
                                    </div>
                                </div>

                            <?php
                        }

                    ?>


                    </div>
                </div>




                <div class="mesgs" id='msg_box'>

                    <div class="msg_history">

                        <div class="msg_container">

                        </div>


                    </div>

                    <div class="mt-3">
                        <form autocomplete="off" id="send_msg_to_man" enctype="multipart/form-data">
        
                            <div class="row">
                                <div class="col-sm-10">
                                    <input class="d-none" name="receiver_id" id="receiver_uid" type="text">
                                    <textarea name="msg" style="background-color: #ebebeb"  id="msg_text" style="background-color: #A1E3D8;" class="form-control" rows="2"></textarea>
                                </div>
                                <div class="col-sm-2 text-center">
                                    <button class="btn btn-success" type="submit">Send</button>
                                </div>
                            </div>

                            <div class="image-upload mt-2">
                                <label for="file-input" class="text-white">
                                    Send File &nbsp;&nbsp;&nbsp;
                                </label>
                                <input style="" name="msg_file" id="file-input" type="file"/>
                            </div>
                        </form>

                    </div>

                </div>

            </div>
        </div>

    </div>

</div>

    <!-- Copyright Section Start -->
    <div class="copyright bg-dark py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mb-3 mb-md-0">
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
    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/validate.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>
    <!--Custom Script-->
    <script src="<?php echo base_url() . 'assets/js/fashion/buyer_event.js'; ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/fashion/buyer.js'; ?>"></script>

</body>

</html>



