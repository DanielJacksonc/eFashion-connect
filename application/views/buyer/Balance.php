<div class="full-row mt-2" style="background-image: url(<?php echo base_url('assets/bg/balance.jpg') ; ?>)">
    <div class="container">
        <div class="row mt-5 text-secondary ">
            <div class="col-sm-3 p-2 text-center border">
                <h4 class="text-primary">Net Balance</h4>
                <h3 class="mt-3"><?php echo number_format( $balance['net_bal'] , 2, '.', ''); ?></h3>
            </div>
            <div class="col-sm-3 p-2 text-center border">
                <h4 class="text-primary">Personal Balance</h4>
                <h3 class="mt-3"><?php echo number_format( $balance['personal_bal'] , 2, '.', '') ;?></h3>
            </div>
            <div class="col-sm-3 p-2 text-center border">
                <h4 class="text-primary">Earning</h4>
                <h3 class="mt-3"><?php echo number_format( $balance['earnings'] , 2, '.', '') ;?></h3>
            </div>
            <div class="col-sm-3 p-2 text-center border">
                <h4 class="text-primary">Total Expense</h4>
                <h3 class="mt-3"><?php echo number_format( $balance['expense'] , 2, '.', '') ;?></h3>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col text-center">
                <button type="button" class="btn btn-secondary pay_popup">Add Balance</button>
            </div>
        </div>
    </div>

    <div class="container mt-4">

      <div class="row">
        <div class="col text-success">
          <h4>Latest Transactions</h4>
        </div>
      </div>
      <hr>

      <div class="container">

        <div class="row mb-3">
          <div class="col-sm-2 text-center">
            <h5>SL.</h5>
          </div>

          <div class="col-sm-2 text-center">
            <h5>Transactions ID</h5>
          </div>

          <div class="col-sm-2 text-center">
            <h5>Sender</h5>
          </div>

          <div class="col-sm-2 text-center">
            <h5>Receiver</h5>
          </div>

          <div class="col-sm-2 text-center">
            <h5>Amount</h5>
          </div>

          <div class="col-sm-2 text-center">
            <h5>Status</h5>
          </div>
        </div>


        <?php

        $sl = 0;
        foreach ($transactions as $transaction ) {
          $sl++;
          ?>
            <div class="row mt-2">

              <div class="col-sm-2 text-center">
                <h6>#<?php echo $sl; ?> </h6>
              </div>

              <div class="col-sm-2 text-center">
                <h6><?php echo $transaction['tran_id']; ?> </h6>
              </div>

              <div class="col-sm-2 text-center">
                <h6><?php echo $transaction['sender']; ?></h6>
              </div>

              <div class="col-sm-2 text-center">
                <h6><?php echo $transaction['receiver']; ?></h6>
              </div>

              <div class="col-sm-2 text-center">
                <h6><?php echo $transaction['amount']; ?></h6>
              </div>

              <div class="col-sm-2 text-center">
                <h6><?php echo $transaction['status']; ?></h6>
              </div>
            </div>
          <?php
        }
        ?>

      </div>

    </div>


    <!-- Modal -->
    <div class="modal fade" id="pay_popup_container" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-info">
          <div class="modal-header text-center">
            <h5 class="modal-title text-white" id="exampleModalLongTitle">Pay With Paypal / Debit / Credit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="alert alert-danger d-none" id="alert"></div>
              <label for="b_amount" class="text-white" >Amount : </label>
              <input type="number" class="form-control" style="background-color: #B9F8D3;" id="balance_amount">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-sm btn-success proceed-btn">Proceed</button>
          </div>
        </div>
      </div>
    </div>
    <div style="height:200px"></div>
</div>