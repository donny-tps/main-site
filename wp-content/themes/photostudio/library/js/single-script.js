var lastScrollTop = 0, dir /* 1 - down, 2 - up */;

jQuery(document).ready(function() {
    jQuery(window).scroll(setScrollDir);
    jQuery(window).scroll(mainScrollHandler);
});
// jQuery(window).load(function() {
//     jQuery(window).scroll(setScrollDir);
//     jQuery(window).scroll(mainScrollHandler);
// });

function loadNextPostHandler() {
    window.shown_posts.push(window.post_id);

    var data = {
        'action': 'load_next_post',
        'cat_id': window.category_id,
        'posts': window.shown_posts
    };

    jQuery.ajax({
        url: window.ajaxurl, 
        data: data, 
        type: 'POST', 
        success:function(data){
            var loader = jQuery('#post-preloader');

            if(data) {
                window.loadMoreIsActive = true;
                loader.slideToggle();
                loader.before(data);
                setAnimVisible();
                jQuery(window).trigger('resize'); 
                setUrlAdressBar();
                postsIsotopeGridBuil()
            } else {
                loader.slideToggle();
                window.loadMoreIsActive = false;
            }            
        }
    });
}

function setAnimVisible() {
    jQuery('.wpb_animate_when_almost_visible').each(function() {        
        if (!jQuery(this).hasClass('wpb_start_animation')){
            jQuery(this).addClass('wpb_start_animation');
        }
    });
}

function setScrollDir(){ 
   var st = jQuery(window).scrollTop(); 
   if (st > lastScrollTop){
        dir = 1;
   } else {
        dir = 2;
   }

   lastScrollTop = st <= 0 ? 0 : st; 
}

function mainScrollHandler() {
    var scrollPosition = window.pageYOffset || document.documentElement.scrollTop,
        posts = jQuery( '#content-container > .site-width' ),
        lastPost = jQuery(posts[posts.length - 1]),
        lastPostBottomPosition = lastPost.offset().top + lastPost.height();

    if( ( ( lastPostBottomPosition - scrollPosition ) < ( window.innerHeight + 400 ) && window.loadMoreIsActive ) ){
        window.loadMoreIsActive = false;
        jQuery('#post-preloader').slideToggle(); 
        loadNextPostHandler(); 
    }    
    
    setUrlAdressBar();
}

function setUrlAdressBar() {
    var windowTop = jQuery(window).scrollTop(),
        windowBottom = windowTop + jQuery(window).height(),    
        posts = jQuery('.post-section');
    
    for(var i = 0; i < posts.length; i++) {
        var postTop = jQuery(posts[i]).position().top, 
            postBottom = postTop + jQuery(posts[i]).height();

        if(window.dir === 1) {
            if(postTop <= windowBottom && postBottom >= windowBottom) {
                changeUrl(posts[i]); 
                break; 
            }
        } else if(window.dir === 2) {
            if(postTop <= windowTop && postBottom >= windowTop) {
                changeUrl(posts[i]);  
                break;
            }
        }        
    }
}

function changeUrl(post) {
    var url = jQuery(post).attr('data-post-url');

    if(window.location.href !== url) {
        window.history.replaceState("", "", url);
    }     
}
function postsIsotopeGridBuil(){
    var postCount = 0;
    var block;
    if( postCount < jQuery('.post-section').length ) {
        postCount = jQuery('.post-section').length;
        block = jQuery('.post-section').eq(postCount-1).find('.blogpost-items');
        // setTimeout(function(){
        //     block.isotope({
        //         itemSelector: '.blogpost-item'
        //     });
        //     console.log('timeout: '+postCount);
        // }, 1500);
        var images = block.find( '.img-container > img' );
        var loaded = 0;
        images.bind('load', function(){
            loaded++;
            if( images.length == loaded ) {
                console.log('ready: '+loaded);
                block.isotope({
                    itemSelector: '.blogpost-item'
                });
            }
        });
    }
}