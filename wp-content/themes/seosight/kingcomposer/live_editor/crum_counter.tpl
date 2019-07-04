<#

        if( data === undefined )
        data = {};

        var atts = ( data.atts !== undefined ) ? data.atts : {},
        delim_html = '',
        icon_html = '',
        label_html = '',
        units_html = '',
        layout    = ( atts['layout'] !== undefined )? atts['layout'] : 'default',
        label    = ( atts['label'] !== undefined )? atts['label'] : 'Some title',
        number    = ( atts['number'] !== undefined )? atts['number'] : '99',
        units    = ( atts['units'] !== undefined )? atts['units'] : '',
        line_show    = ( atts['line_show'] !== undefined )? atts['line_show'] : '',
        icon_show    = ( atts['icon_show'] !== undefined )? atts['icon_show'] : '',
        icon    = ( atts['icon'] !== undefined )? atts['icon'] : 'et-puzzle',
        wrap_class = {},
        custom_class = ( atts['wrap_class'] !== undefined )? atts['wrap_class'] : '',
        wrap_class  = kc.front.el_class( atts );
        wrap_class.push( 'crumina-module' );
        wrap_class.push( 'crumina-counter-item' );
        wrap_class.push( 'counter-item-' + layout );
        wrap_class.push( custom_class );
        if ( line_show == 'yes' ){
        delim_html= '<div class="counter-line"><span class="first"></span><span class="second"></span></div>';
}
if( icon_show == 'yes' ) {
icon_html = '<div class="element-icon"><i class="' + icon + '"></i></div>';
}
if( label.length ){
label_html = '<span class="counter-title">' + label + '</span>';
}
if( units.length ){
units_html = '<div class="units">' + units + '</div>';
}
#>

<div class="{{wrap_class.join(' ')}}">
    {{{icon_html}}}
    <div class="counter-numbers counter">
        <span data-speed="2000" data-refresh-interval="3" data-to="{{number}}" data-from="2">{{number}}</span>
        {{{units_html}}}
    </div>
    {{{label_html}}}
    {{{delim_html}}}
</div>