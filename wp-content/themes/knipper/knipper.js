(function ($) {
    $(document).ready(function () {
        $(window).resize(function () {
            if ($(window).width() < 769) {
                $(".brochure-heading-row").click(function () {
                    var rowID = $(this).attr('id');
                    $('#' + rowID + '-content').toggleClass("active-content");
                    $(this).toggleClass("open-row");
                });
                $(".case-study-heading-row").click(function () {
                    var rowID = $(this).attr('id');
                    $('#' + rowID + '-content').toggleClass("active-content");
                    $(this).toggleClass("open-row");
                });
                $(".video-heading-row").click(function () {
                    var rowID = $(this).attr('id');
                    $('#' + rowID + '-content').toggleClass("active-content");
                    $(this).toggleClass("open-row");
                });
            } //window width
        });
    });
})(jQuery);
// Mobile Menu Toggle
(function ($) {
    $(document).ready(function () {
        $(
            "body ul.et_mobile_menu li.menu-item-has-children, body ul.et_mobile_menu  li.page_item_has_children"
        ).append('<a href="#" class="mobile-toggle"></a>');
        $(
            "ul.et_mobile_menu li.menu-item-has-children .mobile-toggle, ul.et_mobile_menu li.page_item_has_children .mobile-toggle"
        ).click(function (event) {
            event.preventDefault();
            $(this).parent("li").toggleClass("dt-open");
            $(this).parent("li").find("ul.children").first().toggleClass("visible");
            $(this).parent("li").find("ul.sub-menu").first().toggleClass("visible");
        });
        iconFINAL = "P";
        $(
            "body ul.et_mobile_menu li.menu-item-has-children, body ul.et_mobile_menu li.page_item_has_children"
        ).attr("data-icon", iconFINAL);
        $(".mobile-toggle")
            .on("mouseover", function () {
                $(this).parent().addClass("is-hover");
            })
            .on("mouseout", function () {
                $(this).parent().removeClass("is-hover");
            });
    });
})(jQuery);