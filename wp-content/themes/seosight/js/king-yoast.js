/*********************************************************************
 *   Script for YOAST SEO Analyzis enable
 * *******************************************************************/

"use strict";
var cruminaKingYoast = {
    busy: false,
    content: '',

    init: function () {
        YoastSEO.app.registerPlugin('CruminaYoast', {status: 'loading'});

        this.getContent();
    },

    getContent: function () {
        var _this = this;

        if (_this.busy) {
            return;
        }

        jQuery.ajax({
            url: cruminaKingYoastConf.ajaxUrl,
            data: {
                action: cruminaKingYoastConf.action,
                post_ID: cruminaKingYoastConf.post_ID
            },
            dataType: 'html',
            type: 'POST',

            beforeSend: function () {
                _this.busy = true;
            },
            success: function (content) {
                _this.content = content;
                YoastSEO.app.pluginReady('CruminaYoast');
                YoastSEO.app.registerModification('content', _this.setContent, 'CruminaYoast', 5);
            },
            error: function (jqXHR, textStatus) {
                alert(textStatus);
            },
            complete: function () {
                _this.busy = false;
            }
        });
    },

    setContent: function () {
        return cruminaKingYoast.content;
    },
};

jQuery(window).on('YoastSEO:ready', function () {
    cruminaKingYoast.init();
});