
<div class="container-fluid p-5 mt-3">
    <div class="row">
        <div class="col-sm-1 text-center"><h5>#SL</h5></div>
        <div class="col-sm-2 text-center"><h5>User Name</h5></div>
        <div class="col-sm-1 text-center"><h5>Amount</h5></div>
        <div class="col-sm-2 text-center"><h5>Method</h5></div>
        <div class="col-sm-2 text-center"><h5>Details</h5></div>
        <div class="col-sm-2 text-center"><h5>Message</h5></div>
        <div class="col-sm-2 text-center"><h5>Action</h5></div>
    </div>
    <hr>

    <?php

    $sl = 0;
    foreach( $withdrawals as $withdrawal ) {
        $sl++;
        ?>
            <div class="row mb-3 bg-light p-2" id="<?php echo $withdrawal['id']; ?>">
                <div class="col-sm-1 text-center"><h6> <?php echo $sl; ?></h6></div>
                <div class="col-sm-2 text-center"><h6><?php echo $withdrawal['user_name']; ?></h6></div>
                <div class="col-sm-1 text-center"><h6>$ <?php echo $withdrawal['amount']; ?></h6></div>
                <div class="col-sm-2 text-center"><h6><?php echo ($withdrawal['method'] == 'bank')? ucfirst($withdrawal['method']).' Transfer' : ucfirst($withdrawal['method']); ?></h6></div>
                <div class="col-sm-2">
                    <?php

                        if ( $withdrawal['method'] == 'paypal' ) {
                            echo $withdrawal['paypal'];
                        }
                        else {
                            ?>
                                <div class="row"><div class="col">BIC : <?php echo $withdrawal['swift']; ?></div></div>
                                <div class="row"><div class="col">Name : <?php echo $withdrawal['account_name']; ?></div></div>
                                <div class="row"><div class="col">IBAN : <?php echo $withdrawal['account_no']; ?></div></div>
                            <?php
                        }

                    ?>
                </div>
                <div class="col-sm-2 text-center"><textarea name="msg" class="form-control" rows="1" id="<?php echo 'msg-' . $withdrawal['id']; ?>"></textarea></div>

                <div class="col-sm-1 text-center">
                    <button class="btn btn-sm btn-success acp" id="<?php echo 'acp-' . $withdrawal['id']; ?>">Accept</button>
                </div>

                <div class="col-sm-1 text-center">
                    <button class="btn btn-sm btn-danger rej" id="<?php echo 'rej-' . $withdrawal['id']; ?>">Reject</button>
                </div>
            </div>

        <?php
    }

    ?>
    
</div>

