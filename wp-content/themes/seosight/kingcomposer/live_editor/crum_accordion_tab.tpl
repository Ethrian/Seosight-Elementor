<#

        if( data === undefined )
            data = {};

        var panel_heading_class = '',
        panel_content_class = '',
        panel_link_class = 'collapsed',
        panel_content_class = 'collapse';

        var element_attributes = [], title = 'Title', css_class = [],
        atts = ( data.atts !== undefined ) ? data.atts : {};

        css_class = kc.front.el_class( atts );
        css_class.push( 'accordion-panel' );

        if( atts['title'] !== undefined && atts['title'] !== '' )
        title = atts['title'];

        if( atts['class'] !== undefined && atts['class'] !== '' )
        css_class.push( atts['class'] );


        if( atts['open'] !== undefined && atts['open'] === 'yes' ) {
        panel_heading_class = 'active';
        css_class.push( 'active' );
        panel_content_class = 'collapse in';
        }

        if (atts['_id'] !== '')
        random_id = 'accordion_' + atts['_id'];

        if( data.content === undefined )
        data.content = '';
        data.content += '<div class="kc-element drag-helper" data-model="-1" droppable="true" draggable="true"><a href="javascript:void(0)" class="kc-add-elements-inner"><i class="sl-plus kc-add-elements-inner"></i></a></div>';

        data.callback = function( wrp, $ ){ CRUMINA.initAccordion( wrp ); }
#>

<li class="{{css_class.join(' ')}}">
    <div class="panel-heading {{panel_heading_class}}">
        <a href="#{{kc.tools.esc_slug(title)}}" data-prevent="scroll" class="accordion-heading {{panel_link_class}}"
           data-toggle="collapse" aria-expanded="false">
            <span class="icon">
                <i class="fa fa-angle-right default" aria-hidden="true"></i>
                <i class="fa fa-angle-down active" aria-hidden="true"></i>
            </span>
            <span class="ovh">{{{title}}}</span>
        </a>
    </div>
    <div id="{{kc.tools.esc_slug(title)}}" class="panel-collapse {{panel_content_class}}" aria-expanded="false"
         role="tree">
        <div class="panel-info">
            {{{data.content}}}
        </div>
    </div>
</li>