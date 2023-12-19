import data from "./route.js";
import "../ajax/setup.js"

$(document).ready(function() {
    $('#toggleLike').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: data.route.like,
            type: 'POST',
            data: {
                blog_id: $('#blogId').val()
            },

            success:function(result) {
                $('#totalLike').html(result.total);
                if (result.checkLike) {
                    $('i').removeClass('active');
                } else {
                    $('i').addClass('active');
                }
            }
        });
    })
})
