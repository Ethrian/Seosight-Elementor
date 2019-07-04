<#

        if( data === undefined )
        data = {};

        var atts                = ( data.atts !== undefined ) ? data.atts : {},
        textbutton            = kc.std( atts, 'label', 'Button Text'),
        link                = kc.std( atts, 'link', '#'),
        onclick            = kc.std( atts, 'onclick', ''),
        wrap_class            = kc.std( atts, 'wrap_class', ''),
        size                = kc.std( atts, 'size', 'medium'),
        align                = kc.std( atts, 'align', 'none'),
        color                = kc.std( atts, 'color', 'primary'),
        shadow                = kc.std( atts, 'shadow', 'no'),
        outlined            = kc.std( atts, 'outlined', 'no'),
        show_icon            = kc.std( atts, 'show_icon', 'no'),
        icon                = kc.std( atts, 'icon', 'fa-leaf'),
        icon_position        = kc.std( atts, 'icon_position', 'left'),
        button_attributes    = [],
        button_class = [],
        wrapper_class        = [];

        wrapper_class = kc.front.el_class( atts );
        wrapper_class.push( 'crumina-module' );
        wrapper_class.push( 'crum-button' );
        wrapper_class.push( wrap_class );

        link = link.split('|');

        button_class.push( 'btn' );
        size = "btn-" + size ;
        color = "btn--" + color;
        button_class.push( size );
        button_class.push( color );

        if (shadow == 'yes'){
        button_class.push( 'btn-hover-shadow' );
        }
        if (outlined == 'yes'){
        button_class.push( 'btn-border' );
        }
        if( icon_position == 'left' ){
        button_class.push( 'icon-left' );
        }

        button_attributes.push( 'class="' + button_class.join(' ') + '"' );

        if( align == 'none' ){
        wrapper_class.push( 'inline-block' );
        } else {
        wrapper_class.push( align );
        }

        if( link[0] !== undefined )
        button_attributes.push( 'href="' + link[0] + '"' );

        if( link[1] !== undefined )
        button_attributes.push( 'title="' + link[1] + '"' );

        if( link[2] !== undefined )
        button_attributes.push( 'target="' + link[2] + '"' );

        if( onclick !== undefined && onclick !== '')
        button_attributes.push( 'onclick="' + onclick + '"' );

        textbutton  = '<span class="text">' + textbutton  + '</span>';

if( 'yes' === show_icon ){
    if( icon_position == 'left' ){
        textbutton = '<i class="' + icon + '"></i> ' + textbutton ;
    } else if( icon_position == 'right'){
        textbutton += ' <i class="' + icon + '"></i>';
    } else {
        textbutton = '<i class="' + icon + '"></i>';
    }
}

#>
<div class="{{{wrapper_class.join(' ')}}}">
    <a {{{button_attributes.join(' ')}}}>{{{textbutton}}}
        <span class="semicircle"></span>
        <span class="semicircle"></span>
    </a>
</div>
