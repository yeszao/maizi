(function ($) {
    $(document).ready(function () {
        // Fade In and Out when Scroll
        $(window).scroll(function () {
            if ($(this).scrollTop() > 350) {
                $('.scroll-top').fadeIn();
            } else {
                $('.scroll-top').fadeOut();
            }
        });
        // Scroll to Top
        $('.scroll-top').click(function (e) {
            e.preventDefault();
            $("html, body").animate({scrollTop: 0}, 100);
            return false;
        });

        // Sidebar menu
        $('aside .menu-item a').click(function(e) {
            var self = $(this);
            if (self.attr('href') === '#') {
                e.preventDefault();
            }
            $('.menu-item').not(self.parents()).removeClass('current-menu-item');
            self.parent().addClass('current-menu-item');
        });
    });
})(jQuery);