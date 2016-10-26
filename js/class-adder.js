// Snippet from http://stackoverflow.com/questions/12558311/add-remove-class-with-jquery-based-on-vertical-scroll?answertab=votes#tab-top
$(function() {
    //caches a jQuery object containing the header element
    var header = $(".page-nav");
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 600) {
            header.addClass("visible");
        } else {
            header.removeClass("visible");
        }
    });
});
