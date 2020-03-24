$(".approve").click(function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "/approve.php",
        data: {
            id: $(this).attr('id')
        },
        success: function (result) {
            console.log(result);
        },
        error: function (result) {
            console.log(result.responseText);
        }
    });
});
