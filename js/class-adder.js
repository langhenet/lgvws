// Snippet from http://stackoverflow.com/questions/12558311/add-remove-class-with-jquery-based-on-vertical-scroll?answertab=votes#tab-top
$(function() {
    //caches a jQuery object containing the header element
    var pagenav = $(".page-nav");
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 600) {
            pagenav.addClass("visible");
        } else {
            pagenav.removeClass("visible");
        }
    });
});

$(function() {
    //caches a jQuery object containing the header element
    var pagenav = $(".header");
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 100) {
            pagenav.addClass("sticky");
        } else {
            pagenav.removeClass("sticky");
        }
    });
});
