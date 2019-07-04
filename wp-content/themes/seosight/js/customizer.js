/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ($) {
    var $button = $('.user-menu.open-overlay'),
        $logo = $('.right-menu-wrap .logo'),
        $stunning = $('#stunning-header'),
        $footer = $('#site-footer'),
        $subscribe = $('#subscribe-section');

    // Header options.
    wp.customize('fw_options[logo-image]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $('.logo > img').attr('src', newval[1].value);
        });
    });
    wp.customize('fw_options[logo-title]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $('.logo-title').text(newval[0].value);
        });
    });
    wp.customize('fw_options[logo-subtitle]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $('.logo-sub-title').text(newval[0].value);
        });
    });
    wp.customize('fw_options[aside-panel]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            if (newval[0].value == '"yes"') {
                $button.removeClass('visual-hidden');
            } else {
                $button.addClass('visual-hidden');
            }
            if (newval[1].value == 'true') {
                $logo.removeClass('visual-hidden');
            } else {
                $logo.addClass('visual-hidden');
            }
            $('.right-menu-wrap .text').html(newval[2].value);
        });
    });
    /*Stunning header*/
    wp.customize('fw_options[stunning_text_color]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $stunning.addClass('font-color-custom');
            $stunning.css({"color": newval[0].value});
        });
    });
    wp.customize('fw_options[stunning_bg_color]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $stunning.css({'backgroundColor': newval[0].value});
        });
    });
    /*subscribe customize*/
    wp.customize('fw_options[subscribe_text_color]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $subscribe.addClass('font-color-custom');
            $subscribe.css({"color": newval[0].value});
        });
    });
    wp.customize('fw_options[subscribe_bg_image]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            if (newval[0].value == 'custom') {
                $subscribe.css({'backgroundImage': 'url(' + newval[3].value + ')'});
            } else {
                var templateUrl = theme_vars.templateUrl;
                $subscribe.css({'backgroundImage': 'url(' + templateUrl + '/images/' + newval[1].value + '.png)'});
            }
        });
    });
    wp.customize('fw_options[subscribe_bg_cover]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            if (newval[0].value == 'true') {
                $subscribe.css({'backgroundSize': 'cover'});
            } else {
                $subscribe.css({'backgroundSize': 'inherit'});
            }
        });
    });
    wp.customize('fw_options[subscribe_bg_color]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $subscribe.css({'backgroundColor': newval[0].value});
        });
    });
    /*Footer customize*/
    wp.customize('fw_options[footer_text_color]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $footer.addClass('font-color-custom');
            $footer.css({"color": newval[0].value});
        });
    });
    wp.customize('fw_options[footer_title_color]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $footer.addClass('font-color-custom');
            $('.footer .info .heading .heading-title, #site-footer .contacts-item .content .title, #site-footer a').css({"color": newval[0].value});
        });
    });
    wp.customize('fw_options[footer_bg_image]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            if (newval[0].value == 'custom') {
                $footer.css({'backgroundImage': 'url(' + newval[3].value + ')'});
            } else {
                var templateUrl = theme_vars.templateUrl;
                $footer.css({'backgroundImage': 'url(' + templateUrl + '/images/' + newval[1].value + '.png)'});
            }
        });
    });
    wp.customize('fw_options[footer_bg_cover]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            if (newval[0].value == 'true') {
                $footer.css({'backgroundSize': 'cover'});
            } else {
                $footer.css({'backgroundSize': 'inherit'});
            }
        });
    });
    wp.customize('fw_options[footer_bg_color]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $footer.css({'backgroundColor': newval[0].value});
        });
    });

    /*Copyright customize*/
    wp.customize('fw_options[footer_copyright]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $('.site-copyright-text').html(newval[0].value);
        });
    });
    wp.customize('fw_options[size_copyright_section]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $('.sub-footer').attr('class', '').addClass('sub-footer').addClass(newval[0].value);
        });
    });
    wp.customize('fw_options[copyright_bg_color]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $('.sub-footer').css({'backgroundColor': newval[0].value});
        });
    });
    wp.customize('fw_options[copyright_text_color]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $('.site-copyright-text').css('color', newval[0].value);
        });
    });
    wp.customize('fw_options[scroll_top_icon]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            var $button = $('.back-to-top');
            if (newval[1].value == 'true') {
                $button.addClass('back-to-top-fixed');
            } else {
                $button.removeClass('back-to-top-fixed');
            }
        });
    });


})(jQuery);


//console.log(newval);