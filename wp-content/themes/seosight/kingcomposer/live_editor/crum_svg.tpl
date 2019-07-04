<#
        var atts            = ( data.atts !== undefined ) ? data.atts : {},
        wrap_class        = [],
        image_url = '',

        image_id            = ( atts['image'] !== undefined ) ?  atts['image'] : '',
        custom_class    = ( atts['custom_class'] !== undefined ) ? atts['custom_class'] : '';
        wrap_class        = kc.front.el_class( atts );

        wrap_class.push('crumina-module');
        wrap_class.push('animated-svg');

        if ( custom_class !== '' ){
            wrap_class.push( custom_class );
        }
        image_url    = ajaxurl + '?action=kc_get_thumbn&size=full&id=' + image_id;
        #>

    <div class="{{{wrap_class.join(' ')}}}">
        <object data="{{image_url}}" type="image/svg+xml"></object>
    </div>

