<#
        var atts 		= ( data.atts !== undefined ) ? data.atts : {},
        wrap_class 	= [],
        wrap_class  = kc.front.el_class( atts );
        wrap_class.push( 'crumina-module' );
        if( atts['el_class'] !== undefined && atts['el_class'] !== '' )
        wrap_class.push( atts['el_class'] );
#>
<div class="{{wrap_class.join(' ')}}">
    <div style="width: 100%;">
        <h1 class=" heading-title">Not available to edit on frontend</h1>
        <div class="heading-decoration"><span class="first"></span><span class="second"></span></div>
        <h5>For best performance, the Module has been disabled in frontend editing mode. Please use Backend editor</h5>
    </div>
</div>