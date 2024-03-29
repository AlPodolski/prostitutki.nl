function deletePost(object) {

    var id = $(object).attr('data-id');

    $.ajax({
        type: 'POST',
        url: '/admin/posts/delete',
        data: 'id=' + id,
        async: false,
        dataType: "html",
        cache: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
        },
        success: function (data) {
            $(object).closest('tr').remove();
        },

    })
}

function deleteComment(object) {

    var id = $(object).attr('data-id');

    $.ajax({
        type: 'POST',
        url: '/admin/comments/delete',
        data: 'id=' + id,
        async: false,
        dataType: "html",
        cache: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
        },
        success: function (data) {
            $(object).closest('tr').remove();
        },

    })
}

function deleteClaim(object) {

    var id = $(object).attr('data-id');

    $.ajax({
        type: 'POST',
        url: '/admin/claim/delete',
        data: 'id=' + id,
        async: false,
        dataType: "html",
        cache: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
        },
        success: function (data) {
            $(object).closest('tr').remove();
        },

    })
}

function checkComment(object) {

    var id = $(object).attr('data-id');
    var url = $(object).attr('data-url');

    $.ajax({
        type: 'POST',
        url: url, //Путь к обработчику
        response: 'text',
        data: 'id=' + id,
        dataType: "html",
        headers: {
            'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
        },
        cache: false,
        success: function (data) {
            $(object).html('Подтверждено')
        }
    })

}

function check(object) {

    var id = $(object).attr('data-id');
    var url = $(object).attr('data-url');

    var check_photo = $(object).closest('tr').find('.check-photo');

    var check = '';

    if ($(check_photo).prop('checked')){
        check = '&check=true'
    }

    $.ajax({
        type: 'POST',
        url: url, //Путь к обработчику
        response: 'text',
        data: 'id=' + id + check,
        dataType: "html",
        headers: {
            'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
        },
        cache: false,
        success: function (data) {
            $(object).html('Подтверждено')
        }
    })

}

function check_all() {

    $(".check").each(function (index) {
        $(this).trigger('click')
    });

}
function getChat(object){

    var id = $(object).attr('data-id');
    var url = '/admin/chat/get';

    $('.chat__list-item').removeClass('selected-chat')

    $.ajax({
        type: 'POST',
        url: url, //Путь к обработчику
        response: 'text',
        data: 'id=' + id,
        dataType: "html",
        headers: {
            'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
        },
        cache: false,
        success: function (data) {
            $('.chat__dialog').html(data)
            $(object).addClass('selected-chat');
            $('.chat__dialog-list-wrap').scrollTop($('.chat__dialog-list-wrap').height() + 99999999);
        }
    })

}
function sendMessage(object){

    var message = $('.chatMessage').val()
    var id = $(object).attr('data-id')

    $.ajax({
        type: 'POST',
        url: '/admin/chat/send',
        async:false,
        data: 'message=' + message + '&id=' + id,
        dataType: "html",
        headers: {
            'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
        },
        cache: false,
        success: function (data){

            $('.chatMessage').val('')

            addMessage(data);

        },

    })
}

function addMessage(text){

    var message = '<div class="chat__dialog-list-item chat__dialog-list-item--qst">\n' +
        '                    <div class="chat__dialog-list-item-text">\n' +
        text +
        '                    </div>\n' +
        '                </div>';

    $('.chat__dialog-list').append(message);

    $('.chat__dialog-list-wrap').scrollTop($('.chat__dialog-list-wrap').height() + 99999999);

}

function updatePhone(object){

    var phone = $(object).siblings('.phone-change').val();
    var userId = $(object).attr('data-id');

    $.ajax({
        type: 'POST',
        url: "/admin/phone/update", //Путь к обработчику
        data: 'user_id=' + userId + '&phone=' + phone ,
        response: 'text',
        dataType: "html",
        headers: {
            'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
        },
        cache: false,
        success: function (data) {

            $(object).text('Готово');
            $('#chatMessage').text('Готово');

        }
    })

}
