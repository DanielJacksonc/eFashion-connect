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

    $('#form_signup').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        var date = new Date();
        var fullDate = `${date.getDate()}-${date.getMonth() + 1}-${date.getFullYear()}`;
        formData.append("created_at", fullDate);
        console.log(formData)
        $.ajax({
            url: 'signup_submit',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(res) {

                console.log(res)

                if (res[0] == 1) {
                    if (res[1] == 'buyer') {
                        console.log("Program is entered");
                        location.href = "./b";
                    } else if (res[1] == 'seller') {
                        console.log("Program is entered");
                        location.href = "./s";
                    }

                } else {
                    error_message(res[1]);
                    alert.focus();
                }

            }
        })

    })

    $('#form_login').on('submit', function(e) {
        e.preventDefault();

        console.log("Auth Js : Login Form Click submit ");

        let formData = new FormData(this);

        $.ajax({
            url: 'login_submit',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',

            success: function(res) {

                console.log(res)

                if (res[0] == 1) {

                    if (res[1] == 'none') {
                        console.log("Program is entered");
                        location.href = "./admin";
                    }

                    if (res[1] == 'buyer') {
                        console.log("Program is entered");
                        location.href = "./b";
                    } else if (res[1] == 'seller') {
                        console.log("Program is entered");
                        location.href = "./s";
                    }

                } else {
                    error_message(res[1]);
                }
            }
        })

    })


    $('.contact_popup').on('click', function(e) {
        e.preventDefault();

        $.ajax({

            url: ajax_url + 'am_i_valid',
            type: 'post',
            dataType: 'json',
            success: function(res) {
                var gig_author = $("#un").val();

                if (res.valid == 1) {
                    if (res.username != gig_author) {
                        $('#contact_popup_container').modal('show');
                    }
                } else {
                    location.href = ajax_url + 'login';
                }
            }
        })

    })


    $('#contact_designer').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({

            url: ajax_url + 'contact_designer',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(res) {

                if (res[0] == 1) {
                    $('#contact_popup_container').modal('hide');
                } else {
                    error_message(res[1]);
                }
            }
        })
    })



    $('.continue_btn').on('click', function(e) {
        e.preventDefault();

        $.ajax({

            url: ajax_url + 'am_i_valid',
            type: 'post',
            dataType: 'json',
            success: function(res) {
                var gig_author = $("#un").val();

                if (res.valid == 1) {
                    if (res.username != gig_author) {
                        $('#continue_btn_container').modal('show');
                    }
                } else {
                    location.href = ajax_url + 'login';
                }
            }
        })

    })


    $('#order_designer').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({

            url: ajax_url + 'order_designer',
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


})