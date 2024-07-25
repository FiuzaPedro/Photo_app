$('.preview').click(function () {
    let currentSrc = $(this).attr('src');

    $(".modalPreview").css({
        backgroundImage: "url(" + currentSrc + ")",
        display: "flex"
    });
    $('.modalPreview').fadeIn(200);
})
$('#closePreview').click(function () {
    $(this).parent().fadeOut(200)
})