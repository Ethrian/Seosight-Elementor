<#

        if( data === undefined )
        var data = {};

        var atts        = ( data.atts !== undefined ) ? data.atts : {},
        subtitle        = ( atts['subtitle'] !== undefined && atts['subtitle'] !== '__empty__' )? atts['subtitle'] : '',
        title           = ( atts['title'] !== undefined  && atts['title'] !== '__empty__' )? atts['title'] : '',
        image           = ( atts['image'] !== undefined )? atts['image'] : '',
        custom_class    = ( atts['custom_class'] !== undefined )? atts['custom_class'] : '',
        img_size        = ( atts['img_size'] !== undefined )? atts['img_size'] : 'full',
        link            = ( atts['link'] !== undefined )? atts['link'] : '||',
        social_networks = ( atts['social_networks'] !== undefined )? kc.tools.base64.decode(atts['social_networks']) : '',
        data_img        = '',
        img_link        = '',
        data_title      = '',
        data_subtitle   = '',
        data_socials    = '',
        socials         = '',
        icon            = '',
        sizes           = ['full', 'thumbnail', 'medium', 'large'],
        wrap_class      = kc.front.el_class( atts );

        wrap_class.push( 'crumina-module' );
        wrap_class.push( 'crumina-teammembers-item' );
        if ( custom_class !== '' ){
        wrap_class.push( custom_class );
        }


        if ( link !== '' ) {
        link_text = link.split('|');
        link = link_text[0];
        }

        if ( image > 0 ) {
    image = image.replace( /[^\d]/, '' );
    img_link = ajaxurl + '?action=kc_get_thumbn&size=' + img_size + '&id=' + image;

    if ( link !== '' ) {
    data_img += '<a href="' + button_link + '">';
        data_img += '<img src="' + img_link + '" alt="">';
        data_img += '</a>';
    } else {
        data_img += '<img src="' + img_link + '" alt="">';
    }
    }

    if ( title !== '' ) {
    data_title += '<h5 class="teammembers-item-name">';
        if ( link !== '' ) {
        data_title += '<a href="' + button_link + '">';
            data_title += title;
            data_title += '</a>';
        } else {
        data_title += title;
        }
        data_title += '</h5>';

    }

    if ( subtitle !== '' ) {
        data_subtitle += '<p class="teammembers-item-prof">';
        data_subtitle += subtitle;
        data_subtitle += '</p>';
    }

    if (social_networks.length){
    var json = JSON.parse(social_networks);
    for (var key in json) {
    if (json.hasOwnProperty(key)) {
        data_socials += '<a href="' + json[key].link + '" class="social__item">';
        data_socials += '<img src="' + kc_site_url + '/wp-content/themes/seosight/svg/socials/' + json[key].icon + '" alt="">';
        data_socials += '</a>';
    }
    }
    }


    if( data_socials !== '' )
    data_socials = '
    <div class="socials">' + data_socials + '</div>
    ';

    #>

    <div class="{{{wrap_class.join(' ')}}}">
        {{{data_img}}}
        {{{data_title}}}
        {{{data_subtitle}}}
        {{{data_socials}}}
    </div>