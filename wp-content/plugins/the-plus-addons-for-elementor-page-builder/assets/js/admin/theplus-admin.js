(function ($) {
	jQuery(document).on( 'click', '.plus-key-notify .notice-dismiss', function() {

    jQuery.ajax({
        url: ajaxurl,
        data: {
            action: 'theplus_key_notice'
        }
    })
	
	});	
})(window.jQuery);
