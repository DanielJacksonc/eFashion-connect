let current_id = '';
let current_img = '';
let last_msg_time = '';


$(document).ready(function() {

    const ajax_url = $("#ajax_url").text();
    console.log(ajax_url)

    const set_people = (peoples) => {

        let lists = $('.chat_list');

        if (peoples.length == 0 || peoples.length == lists.length) {
            return;
        } else {

            for (let i = 0; i < peoples.length; i++) {

                const user_name = peoples[i].user_name;

                let flag = 1;

                for (let j = 0; j < lists.length; j++) {
                    if (user_name == lists[j].id) {
                        flag = 0;
                        break;
                    }
                }

                if (flag == 1) {

                    let html = '<div class="chat_list" style="cursor: pointer;" id="' + user_name + '">' +
                        '<div class="chat_people">' +
                        '<div class="chat_img"> <img id="' + user_name + '-img" src="' + ajax_url + '/resource/avtar/' + peoples[i].avtar + '" alt="' + user_name + '"></div>' +
                        '<div class="chat_ib">' +
                        '<h5>' + user_name + '<span class="chat_date"></span></h5>' +
                        '<p id="' + user_name + '-msg">' + peoples[i].msg + '</p>' +
                        '</div>' +
                        '</div>' +
                        '</div>';

                    $("#chat_people").prepend(html);
                } else {

                    $("#" + user_name + "-msg").text(peoples[i].msg);
                }
            }
        }
    }

    const set_current_msg = (msg) => {

        if (msg.length == 0) {
            return;
        }

        console.log("last_msg_time : ", last_msg_time);
        let temp_time = ''

        for (let i = 0; i < msg.length; i++) {

            html = ''

            msg[i][1] = msg[i][1].replace("\t", "&emsp;");
            msg[i][1] = msg[i][1].replace("\n", "<br>");

            if (msg[i][0] == 'o') {
                html = '<div class="outgoing_msg">' +
                    '<div class="sent_msg">' +
                    '<p>' + msg[i][1] + ' <br> <a style="color:#ecf511;" href="' + ajax_url + '/resource/msg_file/' + msg[i][2] + '" target="_blank">' + msg[i][3] + '</a> </p>' +
                    // '<span class="time_date"> 11:01 AM    |    Today</span> </div>' +
                    '</div>';
            } else if (msg[i][0] == 'i') {

                var img_html = '';
                if (current_img == undefined) {
                    var img_html = '<i class="flaticon-user flat-mini text-white"></i>';
                } else {
                    var img_html = '<img src="' + current_img + '" alt="' + current_id + '" class="rounded-circle" height="29" width="30" >';
                }

                html = '<div class="incoming_msg mt-1">' +
                    '<div class="incoming_msg_img"> ' + img_html + ' </div>' +
                    '<div class="received_msg">' +
                    '<div class="received_withd_msg">' +
                    '<p>' + msg[i][1] + ' <br> <a href="' + ajax_url + '/resource/msg_file/' + msg[i][2] + '" target="_blank">' + msg[i][3] + '</a> </p>' +
                    // '<span class="time_date"> 11:01 AM    |    Today</span></div>' +
                    '</div>' +
                    '</div>';
            }

            $(".msg_container").append(html);
            temp_time = msg[i][4];

        }

        last_msg_time = temp_time
        console.log(last_msg_time);

    }


    $(document).on("click", ".chat_list", function() {

        let lists = $('.chat_list');
        let id = current_id = this.id;

        last_msg_time = '';

        current_img = $("#" + current_id + "-img").attr('src');
        $("#receiver_uid").val(current_id);

        if (lists.length > 0) {
            for (let i = 0; i < lists.length; i++) {
                const iid = lists[i].id;
                $('#' + iid).removeClass('active_chat')
            }
        }
        $('#' + id).addClass("active_chat");

        $(".msg_container").empty();


        $.ajax({
            url: ajax_url + 'b/get_messages_of_the_user',
            type: 'post',
            data: { id: current_id },
            dataType: 'json',
            success: function(res) {
                console.log(res);
                set_current_msg(res['msg']);
            }
        })


    });


    function get_event() {

        console.log("last_msg_time : ", last_msg_time);

        console.log('current_id is  : ', current_id);

        $.ajax({
            url: ajax_url + 'b/event',
            type: 'post',
            data: { id: current_id, time: last_msg_time },
            dataType: 'json',
            success: function(res) {
                console.log(res);
                set_people(res['peoples']);
                set_current_msg(res['msg']);
            }
        })

    }
    get_event();

    // Event Trigger
    setInterval(get_event, 5000);


    /**
     * Send msg to other people
     */

    $('#send_msg_to_man').on('submit', function(e) {
        e.preventDefault();

        if (current_id == '') {
            console.log("Current Id Is Empty");
        }

        var formData = new FormData(this);

        $.ajax({

            url: ajax_url + 'b/send_msg_to_man',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(res) {

                if (res[0] == 1) {
                    $("#file-input").val('');
                    $("#msg_text").val('');
                } else {

                }
            }
        })

    })




    //

    $(document).on("click", "#c-order", function() {

        remove_alert();
        remove_success();

        if (current_id == '') {
            return;
        }

        $("#buyer_name").val(current_id)
        $("#b-name").text(current_id)
        $("#b-name").removeClass("text-danger")
        $("#des").val('');
        $("#amount").val('');
        $("#d_date").val('');

    });



    $('#custom_order_request').on('submit', function(e) {
        e.preventDefault();

        if (current_id == '') {
            return;
        }

        var formData = new FormData(this);

        $.ajax({

            url: ajax_url + 'send_custom_order',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(res) {
                if (res[0] == 1) {
                    remove_alert();
                    success_message(res[1]);
                    $('#custom_order_modal').modal('hide');
                } else {
                    remove_success();
                    error_message(res[1]);
                }
            }
        })

    })



})