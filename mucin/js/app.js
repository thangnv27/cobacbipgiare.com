jQuery.noConflict();
var PPOFixed = {
    mainMenu: function () {
        jQuery('.fixedHeader').scrollToFixed({
            marginTop: jQuery('#wpadminbar').outerHeight(true),
            limit: jQuery('.footer').offset().top
        });
        /*var msie6 = $.browser == 'msie' && $.browser.version < 7;
        if (!msie6) {
            var top = jQuery('.rHeader').offset().top - parseFloat(jQuery('.rHeader').css('margin-top').replace(/auto/, 0));
            jQuery(window).scroll(function (event) {
                if (jQuery(this).scrollTop() >= top) {
                    var wpadminbar_height = 0;
                    if (jQuery(this).width() > 583) {
                        wpadminbar_height = jQuery('.rHeader').outerHeight(true);
                    }
                    jQuery('.rHeader').css({
                        'position': 'fixed',
                        'top': wpadminbar_height + 0,
                        'z-index': 1000
                    });
                } else {
                    jQuery('.rHeader').css({
                        'position': 'relative',
                        'top': 0,
                        'z-index': 10
                    });
                }
            });
        }*/
    },
    columns: function (col) {
        var summaries = jQuery(col);
        summaries.each(function (i) {
            var summary = jQuery(summaries[i]);
            var next = summaries[i + 1];

            summary.scrollToFixed({
                marginTop: jQuery('#wpadminbar').outerHeight(true) + jQuery(".rHeader").outerHeight(true),
                limit: function () {
                    var limit = 0;
                    if (next) {
                        limit = jQuery(next).offset().top - jQuery(this).outerHeight(true) - 10;
                    } else {
                        limit = jQuery('.footer').offset().top - jQuery(this).outerHeight(true) - 10;
                    }
                    return limit;
                },
                zIndex: 999
            });
        });
    }
};
jQuery(document).ready(function ($) {
    if (is_fixed_menu) {
        PPOFixed.mainMenu();
    }

    jQuery("#btnSearch").click(function () {
        if (jQuery(".search-form").is(":hidden")) {
            jQuery(".search-form").show();
            jQuery(".search-form input[name=s]").focus();
        } else {
            jQuery(".search-form").hide();
        }
    });
    jQuery(window).scroll(function () {
        if (jQuery(this).scrollTop() > 100) {
            jQuery('#toTop').fadeIn();
        } else if (jQuery(this).width() >= 1200) {
            jQuery('#toTop').fadeOut();
        } else {
            jQuery('#toTop').fadeOut();
        }
    });
    jQuery(".back-to-top").click(function () {
        scrollToElement("#header");
    });
    
    // Menu mobile
    jQuery(".menu-mobile").simpleSidebar({
        settings: {
            opener: "#menu",
            wrapper: "#wrapper",
            animation: {
                easing: "easeOutQuint"
            }
        },
        sidebar: {
            align: "left",
            width: 200,
            closingLinks: '.btn-close-menu'
        },
        mask: {
            //STYLE holds all CSS rules. Use this feature to stylize the mask.
            style: {
                //Default options.
                backgroundColor: 'transparent', //if you do not want any color use 'transparent'.
                opacity: 0.5, //if you do not want any opacity use 0.
                filter: 'Alpha(opacity=50)' //IE8 and earlier - If you do not want any opacity use 0.
                        //You can add more options.
            }
        }
    });
});