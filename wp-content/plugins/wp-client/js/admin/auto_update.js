jQuery( document ).ready( function() {
    jQuery.ajax({
        type: 'POST',
        url: wpc_auto_update_data.ajax_url,
        data: 'action=' + wpc_auto_update_data.action + '&js_update=1&nonce=' + wpc_auto_update_data.nonce,
        dataType: "json",
        success: function( data ) {
            window.location = window.location.href;
        }
    });
});
