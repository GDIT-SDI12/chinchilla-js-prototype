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

function savePost(postId) {
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

function removePost(postId) {
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
