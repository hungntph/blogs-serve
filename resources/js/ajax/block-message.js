import "../ajax/setup.js";

$(document).ready(function() {
    let id = $('#box').attr('data');
    let url = $('#box').attr("logout-route");

    window.Echo.private('user.' + id).listen('.user.message', (e) => {
        $.ajax({
            type: 'POST',
            url,
            success: function() {
                $('#box').addClass("block");
                $('#blockPopup').addClass("show");
                $('#navbar').find('input, button').attr('disabled','disabled');
                $('a').removeAttr('href');
                $('img, a').removeAttr('onclick');
            }
        });
    })
})
