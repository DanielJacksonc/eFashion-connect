
<div class="full-row mt-2" style="background-image: url(<?php echo base_url('assets/bg/orders.jpg') ; ?>)">
    <div class="container mt-3">

        <div class="row">
            <div class="col-sm-2 mt-3 text-dark">
                <div class="row">
                    <div class="col text-center">
                        <h4>Job Details</h4>
                    </div>
                </div>
                <hr>

                <div class="row mt-3">
                    <div class="col text-center">
                        <h5 style='color: green;'>Category</h5>
                        <p><?php echo $job['category'];?></p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col text-center">
                        <h5 style='color: green;'>Price</h5>
                        <p>$ <?php echo $job['price'];?> </p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col text-center">
                        <h5 style='color: green;'>Description</h5>
                        <p class='text-justify'><?php echo $job['des'];?></p>
                    </div>
                </div>

            </div>

            <div class="col-sm-10 border-left mt-3">
                <div class="row mt-3">
                    <div class="col text-center">
                        <h4>Offers</h4>
                    </div>
                </div>

                <?php

                    foreach ( $offers as $offer ) {
                        ?>
                            <div class="row border p-2 rounded">
                                <div class="col-sm-6 text-justify">

                                    <div class="row ml-1">
                                        <div>
                                        <?php
                                            if ( $images[$offer['offer_id']] == '' ) {?><i class="flaticon-user flat-small text-dark"></i><?php
                                            }
                                            else {?><img class="rounded-circle" height="35" width="35" src="<?php echo base_url() . 'resource/avtar/' . $images[$offer['offer_id']];?>"/>&nbsp;&nbsp;<?php
                                            }
                                        ?>
                                        </div>
                                        
                                        <h4 style="color:black; font-size:16px;"> <?php echo $offer['seller_uname']; ?> </h4>
                                    </div>

                                    <div class="row ml-1">
                                        <p class="text-dark"> <?php echo $offer['des']; ?> </p>
                                    </div>
                                    
                                </div>
                                <div class="col-sm-2 text-center mt-1">
                                    <p class="text-dark"> $ <?php echo $offer['price']; ?></p>
                                </div>
                                <div class="col-sm-2 text-center mt-1">
                                    <a href="<?php echo base_url('gig/details/') . $offer['gig_id'] ; ?>" class="text-dark"> View Gig </a>
                                </div>
                                <div class="col-sm-2 text-center mt-1">
                                    <button class="btn btn-secondary send_msg" id="<?php echo $offer['seller_uname']; ?>" data-toggle="modal" data-target=".bd-example-modal-lg" >Send Msg</button>
                                </div>
                            </div>

                        <?php

                    }

                ?>

            </div>
        </div>
    </div>

    <div style="height:80px">



    <div class="modal fade bd-example-modal-lg mt-5" tabindex="-1" role="dialog" id="myModal" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-5 bg-info">

            <div class="alert alert-danger d-none" id="alert"></div>
            <div class="alert alert-success d-none" id="success"></div>
            <div id="ruler" class="">
            </div>

            <form autocomplete="off" id="offer_send_msg" enctype="multipart/form-data">

                <input type="text" class="d-none" name="r_u_name" id="user_name" value=''>

                <div class="row">
                    <div class="col">
                        <h3 class="text-secondary"> Type Your Messages </h3>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col text-center">
                    <label for="msg"><h4 class="text-secondary">To : <span class="text-white" id="sender_id"></span></h4></label>
                    <textarea name="msg" class="form-control" style="background-color: #B9F8D3;" id="msg" rows="4"></textarea>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col text-center">
                        <input type="file" class="form-control-file text-white" name="file" id="file" accept="*">
                    </div>
                </div>


                <div class="form-group text-center mt-3">
                    <button class="btn btn-secondary"> Send </button>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>


</div>