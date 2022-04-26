
<div class="full-row mt-2" style="background-image: url(<?php echo base_url('assets/bg/orders.jpg') ; ?>)">
    <div class="container-fluid mt-3">
        <div class="row">

            <div class="col-md-3">
                <div class="row mt-2">
                    <div class="col text-center">
                        <h4 class="text-info"> Requirements </h4>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col text-center">
                        <p class="text-dark"><?php echo $order['des']; ?></p>
                    </div>
                </div>


            </div>

            <div class="col-md-6">

                <div class="row mt-2">
                    <div class="col text-center">
                        <h4 class="text-info"> Delivaries </h4>
                    </div>
                </div>

                <?php

                if ( empty ( $delivaries ) ) {
                    ?>
                        <div class="row mb-3 my-5">
                            <div class="col text-center">
                                <h6 class="text-danger"> No Delivary Yet </h6>
                            </div>
                        </div>

                    <?php

                }
                else {

                    foreach ( $delivaries as $delivary ) {
                        ?>

                        <div class="row mt-2 p-3" style="background-color: #B9F8D3;">

                            <div class="col text-center">
                                <div class="row">
                                    <?php 

                                        if ( $img == '' ) {?><i class="flaticon-user flat-small text-dark"></i><?php
                                        }
                                        else {?><img src="<?php echo base_url().'resource/avtar/' . $img  ;?>"class="rounded-circle" height="32" width="32"><?php
                                        }

                                    ?>
                                    <h4 class="ml-2" ><?php echo $order['seller_id']; ?></h4>
                                    <p class="ml-2"><?php echo " < " . $delivary['created_at'] . " >"; ?></p>
                                </div>

                                <div class="row">
                                    <a href="<?php echo $delivary['file']; ?>" target="_blank" ><?php echo $delivary['file_name']; ?></a>
                                </div>

                                <div class="row">
                                    <p><?php echo $delivary['des']; ?></p>
                                </div>

                            </div>

                        </div>

                        <?php
                    }

                }

                ?>

            </div>


            <div class="col-md-3">

                <div class="row">
                    <div class="col text-center">
                        <h4 class="text-info">Manage</h4>
                    </div>
                </div>

                <?php


                    if ( $order['status'] == 'a' ) {
                        ?>

                            <div class="row p-4 mt-3">
                                <div class="col">

                                    <div class="row">
                                        <div class="col text-center">
                                            <h6> Order Id</h6>
                                            <div><?php echo $order['order_id']; ?></div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col text-center">
                                            <h6> Due Date </h6>
                                            <div><?php echo date('m/d/y', strtotime("+" . $order['d_date'] . "day", strtotime( $order['created_at'] ) ) ); ?></div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col text-center">
                                            <button class="btn btn-secondary mark_as_submit"  data-toggle="modal" data-target="#complete_popup" > Mark As Complete </button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        <?php
                        
                    }

                    else if ( $order['status'] == 'w' ) {
                        ?>

                            <div class="row p-4 mt-3">
                                <div class="col">

                                    <div class="row">
                                        <div class="col text-center">
                                            <h6> Order Id</h6>
                                            <div><?php echo $order['order_id']; ?></div>
                                        </div>
                                    </div>
                                    <br>


                                    <div class="row">
                                        <div class="col text-center">
                                            <h6> Due Date</h6>
                                            <div><?php echo date('m/d/y', strtotime("+" . $order['d_date'] . "day", strtotime( $order['created_at'] ) ) ); ?></div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col text-center">
                                            <h5>Have you got the product ? </h5>
                                        </div>
                                    </div>


                                    <div class="row mt-4">
                                        <div class="col text-center">
                                            <button class="btn btn-secondary release_fund_submit"  data-toggle="modal" data-target="#release_fund_popup" > Release funds </button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        <?php
                        
                    }

                    else if ( $order['status'] == 'c' ) {
                        ?>

                            <div class="row p-4 mt-3">
                                <div class="col">

                                    <div class="row">
                                        <div class="col text-center">
                                            <h6> Order Id</h6>
                                            <div><?php echo $order['order_id']; ?></div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col text-center">
                                            <h6> Due Date</h6>
                                            <div><?php echo date('m/d/y', strtotime("+" . $order['d_date'] . "day", strtotime( $order['created_at'] ) ) ); ?></div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col text-center">
                                            <h6>This Order Has Been Completed</h6>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        <?php
                        
                    }

                ?>


            </div>
        </div>
    </div>



    <?php

        if ( $order['status'] == 'a' ) {
            ?>
                <div class="modal fade bd-example-modal-lg mt-5" tabindex="-1" role="dialog" id="complete_popup" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content p-5" style="background-color: #B9F8D3;">
                
                        <div class="alert alert-danger d-none" id="alert"></div>
                        <div id="ruler" class="">
                        </div>
                
                        <h1>Are You Sure to complete ?</h1><br><br>
                        <button class="btn btn-secondary order_complete_btn" id="<?php echo $order['order_id']; ?>"> Complete </button>
                
                    </div>
                </div>
                </div>
            <?php
        }

        else if ( $order['status'] == 'w' ) {
            ?>
                <div class="modal fade bd-example-modal-lg mt-5" tabindex="-1" role="dialog" id="release_fund_popup" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content p-5" style="background-color: #B9F8D3;">

                        <div class="alert alert-danger d-none" id="alert"></div>
                        <div id="ruler" class="">
                        </div>

                        <h1>Are You Sure to Release funds For Designer ?</h1><br><br>
                        <button class="btn btn-secondary release_fund_btn" id="<?php echo $order['order_id']; ?>"> Release </button>

                    </div>
                </div>
                </div>
            <?php
        }


    ?>

    <div style="height: 250px"></div>
</div>



