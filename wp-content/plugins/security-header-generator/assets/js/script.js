jQuery( document ).ready( function( $ ) {

    // get our access methods allow all
    var _amaa = jQuery( '[data-depend-id="include_acam_methods"][value="*"]' );
    
    // check the click event
    _amaa.on( 'click', function( ){

        // hold the checked
        _ischecked = jQuery( this ).is( ':checked' );

        // get the rest of the checkboxes for this
        _amacbs = jQuery( '[data-depend-id="include_acam_methods"]' );

        // set the other checkboxes based on this one
        _amacbs.prop( "checked", _ischecked );
        
    } );

    // get our WP Defaults Switch
    var _iwd = jQuery( '[data-depend-id="include_wordpress_defaults"]' );

    // we need the original values
    const _csp_styles = jQuery( '[data-depend-id="generate_csp_custom_styles"]' ).val( ) || '';
    const _csp_style_src = jQuery( '[data-depend-id="generate_csp_custom_styles_elem"]' ).val( ) || '';
    const _csp_scripts = jQuery( '[data-depend-id="generate_csp_custom_scripts"]' ).val( ) || '';
    const _csp_script_src = jQuery( '[data-depend-id="generate_csp_custom_scripts_elem"]' ).val( ) || '';
    const _csp_fonts = jQuery( '[data-depend-id="generate_csp_custom_fonts"]' ).val( ) || '';
    const _csp_images = jQuery( '[data-depend-id="generate_csp_custom_images"]' ).val( ) || '';
    const _csp_connect = jQuery( '[data-depend-id="generate_csp_custom_connect"]' ).val( ) || '';
    const _csp_frames = jQuery( '[data-depend-id="generate_csp_custom_frames"]' ).val( ) || '';
    const _csp_worker = jQuery( '[data-depend-id="generate_csp_custom_workers"]' ).val( ) || '';
    const _csp_media = jQuery( '[data-depend-id="generate_csp_custom_media"]' ).val( ) || '';

    // onload
    set_csp_default( _iwd.val( ) );

    // on switch change
    _iwd.change( function( ) {
        
        // switch the value
        set_csp_default( _iwd.val( ) );
        
    } );

    // set the defaults
    function set_csp_default( _iwd_val ) {

        // check it's value onload
        if( _iwd_val == '1' ) {

            // build our new values
            var _styles = _csp_styles + ' fonts.googleapis.com cdn.jsdelivr.net ';
            var _style_src = _csp_style_src + ' fonts.googleapis.com cdn.jsdelivr.net ';
            var _scripts = _csp_scripts + ' cdn.jsdelivr.net ';
            var _script_src = _csp_script_src + ' cdn.jsdelivr.net ';
            var _fonts = _csp_fonts + ' data: fonts.gstatic.com cdn.jsdelivr.net ';
            var _images = _csp_images + ' data: ts.w.org s.w.org ps.w.org ';
            var _connect = _csp_connect + ' ';
            var _frames = _csp_frames + ' blob: www.google.com ';
            var _worker = _csp_worker + ' blob: ';
            var _media = _csp_media + ' s.w.org ';

            // set the field values with our defaults
            jQuery( '[data-depend-id="generate_csp_custom_styles"]' ).val( _styles.remDups( ) );
            jQuery( '[data-depend-id="generate_csp_custom_styles_elem"]' ).val( _style_src.remDups( ) );
            jQuery( '[data-depend-id="generate_csp_custom_scripts"]' ).val( _scripts.remDups( ) );
            jQuery( '[data-depend-id="generate_csp_custom_scripts_elem"]' ).val( _script_src.remDups( ) );
            jQuery( '[data-depend-id="generate_csp_custom_fonts"]' ).val( _fonts.remDups( ) );
            jQuery( '[data-depend-id="generate_csp_custom_images"]' ).val( _images.remDups( ) );
            jQuery( '[data-depend-id="generate_csp_custom_connect"]' ).val( _connect.remDups( ) );
            jQuery( '[data-depend-id="generate_csp_custom_frames"]' ).val( _frames.remDups( ) );
            jQuery( '[data-depend-id="generate_csp_custom_workers"]' ).val( _worker.remDups( ) );
            jQuery( '[data-depend-id="generate_csp_custom_media"]' ).val( _media.remDups( ) );

        } else {

            // clear defaults
            jQuery( '[data-depend-id="generate_csp_custom_styles"]' ).val( _csp_styles.remDups( ) );
            jQuery( '[data-depend-id="generate_csp_custom_styles_elem"]' ).val( _csp_style_src.remDups( ) );
            jQuery( '[data-depend-id="generate_csp_custom_scripts"]' ).val( _csp_scripts.remDups( ) );
            jQuery( '[data-depend-id="generate_csp_custom_scripts_elem"]' ).val( _csp_script_src.remDups( ) );
            jQuery( '[data-depend-id="generate_csp_custom_fonts"]' ).val( _csp_fonts.remDups( ) );
            jQuery( '[data-depend-id="generate_csp_custom_images"]' ).val( _csp_images.remDups( ) );
            jQuery( '[data-depend-id="generate_csp_custom_connect"]' ).val( _csp_connect.remDups( ) );
            jQuery( '[data-depend-id="generate_csp_custom_frames"]' ).val( _csp_frames.remDups( ) );
            jQuery( '[data-depend-id="generate_csp_custom_workers"]' ).val( _csp_worker.remDups( ) );
            jQuery( '[data-depend-id="generate_csp_custom_media"]' ).val( _csp_media.remDups( ) );

        }
    }

} );

// remove the duplciates
String.prototype.remDups = function( ) {
    const set = new Set( this.split( ' ') )
    return [...set].join( ' ' )
}