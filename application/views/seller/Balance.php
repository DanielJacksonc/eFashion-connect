<div class="full-row mt-2" style="background-image: url(<?php echo base_url('assets/bg/balance.jpg') ; ?>)">
  <div class="container">
      <div class="row mt-5 text-secondary ">
          <div class="col-sm-3 p-2 text-center border">
              <h4 class="text-primary">Net Balance</h4>
              <h3 class="mt-3">$ <?php echo number_format( $balance['net_bal'] , 2, '.', ''); ?></h3>
          </div>
          <div class="col-sm-3 p-2 text-center border">
              <h4 class="text-primary">Personal Balance</h4>
              <h3 class="mt-3">$ <?php echo number_format( $balance['personal_bal'] , 2, '.', '') ;?></h3>
          </div>
          <div class="col-sm-3 p-2 text-center border">
              <h4 class="text-primary">Earning</h4>
              <h3 class="mt-3">$ <?php echo number_format( $balance['earnings'] , 2, '.', '') ;?></h3>
          </div>
          <div class="col-sm-3 p-2 text-center border">
              <h4 class="text-primary">Total Expense</h4>
              <h3 class="mt-3">$ <?php echo number_format( $balance['expense'] , 2, '.', '') ;?></h3>
          </div>
      </div>
  </div>

  <div class="container mt-4">
      <div class="row">
          <div class="col text-center">
            <?php
              if ( $balance['personal_bal'] != 0 ) {
                ?>
                <button type="button" class="btn btn-secondary withdraw_popup">Withdraw</button>
                <?php
              }
              else {
                ?>
                <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Insufficient Balance" disabled >Withdraw</button>
                <?php
              }
            ?>
              
          </div>
      </div>
  </div>

  <div class="container mt-5">

    <div class="row">
      <div class="col text-primary">
        <h4>Designer Latest Transactions</h4>
      </div>
    </div>
    <hr>

    <div class="container">

      <div class="row mb-3 text-success">
        <div class="col-sm-1 text-center">
          <h6>SL.</h6>
        </div>

        <div class="col-sm-2 text-center">
          <h6>Method</h6>
        </div>

        <div class="col-sm-2 text-center">
          <h6>Sender</h6>
        </div>

        <div class="col-sm-2 text-center">
          <h6>Receiver</h6>
        </div>

        <div class="col-sm-2 text-center">
          <h6>Amount</h6>
        </div>

        <div class="col-sm-2 text-center">
          <h6>Status</h6>
        </div>

        <div class="col-sm-1 text-center">
          <h6>Message</h6>
        </div>

      </div>


      <?php
      $sl = 0;
      foreach ($withdrawals as $withdrawal ) {
        $sl++;
        ?>
          <div class="row text-dark rounded p-2 mt-2">

            <div class="col-sm-1 text-center">
              <div>#<?php echo $sl; ?> </div>
            </div>

            <div class="col-sm-2 text-center">
              <div><?php echo ($withdrawal['method'] == 'bank')? ucfirst($withdrawal['method']).' Transfer' : ucfirst($withdrawal['method']); ?></div>
            </div>

            <div class="col-sm-2 text-center">
              <div>e-fashion</div>
            </div>

            <div class="col-sm-2 text-center">
              <div><?php echo $withdrawal['user_name']; ?></div>
            </div>

            <div class="col-sm-2 text-center">
              <div><?php echo $withdrawal['amount']; ?></div>
            </div>

            <div class="col-sm-2 text-center">
              <?php
                  if ( $withdrawal['status'] == "Completed" ) {
                    echo "<div class='text-success'>" . $withdrawal['status'] . "</div>";
                  }
                  else if ( $withdrawal['status'] == "Rejected" ) {
                    echo "<div class='text-danger'>" . $withdrawal['status'] . "</div>";
                  }
                  else {
                    echo "<div class='text-secondary'>" . $withdrawal['status'] . "</div>";
                  }
              ?>
              
            </div>

            <p class="d-none" id="<?php echo 'msg-' . $withdrawal['id']; ?>"><?php echo $withdrawal['msg']; ?></p>
            <div class="col-sm-1 text-center">
              <button class="bg-success rounded w_msg" id="<?php echo $withdrawal['id']; ?>">MSG</button>
            </div>

          </div>
        <?php
      }
      ?>

    </div>

  </div>


  <div class="modal fade" id="withdraw_popup_container" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content bg-info">
        <div class="modal-header text-center">
          <h5 class="modal-title text-white" id="exampleModalLongTitle">Withdraw</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger d-none" id="alert"></div>

            <div class="container">
              <div class="row">
                <div class="col">
                  <button class="btn btn-secondary btn-success" id='paypal_method'>Paypal</button>
                  <button class="btn btn-secondary" id='bank_transfer_method' >Bank Transfer</button>
                </div>
              </div>
            </div>
            <hr>

            <div class="container text-white">
              <div class="row mt-2">
                <div class="col">
                  <label for="w_amount">Amount : </label>
                  <input type="number" style="background-color: #B9F8D3;" id="w_amount" class="form-control" placeholder="">
                </div>
              </div>
            </div>

            <div class="container text-white" id="paypal_form">
              <div class="row mt-2">
                <div class="col">
                  <label for="paypal_email">Paypal Email : </label>
                  <input type="email" style="background-color: #B9F8D3;" id="paypal_email" class="form-control border" placeholder="example@com">
                </div>
              </div>
            </div>

            <div class="container d-none text-white" id="bank_transfer_form">
              <div class="row mt-2 mb-2">
                  <div class="col">
                      <label for="bic">BIC (SWIFT) : </label>
                      <input type="text" style="background-color: #B9F8D3;" id="bic" class="form-control border">
                  </div>
              </div>
              <div class="row mb-2">
                  <div class="col">
                      <label for="name">Account Name : </label>
                      <input type="text" style="background-color: #B9F8D3;" id="name" class="form-control border">
                  </div>

              </div>
              <div class="row mb-2">
                  <div class="col">
                      <label for="acno">Account No. (IBAN) : </label>
                      <input type="number" style="background-color: #B9F8D3;" id="acno" class="form-control border">
                  </div>

              </div>
            </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-sm btn-success withdraw-btn">Withdraw</button>
        </div>
      </div>
    </div>
  </div>




  <div class="modal fade" id="w_msg_container" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content bg-info">
        <div class="modal-header text-center">
          <h5 class="modal-title text-secondary" id="exampleModalLongTitle">Withdraw Feedback</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger d-none" id="alert"></div>
            <div class="w_msg_c text-white"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div style="height:200px"></div>
</div>
