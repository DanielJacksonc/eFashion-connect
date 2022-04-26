<?php

$a = $c = $l = '';
if ( $active == 'a') {
    $a = 'text-success';
}
if ( $active == 'c') {
    $c = 'text-success';
}
if ( $active == 'l') {
    $l = 'text-success';
}

?>
<div class="full-row mt-2" style="background-image: url(<?php echo base_url('assets/bg/orders.jpg') ; ?>)">
    <div class="container">
        <div class="row mt-2">
            <div class="col">
                <h1>Manage Orders</h1>
            </div>
        </div>


        <div class="row mt-4">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-4">
                        <h5><a class="<?php echo $a; ?>" href="<?php echo base_url() . 's/orders/active' ?>">Activate</a></h5>
                    </div>
                    <div class="col-sm-4">
                        <h5 ><a class="<?php echo $c; ?>" href="<?php echo base_url() . 's/orders/completed' ?>">Completed</a></h5>
                    </div>
                    <!-- <div class="col-sm-4">
                        <h5><a class="<?php //echo $l; ?>"  href="<?php //echo base_url() . 'b/orders/late' ?>">Late</a></h5>
                    </div> -->
                </div>
            </div>
            <div class="col-sm-6">
                
            </div>
        </div>
        <hr>

        <div class="row">
            
            <div class="col-sm-3">
                <h6>DESIGNER</h6>
            </div>
            <div class="col-sm-5">
                <h6>GIG</h6>
            </div>
            <div class="col-sm-2">
                <h6>TOTAL</h6>
            </div>
            <div class="col-sm-2">
                <h6>DUE ON</h6>
            </div>
        </div>
        <hr>

        <?php

            foreach ( $orders as $order ) {
                ?>



                    <div class="row text-dark">
                        <div class="col-sm-3">

                            <div class="row">
                                <div class="col-3">
                                    <div>
                                        <?php

                                            if ( $images[$order['seller_id']] == '' ) {?><i class="flaticon-user flat-mini text-dark"></i><?php
                                            }
                                            else {?><img height="35" width="35" class="rounded-circle" src="<?php echo base_url().'resource/avtar/' . $images[$order['seller_id']] ;?>" alt="<?php echo $order['buyer_id'] ; ?>" ><?php
                                            }
                                        ?>
                                    </div>
                                    
                                </div>
                                <div class="col-9">
                                <div><?php echo $order['seller_id']; ?></div>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-5">
                            <div><a class="text-info" href="<?php echo base_url() . "s/manage_order/" . $order['order_id']; ?>"><?php echo $title [ $order['gig_id'] ] ; ?></a></div>
                        </div>
                        <div class="col-sm-2">
                            <div>$ <?php echo $order['amount']; ?></div>
                        </div>
                        <div class="col-sm-2">
                            <div><?php echo date('m/d/y', strtotime("+" . $order['d_date'] . "day", strtotime( $order['created_at'] ) ) ); ?></div>
                        </div>
                    </div>

                <?php


            }

        ?>
    </div>


    <div style="height: 250px"></div>
</div>

