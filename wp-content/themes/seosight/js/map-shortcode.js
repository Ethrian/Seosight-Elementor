
( function ( $ ) {
    "use strict";
    var $dragable = true;
    if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test( navigator.userAgent ) ) {
        $dragable = false;
    }

    CRUMINA.google_map_init = function ( ) {
        $( '.google-map' ).each( function ( ) {
            var $this = $( this );
            var $convas = $this.find( '.map-canvas' );
            var locations = $this.data( 'locations' );

            if ( !locations ) {
                $convas.html( '<h6 style="color: red;">Address field is empty!</h6>' )
                return;
            }

            locations = locations.trim().split( /\r?\n/ );

            var geocoder = new google.maps.Geocoder();
            var bounds = new google.maps.LatLngBounds( );

            var style = $this.data( 'map-style' ).replace( /'/g, '"' );
            var EncStyle = ( style.length > 0 ) ? JSON.parse( style ) : '';

            // Init Google map
            var map = new google.maps.Map( $convas[0], {
                scrollwheel: $this.data( 'disable-scrolling' ) === 'yes' ? false : true,
                mapTypeId: google.maps.MapTypeId[$this.data( 'map-type' )],
                zoom: $this.data( 'zoom' ),
                streetViewControl: false,
                draggable: $dragable,
                styles: EncStyle,
                mapTypeControl: false
            } );

            for ( var i = 0; i < locations.length; i++ ) {

                // Get coords by address
                geocoder.geocode( { 'address': locations[i] }, function ( results, status ) {
                    if ( status == google.maps.GeocoderStatus.OK ) {
                        map.setCenter( results[0].geometry.location );

                        var customImg = $this.data( 'custom-marker' );
                        var markerParams = {
                            position: results[0].geometry.location,
                            map: map
                        };

                        if ( customImg ) {
                            markerParams.icon = {
                                scaledSize: new google.maps.Size( 50, 50 ),
                                url: customImg
                            }
                        }

                        // Create marker
                        var marker = new google.maps.Marker( markerParams );

                        //Add coords to bounds
                        bounds.extend( marker.position );

                    }
                } );

            }

            // Center map to all markers
            if ( locations.length > 1 ) {
                map.fitBounds( bounds );
            }

        } );
    };
    $( document ).ready( function ( ) {
        CRUMINA.google_map_init( );
    } );
} )( jQuery );