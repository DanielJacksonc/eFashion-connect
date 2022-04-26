

<div class="full-row mt-2" style="background-image: url(<?php echo base_url('assets/bg/orders.jpg') ; ?>)">

    <div class="container my-2">
        <div class="row">
            <div class="col text-center">
                <h4>Active Requests</h4>
            </div>
        </div>
    </div>

    <div class="container p-3" id="offer_container">

        <?php

            $jobs = array_reverse($jobs);
            foreach ( $jobs as $job ) {
                ?>

                    <div class="row text-dark border border-dark p-3 text-justify mb-3 rounded" id="c-<?php echo $job['job_id']; ?>" >
                        <div class="col-1 "> 
                            <?php
                                if ( $images[$job['job_id']] == '' ) {?><i class="flaticon-user flat-small text-dark"></i><?php
                                }
                                else {?><img class="rounded-circle" height="30" width="30" src="<?php echo base_url() . 'resource/avtar/' . $images[$job['job_id']];?>"/><?php
                                }
                            ?>
                        </div>
                        <div class="col-6 text-left"> <?php echo $job['des']; ?> </div>
                        <div class="col-2 text-center"><?php echo $job['category']; ?></div>
                        <div class="col-1 text-center">$ <?php echo $job['price']; ?></div>
                        <div class="col-2 text-center">
                            <button type="button" class="btn btn-secondary send_offer_btn" data-toggle="modal" data-target=".bd-example-modal-lg" id="<?php echo $job['job_id']; ?>" >
                                Send Offer 
                            </button>
                        </div>
                    </div>

                <?php
            }

        ?>

    </div>

    <div style="height:400px"></div>



    <div class="modal fade bd-example-modal-lg mt-5" tabindex="-1" role="dialog" id="myModal" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-4 bg-info">

            <div class="alert alert-danger d-none" id="alert"></div>
            <div class="alert alert-success d-none" id="success"></div>
            <div id="ruler" class="">
            </div>

            <form autocomplete="off" id="send_offer_form" enctype="multipart/form-data">

                <input type="text" class="d-none" name="job_id" id="job_id">

                <div class="row">
                    <div class="col text-center">
                        <h5>Select Your Gig</h5>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col text-center">
                        <select name="gig_id" id="" class="form-control" style="background-color: #B9F8D3;" >
                            <?php
                                foreach ( $gigs as $gig ) {
                                    echo "<option class='overflow-auto' value=" . $gig['gig_id'] . ">" . $gig['title'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>


                <div class="row mt-2">
                    <div class="col text-center"><h5>Description</h5>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col text-center">
                    <textarea name="offer_des" class="form-control" style="background-color: #B9F8D3;" id="offer_des" rows="4"></textarea>
                    </div>
                </div>

                <div class="row mt-2">

                    <div class="col-sm-6">
                        <div class="form-group text-center">
                            <label for="price"><h5>Price</h5></label>
                            <input type="number" class="form-control" style="background-color: #B9F8D3;" name="price" id="price" min="1">
                        </div>
                    </div>

                    <div class="col-sm-6">

                        <div class="form-group text-center">
                            <label for="price"><h5>Delivary Date </h5> </label>
                            <input type="number" class="form-control" style="background-color: #B9F8D3;" name="d_date" id="d_date" min="1">
                        </div>
                        
                    </div>

                </div>

                <div class="form-group text-center mt-3">
                    <button class="btn btn-secondary rounded"> Send </button>
                </div>


            </div>



        </div>
    </div>
    </div>

</div>
