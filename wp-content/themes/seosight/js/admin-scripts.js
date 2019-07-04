if (window.Backbone && typeof(window.Backbone.sync) === 'function') {
    var myWidgets = {};

    /******************************
     * Contacts add to widget
     ******************************/
// Model for a single contact
    myWidgets.Contact = Backbone.Model.extend({
        defaults: {'icon': '', 'value': '', 'desc': ''}
    });

// Single view, responsible for rendering and manipulation of each single contact
    myWidgets.ContactView = Backbone.View.extend({
        className: 'contacts-widget-child',
        events: {
            'click .js-remove-contact': 'destroy'
        },

        initialize: function (params) {
            this.template = params.template;
            this.model.on('change', this.render, this);
            return this;
        },

        render: function () {
            this.$el.html(this.template(this.model.attributes));
            return this;
        },

        destroy: function (ev) {
            ev.preventDefault();
            this.remove();
            this.model.trigger('destroy');

        }
    });

// The list view, responsible for manipulating the array of contacts
    myWidgets.ContactsView = Backbone.View.extend({

        events: {
            'click #js-contact-add': 'addNew'
        },

        initialize: function (params) {
            this.widgetId = params.id;
            // cached reference to the element in the DOM
            this.$contacts = this.$('#js-contacts-list');
            // collection of contacts, local to each instance of myWidgets.contactsView
            this.contacts = new Backbone.Collection([], {
                model: myWidgets.Contact
            });
            // listen to adding of the new contacts
            this.listenTo(this.contacts, 'add', this.appendOne);
            return this;
        },

        addNew: function (ev) {
            ev.preventDefault();
            // default, if there is no contacts added yet
            var contactId = 0;
            if (!this.contacts.isEmpty()) {
                var contactsWithMaxId = this.contacts.max(function (contact) {
                    return contact.id;
                });
                contactId = parseInt(contactsWithMaxId.id, 10) + 1;
            }
            var model = myWidgets.Contact;
            this.contacts.add(new model({id: contactId}));
            return this;
        },

        appendOne: function (contact) {
            var renderedContact = new myWidgets.ContactView({
                model: contact,
                template: _.template(jQuery('#js-contact-' + this.widgetId).html())
            }).render();
            this.$contacts.append(renderedContact.el);
            return this;
        }
    });


    myWidgets.repopulateContacts = function (id, JSON) {
        var contactsView = new myWidgets.ContactsView({
            id: id,
            el: '#js-contacts-' + id
        });
        contactsView.contacts.add(JSON);
    };

    /******************************
    * Social networks add to widget
    ******************************/

// Model for a single social
    myWidgets.Social = Backbone.Model.extend({
        defaults: {'network': '', 'name': '', 'link': ''}
    });

// Single view, responsible for rendering and manipulation of each single social
    myWidgets.SocialView = Backbone.View.extend({
        className: 'social-widget-child',
        events: {
            'click .js-remove-social': 'destroy'
        },
        initialize: function (params) {
            this.template = params.template;
            this.model.on('change', this.render, this);
            return this;
        },

        render: function () {
            this.$el.html(this.template(this.model.attributes));
            return this;
        },

        destroy: function (ev) {
            ev.preventDefault();
            this.remove();
            this.model.trigger('destroy');
        }
    });

// The list view, responsible for manipulating the array of socials
    myWidgets.SocialsView = Backbone.View.extend({

        events: {
            'click #js-socials-add': 'addNew'
        },

        initialize: function (params) {
            this.widgetId = params.id;
            // cached reference to the element in the DOM
            this.$socials = this.$('#js-socials-list');
            // collection of socials, local to each instance of myWidgets.socialsView
            this.socials = new Backbone.Collection([], {
                model: myWidgets.Social
            });
            // listen to adding of the new socials
            this.listenTo(this.socials, 'add', this.appendOne);
            return this;
        },

        addNew: function (ev) {

            ev.preventDefault();

            // default, if there is no socials added yet
            var socialId = 0;

            if (!this.socials.isEmpty()) {
                var socialsWithMaxId = this.socials.max(function (social) {
                    return social.id;
                });

                socialId = parseInt(socialsWithMaxId.id, 10) + 1;
            }
            var model = myWidgets.Social;
            this.socials.add(new model({id: socialId}));
            return this;
        },

        appendOne: function (social) {
            var renderedSocial = new myWidgets.SocialView({
                model: social,
                template: _.template(jQuery('#js-social-' + this.widgetId).html())
            }).render();
            this.$socials.append(renderedSocial.el);
            return this;
        }
    });
    myWidgets.repopulateSocials = function (id, JSON) {

        var socialsView = new myWidgets.SocialsView({
            id: id,
            el: '#js-socials-' + id
        });
        socialsView.socials.add(JSON);
    };
}

var cruminaAdmin = {
    init: function () {
        this.sliderAutoSave.init();
    },
    sliderAutoSave: {
        trigger: false,
        $body: null,
        $publish: null,
        $container: null,
        init: function () {
            this.$body = jQuery( 'body.post-type-fw-slider' );

            if ( !this.$body.length ) {
                return;
            }

            this.$publish = jQuery( '#publish', this.$body );
            this.$container = jQuery( 'div.fw-option.fw-option-type-slides', this.$body );
            this.addEventListeners();
        },
        addEventListeners: function () {
            var _this = this;
            this.$body.on( 'click', 'button.fw-edit-slide:visible', function () {
                if ( typeof fw.loading.show === "function" ) {
                    fw.loading.show();
                }
            } );
            this.$publish.on( 'click', function ( event ) {
                var $btn = jQuery( 'button.fw-edit-slide:visible', _this.$body );
                if ( _this.trigger || !$btn.length ) {
                    return;
                }

                event.preventDefault();
                $btn.click();
            } );
            this.$container.on( 'fw:edit:slide', function ( ) {
                _this.trigger = true;
                _this.$publish.click();
            } );
        }
    }
};

jQuery(document).ready(function ($) {
    // Init Crumina scripts
    cruminaAdmin.init();

    var widget_image = $("input.widget_image_add");
    if (0 == widget_image.siblings("a").length) {
        widget_image.after('<a href="#" class="remove-item-image button">Remove image</a>');
        widget_image.after('<a href="#" class="add-item-image button">Add image</a>');
    }

    var tgm_media_frame;
    var image_field;

    jQuery(document.body).on("click", '.add-item-image', function (e) {
        image_field = $(this).siblings("input.widget_image_add");
        e.preventDefault();
        if (tgm_media_frame) {
            tgm_media_frame.open();
            return false;
        }

        tgm_media_frame = wp.media.frames.tgm_media_frame = wp.media({
            frame: 'select',
            multiple: false,
            library: {type: 'image'}
        });

        tgm_media_frame.on("select", function () {
            var media_attachment = tgm_media_frame.state().get('selection').first().toJSON();
            var image_link = media_attachment.url;
            jQuery(image_field).val(image_link);
        });
        // Now that everything has been set, let's open up the frame.
        tgm_media_frame.open();
    });

    //Remove image button
    jQuery(document.body).on("click", ".remove-item-image", function (e) {
        e.preventDefault();
        jQuery(this).siblings('input.widget_image_add').val("");
    });

    /* Colored dropdown options for color selection in shortcodes */
    var CruminaColoredSelect = function () {
        $('.colored-options').each(function () {
            var $color_select = $(this);
            $color_select.children('option').addClass(function () {
                return 'colored-option btn--' + $(this).val();
            });
        });
    };


    /* Colored dropdown for unyson options*/
    if (typeof fwEvents !== "undefined") {
        fwEvents.on('fw:options:init', function () {
            CruminaColoredSelect();
        });
    }
    /* Colored dropdown for Widgets save*/
    if ($('body').hasClass('widgets-php')) {
        jQuery(document).ajaxSuccess(function (e, xhr, settings) {
            var widget_id_base = 'banner';
            if (settings.data.search('action=save-widget') != -1 && settings.data.search('id_base=' + widget_id_base) != -1) {
                CruminaColoredSelect();
            }
        });
    }
});

jQuery(window).load(function () {
    /**Post featured metaboxes for different post formats**/
    if (jQuery('body').hasClass('post-type-post')) {
        var $selector_panel = jQuery("select[id^=\"post-format-selector\"], #post-formats-select input[name=\"post_format\"]:checked");
        var $selector_panels = jQuery("select[id^=\"post-format-selector\"], #post-formats-select input[name=\"post_format\"]");
        var $post_format_metaboxes = jQuery('#fw-options-box-post-quote, #fw-options-box-post-image, #fw-options-box-post-video, #fw-options-box-post-link, #fw-options-box-post-audio, #fw-options-box-post-gallery');

        $post_format_metaboxes.hide(); // Default Hide
        console.log($selector_panel.val());
        jQuery('#fw-options-box-post-' + $selector_panel.val()).show();

        $selector_panels.change(function () {
            $post_format_metaboxes.hide(); // Hide during changing
            console.log(jQuery(this));
            jQuery('#fw-options-box-post-' + jQuery(this).val()).show();
        });
    }
});

/*********************************************************************
 *   JS Helpers for frontend editor (for PHP in inc/helpers.php)
 * *******************************************************************/

// Collection of row animation images

(function ($) {

    if (typeof( kc ) == 'undefined')
        window.kc = {};

    $().extend(kc.tools, {
        seosight_animated_images_collection: function ($row_animation) {

        }
    });
})(jQuery);
