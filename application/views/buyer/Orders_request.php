
<div class="full-row mt-2" style="background-image: url(<?php echo base_url('assets/bg/orders.jpg') ; ?>)">
    <div class="container">

        <div class="alert alert-danger d-none" id="alert"></div>
        <div class="alert alert-success d-none" id="success"></div>
        <div id="ruler" class=""></div>

        <div class="row mt-3">
            <div class="col text-center">
                <h4>Designer Custom Order Requests</h4>
            </div>
        </div>
        <hr>

        <?php

            if ( empty($orders)  ) {
                ?>
                <div class="row mt-5">
                    <div class="col text-center">
                        <h4>There Is No Designer Custom Requests</h4>
                    </div>
                </div>
                <?php
            }

            else {

                ?>
                    <div class="row m-4">
                        <div class="col-sm-2">
                            <h6>Designer Name</h6>
                        </div>
                        <div class="col-sm-2">
                            <h6>GIG</h6>
                        </div>
                        <div class="col-sm-3">
                            <h6>Description</h6>
                        </div>
                        <div class="col-sm-1">
                            <h6>Amount</h6>
                        </div>
                        <div class="col-sm-2">
                            <h6>Delivary Time</h6>
                        </div>
                        <div class="col-sm-1">
                            <h6>Accept</h6>
                        </div>
                        <div class="col-sm-1">
                            <h6>Reject</h6>
                        </div>
                    </div>

                <?php

                foreach ( $orders as $order ) {
                    ?>
                        <div class="row m-4 text-dark" id="<?php echo $order['order_id']; ?>-container">
                            <div class="col-sm-2">
                                <?php echo $order['seller_id']; ?>
                            </div>
                            <div class="col-sm-2">
                                <?php echo $order['gig_id']; ?>
                            </div>
                            <div class="col-sm-3">
                                <?php echo $order['des']; ?>
                            </div>
                            <div class="col-sm-1">
                                <?php echo $order['amount']; ?>
                            </div>
                            <div class="col-sm-2">
                                <?php echo $order['d_date']; ?>
                            </div>
                            <div class="col-sm-1">
                                <button class="btn btn-sm btn-success accept_btn" id = "<?php echo $order['order_id']; ?>" > Accept </button>
                            </div>
                            <div class="col-sm-1">
                                <button class="btn btn-sm btn-danger reject_btn" id = "<?php echo $order['order_id']; ?>" > Reject </button>
                            </div>
                        </div>

                    <?php
                }

            }




        ?>


    </div>
    <div style="height: 300px"></div>
</div>