<div class="full-row mt-2" style="background-image: url(<?php echo base_url('assets/bg/orders.jpg') ; ?>)">

    <div class="container-fluid mt-2">
        <div class="row">

            <div class="col-sm-3">
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

            <div class="col-sm-6">

                <div class="row mt-2">
                    <div class="col text-center">
                        <h4 class="text-info" > Delivaries </h4>
                    </div>
                </div>


                <?php

                    if ( empty ( $delivaries ) ) {
                        ?>
                            <div class="row mb-3">
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
                                        <a href="<?php echo base_url() . "resource/delivary_file/" . $delivary['file']; ?>" target="_blank" ><?php echo $delivary['file_name']; ?></a>
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

            

            
            <div class="col-sm-3">
                <div class="row mt-2">
                    <div class="col text-center">
                        <h4 class="text-info">Manage</h4>
                    </div>
                </div>

                <div class="row p-4 mt-3">

                    <?php
                        if ( $order['status'] == 'a') {
                            ?>

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
                                        <button class="btn btn-success delivary_btn" id="<?php echo $order['order_id']; ?>" data-toggle="modal" data-target="#delivar_design" > Delivar Now </button>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                        else if ( $order['status'] == 'w') {

                            ?>
                            <div class="col">

                                <div class="row">
                                    <div class="col text-center">
                                        <h6> Order Id</h6>
                                        <div><?php echo $order['order_id']; ?></div>
                                    </div>
                                </div>
                                <br>


                                <div class="row mt-4">
                                    <div class="col text-center text-primary">
                                        <h5>STATUS</h5>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col text-center text-success">
                                        <h6> Please Delivar Physical product</h6>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col text-center text-success">
                                        <h6> Waiting For Shipping </h6>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        else if ( $order['status'] == 'c') {
                            ?>
                            <div class="col">

                                <div class="row">
                                    <div class="col text-center">
                                        <h6> Order Id</h6>
                                        <div><?php echo $order['order_id']; ?></div>
                                    </div>
                                </div>
                                <br>


                                <div class="row mt-4">
                                    <div class="col text-center text-primary">
                                        <h5>STATUS</h5>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col text-center text-success">
                                        <h6> Completed </h6>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }

                    ?>
                    
                </div>
            </div>

        </div>
    </div>


    <div style="height: 250px"></div>


    <div class="modal fade bd-example-modal-lg mt-5" tabindex="-1" role="dialog" id="delivar_design" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-5 bg-info">

            <div class="alert alert-danger d-none" id="alert"></div>
            <div class="alert alert-success d-none" id="success"></div>
            <div id="ruler" class="">
            </div>

            <form autocomplete="off" id="delivar_submit" enctype="multipart/form-data">

                <input type="text" class="d-none" name="order_id" id="order_id" >

                <div class="row mt-2">
                    <div class="col">
                    <label for="msg"><h5>Design Description :</h5> <span id="sender_id"></span></label>
                        <textarea name="msg" style="background-color: #B9F8D3;" class="form-control" id="d_des" rows="4"></textarea>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col text-center">
                        <input type="file" class="form-control-file" name="file" id="file" accept="*">
                    </div>
                </div>


                <div class="form-group text-center mt-3">
                    <button class="btn btn-secondary rounded"> Submit </button>
                </div>
            </form>

        </div>
    </div>
    </div>

</div>
