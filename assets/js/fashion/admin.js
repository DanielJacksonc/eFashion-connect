$(document).ready(function() {

    const ajax_url = $("#ajax_url").text();
    console.log("Admin js working")

    $('.acp').on('click', function(e) {
        e.preventDefault();

        const id = this.id.substring(4);
        const msg = $("#msg-" + id).val();
        $.ajax({

            url: ajax_url + 'admin/a_withraw',
            type: 'post',
            data: { id: id, msg: msg },
            dataType: 'json',
            success: function(res) {
                if (res[0] == 1) {
                    $("#" + id).empty();
                    $("#" + id).append('<div class="col"><div class="alert alert-success"> Successfully Accepted! </div></div>');


                } else {
                    console.log("server error, Contact to developer");

                }
            }
        })

    })


    $('.rej').on('click', function(e) {
        e.preventDefault();

        let id = this.id.substring(4);
        const msg = $("#msg-" + id).val();

        $.ajax({

            url: ajax_url + 'admin/r_withraw',
            type: 'post',
            data: { id: id, msg: msg },
            dataType: 'json',
            success: function(res) {
                if (res[0] == 1) {
                    $("#" + id).empty();
                    $("#" + id).append('<div class="col"><div class="alert alert-danger"> Successfully Rejected! </div></div>');

                } else {
                    console.log("server error, Contact to developer");

                }
            }
        })

    })

})