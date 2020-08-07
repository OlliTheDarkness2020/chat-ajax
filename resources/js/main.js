$(document).ready(function() {
    if (location.pathname === '/auth') {
        $('form').submit(function() {
            let name = $('#name').val();
            if (name.length === 0 || name.length > 16) {
                return false;
            }
            localStorage.setItem('chat_name', name);
        });
        return;
    } else if (localStorage.getItem('chat_name') == null) {
        location.href = '/auth';
        return;
    }

    let $field = $('.send-message');

    let sendMessage = function() {
        let name = localStorage.getItem('chat_name');

        if (name == null) {
            location.href = '/auth';
            return false;
        }

        if ($field.val().length === 0) {
            return false;
        }

        $.ajax('/chat', {
            type: 'POST',
            data: {
                name: name,
                body: $field.val(),
            },
        });

        $field.val('');
        return false;
    };
    $('.send-message-btn').click(sendMessage);
    $field.keypress(function(e) {
        if (e.key === 'Enter') {
            sendMessage();
            return false;
        }
        return true;
    });

    let $wrap = $('.msg-wrap');
    let scrollDown = function () {
        $($wrap).scrollTop($($wrap)[0].scrollHeight);
    }
    scrollDown();

    let sub = function() {
        $.ajax('/chat', {
            type: 'GET',
        }).done((data) => {
            data = JSON.parse(data);
            if (data.message != null) {
                $wrap.append(data.message);
            }
            if (data.new_name != null) {
                $('.conversation-wrap').append(data.new_name);
            }
            setTimeout(scrollDown, 10);
        }).always(() => {
            sub();
        });
    }
    sub();
});
