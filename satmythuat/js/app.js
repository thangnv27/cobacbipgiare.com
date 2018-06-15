var viewport_width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
var viewport_height = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
var PPOFixed = {
    mainMenu:function(){
        /*jQuery('.main-menu').scrollToFixed( {
            marginTop: jQuery('#wpadminbar').outerHeight(true),
            limit: jQuery('.fanfacebook').offset().top
        });*/
        var msie6 = jQuery.browser == 'msie' && jQuery.browser.version < 7;
        if (!msie6) {
            var top = jQuery('.desktop-header .menu').offset().top - parseFloat(jQuery('.desktop-header .menu').css('margin-top').replace(/auto/, 0));
            jQuery(window).scroll(function(event){
                if (jQuery(this).scrollTop() >= top){
                    var wpadminbar_height = 0;
                    if(jQuery(this).width() > 583){
                        wpadminbar_height = jQuery('#wpadminbar').outerHeight(true);
                    }
                    jQuery('.desktop-header .menu').css({
                        'position':'fixed',
                        'top':wpadminbar_height + 0,
                        'z-index':1000
                    });
                } else {
                    jQuery('.desktop-header .menu').css({
                        'position':'relative',
                        'top':0,
                        'z-index':1000
                    });
                }
            });
        }
    },
    columns:function(col){
        var nav_height = jQuery('#wpadminbar').outerHeight(true) + jQuery(".desktop-header .menu").outerHeight(true);
        var summaries = jQuery(col);
        summaries.each(function(i) {
            var summary = jQuery(summaries[i]);
            var next = summaries[i + 1];

            summary.scrollToFixed({
                marginTop: nav_height,
                limit: function() {
                    var limit = 0;
                    if (next) {
                        limit = jQuery(next).offset().top - jQuery(this).outerHeight(true) - 10;
                    }else if(jQuery("#related-product").length > 0){
                        limit = jQuery('#related-product').offset().top - jQuery(this).outerHeight(true) - 10;
                    }else if(jQuery("#before-footer").length > 0){
                        limit = jQuery('#before-footer').offset().top - jQuery(this).outerHeight(true) - 10;
                    }else{
                        limit = jQuery('#footer').offset().top - jQuery(this).outerHeight(true) - 10;
                    }
                    return limit;
                },
                zIndex: 999
            });
        });
    }
};
this.imagePreview = function () {
    xOffset = 10;
    yOffset = 30;
    jQuery("a.preview").hover(function (e) {
        this.t = this.title;
        this.title = "";
        var c = (this.t != "") ? "<br/>" + this.t : "";
        jQuery("body").append("<p id='preview'><img src='" + this.rel + "' alt='Image preview' />" + c + "</p>");
        jQuery("#preview").css("top", (e.pageY - xOffset) + "px").css("left", (e.pageX + yOffset) + "px").fadeIn("fast");
    }, function () {
        this.title = this.t;
        jQuery("#preview").remove();
    });
    jQuery("a.preview").mousemove(function (e) {
        jQuery("#preview").css("top", (e.pageY - xOffset) + "px").css("left", (e.pageX + yOffset) + "px");
    });
};
jQuery(document).ready(function ($) {
//    PPOFixed.sidebar();
    if(is_fixed_menu){
        PPOFixed.mainMenu();
    }
    if(viewport_width > 991 && jQuery("#sidebar").height() < jQuery("#sidebar").prev().height()){
        PPOFixed.columns(jQuery("#sidebar .widget").get(jQuery("#sidebar .widget").length - 1));
    }
    if(!is_mobile && viewport_width > 991){
        imagePreview();
    }
    
    // Expand/Collapse menu on sidebar
    jQuery(".sidebar .widget .menu li.menu-item-has-children > ul.sub-menu").hide();
    jQuery(".sidebar .widget .menu li.menu-item-has-children.current-menu-item > ul.sub-menu").show();
    jQuery(".sidebar .widget .menu li.menu-item-has-children.current-menu-parent > ul.sub-menu").show();
    if(viewport_width > 991){
        jQuery(".sidebar .widget .menu > li.menu-item-has-children > ul.sub-menu").show();
        jQuery(".sidebar .widget .menu > li.menu-item-has-children").addClass('dropdown');
        jQuery(".sidebar .widget .menu li.menu-item-has-children.current-menu-parent").addClass('dropdown');
    }
    jQuery(".sidebar .widget .menu > li.menu-item-has-children > a").click(function (){
        if(jQuery(this).parent().hasClass('dropdown')){
            jQuery(this).parent().removeClass('dropdown');
            jQuery(this).next().slideUp();
        } else {
            jQuery(this).parent().addClass('dropdown');
            jQuery(this).next().slideDown();
        }
        return false;
    });
    
    // Back to top
    jQuery("#back-top").click(function (){
        jQuery("html, body").animate({ scrollTop: 0 }, "slow");
    });

    // Menu mobile
    jQuery('button.left-menu').click(function (){
        var effect = jQuery(this).attr('data-effect');
        if(jQuery(this).parent().parent().hasClass('mobile-clicked')){
            jQuery('.st-menu').animate({
                width: 0
            }).css({
                display: 'none',
                transform: 'translate(0px, 0px)',
                transition: 'transform 400ms ease 0s'
            });
            jQuery(this).parent().parent().addClass('mobile-unclicked').removeClass('mobile-clicked').css({
                transform: 'translate(0px, 0px)',
                transition: 'transform 400ms ease 0s'
            });
            jQuery(this).parent().parent().parent().removeClass('st-menu-open ' + effect);
//            jQuery("#overlay").hide();
        } else {
            jQuery(this).parent().parent().parent().addClass('st-menu-open ' + effect);
            jQuery('.st-menu').animate({
                width: 250
            }).css({
                display: 'block',
                transform: 'translate(250px, 0px)',
                transition: 'transform 400ms ease 0s'
            });
            jQuery(this).parent().parent().addClass('mobile-clicked').removeClass('mobile-unclicked').css({
                transform: 'translate(250px, 0px)',
                transition: 'transform 400ms ease 0s'
            });
//            jQuery("#overlay").show();
        }
    });
    
    jQuery("#search").focusin(function (){
        jQuery(this).prev().hide();
    });
    jQuery("#search").focusout(function (){
        jQuery(this).prev().show();
    });
    jQuery(".right-menu").click(function (){
        setLocation(cartUrl);
    });
    /*
    jQuery(window).load(function (){
        var popular_product_items = 4, popular_product_margin = 30;
        if(viewport_width >= 992 && viewport_width < 1199){
            // some code
        } else if(viewport_width >= 768 && viewport_width < 992){
            popular_product_items = 3;
        } else if(viewport_width >= 600 && viewport_width < 768){
            popular_product_items = 2;
        } else if(viewport_width > 360 && viewport_width < 600){
            popular_product_items = 2;
            popular_product_margin = 15;
        } else if(viewport_width <= 360){
            popular_product_items = 1;
            popular_product_margin = 0;
        }
        if(jQuery('.list-product .flexslider').length > 0){
            jQuery('.list-product .flexslider').each(function (){
                jQuery(this).show().flexslider({
                    animation: "slide",
                    pauseOnHover: true,
                    mousewheel: false,
                    controlNav: false,
                    reverse: true,
                    minItems: popular_product_items,
                    maxItems: popular_product_items,
                    itemWidth: 300,
                    itemMargin: popular_product_margin,
                    prevText: "<",
                    nextText: ">"
                });
            });
        }
    });*/
    
    jQuery('.list-product .flexslider').show();
    jQuery('.owl-carousel').owlCarousel({
        autoplay: true,
        loop: true,
        margin: 30,
        responsiveClass: true,
        nav: true,
        navText: ['<','>'],
        dots: false,
        responsive: {
            0: {
                items: 1,
                margin: 0
            },
            361: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            }
        }
    });
});