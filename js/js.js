$(".approve").click(function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "./approve.php",
        data: {
            id: $(this).attr('id')
        },
        success: function (result) {
            location.reload();
        },
        error: function (result) {
            console.log(result.responseText);
        }
    });
});

function subscribePost(postId) {
    $.ajax({
        type: "POST",
        url: "./savePost.php",
        data: {
            id: postId
        },
        success: function (result) {
            location.reload();
        },
        error: function (result) {
            console.log(result.responseText);
        }
    });
}

function unsubscribePost(postId) {
    $.ajax({
        type: "POST",
        url: "./removePost.php",
        data: {
            id: postId
        },
        success: function (result) {
            location.reload();
        },
        error: function (result) {
            console.log(result.responseText);
        }
    });
}

$('#deletePostModal').on('show.bs.modal', function (event) {
    const postTitle = $(event.relatedTarget).data('title');
    const postId = $(event.relatedTarget).data('id');
    $(this).find("#deletePostId").attr("value", postId);
    $(this).find(".modal-body").find("#post-title").text(postTitle);
});

$('#editPostModal').on('show.bs.modal', function(event) {
    const id = $(event.relatedTarget).data('id');
    const type = $(event.relatedTarget).data('type');
    const title = $(event.relatedTarget).data('title');
    const description = $(event.relatedTarget).data('description');
    const image = $(event.relatedTarget).data('image');
    console.log(id + ' | ' + type + ' | ' + title + ' | ' + description + ' | ' + image);

    $(this).find("#title").attr("value", title);
    $(this).find("#description").val(description);
    
});