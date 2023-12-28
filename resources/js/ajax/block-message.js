import "../ajax/setup.js"

$(document).ready(function() {
    window.Echo.private('user.{{ auth()->user()?->id }}').listen('.user.message', (e) => {
        $.ajax({
            type: 'POST',
            url: '{{ route("logout") }}',
            success: function() {
                $('#box').addClass("block");
                $('#blockPopup').addClass("show");
            }
        });
    })
})
