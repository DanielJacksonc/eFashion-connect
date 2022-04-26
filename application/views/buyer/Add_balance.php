<div class="full-row mt-2" style="background-image: url(<?php echo base_url('assets/bg/balance.jpg') ; ?>)">

<div class="container">
    <div class="row mt-4">
        <div class="col text-center">
            <h4>Amount : $ <?php echo $amount; ?></h4>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col text-center">

                <script src="https://www.paypal.com/sdk/js?client-id=AfWRseS_lGV3guZ9pcItVHygL97zahy7aIecmqVgKyebT9diO9i8E4Vo4Vym6O8Bm_3xUmLAOxhYWbn2&currency=USD"></script>
                <div id="paypal-button-container"></div>
                <script>
                paypal.Buttons({
                    // Sets up the transaction when a payment button is clicked
                    createOrder: (data, actions) => {
                    return actions.order.create({
                        purchase_units: [{
                        amount: {
                            value: '<?php echo $amount; ?>' // Can also reference a variable or function
                        }
                        }]
                    });
                    },
                    // Finalize the transaction after payer approval


                    onApprove: (data, actions) => {
                    return actions.order.capture().then(function(orderData) {

                        console.log(orderData);
                        const element = document.getElementById('paypal-button-container');

                        $(document).ready(function () {
                            // Start Paypal Loading 
                            $("#paypal_loading").removeClass("d-none");
                            
                            const ajax_url = $("#ajax_url").text();

                            $.ajax({
                                url: ajax_url + 'b/paypal_transaction_complete',
                                type: 'post',
                                data: { orderID: orderData.id },
                                dataType: 'json',
                                success: function (res) {
                                    if ( res[0] == 1 ) {
                                        element.innerHTML = '<h3>You Have Successfully Paid!</h3>';
                                        $("#hhh2").css("height", "600px");
                                    }
                                    else {
                                        element.innerHTML = '<h3>'+ res[1] +'</h3>';
                                    }
                                    
                                    $("#paypal_loading").addClass("d-none");
                                }
                            })

                        })
                        
                    });
                    }

                }).render('#paypal-button-container');
                </script>
        </div>
    </div>
</div>




<div class="d-none" id="paypal_loading">
<html><body><div id="paypal-overlay-uid_516010cfa9_mtm6ntc6mja" class="paypal-overlay-context-popup paypal-checkout-overlay"><a href="#" class="paypal-checkout-close" aria-label="close" role="button"></a><div class="paypal-checkout-modal"><div class="paypal-checkout-logo"><img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMzIiIHZpZXdCb3g9IjAgMCAyNCAzMiIgcHJlc2VydmVBc3BlY3RSYXRpbz0ieE1pbllNaW4gbWVldCIgeG1sbnM9Imh0dHA6JiN4MkY7JiN4MkY7d3d3LnczLm9yZyYjeDJGOzIwMDAmI3gyRjtzdmciPjxwYXRoIGZpbGw9IiNmZmZmZmYiIG9wYWNpdHk9IjAuNyIgZD0iTSAyMC45MjQgNy4xNTcgQyAyMS4yMDQgNS4wNTcgMjAuOTI0IDMuNjU3IDE5LjgwMSAyLjM1NyBDIDE4LjU4MyAwLjk1NyAxNi40MyAwLjI1NyAxMy43MTYgMC4yNTcgTCA1Ljc1OCAwLjI1NyBDIDUuMjkgMC4yNTcgNC43MjkgMC43NTcgNC42MzQgMS4yNTcgTCAxLjM1OCAyMy40NTcgQyAxLjM1OCAyMy44NTcgMS42MzkgMjQuMzU3IDIuMTA3IDI0LjM1NyBMIDYuOTc1IDI0LjM1NyBMIDYuNjk0IDI2LjU1NyBDIDYuNiAyNi45NTcgNi44ODEgMjcuMjU3IDcuMjU1IDI3LjI1NyBMIDExLjM3NSAyNy4yNTcgQyAxMS44NDQgMjcuMjU3IDEyLjMxMSAyNi45NTcgMTIuNDA1IDI2LjQ1NyBMIDEyLjQwNSAyNi4xNTcgTCAxMy4yNDcgMjAuOTU3IEwgMTMuMjQ3IDIwLjc1NyBDIDEzLjM0MSAyMC4yNTcgMTMuODA5IDE5Ljg1NyAxNC4yNzcgMTkuODU3IEwgMTQuODQgMTkuODU3IEMgMTguODY0IDE5Ljg1NyAyMS45NTQgMTguMTU3IDIyLjg5IDEzLjE1NyBDIDIzLjM1OCAxMS4wNTcgMjMuMTcyIDkuMzU3IDIyLjA0OCA4LjE1NyBDIDIxLjc2NyA3Ljc1NyAyMS4yOTggNy40NTcgMjAuOTI0IDcuMTU3IEwgMjAuOTI0IDcuMTU3Ij48L3BhdGg+PHBhdGggZmlsbD0iI2ZmZmZmZiIgb3BhY2l0eT0iMC43IiBkPSJNIDIwLjkyNCA3LjE1NyBDIDIxLjIwNCA1LjA1NyAyMC45MjQgMy42NTcgMTkuODAxIDIuMzU3IEMgMTguNTgzIDAuOTU3IDE2LjQzIDAuMjU3IDEzLjcxNiAwLjI1NyBMIDUuNzU4IDAuMjU3IEMgNS4yOSAwLjI1NyA0LjcyOSAwLjc1NyA0LjYzNCAxLjI1NyBMIDEuMzU4IDIzLjQ1NyBDIDEuMzU4IDIzLjg1NyAxLjYzOSAyNC4zNTcgMi4xMDcgMjQuMzU3IEwgNi45NzUgMjQuMzU3IEwgOC4yODYgMTYuMDU3IEwgOC4xOTIgMTYuMzU3IEMgOC4yODYgMTUuNzU3IDguNzU0IDE1LjM1NyA5LjMxNSAxNS4zNTcgTCAxMS42NTUgMTUuMzU3IEMgMTYuMjQzIDE1LjM1NyAxOS44MDEgMTMuMzU3IDIwLjkyNCA3Ljc1NyBDIDIwLjgzMSA3LjQ1NyAyMC45MjQgNy4zNTcgMjAuOTI0IDcuMTU3Ij48L3BhdGg+PHBhdGggZmlsbD0iI2ZmZmZmZiIgb3BhY2l0eT0iMSIgZD0iTSA5LjUwNCA3LjE1NyBDIDkuNTk2IDYuODU3IDkuNzg0IDYuNTU3IDEwLjA2NSA2LjM1NyBDIDEwLjI1MSA2LjM1NyAxMC4zNDUgNi4yNTcgMTAuNTMyIDYuMjU3IEwgMTYuNzExIDYuMjU3IEMgMTcuNDYxIDYuMjU3IDE4LjIwOCA2LjM1NyAxOC43NzIgNi40NTcgQyAxOC45NTggNi40NTcgMTkuMTQ2IDYuNDU3IDE5LjMzMyA2LjU1NyBDIDE5LjUyIDYuNjU3IDE5LjcwNyA2LjY1NyAxOS44MDEgNi43NTcgQyAxOS44OTQgNi43NTcgMTkuOTg3IDYuNzU3IDIwLjA4MiA2Ljc1NyBDIDIwLjM2MiA2Ljg1NyAyMC42NDMgNy4wNTcgMjAuOTI0IDcuMTU3IEMgMjEuMjA0IDUuMDU3IDIwLjkyNCAzLjY1NyAxOS44MDEgMi4yNTcgQyAxOC42NzcgMC44NTcgMTYuNTI1IDAuMjU3IDEzLjgwOSAwLjI1NyBMIDUuNzU4IDAuMjU3IEMgNS4yOSAwLjI1NyA0LjcyOSAwLjY1NyA0LjYzNCAxLjI1NyBMIDEuMzU4IDIzLjQ1NyBDIDEuMzU4IDIzLjg1NyAxLjYzOSAyNC4zNTcgMi4xMDcgMjQuMzU3IEwgNi45NzUgMjQuMzU3IEwgOC4yODYgMTYuMDU3IEwgOS41MDQgNy4xNTcgWiI+PC9wYXRoPjwvc3ZnPg" alt="" role="presentation" class="paypal-logo paypal-logo-pp paypal-logo-color-white"><img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAxcHgiIGhlaWdodD0iMzIiIHZpZXdCb3g9IjAgMCAxMDEgMzIiIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaW5ZTWluIG1lZXQiIHhtbG5zPSJodHRwOiYjeDJGOyYjeDJGO3d3dy53My5vcmcmI3gyRjsyMDAwJiN4MkY7c3ZnIj48cGF0aCBmaWxsPSIjZmZmZmZmIiBkPSJNIDEyLjIzNyAyLjggTCA0LjQzNyAyLjggQyAzLjkzNyAyLjggMy40MzcgMy4yIDMuMzM3IDMuNyBMIDAuMjM3IDIzLjcgQyAwLjEzNyAyNC4xIDAuNDM3IDI0LjQgMC44MzcgMjQuNCBMIDQuNTM3IDI0LjQgQyA1LjAzNyAyNC40IDUuNTM3IDI0IDUuNjM3IDIzLjUgTCA2LjQzNyAxOC4xIEMgNi41MzcgMTcuNiA2LjkzNyAxNy4yIDcuNTM3IDE3LjIgTCAxMC4wMzcgMTcuMiBDIDE1LjEzNyAxNy4yIDE4LjEzNyAxNC43IDE4LjkzNyA5LjggQyAxOS4yMzcgNy43IDE4LjkzNyA2IDE3LjkzNyA0LjggQyAxNi44MzcgMy41IDE0LjgzNyAyLjggMTIuMjM3IDIuOCBaIE0gMTMuMTM3IDEwLjEgQyAxMi43MzcgMTIuOSAxMC41MzcgMTIuOSA4LjUzNyAxMi45IEwgNy4zMzcgMTIuOSBMIDguMTM3IDcuNyBDIDguMTM3IDcuNCA4LjQzNyA3LjIgOC43MzcgNy4yIEwgOS4yMzcgNy4yIEMgMTAuNjM3IDcuMiAxMS45MzcgNy4yIDEyLjYzNyA4IEMgMTMuMTM3IDguNCAxMy4zMzcgOS4xIDEzLjEzNyAxMC4xIFoiPjwvcGF0aD48cGF0aCBmaWxsPSIjZmZmZmZmIiBkPSJNIDM1LjQzNyAxMCBMIDMxLjczNyAxMCBDIDMxLjQzNyAxMCAzMS4xMzcgMTAuMiAzMS4xMzcgMTAuNSBMIDMwLjkzNyAxMS41IEwgMzAuNjM3IDExLjEgQyAyOS44MzcgOS45IDI4LjAzNyA5LjUgMjYuMjM3IDkuNSBDIDIyLjEzNyA5LjUgMTguNjM3IDEyLjYgMTcuOTM3IDE3IEMgMTcuNTM3IDE5LjIgMTguMDM3IDIxLjMgMTkuMzM3IDIyLjcgQyAyMC40MzcgMjQgMjIuMTM3IDI0LjYgMjQuMDM3IDI0LjYgQyAyNy4zMzcgMjQuNiAyOS4yMzcgMjIuNSAyOS4yMzcgMjIuNSBMIDI5LjAzNyAyMy41IEMgMjguOTM3IDIzLjkgMjkuMjM3IDI0LjMgMjkuNjM3IDI0LjMgTCAzMy4wMzcgMjQuMyBDIDMzLjUzNyAyNC4zIDM0LjAzNyAyMy45IDM0LjEzNyAyMy40IEwgMzYuMTM3IDEwLjYgQyAzNi4yMzcgMTAuNCAzNS44MzcgMTAgMzUuNDM3IDEwIFogTSAzMC4zMzcgMTcuMiBDIDI5LjkzNyAxOS4zIDI4LjMzNyAyMC44IDI2LjEzNyAyMC44IEMgMjUuMDM3IDIwLjggMjQuMjM3IDIwLjUgMjMuNjM3IDE5LjggQyAyMy4wMzcgMTkuMSAyMi44MzcgMTguMiAyMy4wMzcgMTcuMiBDIDIzLjMzNyAxNS4xIDI1LjEzNyAxMy42IDI3LjIzNyAxMy42IEMgMjguMzM3IDEzLjYgMjkuMTM3IDE0IDI5LjczNyAxNC42IEMgMzAuMjM3IDE1LjMgMzAuNDM3IDE2LjIgMzAuMzM3IDE3LjIgWiI+PC9wYXRoPjxwYXRoIGZpbGw9IiNmZmZmZmYiIGQ9Ik0gNTUuMzM3IDEwIEwgNTEuNjM3IDEwIEMgNTEuMjM3IDEwIDUwLjkzNyAxMC4yIDUwLjczNyAxMC41IEwgNDUuNTM3IDE4LjEgTCA0My4zMzcgMTAuOCBDIDQzLjIzNyAxMC4zIDQyLjczNyAxMCA0Mi4zMzcgMTAgTCAzOC42MzcgMTAgQyAzOC4yMzcgMTAgMzcuODM3IDEwLjQgMzguMDM3IDEwLjkgTCA0Mi4xMzcgMjMgTCAzOC4yMzcgMjguNCBDIDM3LjkzNyAyOC44IDM4LjIzNyAyOS40IDM4LjczNyAyOS40IEwgNDIuNDM3IDI5LjQgQyA0Mi44MzcgMjkuNCA0My4xMzcgMjkuMiA0My4zMzcgMjguOSBMIDU1LjgzNyAxMC45IEMgNTYuMTM3IDEwLjYgNTUuODM3IDEwIDU1LjMzNyAxMCBaIj48L3BhdGg+PHBhdGggZmlsbD0iI2ZmZmZmZiIgZD0iTSA2Ny43MzcgMi44IEwgNTkuOTM3IDIuOCBDIDU5LjQzNyAyLjggNTguOTM3IDMuMiA1OC44MzcgMy43IEwgNTUuNzM3IDIzLjYgQyA1NS42MzcgMjQgNTUuOTM3IDI0LjMgNTYuMzM3IDI0LjMgTCA2MC4zMzcgMjQuMyBDIDYwLjczNyAyNC4zIDYxLjAzNyAyNCA2MS4wMzcgMjMuNyBMIDYxLjkzNyAxOCBDIDYyLjAzNyAxNy41IDYyLjQzNyAxNy4xIDYzLjAzNyAxNy4xIEwgNjUuNTM3IDE3LjEgQyA3MC42MzcgMTcuMSA3My42MzcgMTQuNiA3NC40MzcgOS43IEMgNzQuNzM3IDcuNiA3NC40MzcgNS45IDczLjQzNyA0LjcgQyA3Mi4yMzcgMy41IDcwLjMzNyAyLjggNjcuNzM3IDIuOCBaIE0gNjguNjM3IDEwLjEgQyA2OC4yMzcgMTIuOSA2Ni4wMzcgMTIuOSA2NC4wMzcgMTIuOSBMIDYyLjgzNyAxMi45IEwgNjMuNjM3IDcuNyBDIDYzLjYzNyA3LjQgNjMuOTM3IDcuMiA2NC4yMzcgNy4yIEwgNjQuNzM3IDcuMiBDIDY2LjEzNyA3LjIgNjcuNDM3IDcuMiA2OC4xMzcgOCBDIDY4LjYzNyA4LjQgNjguNzM3IDkuMSA2OC42MzcgMTAuMSBaIj48L3BhdGg+PHBhdGggZmlsbD0iI2ZmZmZmZiIgZD0iTSA5MC45MzcgMTAgTCA4Ny4yMzcgMTAgQyA4Ni45MzcgMTAgODYuNjM3IDEwLjIgODYuNjM3IDEwLjUgTCA4Ni40MzcgMTEuNSBMIDg2LjEzNyAxMS4xIEMgODUuMzM3IDkuOSA4My41MzcgOS41IDgxLjczNyA5LjUgQyA3Ny42MzcgOS41IDc0LjEzNyAxMi42IDczLjQzNyAxNyBDIDczLjAzNyAxOS4yIDczLjUzNyAyMS4zIDc0LjgzNyAyMi43IEMgNzUuOTM3IDI0IDc3LjYzNyAyNC42IDc5LjUzNyAyNC42IEMgODIuODM3IDI0LjYgODQuNzM3IDIyLjUgODQuNzM3IDIyLjUgTCA4NC41MzcgMjMuNSBDIDg0LjQzNyAyMy45IDg0LjczNyAyNC4zIDg1LjEzNyAyNC4zIEwgODguNTM3IDI0LjMgQyA4OS4wMzcgMjQuMyA4OS41MzcgMjMuOSA4OS42MzcgMjMuNCBMIDkxLjYzNyAxMC42IEMgOTEuNjM3IDEwLjQgOTEuMzM3IDEwIDkwLjkzNyAxMCBaIE0gODUuNzM3IDE3LjIgQyA4NS4zMzcgMTkuMyA4My43MzcgMjAuOCA4MS41MzcgMjAuOCBDIDgwLjQzNyAyMC44IDc5LjYzNyAyMC41IDc5LjAzNyAxOS44IEMgNzguNDM3IDE5LjEgNzguMjM3IDE4LjIgNzguNDM3IDE3LjIgQyA3OC43MzcgMTUuMSA4MC41MzcgMTMuNiA4Mi42MzcgMTMuNiBDIDgzLjczNyAxMy42IDg0LjUzNyAxNCA4NS4xMzcgMTQuNiBDIDg1LjczNyAxNS4zIDg1LjkzNyAxNi4yIDg1LjczNyAxNy4yIFoiPjwvcGF0aD48cGF0aCBmaWxsPSIjZmZmZmZmIiBkPSJNIDk1LjMzNyAzLjMgTCA5Mi4xMzcgMjMuNiBDIDkyLjAzNyAyNCA5Mi4zMzcgMjQuMyA5Mi43MzcgMjQuMyBMIDk1LjkzNyAyNC4zIEMgOTYuNDM3IDI0LjMgOTYuOTM3IDIzLjkgOTcuMDM3IDIzLjQgTCAxMDAuMjM3IDMuNSBDIDEwMC4zMzcgMy4xIDEwMC4wMzcgMi44IDk5LjYzNyAyLjggTCA5Ni4wMzcgMi44IEMgOTUuNjM3IDIuOCA5NS40MzcgMyA5NS4zMzcgMy4zIFoiPjwvcGF0aD48L3N2Zz4" alt="" role="presentation" class="paypal-logo paypal-logo-paypal paypal-logo-color-white"></div><div class="paypal-checkout-message"></div><div class="paypal-checkout-loader"><div class="paypal-spinner"></div></div></div><div class="paypal-checkout-iframe-container"></div><style nonce="">
        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja {
            position: absolute;
            z-index: 2147483647;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;

            transform: translate3d(0, 0, 0);

            background-color: black;
            background-color: rgba(0, 0, 0, 0.8);
            background: radial-gradient(50% 50%, ellipse closest-corner, rgba(0,0,0,0.6) 1%, rgba(0,0,0,0.8) 100%);

            color: #fff;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja a {
            color: #fff;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja .paypal-checkout-close:before,
        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja .paypal-checkout-close:after {
            background-color: #fff;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-popup {
            cursor: pointer;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja a {
            text-decoration: none;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja .paypal-checkout-modal {
            font-family: "HelveticaNeue", "HelveticaNeue-Light", "Helvetica Neue Light", helvetica, arial, sans-serif;
            font-size: 14px;
            text-align: center;

            box-sizing: border-box;
            max-width: 350px;
            top: 50%;
            left: 50%;
            position: absolute;
            transform: translateX(-50%) translateY(-50%);
            cursor: pointer;
            text-align: center;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-loading .paypal-checkout-message, #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-loading .paypal-checkout-continue {
            display: none;
        }

        .paypal-checkout-loader {
            display: none;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-loading .paypal-checkout-loader {
            display: block;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja .paypal-checkout-modal .paypal-checkout-logo {
            cursor: pointer;
            margin-bottom: 30px;
            display: inline-block;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja .paypal-checkout-modal .paypal-checkout-logo img {
            height: 36px;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja .paypal-checkout-modal .paypal-checkout-logo img.paypal-checkout-logo-pp {
            margin-right: 10px;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja .paypal-checkout-modal .paypal-checkout-message {
            font-size: 15px;
            line-height: 1.5;
            padding: 10px 0;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .paypal-checkout-message, #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .paypal-checkout-continue {
            display: none;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja .paypal-checkout-modal .paypal-checkout-continue {
            font-size: 15px;
            line-height: 1.35;
            padding: 10px 0;
            font-weight: bold;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja .paypal-checkout-modal .paypal-checkout-continue a {
            border-bottom: 1px solid white;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja .paypal-checkout-close {
            position: absolute;
            right: 16px;
            top: 16px;
            width: 16px;
            height: 16px;
            opacity: 0.6;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-loading .paypal-checkout-close {
            display: none;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja .paypal-checkout-close:hover {
            opacity: 1;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja .paypal-checkout-close:before, .paypal-checkout-close:after {
            position: absolute;
            left: 8px;
            content: ' ';
            height: 16px;
            width: 2px;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja .paypal-checkout-close:before {
            transform: rotate(45deg);
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja .paypal-checkout-close:after {
            transform: rotate(-45deg);
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja .paypal-checkout-iframe-container {
            display: none;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .paypal-checkout-iframe-container,
        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .paypal-checkout-iframe-container > .outlet,
        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .paypal-checkout-iframe-container > .outlet > iframe {
            max-height: 95vh;
            max-width: 95vw;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .paypal-checkout-iframe-container-full,
        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .paypal-checkout-iframe-container-full > .outlet,
        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .paypal-checkout-iframe-container-full > .outlet > iframe {
            height: 100vh;
            max-width: 100vw;
            width: 100vw;
        }

        @media screen and (max-width: 470px) {
            #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .paypal-checkout-iframe-container,
            #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .paypal-checkout-iframe-container > .outlet,
            #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .paypal-checkout-iframe-container > .outlet > iframe {
                max-height: 85vh;
            }
            #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .paypal-checkout-iframe-container-full,
            #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .paypal-checkout-iframe-container-full > .outlet,
            #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .paypal-checkout-iframe-container-full > .outlet > iframe {
                height: 100vh;
            }
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .paypal-checkout-iframe-container {

            display: block;

            position: absolute;

            top: 50%;
            left: 50%;

            min-width: 450px;

            transform: translate(-50%, -50%);
            transform: translate3d(-50%, -50%, 0);

            border-radius: 10px;
            overflow: hidden;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .outlet {

            position: relative;

            transition: all 0.3s ease;
            animation-duration: 0.3s;
            animation-fill-mode: forwards !important;

            min-width: 450px;
            max-width: 450px;
            width: 450px;
            height: 535px;

            background-color: white;

            overflow: auto;

            opacity: 0;
            transform: scale3d(.3, .3, .3);

            -webkit-overflow-scrolling: touch;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .outlet > iframe {
            position: absolute;
            top: 0;
            left: 0;
            transition: opacity .4s ease-in-out;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .outlet > iframe.component-frame {
            z-index: 100;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .outlet > iframe.prerender-frame {
            z-index: 200;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .outlet > iframe.visible {
            opacity: 1;
            z-index: 200;
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .outlet > iframe.invisible {
            opacity: 0;
            z-index: 100;
        }

        @media screen and (max-width: 470px) {

            #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .paypal-checkout-iframe-container,
            #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .outlet {
                min-width: 100%;
                min-width: calc(100% - 20px);

                max-width: 100%;
                max-width: calc(100% - 20px);
            }
        }

        #paypal-overlay-uid_516010cfa9_mtm6ntc6mja.paypal-overlay-context-iframe .outlet iframe {
            width: 1px;
            min-width: 100%;
            height: 100%;
        }

        @keyframes show-component {
            from {
                opacity: 0;
                transform: scale3d(.3, .3, .3);
            }

            to {
                opacity: 1;
                transform: scale3d(1, 1, 1);
            }
        }

        @keyframes hide-component {
            from {
                opacity: 1;
                transform: scale3d(1, 1, 1);
            }

            to {
                opacity: 0;
                transform: scale3d(.3, .3, .3);
            }
        }

        .paypal-spinner {
            height: 30px;
            width: 30px;
            display: inline-block;
            box-sizing: content-box;
            opacity: 1;
            filter: alpha(opacity=100);
            animation: rotation .7s infinite linear;
            border-left: 8px solid rgba(0, 0, 0, .2);
            border-right: 8px solid rgba(0, 0, 0, .2);
            border-bottom: 8px solid rgba(0, 0, 0, .2);
            border-top: 8px solid #fff;
            border-radius: 100%
        }

        @keyframes rotation {
            from {
                transform: rotate(0deg)
            }
            to {
                transform: rotate(359deg)
            }
        }
    </style></div></body></html>
</div>


<div id="hhh2" style="height:130px"></div>

</div>