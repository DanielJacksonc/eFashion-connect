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

    console.log(ajax_url)

    $('#btn-gig-submit').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: ajax_url + 'b/create_new_gig',
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
            url: ajax_url + 'b/setting_update',
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




    $('#genarate').on('click', function(e) {
        e.preventDefault();

        let len = $('.mes').length + 1
        console.log(len + 1)

        new_mes = '<div class="row mb-3 mes" id="md-' + len + '" >' +
            '<div class="col-lg-6">' +
            '<input name="mn' + len + '" type="text" class="form-control" placeholder="field" >' +
            '</div>' +

            '<div class="col-lg-5">' +
            '<input name="mv' + len + '" type="text" class="form-control" placeholder="value" >' +
            '</div>' +
            '<div class="col-lg-1">' +
            '</div>' +
            '</div>';
        console.log(new_mes);

        $("#mes-container").append(new_mes);
    })




    $('#btn-post-submit').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: ajax_url + 'b/post_submit',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(res) {
                console.log(res)
                if (res[0] == 1) {
                    remove_success();
                    success_message(res[1]);
                } else {
                    remove_alert();
                    error_message(res[1]);
                }
            }
        })

    })





    $('.send_msg').on('click', function(e) {
        e.preventDefault();
        let id = this.id
        $('#user_name').val(id);
        $('#sender_id').text(id);
        console.log(id);
    })



    $('#offer_send_msg').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        console.log(formData);

        $.ajax({
            url: ajax_url + 'b/offer_send_msg',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(res) {

                if (res[0] == 1) {
                    remove_alert();
                    remove_success();
                    success_message(res[1]);
                } else {
                    remove_alert();
                    remove_success();
                    error_message(res[1]);
                }
            }
        })

    })




    /**
     * Accepting Buyer Custom requests
     */

    $(document).on("click", ".accept_btn", function() {

        let order_id = this.id

        $.ajax({
            url: ajax_url + 'b/cumtom_order_submit',
            type: 'post',
            data: { order_id: order_id, state: 'accept' },
            dataType: 'json',
            success: function(res) {
                remove_alert();
                remove_success()
                if (res[0] == 1 && res[1] == 'accepted') {
                    $("#" + order_id + "-container").remove()
                    success_message(res[2]);
                } else if (res[0] == 1 && res[1] == 'rejected') {
                    $("#" + order_id + "-container").remove()
                    success_message(res[2]);
                } else {
                    error_message(res[1])
                }
            }
        })


    });

    $(document).on("click", ".reject_btn", function() {

        let order_id = this.id

        $.ajax({
            url: ajax_url + 'b/cumtom_order_submit',
            type: 'post',
            data: { order_id: order_id, state: 'reject' },
            dataType: 'json',
            success: function(res) {
                remove_alert();
                remove_success()
                if (res[0] == 1) {
                    $("#" + order_id + "-container").remove()
                    success_message(res[2]);
                } else {
                    error_message(" Request Error, Please Try Again ")
                }
            }
        })
    });




    ////////////////////////////////////////////////
    $(document).on("click", ".order_complete_btn", function() {

        let order_id = this.id
        console.log(order_id);

        $.ajax({
            url: ajax_url + 'b/complete_an_order',
            type: 'post',
            data: { order_id: order_id },
            success: function(res) {
                remove_alert();
                if (res == 1) {
                    location.href = ajax_url + "b/orders/waiting";
                } else {
                    error_message("Some Tecnical Issue , Try Again")
                }
            }
        })

    });

    ///////////////////////////////////////////////////

    $(document).on("click", ".release_fund_btn", function() {

        let order_id = this.id
        console.log(order_id);

        $.ajax({
            url: ajax_url + 'b/release_a_fund',
            type: 'post',
            data: { order_id: order_id },
            dataType: 'json',
            success: function(res) {
                remove_alert();
                if (res[0] == 1) {
                    location.href = ajax_url + "b/orders/completed";
                } else {
                    error_message("Some Tecnical Issue , Try Again")
                }
            }
        })

    });


    $(document).on("click", ".pay_popup", function() {
        remove_alert();
        $("#balance_amount").val("");
        $('#pay_popup_container').modal('show');
    });


    $(document).on("click", ".proceed-btn", function() {
        amount = $("#balance_amount").val();

        if (amount != '' && !isNaN(amount) && parseInt(amount) > 0) {
            location.href = ajax_url + "b/add_balance?amount=" + amount;
        } else {
            error_message("Please Put A Valid Amount");
        }
    });






})