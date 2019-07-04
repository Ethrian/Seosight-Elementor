<#

        if( data === undefined )
        data = {};

        var element_attributes = [], css_classes = [],
        atts = ( data.atts !== undefined ) ? data.atts : {};

        css_classes = kc.front.el_class( atts );
        css_classes.push( 'crumina-module' );
        css_classes.push( 'crumina-accordion' );

        if( atts['class'] !== undefined && atts['class'] !== '' )
        css_classes.push( atts['class'] );

        if( atts['open_all'] !== undefined && atts['open_all'] == 'yes' )
        element_attributes.push( 'panel-group' );

        if (atts['_id'] !== '')
        random_id = 'accordion_' + atts['_id'];

        data.callback =  function( wrp ){ kc_front.accordion( wrp ) };
        #>
    <div class="{{css_classes.join(' ')}}">
        <ul class="{{{element_attributes.join(' ')}}}" id="{{random_id}}">
            {{{data.content}}}
        </ul>
    </div>