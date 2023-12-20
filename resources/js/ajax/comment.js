import data from "./route.js";
import "../ajax/setup.js"

$(document).ready(function () {
    function comment(comment, user) {
        const element = 
        `
        <div class="blog-container-detail-comments list">
            <div class="blog-container-detail-comments-user">
                <img src="/storage/upload/${user.avatar}">
                <p>${user.name}</p>
            </div>
            <div class="blog-container-detail-comments-content comment" id="${comment.id}">
                <div class="blog-container-detail-comments-content-icon">
                    <p id="content">${comment.content}</p>
                        <div class="blog-container-detail-comments-edit">
                            <span class="show-edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </span>
                            <span class="delete">
                                <i class="fa-solid fa-trash"></i>
                            </span>
                        </div>
                </div>
                <span id="time">${comment.created_at}</span>
            </div>
            <form id="formEdit" class="update hidden">
                <input type="hidden" id="id" name="id" value="${comment.id}">
                <input id="comment" name="comment" value="${comment.content}">
                <button type="submit"> 
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <span class="cancel-edit">
                    <i class="fa-solid fa-trash"></i>
                </span>
            </form>
        </div>
            `
        return element;
    }

    $('#createComment').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: data.route.createComment,
            type: 'POST',
             data: {
                content: $('#content').val(),
                blog_id: $('#blogId').val()
            },
            success:function(result) {
                $('#createComment')[0].reset();
                let newComment = comment(result.comment, result.user);
                let addComment = $("<div></div>").addClass('blog-container-detail-comments').html(newComment);
                $("#commentList").prepend(addComment);
            },
            error: function (err) {
                throw new Error(err);
            }
        })
    })

    $('#comments').on('click', '.show-edit', function(){
        let comment = $(this).closest('.comment');
        let form = comment.siblings('form');
        comment.hide();
        form.removeClass('hidden');
    })

    $('#comments').on('click', '.cancel-edit', function(){
        let form = $(this).closest('.list');
        form.find('form').addClass('hidden');
        form.find('.comment').show();
    })

    $('#comments').on('submit', '.update', function(event){
        event.preventDefault();
        let oldComment = $(this).siblings('.comment');
        let newComment = $(this).find('#comment').val();
        $.ajax({
            url: data.route.updateComment,
            type: 'PUT',
            data: {
                content: newComment,
            },
            success:function(result) {
                if (result) {
                    let comment = $('#commentList').find('.comment');
                    let form = comment.siblings('form');
                    form.addClass('hidden');
                    oldComment.find('p').text(newComment);
                    comment.show();  
                } 
            },
            error: function (err) {
                throw new Error(err);
            }
        })
    })

    $('#comments').on('click', '.delete', function(){
        let comment = $(this).closest('.userComment');
        $.ajax({
            url: data.route.deleteComment,
            type: 'DELETE',
            success:function(result) {
                if (result) {
                    comment.remove();
                } 
            },
            error: function (err) {
                throw new Error(err);
            }
        })
    })
})
