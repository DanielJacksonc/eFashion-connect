let job_id = '';
let withdrawl_method = 'paypal';

let alert = document.getElementById('alert')
let success = document.getElementById('success')

const error_message = (message) => {
    alert.classList.remove('d-none');
    alert.innerHTML = "<strong>Error!</strong> " + message;
}
const success_message = (message) => {
    success.classList.remove('d-none');
    success.innerHTML = "<strong>Success !</strong> " + message;
}
const remove_alert = () => {
    alert.classList.add('d-none');
    alert.innerHTML = "";
}
const remove_success = () => {
    success.classList.add('d-none');
    success.innerHTML = "";
}



$(document).ready(function() {

    const ajax_url = $("#ajax_url").text();

    $('#btn-gig-submit').on('submit', function(e) {
        e.preventDefault();

        console.log(ajax_url);

        var formData = new FormData(this);

        $.ajax({
            url: ajax_url + 's/create_new_gig',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(res) {
                console.log(res)
                if (res[0] == 1) {

                    success_message(res[1]);
                } else {
                    remove_alert();
                    error_message(res[1]);
                }
            }
        })

    })


    $('#update_profile').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        console.log(formData);
        $.ajax({
            url: ajax_url + 's/setting_update',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(res) {

                if (res[0] == 1) {
                    success_message(res[1]);
                } else {
                    error_message(res[1]);
                }
            }
        })
    })



    /**
     *  Function For sending Offers
     */

    $('.send_offer_btn').on('click', function(e) {
        $("#job_id").val(this.id)
    })



    $('#send_offer_form').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        console.log(formData);

        $.ajax({
            url: ajax_url + 's/send_offer',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(res) {

                if (res[0] == 1) {
                    remove_alert()
                    remove_success()

                    success_message(res[2]);
                    $("#c-" + res[1]).remove()

                    $('#myModal').modal('hide')

                } else {

                    remove_alert()
                    remove_success()
                    error_message(res[1]);
                }

                $("#job_id").val('')
                $("#offer_des").val('')
                $("#price").val('')
                $("#d_date").val('')

            }
        })

    })






    $('.delivary_btn').on('click', function(e) {
        e.preventDefault();

        console.log(this.id)
        $("#order_id").val(this.id);

    })



    $('#delivar_submit').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({

            url: ajax_url + 's/delivar_submit',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(res) {
                if (res[0] == 1) {
                    location.reload();

                } else {
                    remove_alert();
                    error_message(res[1])
                }
            }
        })

    })


    $(document).on("click", ".withdraw_popup", function() {
        remove_alert();
        $('#withdraw_popup_container').modal('show');
    });

    $(document).on("click", "#paypal_method", function() {
        remove_alert();
        withdrawl_method = 'paypal';
        // Change Color Of button
        $("#paypal_method").addClass("btn-success");
        $("#bank_transfer_method").removeClass("btn-success");

        // Showing dialouge
        $('#paypal_form').removeClass('d-none');
        $('#bank_transfer_form').addClass('d-none');
    });

    $(document).on("click", "#bank_transfer_method", function() {
        remove_alert();
        withdrawl_method = 'bank';
        // Change Color Of button
        $("#bank_transfer_method").addClass("btn-success");
        $("#paypal_method").removeClass("btn-success");


        // Showing dialouge
        $('#bank_transfer_form').removeClass('d-none');
        $('#paypal_form').addClass('d-none');
    });


    $(document).on("click", ".withdraw-btn", function() {

        remove_alert();

        var pm = sw = an = ac = '';
        var w_amount = $("#w_amount").val()
        if (w_amount == '' || w_amount == '0') {
            error_message("Please Put A Amount");
            return;
        }


        if (withdrawl_method == 'paypal') {
            pm = $('#paypal_email').val();
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(pm)) {
                pm = $('#paypal_email').val();
            } else {
                error_message("Paypal Email Is Not Valid");
                return;
            }
        } else if (withdrawl_method == 'bank') {
            sw = $('#bic').val();
            an = $('#name').val();
            ac = $('#acno').val();
        } else {
            error_message("No Withdrawal Method Found");
            return;
        }

        const withdraw = {
            amount: w_amount,
            method: withdrawl_method,
            paypal: pm,
            swift: sw,
            account_name: an,
            account_no: ac
        }

        // Start ajax
        $.ajax({
            url: ajax_url + 's/withdraw',
            type: 'post',
            data: withdraw,
            dataType: 'json',
            success: function(res) {
                if (res[0] == 1) {
                    location.reload();
                } else {
                    remove_alert();
                    error_message(res[1])
                }
            }
        })





        // amount = $("#balance_amount").val();

        // if ( amount != '' && !isNaN(amount) && parseInt(amount) > 0 ) {
        // 	location.href = ajax_url + "b/add_balance?amount=" + amount;
        // }
        // else {
        // 	error_message("Please Put A Valid Amount");
        // }
    });


    $('.w_msg').on('click', function(e) {
        e.preventDefault();

        const id = this.id;

        const msg = $("#msg-" + id).text();

        if (msg != '') {
            $(".w_msg_c").text(msg)
        } else {
            $(".w_msg_c").text('Pending')
        }



        $('#w_msg_container').modal('show')



    })


})