jQuery(document).ready(function(jQuery) {
	// resizeFunc();
	
	// jQuery(window).resize(resizeFunc);
});
	
function resizeFunc() {
	var elem = jQuery('.content-page-header')[0];
		
	if(!elem){
		elem = jQuery('#homeHeader')[0];
	}

	if(!elem)
		return;

	if(window.innerWidth < 639){		
		var hgth = ';height: ' + (window.innerWidth / 100 * 67) + 'px!important';
		elem.style.cssText = hgth;
    } else {		
		if(elem.style.height !== 'auto') {
			elem.style.height = 'auto';
		}
	}
}