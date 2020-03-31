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

function reversePostActiveness(postId) {
    console.log(postId);
    $.ajax({
        type: "POST",
        url: "./reversePostActiveness.php",
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


//Pass correct data into deletion confirmation dialog
$('#deletePostModal').on('show.bs.modal', function (event) {
    const postTitle = $(event.relatedTarget).data('title');
    const postId = $(event.relatedTarget).data('id');
    $(this).find("#deletePostId").attr("value", postId);
    $(this).find(".modal-body").find("#post-title").text(postTitle);
});
