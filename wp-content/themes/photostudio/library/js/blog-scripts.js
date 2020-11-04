var isotopeWrap, btShowFilterTop, scrollBottom = false, lastScrollTop = 0; 

jQuery(document).ready(function() {
    
    jQuery('#categories-drawer .drawer-container').mCustomScrollbar({
        theme: "minimal"
    });
    
    jQuery('#show-filter').click(btShowFilterHandler);
    jQuery('#close-drawer-button').click(closeFilter);

    jQuery(document).on('click', '#load-more-button', loadMorePostsHandler);
    jQuery('#categories-drawer .checkbox').change(loadCatPosts);

    /* swipe toggle */

    var hammerOpen = new Hammer(jQuery('#hammer-open')[0], { touchAction: 'auto' }),
        hammerClose =  new Hammer(jQuery('#categories-drawer')[0], { touchAction: 'auto' });

    // hammerClose.on('panleft', function(ev){
    //     closeFilter();
    // });
    //
    // hammerOpen.on('panright', function(ev){
    //     showFilter();
    // });

    hammerClose.on('panup', function(ev){
        closeFilter();
    });

    hammerOpen.on('pandown', function(ev){
        showFilter();
    });
    /* Closed Filter On Click Items */
    jQuery(function($){
        if( !$('#categories-inputs') ) return;
        var filter = $('#categories-inputs');
        var items = filter.find('.parent-cat > input[type=checkbox]');
        items.on('click', function(e){
            // if( !filter.find('.parent-cat > input[type=checkbox]:checked').length )
            //     return;
            closeFilter();
        });
    });
    isotopeWrap = jQuery('.post-items-wrapper');

    isotopeWrap.imagesLoaded(function() {
        isotopeWrap.isotope({
            itemSelector: '.post-item'
        });
    });

    jQuery('.magazine-filter').on('click', '.magazine-filter-item', function () {
        console.log(this);
        var filterValue = jQuery(this).data('slug');
        isotopeWrap.isotope({filter: '.' + filterValue});
        jQuery('.magazine-filter-item.active').removeClass('active');
        jQuery(this).addClass('active');
    });

    btShowFilterTop = jQuery('button#show-filter').offset().top;
    
    jQuery(window).scroll(setFilterPosition);
    jQuery(window).scroll(btFilterPosition);
    setContainerHeight();
    jQuery(window).resize(setContainerHeight);
    jQuery(window).resize(setFilterPosition);

    jQuery(window).scroll(function() {
        var st = window.pageYOffset || document.documentElement.scrollTop; 
        if (st > lastScrollTop){
            scrollBottom = true;
        } else {
            scrollBottom = false;
        }
        lastScrollTop = st <= 0 ? 0 : st; 
    });

    // jQuery( document ).on( 'click', 'a.post-link', function(e) {
    //     if(jQuery(window).width() <= 768) {
    //         var elem = this;
    //
    //         if(jQuery(elem).attr('data-prevented') != 1) {
    //             e.preventDefault();
    //             jQuery('a.post-link').attr('data-prevented', 0);
    //             jQuery(elem).attr('data-prevented', 1);
    //         }
    //
    //     }
    // });

    /**
     * handler for page scroll and infinity loader
     */
    window.btnLoadMoreIsActive = true;
    jQuery( '#load-more-button' ).css( 'opacity', '0' );
    jQuery( window ).scroll(function() {
        if( !!document.getElementById( "load-more-button" ) ){
            var scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
            var buttonTopPosition = jQuery( '#load-more-button' ).offset().top;
            if( ( ( buttonTopPosition - scrollPosition ) < ( window.innerHeight + 300 ) ) && window.btnLoadMoreIsActive ){
                window.btnLoadMoreIsActive = false;
                loadMorePostsHandler();
            }
        }
    });
});

jQuery(window).load(function() {
    //if( !jQuery('#hammer-open').length ) return;
    var elem =  jQuery('#hammer-open .message > i');
    setFilterPosition();
    togglePreloader();
    elem.css('animation-play-state', 'running');
    setTimeout(function() {
        elem.css('animation-play-state', 'paused');
    }, 3000);

    setInterval(function() {
        elem.css('animation-play-state', 'running');

        setTimeout(function() {
            elem.css('animation-play-state', 'paused');
        }, 3000);
    }, 30000);
});

// function btFilterPosition() {
//     var elem = jQuery('button#show-filter'),
//         posTop = jQuery(document).scrollTop()
//         diff = btShowFilterTop - posTop;
//
//         if(diff <= 90) {
//             if(!elem.hasClass('fixed')) {
//                 elem.addClass('fixed');
//             }
//         } else {
//             if(elem.hasClass('fixed')) {
//                 elem.removeClass('fixed');
//             }
//         }
// }
function btFilterPosition() {
    var elem = jQuery('button#show-filter');
        posTop = jQuery(document).scrollTop();
        diff = btShowFilterTop - posTop;
    if( jQuery('html').hasClass('admin-bar') ) {
        diff += 32;
    }
    if(jQuery(window).width() >= 992) {
        if(diff <= 100) {
            if(!elem.hasClass('fixed')) {
                elem.addClass('fixed');
            }
        } else {
            if(elem.hasClass('fixed')) {
                elem.removeClass('fixed');
            }
        }
    } else if ( jQuery(window).width() <= 991 && jQuery(window).width() >= 769 ) {
        if( elem.hasClass('fixed') ) {
            elem.removeClass('fixed');
        }
        jQuery('#hammer-open').hide();
            if(diff <= 155) {
            jQuery('#hammer-open').css('display', 'flex');
            elem.css('opacity', 0);
        } else {
            jQuery('#hammer-open').css('display', 'none');
            elem.css('opacity', 1);
        }
    } else if ( jQuery(window).width() <= 768 && jQuery(window).width() >= 575 ) {
        if( elem.hasClass('fixed') ) {
            elem.removeClass('fixed');
        }
        jQuery('#hammer-open').hide();
            if(diff <= 100) {
            jQuery('#hammer-open').css('display', 'flex');
            elem.css('opacity', 0);
        } else {
            jQuery('#hammer-open').css('display', 'none');
            elem.css('opacity', 1);
        }
    } else if(jQuery(window).width() <= 574) {
        if( elem.hasClass('fixed') ) {
            elem.removeClass('fixed');
        }
        jQuery('#hammer-open').hide();
        if(diff <= 95) {
            jQuery('#hammer-open').css('display', 'flex');
            elem.css('opacity', 0);
        } else {
            jQuery('#hammer-open').css('display', 'none');
            elem.css('opacity', 1);
        }
    }
}
function setContainerHeight() {
    var elem = jQuery('.content-page-header.blog');

    if(elem.css('height') != 'fit-content') {
        elem.css({'height': 'fit-content'});
    }
}

function setFilterPosition() {
    var catDrawElem = jQuery('#categories-drawer');

    if(jQuery(window).width() > 768) {
        var pageWrapperTop = jQuery('#post-items-with-bt').offset().top,
        posTop = jQuery(document).scrollTop(),        
        filterTop = catDrawElem.position().top,
        diff = pageWrapperTop - posTop;

        if(diff < 90) {
            if(filterTop > 90) {
                catDrawElem.css({'top': '90px'});
            }
        } else {
            catDrawElem.css({'top': diff + 'px'});
        }
    } 
}

function btShowFilterHandler() {
    var elem = jQuery('#categories-drawer');

    elem.toggleClass('hidden');
} jQuery('.message').on('click', btShowFilterHandler);

function showFilter() {
    var elem = jQuery('#categories-drawer');

    if(elem.hasClass('hidden')) {
        elem.removeClass('hidden');
    }
}

function closeFilter() {
    var elem = jQuery('#categories-drawer');

    if(!elem.hasClass('hidden')) {
        elem.addClass('hidden');
    }
}

function loadMorePostsHandler() {
    // togglePreloader();
    var data = {
        'action': 'loadmore',
        'query': window.posts_query,
        'page' : window.current_page
    };

    jQuery.ajax({
        url: window.ajaxurl, 
        data: data, 
        type: 'POST', 
        success:function(data){
            window.btnLoadMoreIsActive = true;
            if( data ) { 
                var items = jQuery(data);
                setTimeout(function() {
                    isotopeWrap.append(items).isotope( 'appended', items );
                    isotopeWrap.imagesLoaded({}, function () {
                        isotopeWrap.isotope('layout');
                        setFilterPosition();
                        // togglePreloader();
                    });
                }, 300);
                
                window.current_page++; 
                if (window.current_page == window.max_pages) 
                    jQuery("#load-more-button").remove(); 
            } else {
                jQuery('#load-more-button').remove(); 
                // togglePreloader();
            }
        }
    });
}

function loadCatPosts() {
    togglePreloader();
    checkRelated(this);
    var chbxs = jQuery('#categories-drawer .checkbox');
    var checked = [];

    for(var i = 0; i < chbxs.length; i++) {
        var elem = jQuery(chbxs[i]);

        if(elem.is(':checked')) {
            checked.push(elem.attr('name'));
        }
    }

    var data = {
        'action': 'load_cat_posts',
        'query': window.posts_query,
        'page' : window.current_page,
        'cats': checked.join()
    };

    jQuery.ajax({
        url: window.ajaxurl, 
        data: data, 
        type: 'POST', 
        success:function(data){
            jQuery('#post-items-with-bt').html(data);

            setTimeout(function() {
                isotopeWrap = jQuery('.post-items-wrapper');
                isotopeWrap.isotope({
                    itemSelector: '.post-item'
                });
                isotopeWrap.imagesLoaded({}, function () {
                    isotopeWrap.isotope('layout');
                    setFilterPosition();
                    togglePreloader();
                });
            }, 300);
        }
    });
}

function checkRelated(input) {
    var elem = jQuery(input);
    var parent = elem.parent();
    var isChecked = elem.is(':checked');

    parent.find('.checkbox').prop('checked', isChecked);  
}

function togglePreloader() {
    var elem = jQuery('#preloader');

    if(elem.hasClass('shown')) {
        elem.removeClass('shown');
    } else {
        elem.addClass('shown');
    }
}
