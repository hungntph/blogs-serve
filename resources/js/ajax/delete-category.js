$(document).ready(function() {
    $('.delete-category').click(function(e) {
        e.preventDefault();
        var id = $(this).attr("data-id");
        $("input:last").val(id);
        $('#popup').addClass("active");
    })
})
