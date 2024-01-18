$(document).ready(function() {
    $('.delete-blog').click(function(e) {
        e.preventDefault();
        var id = $(this).attr("data-id");
        $("input:last").val(id);
        $('#popup').addClass("active");
    })
})
