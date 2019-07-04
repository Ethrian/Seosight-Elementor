<#
        var atts        = ( data.atts !== undefined ) ? data.atts : {},
        wrap_class      = [],
        desc            = ( atts['desc'] !== undefined ) ? kc.tools.base64.decode( atts['desc'] ) : '',
        list_icon       = ( atts['list_icon'] !== undefined ) ? atts['list_icon'] : '',
        icon            = ( atts['icon'] !== undefined ) ? atts['icon'] : '',
        custom_class    = ( atts['custom_class'] !== undefined ) ? atts['custom_class'] : '';

        wrap_class        = kc.front.el_class( atts );

        wrap_class.push('crumina-module');
        wrap_class.push('list');

        if ( 'seoicon-check' == list_icon || 'seoicon-right-arrow' == list_icon ) {
            wrap_class.push('list--secondary');
            icon = list_icon;
        } else {
            wrap_class.push('list--primary');
        }

        if ( custom_class !== '' ){
            wrap_class.push( custom_class );
        } #>
<div class="{{{wrap_class.join(' ')}}}" data-icon="{{icon}}">
    {{{desc}}}
</div>
    <# data.callback = function( wrp, $ ){
        var icon = wrp.data('icon');
        wrp.find('li').wrapInner('<div class="ovh"></div>');
        wrp.find('li').prepend('<i class="' + icon + '"></i>');
    } #>
