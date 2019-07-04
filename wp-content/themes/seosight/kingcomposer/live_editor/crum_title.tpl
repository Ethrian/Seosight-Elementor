<#
        var output        = '',
        delim_html = '',
        link_html = '',
        subtitle_html ='',
        button_attributes = [],
        wrap_class    = [],
        classes    = ['heading-title'],
        type        = 'h1',
        atts        = ( data.atts !== undefined ) ? data.atts : {},
        title    = ( atts['title'] !== undefined )? atts['title'] : 'The Title',
        subtitle    = ( atts['subtitle'] !== undefined )? atts['subtitle'] : '',
        align    = ( atts['align'] !== undefined )? atts['align'] : 'align-center',
        post_title    = ( atts['post_title'] !== undefined )? atts['post_title'] : 'no',
        title_delim    = ( atts['title_delim'] !== undefined )? atts['title_delim'] : 'no',
        inline_link    = ( atts['inline_link'] !== undefined )? atts['inline_link'] : 'no';
        link    = ( atts['title_link'] !== undefined )? atts['title_link'] : '';

        wrap_class  = kc.front.el_class( atts );
        wrap_class.push( 'crumina-module' );
        wrap_class.push( 'crumina-heading' );
        if ( 'yes' !== inline_link ) {
            wrap_class.push( align );
        }


        if( atts['el_class'] !== undefined && atts['el_class'] !== '' )
            classes.push( atts['el_class'] );

        if( atts['type'] !== undefined && atts['type'] !== '' )
            type = atts['type'];

        if ( atts['title_wrap'] == 'yes' && atts['title_wrap_class'] !== undefined )
            wrap_class.push(atts['title_wrap_class']);

        if ( post_title === 'yes')
            title = kc_post_title;

        if ( 'yes' === inline_link ){
            var link_url = '#',
            link_title = 'Read more',
            link_arr = [];

            wrap_class.push( 'with-read-more');

            if ( link.length ) {
                link_arr = link.split('|');
                button_attributes.push( 'class="read-more"' );

                if( link_arr[0].length ){
                    link_url = link_arr[0];
                    button_attributes.push( 'href="' + link_arr[0] + '"' );
                }
        if( link_arr[1].length ){
        link_title = link_arr[1];
        button_attributes.push( 'title="' + link_arr[1] + '"' );
        }
        if( link_arr[2].length ){
        button_attributes.push( 'target="' + link_arr[2] + '"' );
        }
        if( link_url.length ) {
            link_html = '<a ' + button_attributes.join(' ') + '>' + link_title + '<i class="seoicon-right-arrow"></i></a>';
        }
    }
}

if ( title_delim == 'yes' ){
delim_html= '<div class="heading-decoration"><span class="first"></span><span class="second"></span></div>';
}

if (subtitle.length)
    subtitle_html = '<div class="h5 heading-text">' + subtitle + '</div>';
#>

<div class="{{wrap_class.join(' ')}}">
    <div class="title-text-wrap">
        <{{type}} class="{{classes.join(' ')}}">{{title}}</{{type}}>
        {{{link_html}}}
    </div>
{{{delim_html}}}
{{{subtitle_html}}}
</div>
