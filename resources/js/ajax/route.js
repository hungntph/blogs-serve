const e = $('#route');

const comment = $('#commentRoute');

const data = {
    route: {
        like: e.attr('like-route'),
        createComment: comment.attr('comment-create-route'),
        updateComment: comment.attr('comment-update-route'),
        deleteComment: comment.attr('comment-delete-route'),
    }
};

export default data;
