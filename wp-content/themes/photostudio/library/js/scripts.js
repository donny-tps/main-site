function updateViewportDimensions() {
    var w = window, d = document, e = d.documentElement, g = d.getElementsByTagName('body')[0], x = w.innerWidth || e.clientWidth || g.clientWidth, y = w.innerHeight || e.clientHeight || g.clientHeight;
    return {width: x, height: y}
}
// setting the viewport width
var viewport = updateViewportDimensions();
/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: ht tp://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
 */
var waitForFinalEvent = (function () {
    var timers = {};
    return function (callback, ms, uniqueId) {
        if (!uniqueId) {
            uniqueId = "Don't call this twice without a uniqueId";
        }
        if (timers[uniqueId]) {
            clearTimeout(timers[uniqueId]);
        }
        timers[uniqueId] = setTimeout(callback, ms);
    };
})();
// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;
function loadGravatars() {
    // set the viewport using the function above
    viewport = updateViewportDimensions();
    // if the viewport is tablet or larger, we load in the gravatars
    if (viewport.width >= 768) {
        jQuery('.comment img[data-gravatar]').each(function () {
            jQuery(this).attr('src', jQuery(this).attr('data-gravatar'));
        });
    }
} // end function

/*
 * Put all your regular jQuery in here.
 */
//document.ready
jQuery(document).ready(function (jQuery) {

    var jQuerycontainer = jQuery('.blogpost-wrapper');

   // setTimeout(function () {
   //  jQuerycontainer.isotope({
   //      // options
   //      itemSelector: '.blogpost-item'
   //  });
   // }, 1500);

    var images = jQuerycontainer.find( '.blogpost-item > a > img' );
    var loaded = 0;
    images.bind('load', function(){
        loaded++;
        if( images.length == loaded ) {
            jQuerycontainer.isotope({
                itemSelector: '.blogpost-item'
            });
            loaded = 0;
        }
    });

    jQuery('.blog-filters').on('click', 'span', function () {
        var filterValue = jQuery(this).data('slug');
        jQuerycontainer.isotope({filter: '.' + filterValue});
    });



    jQuery('#ubermenu-main-2-main-nav').slicknav(
            {
                prependTo: '.mobile-nav',
                closedSymbol: '',
                openedSymbol: ''
            }
    );
jQuery(function(){
    if( jQuery(window).width() <= 1185 ) return;
    jQuery(window).scroll(function () {
        var scroll = jQuery(window).scrollTop();
        if (scroll >= 200) {
            jQuery(".header").addClass("scroll");
        } else {
            jQuery(".header").removeClass("scroll");
        }
    });
});

    jQuery('a[href*="#"]:not([href="#"]), button[href*="#"]:not([href="#"])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = jQuery(this.hash);
            target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                jQuery('html,body').animate({
                    scrollTop: target.offset().top - 90
                }, 1000);
                return false;
            }
        }
    });
    jQuery('.staff-item .plus').click(function () {
        jQuery(this).parent().find('.staff-name').fadeToggle();
        jQuery(this).parent().find('.staff-details').slideToggle();
        jQuery(this).toggleClass('active');
        if (jQuery(this).hasClass('active')) {
            jQuery(this).html('-');
        } else {
            jQuery(this).html('+');
        }
    });
    var jQuerygrid = jQuery('.team-members').isotope({
// options
        itemSelector: '.staff-item',
        layoutMode: 'fitRows'
    });
    jQuery('.team-filters').on('click', 'span', function () {
        var filterValue = jQuery(this).data('slug');
        jQuerygrid.isotope({filter: '.' + filterValue});
        jQuery('.team-filters span.active').removeClass('active');
        jQuery(this).addClass('active');
    });
    var jQuerygallery = jQuery('.gallery-wrapper-listing, .event-wrapper-listing');
    setTimeout(function () {
        jQuerygallery.isotope({
            // options
            itemSelector: '.gallery-item-listing, .event-item-listing',
            layoutMode: 'masonry'
        });
    }, 200);

    setTimeout(function () {
        jQuery('.gallery-wrapper-listing').isotope();
    }, 1000);

    setTimeout(function () {
        jQuery('.event-wrapper-listing').isotope();
    }, 1000);

    jQuery('.blog-filters').on('click', 'span', function () {
        var filterValue = jQuery(this).data('slug');
        jQuerycontainer.isotope({filter: '.' + filterValue});
    });
    jQuery('.carousel-holder .close, .event-holder-modal .close').click(function () {
        jQuery('.carousel-holder, .overlay, .event-holder-modal').fadeOut();
    });
    jQuery(document).on('click', '.gallery-item-listing', function () {
        galleryItem.init(jQuery(this));
        return;
    });
    jQuery(document).on('click', '.event-item-listing', function () {
        eventItem.init(jQuery(this));
        return;
    });

    jQuery('.event-holder-modal .next').click(function () {
        eventItem.next();
        return;
    });
    jQuery('.event-holder-modal .prev').click(function () {
        eventItem.prev();
        return;
    });
    jQuery('.carousel-holder .next').click(function () {
        galleryItem.next();
        return;
    });
    jQuery('.carousel-holder .prev').click(function () {
        galleryItem.prev();
        return;
    });

    // Gallery pages
    jQuery('.load-more').click(function () {
        var item;
        for (var i = 0; i < 10; i++) {
            item = jQuery('<div class="gallery-item-listing" data-title="' + galleryElements[0]['title'] + '" data-description="' + galleryElements[0]['description'] + '" data-image="' + galleryElements[0]['url'] + '"><img src="' + galleryElements[0]['listingUrl'] + '"></div>');
            galleryElements.splice(0, 1);
            jQuery('.gallery-wrapper-listing').isotope('insert', item);
            // setTimeout(function () {
            //     jQuery('.gallery-wrapper-listing').isotope();
            // }, 200);
            var grid = jQuery('.gallery-wrapper-listing').imagesLoaded(function () {
                grid.isotope({});
            });
            if (!galleryElements.length) {
                jQuery('.load-more').html('YOU\'VE REACHED THE END!');
                return;
            }
        }

        setTimeout(function () {
            jQuery('.gallery-wrapper-listing').isotope('reload');
        }, 3000);
    });

    // Event pages
    jQuery('.load-more-events').click(function () {
        var item;
        for (var i = 0; i < 24; i++) {
            item = jQuery('<div class="event-item-listing" data-reference="' + eventElements[0]['reference'] + '" data-image="' + eventElements[0]['url'] + '" data-votes="' + eventElements[0]['votes'] + '" data-pid="' + eventElements[0]['pid'] + '"> <span class="vote-count"><i class="fa fa-heart"></i> ' + eventElements[0]['votes'] + '</span><img src="' + eventElements[0]['thumb'] + '"></div>');
            jQuery('.event-wrapper-listing').isotope('insert', item);
            eventElements.splice(0, 1);
            // setTimeout(function () {
            //     jQuery('.event-wrapper-listing').isotope();
            // }, 200);
            var grid = jQuery('.event-wrapper-listing').imagesLoaded(function () {
                grid.isotope({});
            });
            if (!eventElements.length) {
                jQuery('.load-more-events').html('YOU\'VE REACHED THE END!');
                return;
            }
        }

        setTimeout(function () {
            jQuery('.event-wrapper-listing').isotope('reload');
        }, 3000);
    });

    // Blog pages
// added new function setTimeout(function(){  ---original code here---});
//this buys the browser enough time  load the contents for the given item
// and hopefully will fix the glitch    
    jQuery('.load-more-posts').click(function () {
        var item;
        var temp = blogPosts.length;
        var length = jQuery(".blogpost-item").length;
        if (length == (temp+5)) {
            jQuery('.blogpost-wrapper').css('margin-bottom', '0px', 'important');
        } else {
            jQuery('.blogpost-wrapper').css('margin-bottom', '500px', 'important');
        }
        var items = [];
        for (var i = (length - 5); ((i < (length)) && (i < temp)); i++) {         
            if (blogPosts[i]['isTestimonial'] === true) {
                item = jQuery('<div class="blogpost-item all' + blogPosts[i]['terms'] + '"><a href="' + blogPosts[i]['url'] + '" class="testimonial"><span class="quote-quote">"</span><span class="quote-content">' + blogPosts[i]['content'] + '....</span><span class="person-name">' + blogPosts[i]['title'] + '</span></a></div>');
            } else if (blogPosts[i]['isTestimonial'] === false) {
                item = jQuery('<div class="blogpost-item all' + blogPosts[i]['terms'] + '"><a href="' + blogPosts[i]['url'] + '">' + blogPosts[i]['thumbnail'] + '<div class="post-content"><h3>' + blogPosts[i]['title'] + '</h3><div class="excerpt"><span class="categories">' + blogPosts[i]['excerpt'] + '</span><span class="post-date"></span>' + blogPosts[i]['description'] + '</div></div></a></div>');
            }
            
            items.push(item[0]);            
        }
        
        var grid = jQuery('.blogpost-wrapper').isotope('insert', items);
        grid.imagesLoaded().progress(function () {
            grid.isotope('layout');
        });        

        jQuery('.blogpost-wrapper').on('layoutComplete', function ( ) {
            jQuery('.blogpost-wrapper').css('margin-bottom', '0px', 'important');
        });
        
        if( i == temp){
            jQuery('.load-more-posts').html('YOU\'VE REACHED THE END!');
            return;
        }
    });

    jQuery('.personal-box, .model-box, .photo-package').click(function () {
        var location = jQuery(this).find('a').attr('href');
        window.location.href = location;
        return;
    });
// Youll need to call this every time the event occurs that exposes the bug, such as changing tab divs.
//     jQuery(window).scroll(function () {
//         /* FORCE REPAINT */
//         jQuery(".hero-image-width").repaint();
//     });
    loadGravatars();

    jQuery('form#login').on('submit', function (e) {
        jQuery('form#login p.status').show().text(ajax_scripts_object.loadingmessage);
        console.log(ajax_scripts_object.redirecturl);
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_scripts_object.ajaxurl,
            data: {
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': jQuery('form#login #username').val(),
                'password': jQuery('form#login #password').val(),
                'security': jQuery('form#login #security').val()},
            success: function (data) {
                jQuery('form#login p.status').text(data.message);
                if (data.loggedin == true) {
                    document.location.href = ajax_scripts_object.redirecturl;
                    return;
                }
            }
        });
        e.preventDefault();
    });


    var headerHeight = jQuery('.header').outerHeight();
    jQuery('.header-spacing').css('height', headerHeight);

    //JUMPS WHEN PUSHING THE ADDRESS BAR ON THE MOBILE!
    // jQuery(window).resize(function () {
    //     var headerHeight = jQuery('.header').outerHeight();
    //     jQuery('.header-spacing').css('height', headerHeight);
    // });

//    jQuery('form.new-group .add-touchpoint').click(function() {
//        jQuery('');
//    });


});
jQuery.fn.repaint = function () {

    jQuery(this).each(function () {

        var athis = jQuery(this);
        var opacity = athis.css("opacity");
        if (opacity > 0)
            athis.css({"opacity": opacity - 0.01});
        setTimeout(function () {

            athis.css({"opacity": opacity});
        }, 1); // async call: prevent skipping
    });
};
var galleryItem = {
    current: '',
    init: function (ele) {
        galleryItem.current = ele;
        var image = ele.data('image');
        var title = ele.data('title');
        var description = ele.data('description');
        jQuery('.carousel-holder, .overlay').fadeIn();
        jQuery('.carousel-holder').css('background-image', 'url(' + image + ')');
        jQuery('.carousel-holder .content-holder h3').html(title);
        jQuery('.carousel-holder .content-holder p').html(description);
        jQuery('.carousel-holder .loading').fadeOut();
    },
    next: function () {
        var next = galleryItem.current.next();
        if (next.length) {
            galleryItem.init(next);
            return;
        }
        galleryItem.init(jQuery('.gallery-wrapper-listing .gallery-item-listing:first-child'));
        return;
    },
    prev: function () {
        var next = galleryItem.current.prev();
        if (next.length) {
            galleryItem.init(next);
            return;
        }
        galleryItem.init(jQuery('.gallery-wrapper-listing .gallery-item-listing:last-child'));
        return;
    }
};
var eventItem = {
    current: '',
    loggedIn: "",
    init: function (ele) {
        eventItem.current = ele;
        var image = ele.data('image');
        var reference = ele.data('reference');
        var votes = ele.data('votes');
        var pid = ele.data('pid');
        jQuery('.event-holder-modal, .overlay').fadeIn();
        //jQuery('.event-holder-modal .image-holder').html('<img src="'+ image + '" />');
        //jQuery('.event-holder-modal').css('background-image', 'url(' + image + ')');
        jQuery('.event-holder-modal .image-holder').css('background-image', 'url(' + image + ')');
        jQuery('.event-holder-modal .content-holder h3').html('Photo Reference #' + reference + ' - <span title="Votes for this photo"><i class="fa fa-heart">' + votes + '</span>');
        jQuery('.event-holder-modal .content-holder p').html('<span class="buy-print vote-button" data-postid="' + pid + '"><i class="fa fa-heart"></i> Vote for this photo</i></span><a href="' + image + '" class="buy-print download" download><i class="fa fa-download"></i> Download Image</a>');
        jQuery('.event-holder-modal .loading').fadeOut();
        jQuery(document).on('click', '.vote-button', function () {

            var isOpen = jQuery('.voting-open').data('isopen');
            if (isOpen == 'yes') {

                eventItem.voteBoxInit(jQuery(this));
                return false;
            }

            if (isOpen == 'no') {
                jQuery(this).html('Sorry! Voting has been closed on this event.');
                return false;
            }
        });

    },
    voteBoxInit: function (ele) {
        var photo = ele.data('postid');
        jQuery('.voting-box #photo').val(photo);
        jQuery('.voting-box, .voting-overlay').fadeIn();


        jQuery('#voteform button').click(function () {


            eventItem.processVote();

            return false;
        });
        jQuery('.voting-box .close-vote').click(function () {

            jQuery('.voting-box, .voting-overlay').fadeOut();
            jQuery('.voting-box .message, .voting-box .social-wrap').fadeOut();
            jQuery('.voting-box #voteform').slideDown();

        });
        return false;
    },
    processVote: function () {
        var data = jQuery('#voteform').serialize();
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_scripts_object.ajaxurl,
            data: 'action=ajaxprocessvote&' + data,
            success: function (data) {
                if (data.error) {
                    jQuery('.voting-box .message').html('<p class="alert-error">' + data.error + '</p>');
                    return;
                }
                if (data.success) {
                    jQuery('.voting-box .message').html('<p class="alert-success">' + data.success + '</p>');
                    jQuery('#voteform').slideUp();
                    jQuery('.voting-box .social-wrap').slideDown();
                }
            }
        });

    },
    next: function () {
        var next = eventItem.current.next();
        if (next.length) {
            eventItem.init(next);
            return;
        }
        eventItem.init(jQuery('.event-wrapper-listing .event-item-listing:first-child'));
        return;
    },
    prev: function () {
        var next = eventItem.current.prev();
        if (next.length) {
            eventItem.init(next);
            return;
        }
        eventItem.init(jQuery('.event-wrapper-listing .event-item-listing:last-child'));
        return;
    },
    voteInit: function (selected) {
        var pid = selected.data('postid');
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_scripts_object.ajaxurl,
            data: 'action=ajaxcheckloggedin',
            success: function (data) {
                if (data.success === "yes") {
                    eventItem.loggedIn = "yes";
                } else {
                    jQuery(selected).before('<div class="login-link-vote"><a href="/login/"><i class="fa fa-exclamation"></i> You must be signed in to vote, login/sign up here.</a></div>');
                    jQuery(selected).remove();
                    return;
                }
            }
        });
        // must be logged in to get this far
        selected.html('<i class="fa fa-circle-o-notch fa-spin"></i> Adding your vote');
        //add vote
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_scripts_object.ajaxurl,
            data: 'action=ajaxaddvote&pid=' + pid,
            success: function (data) {
                if (data.success == 'yes') {
                    selected.html('<i class="fa fa-check"></i> ' + data.message + '');
                    var count = selected.parent().parent().find('h3 span i').html();
                    selected.parent().parent().find('h3 span i').html(parseInt(count) + 1);
                    return;
                } else {
                    selected.html('<i class="fa fa-warning"></i> ' + data.message + '');
                }
            }
        });
    },
};

/* Show More Comments Script */
jQuery(document).ready(function($) {

    if(!$('.commentlist')) return;

    var list = $('.commentlist');
    var comments = $('.comment.depth-1');
    comments.hide();
    comments.eq(0).show().after('<a href="#" id="showMoreComments" class="comment-reply-link show-more-comments">Show more comments</a>');
    $('.commentlist').on('click', '#showMoreComments', function(e){
        e.preventDefault();
        //$(this).next().fadeIn().after('<a href="#" id="showMoreComments" class="comment-reply-link show-more-comments">Show more comments</a>');
        $(this).remove();
        comments.fadeIn();
    })
});

jQuery(function($){
    if( !$('.ubermenu-item-has-children') )
        return;

    $('.ubermenu-item-has-children a.slicknav_item').attr('data-prevented', 0)

    $('.ubermenu-nav').on('click', '.slicknav_item', function(e) {
        if( $(window).width() >= 1186 ) {
            return;
        }
        $this = $(this);
        if( $this.parents( '.ubermenu-item-level-1' ).length ) {
            window.location = $this.find('.ubermenu-target').attr('href');
            return;
        }
        if( $this.attr( 'data-prevented' ) == 0 ) {
            $this.attr( 'data-prevented', 1 );
        } else if( $this.attr( 'data-prevented' ) == 1 ) {
            window.location = $this.find('.ubermenu-target').attr('href');
        }
    });
});



function unSelectedImage() {
    var el = jQuery('.image-container .image-block-container > .vc_column-inner[data-hover="true"]');
    el.attr('data-hover', 'false');
    el.removeClass('selected');
};
jQuery(function($){
    $('.image-block-container').css('display', 'block');
    $('.image-title').on('click', function(e){
        e.stopPropagation();
        if( jQuery('.image-container .image-block-container > .vc_column-inner[data-hover="true"]').length ) {
            unSelectedImage();
        } else {
            history.pushState(null, null, ' ');
        }
        $(this).parent().parent().attr('data-hover', 'true').addClass('selected');
    });
    jQuery('.image-content').on('click', function (e) {
        window.history.back();
    });
    window.addEventListener('popstate', function(event) {
        unSelectedImage();
    });
});

jQuery(function($){
    if( !($('.post-section').length ) )
        return
    var postCount = $('.post-section').length;
    $('#content-container').on('DOMSubtreeModified', function(){
        if( postCount < $('.post-section').length ) {
            postCount = $('.post-section').length;
            $(document).trigger('triggerednextpost');
			//send event to GTM
			dataLayer.push({'event':'triggerednextpost'});
			//dataLayer.push({'scrollTriggeredPost':window.location.href});
        }
    });
    //$(document).on('triggerednextpost', function(){
        //console.log('triggerednextpost');
    //});
});

jQuery(function($){
    // These variables are created in the header front page
    if( !window.style_url && !window.script_url ) {
        // If from no means it's not a front page
        return;
    }
    if (window.innerWidth < 640)
        return;

    // Added Styles Plyr Library
    var head = document.getElementsByTagName('head')[0];
    var styles = document.createElement('style');
    styles.setAttribute('type', 'text/css');
    styles.setAttribute('id', 'plyrStyles');
    head.appendChild(styles);
    $( "#plyrStyles" ).load( window.style_url );

    // Added Script Plyr Library
    var body = document.getElementsByTagName('body')[0];
    var script = document.createElement('script');
    script.setAttribute('type', 'text/javascript');
    script.setAttribute('id', 'plyrScript');
    body.appendChild(script);
    $( "#plyrScript" ).load( window.script_url, function(){
        playerInit();
    } );

    // Init Player
    // if( !jQuery(".js-player").length )
    //     return;

    // var frameLoad = false;
    // console.log(jQuery(".homepage-video"));
    // jQuery(".homepage-video").on('DOMSubtreeModified', function(){
    //     console.log(jQuery(".js-player").find('iframe'));
    //     if( jQuery(".js-player").find('iframe').length && frameLoad ) {
    //         return;
    //     }
    //     jQuery(".js-player").find('iframe').on('load', function(){
    //         console.log(jQuery(".js-player").find('iframe'));
    //         playerInit();
    //         frameLoad = true;
    //     });
    // });

    // Init Player



    function playerInit() {
        if ( jQuery(".js-player").length > 0) {
            players = plyr.setup(document.querySelector('.js-player'), {
            // var players =  new Plyr('.js-player', {
                autoplay: true,
                clickToPlay: false,
                controls: '',
                // debug: true,
                muted: true
            });
            window.player = players[0];
            // window.player = players[0];
            // players[0].on('ready', function(){
            //
            // });
            // players[0].on('statechange', function(){
            //     players[0].play();
            //     players[0].togglePlay(false);
            //     console.log('statechange statechange');
            // });
            // players[0].on('ended', function(event){
            //     players[0].play();
            // });
        }
		//disabled livechatinc code. Uncomment these to enable.
		//      WARNING::::::: this will enable two livechat windows on the website. Check the documentation for disabling the other one first.
        //window.__lc = window.__lc || {};
        //window.__lc.license = 6834961;
        //(function() {
        //    var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
        //    lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
        //    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
        //})();
    }

});

// Set Background Image for header in single post
// Variables desktopBackground and mobileBackground are determined in single.php
jQuery(function($){
    if( !window.desktopBackground && !window.mobileBackground )
        return;
    var header = $('.blog-background');
    if( $(window).width() >= 640 ) {
        $(header[0]).css('background-image', 'url('+window.desktopBackground+')');
    } else {
        $(header[0]).css('background-image', 'url('+window.mobileBackground+')');
    }
});

jQuery(function($){
    if( $(window).width() > 1185 || !$('.slicknav_menu').length ) return;
    var CurrentScroll,
        filterBlock,
        filterHeight,
        height,
        NextScroll,
        filterStartHeight,
        actualScroll,
        filterHidden,
        filterChange;

    CurrentScroll = jQuery(window).scrollTop();
    filterBlock = jQuery('.header');
    filterHeight = filterBlock.outerHeight();
    filterStartHeight = filterBlock.outerHeight();
    jQuery('.header-spacing').css('height', filterStartHeight);
    height = filterHeight;
    headerScroll();
    jQuery(window).on('scroll', headerScroll);

    function headerScroll(){
        // if( jQuery(window).width() > 991 ) return;
        NextScroll = jQuery(window).scrollTop();
        if ( NextScroll > CurrentScroll && height > 0 || NextScroll > CurrentScroll && filterHidden){
            if(actualScroll != 0) {
                actualScroll = 0;
                filterHidden = false;
                filterBlock.css('transition', 'unset');
            }
            filterBlock.addClass('magazine-filter_close');
            jQuery('.slicknav_open').trigger('click');
            filterBlock.css('overflow', 'hidden');
            height -= NextScroll - CurrentScroll;
            filterChange = true;
        } else if( height < filterHeight && NextScroll < CurrentScroll && actualScroll < 900 || height !== 0) {
            height += CurrentScroll - NextScroll;
            if( CurrentScroll - NextScroll > 0 ) {
                actualScroll += CurrentScroll - NextScroll;
            }
            if( actualScroll > 700 ) {
                filterBlock.css('transition', 'height .3s');
                height = 0;
                jQuery('.slicknav_open').trigger('click');
                filterBlock.css('overflow', 'hidden');
                filterHidden = true;
            }
            if( jQuery('.magazine-filter_close').length ) {
                filterBlock.removeClass('magazine-filter_close');
                filterBlock.removeClass('border-transparent');
            }
            filterChange = true;
        } else {
            filterChange = false;
        }
        if( filterChange || NextScroll === 0 ) {
            if( height > filterHeight || NextScroll === CurrentScroll || NextScroll === 0) {
                height = filterHeight;
                filterBlock.css('overflow', 'visible');
            } else if( height < 0 ) {
                height = 0;
            }
            filterBlock.css('height', height );
        }
        CurrentScroll = NextScroll;  //Updates current scroll position
    }
});
jQuery(function($){
    if( !$('body').hasClass('home') )
        return;
    $(document).on('click', function(){
        window.player.play();
        delete window.player;
        $(document).off('click');
    });

});

/*Custom multipage for gravity forms (only form id 21 & 11)*/
jQuery(function($){
	/*Script for form id 21*/
	/*Add proggress bar*/
	$("#gform_21").before('<div id="pb-container" class="pb-container"><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width:100%;height:100%;background:#d8d8d8;"><path d="M 0,2 L 100,2" stroke="#eee" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 100,2" stroke="rgb(2,242,0)" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 87.5; transition: all 0.5s cubic-bezier(0.4, 0, 1, 1);"></path></svg><div class="pb-text">12%</div></div>');
	
	/*Add next button*/
	$("#gform_21").after('<a class="pb-button-next" id="pb-next"><span>Next ></span></a>');
	/*Add back button*/
	$("#gform_21").after('<a class="pb-button-back" id="pb-back"><span>< Back</span></a>');
	
	/*Modify onepage form to multipage form*/
	$("#gform_fields_21 li").removeClass('col-fifth').addClass('pb-fields');
	$("#gform_wrapper_21").addClass('pb-wrapper');
	$("#field_21_7").css('display','none');
	$("#field_21_4").css('display','none');
	$("#field_21_5").css('display','none');
	$("#field_21_8").css('display','none');
	$("#field_21_3").css('display','none');
	$("#field_21_6").css('display','none');
	$("#field_21_11").css('display','none');
	$("#gform_submit_button_21").css('display','none');
	$("#gform_wrapper_21 a.pb-button-back").css('display','none').attr('page','0');
	$("#gform_wrapper_21 a.pb-button-next").attr('page','2');
	
	$("#gform_fields_21 input").each(function(){
		var $this = $(this);
		$this.on('input', function(){
			$this.removeClass('hasError');
			$("." + $this.attr('id') + "_error").remove();
		});
	});
	$("#gform_fields_21 select").each(function(){
		var $this = $(this);
		$this.on('change', function(){
			$this.removeClass('hasError');
			$("." + $this.attr('id') + "_error").remove();
		});
	});
	
	
	/*Script for form id 11*/
	/*Add proggress bar*
	$("#gform_11").before('<div id="pb-container" class="pb-container"><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width:100%;height:100%;"><path d="M 0,2 L 100,2" stroke="#eee" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 100,2" stroke="rgb(2,242,0)" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 87.5; transition: all 0.5s cubic-bezier(0.4, 0, 1, 1);"></path></svg><div class="pb-text">12%</div></div>');
	
	/*Add next/back buttons*
	$("#gform_11").after('<a class="pb-button-next" id="pb-next"><span>Next ></span></a>');
	$("#gform_11").after('<a class="pb-button-back" id="pb-back"><span>< Back</span></a>');
	
	/*Modify onepage form to multipage form*
	$("#gform_fields_11 li").removeClass('col-fifth').addClass('pb-fields');
	$("#gform_wrapper_11").addClass('pb-wrapper');
	$("#field_11_7").css('display','none');
	$("#field_11_4").css('display','none');
	$("#field_11_5").css('display','none');
	$("#field_11_8").css('display','none');
	$("#field_11_3").css('display','none');
	$("#field_11_6").css('display','none');
	$("#field_11_11").css('display','none');
	$("#gform_submit_button_11").css('display','none');
	$("#gform_wrapper_11 a.pb-button-back").css('display','none').attr('page','0');
	$("#gform_wrapper_11 a.pb-button-next").attr('page','2');
	
	$("#gform_fields_11 input").each(function(){
		var $this = $(this);
		$this.on('input', function(){
			$this.removeClass('hasError');
			$("." + $this.attr('id') + "_error").remove();
		});
	});
	$("#gform_fields_11 select").each(function(){
		var $this = $(this);
		$this.on('change', function(){
			$this.removeClass('hasError');
			$("." + $this.attr('id') + "_error").remove();
		});
	});
	
	/*Universal methods for form id 21 & 11*/
	$(".pb-button-next").on('click', function(){
		var formID = $(".pb-wrapper form").attr('id').split('_')[1];
		switch($(this).attr('page')) { 
			case "2":
				if($("#input_" + formID + "_1").val() == "") {
					$("#input_" + formID + "_1").addClass('hasError');
					$(".input_" + formID + "_1_error").remove();
					$("#input_"+formID+"_1").after('<span class="input_'+formID+'_1_error">First Name is required!</span>');
				} else {
					$("#field_"+formID+"_1").css('display','none');
					$("#field_"+formID+"_7").css('display','block');
					$(".pb-button-back").css('display','block').attr('page','1');
					$(".pb-button-next").css('display','block').attr('page','3');
					$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','75');
					$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,222,0)');
					$(".pb-text").html('25%').css('left','70px');
				}
				break;
			case "3":
				if($("#input_"+formID+"_7").val() == "") {
					$("#input_"+formID+"_7").addClass('hasError');
					$(".input_"+formID+"_7_error").remove();
					$("#input_"+formID+"_7").after('<span class="input_'+formID+'_7_error">Last Name is required!</span>');
				} else {
					$("#field_"+formID+"_7").css('display','none');
					$("#field_"+formID+"_4").css('display','block');
					$(".pb-button-back").css('display','block').attr('page','2');
					$(".pb-button-next").css('display','block').attr('page','4');
					$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','62.5');
					$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,202,0)');
					$(".pb-text").html('37%').css('left','92px');
				}
				break;
			case "4":
				var regexPhone = /^([0-9\-\(\)\s]+)$/;
				if($("#input_"+formID+"_4").val() == "") {
					$("#input_"+formID+"_4").addClass('hasError');
					$(".input_"+formID+"_4_error").remove();
					$("#input_"+formID+"_4").after('<span class="input_'+formID+'_4_error">Phone is required!</span>');
				} else {
					if(!regexPhone.test($("#input_"+formID+"_4").val())) {
						$("#input_"+formID+"_4").addClass('hasError');
						$(".input_"+formID+"_4_error").remove();
						$("#input_"+formID+"_4").after('<span class="input_'+formID+'_4_error">Please enter a valid phone number!</span>');
					} else {
						$("#field_"+formID+"_4").css('display','none');
						$("#field_"+formID+"_5").css('display','block');
						$(".pb-button-back").css('display','block').attr('page','3');
						$(".pb-button-next").css('display','block').attr('page','5');
						$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','50');
						$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,182,0)');
						$(".pb-text").html('50%').css('left','114px');
					}
				}
				break;
			case "5":
				var regexEmail = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if($("#input_"+formID+"_5").val() == "") {
					$("#input_"+formID+"_5").addClass('hasError');
					$(".input_"+formID+"_5_error").remove();
					$("#input_"+formID+"_5").after('<span class="input_'+formID+'_5_error">Email is required!</span>');
				} else {
					if(!regexEmail.test($("#input_"+formID+"_5").val())) {
						$("#input_"+formID+"_5").addClass('hasError');
						$(".input_"+formID+"_5_error").remove();
						$("#input_"+formID+"_5").after('<span class="input_'+formID+'_5_error">Please enter a valid email address!</span>');
					} else {
						$("#field_"+formID+"_5").css('display','none');
						$("#field_"+formID+"_8").css('display','block');
						$(".pb-button-back").css('display','block').attr('page','4');
						$(".pb-button-next").css('display','block').attr('page','6');
						$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','37.5');
						$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,162,0)');
						$(".pb-text").html('62%').css('left','136px');
					}
				$(".pb-button-next").trigger("click");
				}
				break;
			case "6":
				
				$("#field_"+formID+"_8").css('display','none');
				$("#field_"+formID+"_3").css('display','block');
				$(".pb-button-back").css('display','block').attr('page','5');
				$(".pb-button-next").css('display','block').attr('page','7');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','25');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,142,0)');
				$(".pb-text").html('75%').css('left','158px');
				
				break;
			case "7":
				if($("#input_"+formID+"_3 :selected").val() == "Please choose") {
					$("#input_"+formID+"_3").addClass('hasError');
					$(".input_"+formID+"_3_error").remove();
					$("#input_"+formID+"_3").after('<span class="input_'+formID+'_3_error">Studio is required!</span>');
				} else {
					$("#field_"+formID+"_3").css('display','none');
					$("#field_"+formID+"_6").css('display','block');
					$(".pb-button-back").css('display','block').attr('page','6');
					$(".pb-button-next").css('display','block').attr('page','8');
					$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','12.5');
					$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,122,0)');
					$(".pb-text").html('87%').css('left','180px');
				}
				break;
			case "8":
				if($("#input_"+formID+"_6 :selected").val() == "Please choose") {
					$("#input_"+formID+"_6").addClass('hasError');
					$(".input_"+formID+"_6_error").remove();
					$("#input_"+formID+"_6").after('<span class="input_'+formID+'_6_error">Type of Photo Shoot is required!</span>');
				} else {
					$("#field_"+formID+"_6").css('display','none');
					$("#field_"+formID+"_11").css('display','block');
					$("#gform_submit_button_"+formID+"").css('display','block');
					$(".pb-button-back").css('display','block').attr('page','7');
					$(".pb-button-next").css('display','none');
					$(".pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','0');
					$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,102,0)');
					$(".pb-text").html('100%').css('left','202px');
					$(".pb-button-back").addClass('mTextareaBottom');
					$(".pb-wrapper .gform_footer input[type=submit]").addClass('mTextareaBottom');
				}
				break;
		}
	});
	$(".pb-button-back").on('click', function(){
		var formID = $(".pb-wrapper form").attr('id').split('_')[1];
		switch($(this).attr('page')) {
			case "1":
				$("#field_"+formID+"_1").css('display','block');
				$("#field_"+formID+"_7").css('display','none');
				$(".pb-button-back").css('display','none');
				$(".pb-button-next").css('display','block').attr('page','2');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','87.5');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,242,0)');
				$(".pb-text").html('12%').css('left','48px');
				break;
			case "2":
				$("#field_"+formID+"_7").css('display','block');
				$("#field_"+formID+"_4").css('display','none');
				$(".pb-button-back").css('display','block').attr('page','1');
				$(".pb-button-next").css('display','block').attr('page','3');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','75');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,222,0)');
				$(".pb-text").html('25%').css('left','70px');
				break;
			case "3":
				$("#field_"+formID+"_4").css('display','block');
				$("#field_"+formID+"_5").css('display','none');
				$(".pb-button-back").css('display','block').attr('page','2');
				$(".pb-button-next").css('display','block').attr('page','4');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','62.5');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,202,0)');
				$(".pb-text").html('37%').css('left','92px');
				break;
			case "4":
				$("#field_"+formID+"_5").css('display','block');
				$("#field_"+formID+"_8").css('display','none');
				$(".pb-button-back").css('display','block').attr('page','3');
				$(".pb-button-next").css('display','block').attr('page','5');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','50');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,182,0)');
				$(".pb-text").html('50%').css('left','114px');
				break;
			case "5":
				$("#field_"+formID+"_8").css('display','block');
				$("#field_"+formID+"_3").css('display','none');
				$(".pb-button-back").css('display','block').attr('page','4');
				$(".pb-button-next").css('display','block').attr('page','6');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','37.5');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,162,0)');
				$(".pb-text").html('62%').css('left','136px');
				break;
			case "6":
				$("#field_"+formID+"_3").css('display','block');
				$("#field_"+formID+"_6").css('display','none');
				$(".pb-button-back").css('display','block').attr('page','5');
				$(".pb-button-next").css('display','block').attr('page','7');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','25');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,142,0)');
				$(".pb-text").html('75%').css('left','158px');
				break;
			case "7":
				$("#field_"+formID+"_6").css('display','block');
				$("#field_"+formID+"_11").css('display','none');
				$("#gform_submit_button_"+formID+"").css('display','none');
				$(".pb-button-back").css('display','block').attr('page','6');
				$(".pb-button-next").css('display','block').attr('page','8');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','12.5');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,122,0)');
				$(".pb-text").html('87%').css('left','180px');
				$(".pb-button-back").removeClass('mTextareaBottom');
				$(".pb-wrapper .gform_footer input[type=submit]").removeClass('mTextareaBottom');
				break;
		}
	});
});

