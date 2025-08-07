'use strict';

(function ($) {
    var site_layout = localStorage.getItem('site_layout');
    $('body').addClass(site_layout);

    $(window).on('load', function () {
        if ($('body').hasClass('horizontal-side-menu') && $(window).width() > 768) {
            if ($('body').hasClass('layout-container')) {
                $('.side-menu .side-menu-body').wrap('<div class="container"></div>');
            } else {
                $('.side-menu .side-menu-body').wrap('<div class="container-fluid"></div>');
            }
            setTimeout(function () {
                $('.side-menu .side-menu-body > ul').append('<li><a href="#"><span>سایر</span></a><ul></ul></li>');
            }, 100);
            $('.side-menu .side-menu-body > ul > li').each(function () {
                var index = $(this).index(),
                    $this = $(this);
                if (index > 7) {
                    setTimeout(function () {
                        $('.side-menu .side-menu-body > ul > li:last-child > ul').append($this.clone());
                        $this.addClass('d-none');
                    }, 100);
                }
            });
        }
    });

    $(document).on('click', '[data-attr="layout-builder-toggle"]', function () {
        $('.layout-builder').toggleClass('show');
        return false;
    });

})(jQuery);
