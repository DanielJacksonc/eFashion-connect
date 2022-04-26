
<div class="full-row py-2" style="background-image: url(<?php echo base_url('assets/bg/orders.jpg') ; ?>)">
<div class="container p-4 rounded" style="background-color: gray;">

    <div class="row m-1 mt-3">
        <div class="col-sm-10">
            <h4 class="text-white"><?php echo $gig['title']; ?></h4>
        </div>
        <!-- <div class="col-sm-2 text-right">
            <a href=""><button class="btn btn-outline-primary"> Edit Gig </button></a>
        </div> -->
    </div>

    <div class="row m-1 mt-2">
        <?php
            if ( $profile['avtar'] == '' ) {?><i class="flaticon-user flat-mini text-dark"></i><?php
            }
            else {?><img src="<?php echo base_url('resource/avtar/') . $profile['avtar']; ?>" alt="<?php echo $user['user_name']; ?>" class="rounded-circle  bg-primary" height="40" width="40"><?php
            }
        ?>

        <a class="ml-2 text-white" href="<?php echo base_url() . 'profile'; ?>"> <?php echo $user['user_name']; ?> </a>
    </div>

    <div class="row m-1 mt-2">
        <div class="col-sm-8">
            <div class="row mt-4">
                <img src="<?php echo  base_url() . 'resource/gig-images/' . $gig['img']; ?>" height="400" width="650" alt="">
            </div>
        </div>

        <div class="col-sm-4 mt-5">

            <div class="card bg-info">
                <div class="card-body">
                    <div class="row">
                        <div class="col text-center">
                            <h4>Price</h4>
                        </div>
                    </div>
                    <hr>

                    <div class="row mb-2">
                        <div class="col text-center">
                            <h6>&#36; <?php echo $gig['price']; ?></h6>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col text-center">
                            <h6><?php echo $gig['d_date']; ?> Days Delivary </h6>
                        </div>
                    </div>

                    <div class="row">
                        <button class="btn btn-success btn-block continue_btn">Continue</button>
                    </div>

                </div>
            </div>
            
        </div>
    </div>

    <div class="row m-1 mt-5 ">
        <h5 class="text-white">About The Gig</h5>
    </div>

    <div class="row m-1 my-3">
        <p class="text-dark"><?php echo $gig['des']; ?></p>
    </div>

    <div class="row m-1">
        <h5 class="text-white">About The Designer</h5>
    </div>
    <div class="row m-1 mt-3">

        <div class="col-sm-2">
            <?php
                if ( $profile['avtar'] == '' ) {?><i class="flaticon-user flat-large text-dark"></i><?php
                }
                else {?><img src="<?php echo base_url() . 'resource/avtar/' . $profile['avtar']; ?>" class="rounded-circle  bg-primary" height="100" width="100"><?php
                }
            ?>
            
        </div>

        <div class="col-sm-10">
            <h6><a class="ml-2 text-white" href="<?php echo base_url() . 'profile'; ?>"> <?php echo $profile['f_name'] . " " . $profile['l_name'] ; ?> </a></h6>
            <button class="btn btn-success text-white contact_popup">Contact To The Designer</button>
            
        </div>

    </div>

</div>
</div>


<div class="modal fade bd-example-modal-lg mt-5" tabindex="-1" role="dialog" id="continue_btn_container" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-5 bg-info">

            <div class="alert alert-danger d-none" id="alert"></div>
            <div class="alert alert-success d-none" id="success"></div>
            <div id="ruler" class=""></div>

            <form autocomplete="off" id="order_designer" enctype="multipart/form-data">

                <input type="text" class="d-none" name="user_name" id="un" value="<?php echo $user['user_name'];?>">
                <input type="text" class="d-none" name="gig_id" id="gig_id" value="<?php echo $gig['gig_id'];?>">

                <div class="row">
                    <div class="col text-center">
                        <h3 class="text-white"> Order Now </h3>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col text-center">
                        <p class="text-dark"> Amount : <?php echo $gig['price'];?> </p>
                        <p class="text-dark"><?php echo $gig['d_date']; ?> Days Delivary</p>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col">
                    <label for="cmsg"><h5>Requirements : </h5></label>
                    <textarea name="req" class="form-control" style="background-color: #B9F8D3;" id="cmsg" rows="2"></textarea>
                    </div>
                </div>

                <div class="form-group text-center mt-3">
                    <button class="btn btn-success"> Order </button>
                </div>
            </div>

        </div>
    </div>
</div>






<div class="modal fade bd-example-modal-lg mt-5" tabindex="-1" role="dialog" id="contact_popup_container" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-5 bg-info">

            <div class="alert alert-danger d-none" id="alert"></div>
            <div class="alert alert-success d-none" id="success"></div>
            <div id="ruler" class=""></div>

            <form autocomplete="off" id="contact_designer" enctype="multipart/form-data">

                <input type="text" class="d-none" name="user_name" id="un" value="<?php echo $user['user_name'];?>">

                <div class="row">
                    <div class="col">
                        <h3 class="text-white"> Type Your Messages </h3>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col text-center">
                    <label for="msg"><h4 class="text-white">To : <span id="sender_id"></span></h4></label>
                    <textarea name="msg" class="form-control" style="background-color: #B9F8D3;" id="cmsg" rows="4"></textarea>
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