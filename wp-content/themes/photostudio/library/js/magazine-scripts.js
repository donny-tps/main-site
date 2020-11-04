jQuery(function($){
    var CurrentScroll,
        filterBlock = jQuery('.header'),
        $window = jQuery(window),
        filterHeight,
        height,
        NextScroll,
        filterStartHeight,
        actualScroll,
        filterHidden,
        filterChange,
        filterNewItems = [],
        isotopeWrap,
        allItems = false,
        filterNewItemsPages = [],
        appended_page = 1,
        allLoaded = false,
        postItems,
        windowCenterHeight,
        hiddenElemets = [],
        visibleElemtns = [],
        timerHidden;

    isotopeWrap = jQuery('.post-items-wrapper');
    isotopeWrap.imagesLoaded(function() {
        isotopeWrap.isotope({
            itemSelector: '.post-item'
        });
    });
    // Isotope Filtering
    var filterItems = [];
    var filterValue = '';
    jQuery('.magazine-filter').on('click', '.magazine-filter-item > span', function (e) {
        e.stopPropagation();
        var $this = jQuery(this);
        var appended = true;

        if( $this.parent().hasClass('some-selected') ) {
            appended = false;
        } else if ( $this.parent().hasClass('all-selected') ) {
            appended = false;
        }

        if( !$(e.target).parents('.magazine-subfilter').length ) {
            submenuOpened($this);
        }

        // visibleItems();

        // not filtering if have child categories
        //if( $this.parent('.has-child-item').length ) return;

        if( $this.parent().hasClass('magazine-filter-subitem') ) {
            var parentItem = $this.parents('.has-child-item');
            var parentSpan = parentItem.children('span');
            if( parentSpan.hasClass('active') ) {
                parentSpan.removeClass('active');
                for(var i = 0; i < filterItems.length; i++) {
                    if( filterItems[i] == '.'+parentSpan.data('slug') ) {
                        filterItems.splice(i, 1);
                    }
                }
            }
        }

        if( $this.hasClass( 'active' ) ) {
            // Remove Item Out Of Filter
            $this.removeClass('active');
            for(var i = 0; i < filterItems.length; i++) {
                if( filterItems[i] == '.'+jQuery(this).data('slug') ) {
                    filterItems.splice(i, 1);
                }
            }
        } else if ( appended ) {
            // Add Item In Filter
            $this.addClass('active');
            filterItems.push( '.'+jQuery(this).data('slug') );
        }
        if( $this.parents('.has-child-item').length ) {
            var parentItem = $this.parents('.has-child-item');
            parentItem.removeClass('all-selected some-selected');
            var spans = parentItem.find('.magazine-filter-subitem > span');
            var activeSpans = parentItem.find('.magazine-filter-subitem > span.active');
            if( activeSpans.length == spans.length ) {
                parentItem.addClass('all-selected');
            } else if( parentItem.children('span').hasClass('active') ){
                parentItem.addClass('all-selected');
            } else if( activeSpans.length == 0 ) {
                parentItem.removeClass('all-selected some-selected');
            } else {
                parentItem.addClass('some-selected');
            }
        }
        if( appended ) {
            visibleItems();
            appendToFilter();
            setTimeout(function () {
                isotopeWrap.isotope({filter: filterItems.join(', ')}).isotope();//.isotope( 'layout' );
            }, 1500);
        }
    });

    function submenuOpened(item) {
        var $this = item.parent();
        filterHeight = filterStartHeight;
        headerScroll();
        if( $this.hasClass('open') ) {
            $this.removeClass('open').removeClass('opened').attr('style', '');
            return;
        }
        $('.magazine-filter-item').removeClass('open').removeClass('opened').attr('style', '');
        $('.magazine-subfilter').attr('style', '');

        var $submenu = $this.find('.magazine-subfilter').eq(0);
        var buttonPos = $this.position();
        window.setTimeout(function(){
            var buttonPos = $this.position();
            if( $submenu.length ) {
                $this.css('position', 'static');
                var submenuHeight = $submenu.outerHeight();
                var openMenuHeight = $this.outerHeight();
                $this.addClass('opened');
                window.setTimeout(function(){
                    $this.addClass('open').css('height', openMenuHeight).css('margin-bottom', submenuHeight);
                    $submenu.css('top', buttonPos.top + $this.outerHeight() + 20 + 'px').css('height', submenuHeight-10);
                    filterHeight += submenuHeight;
                    headerScroll();
                },100);
            }
        }, 300);

    }
    window.btnLoadMoreIsActive = true;
    var button = jQuery( '#load-more-button' );
    button.css( 'opacity', '0' );
    $window.scroll(function() {
        hiddenItems();
        headerScroll();
        if( !!button ){
            var scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
            var buttonTopPosition = button.offset().top;
            if( ( ( buttonTopPosition - scrollPosition ) < ( window.innerHeight + 300 ) ) && window.btnLoadMoreIsActive ){
                window.btnLoadMoreIsActive = false;
                appendPageToFilter();
            }
        }
    });
    jQuery(window).load(function(){
        loadMorePostsHandler();
        CurrentScroll = $window.scrollTop();
        filterHeight = filterBlock.outerHeight();
        filterStartHeight = filterBlock.outerHeight();
        jQuery('.header-spacing').css('height', filterStartHeight);
        height = filterHeight;
        headerScroll();
        postItems = $('.post-item');
        windowCenterHeight = $window.height()/2; + $('#post-items-with-bt').offset().top;
        // Blinking bar on closed filter
        if( $window.width() < 992 ) {
            window.setInterval(function(){
                if( !jQuery('.magazine-filter_close').length ) return;
                jQuery('.magazine-filter_close').addClass('border-transparent');
                window.setTimeout(function () {
                    jQuery('.magazine-filter_close').removeClass('border-transparent');
                }, 300)
            }, 4000);
        }
    });
    /*
    ** Closed / Opened Header
     */
    function headerScroll(){
        NextScroll = $window.scrollTop();
        if ( NextScroll > CurrentScroll && height > 0 || NextScroll > CurrentScroll && filterHidden){
            if(actualScroll != 0) {
                actualScroll = 0;
                filterHidden = false;
                filterBlock.css('transition', 'unset');
            }
            if( !filterBlock.hasClass('magazine-filter_close') )
                filterBlock.addClass('magazine-filter_close');
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
                filterHidden = true;
            }
            if( filterBlock.hasClass('magazine-filter_close') )
                filterBlock.removeClass('magazine-filter_close border-transparent');
            filterChange = true;
        } else {
            filterChange = false;
        }
        if( filterChange || NextScroll === 0 ) {
            if( height > filterHeight || NextScroll === CurrentScroll || NextScroll === 0) {
                height = filterHeight;
            } else if( height < 0 ) {
                height = 0;
            }
            filterBlock.css('height', height );
        }
        CurrentScroll = NextScroll;  //Updates current scroll position
    }

    /*
    ** Adds all elements to the filter
     */
    function appendToFilter() {
        if( allItems ) {
            return;
        }
        if( !allLoaded ) {
            setTimeout(function(){
                appendToFilter();
            }, 2000);
            return false;
        }
        for( var i = 0; i < filterNewItemsPages.length; i++ ) {
            jQuery(filterNewItemsPages[i]).each(function(index, element){
                filterNewItems.push( element );
            });
        }
        isotopeWrap.isotope()
            .append( jQuery(filterNewItems) )
            .isotope( 'appended', jQuery(filterNewItems) )
        setTimeout(function(){
            postItems = $('.post-item');
            isotopeWrap.isotope( 'layout' );
        }, 500);
        allItems = true;
        filterNewItems = null;
    }

    /*
    **  Adds items to a filter by one page
     */
    function appendPageToFilter() {
        if( allItems ) return;
        if( !allLoaded ) {
            setTimeout(function(){
                appendPageToFilter();
            }, 2000);
            return false;
        }
        isotopeWrap.isotope()
            .append( filterNewItemsPages[0] )
            .isotope( 'appended', filterNewItemsPages[0] );
        filterNewItemsPages = filterNewItemsPages.slice(1);
        setTimeout(function(){
            isotopeWrap.isotope( 'layout' );
            appended_page++;
            window.btnLoadMoreIsActive = true;
            postItems = $('.post-item');
            //hiddenItems();
        }, 500);
        if( !filterNewItemsPages.length ) {
            allItems = true;
            window.btnLoadMoreIsActive = false;
            return;
        }
    }

    /*
    **  Loads posts
     */
    function loadMorePostsHandler() {
        var action;
        if( jQuery('.post-items-wrapper-plus').length ) {
            action = 'loadmoreplus';
        } else {
            action = 'loadmore';
        }
        var data = {
            'action': action,
            'query': window.posts_query,
            'page' : window.current_page,
            'first_page_posts' : window.first_page_posts,
        };
        jQuery.ajax({
            url: window.ajaxurl,
            data: data,
            type: 'POST',
            success:function(data){
                window.btnLoadMoreIsActive = true;
                if( data ) {
                    filterNewItemsPages.push( jQuery(data) );
                    if (window.current_page == window.max_pages) {
                        allLoaded = true;
                    } else {
                        window.current_page++;
                        loadMorePostsHandler();
                    }
                } else {
                    if (window.current_page == window.max_pages) {
                        allLoaded = true;
                    }
                    // jQuery('#load-more-button').remove();
                }
            }
        });
    }
    /*
    ** Hides items that are out of the screen
     */
    function hiddenItems(){
        // if( !$('.post-items-wrapper-plus-mobile').length ) return; //Deleted For Production
        if( $window.width() > 991 ) return;
        if( postItems == undefined || !postItems.length ) return;
        clearTimeout(timerHidden);
        timerHidden = setTimeout(function(){
            hiddenElemets = [];
            visibleElemtns = [];
            var filterFilter;
            if( filterItems.length ) {
                filterFilter = filterItems.join(', ');
            } else {
                filterFilter = '.all';
            }
            postItems.filter(filterFilter).each(function(i, el){
                $el = $(el);
                var top = Math.abs( ($el.css('top').substr(0, $el.css('top').length - 2)) - NextScroll + windowCenterHeight);
                if( top > 2000 ) {
                    if( !$el.hasClass('hiddenPostItem') ) {
                        hiddenElemets.push(el);
                        $el.addClass('hiddenPostItem');
                    }
                } else {
                    if( $el.hasClass('hiddenPostItem') ) {
                        visibleElemtns.push(el);
                        $el.removeClass('hiddenPostItem');
                    }
                }
            });
            isotopeWrap.isotope( 'hideItemElements', hiddenElemets );
            isotopeWrap.isotope( 'revealItemElements', visibleElemtns );
        }, 20);
    }
    function visibleItems(){
        // if( !$('.post-items-wrapper-plus-mobile').length ) return; //Deleted For Production
        if( $window.width() > 991 ) return;
        for(var i = 0; i < postItems.length; i++) {
            if( $(postItems[i]).hasClass('hiddenPostItem') )
                $(postItems[i]).removeClass('hiddenPostItem');
        }
        isotopeWrap.isotope( 'revealItemElements', postItems );
    }
});

jQuery(function($){
   if( $(window).width() < 768 ) return;
   $(window).load(function(){
       /*
        **  The click event handler for the post item for desktop
        */
       $('#post-items-with-bt').on('click', '.post-item_cart-open-back', function(e){
           e.preventDefault();
           $(this).parents('.post-item_cart').toggleClass('post-item_cart__reverse');
           var content = $(this).parents('.post-item_cart').find('.post-item_cart-back-content');
           if( !content.attr('data-height') ) {
               content.attr('data-height', content.outerHeight());
           }
           if( !content.attr('data-height-container') ) {
               content.attr('data-height-container', content.parent().outerHeight());
           }
           if( content.attr('data-opened') ) {
               content.removeAttr('data-opened')
                   .removeClass('post-item_cart-back-content__bottomhide')
                   .css( 'height', content.attr('data-height-container') );
               setTimeout(function () {
                   content.css( 'height', content.attr('data-height') );
               }, 500);
           }
           if( $(e.target).parent().hasClass('post-item_cart-front') ) {
               content.parent().css('overflow', 'visible');
               dataLayer.push({'event':'magCardFlippedToText'});
           } else if( $(e.target).parent().hasClass('post-item_cart-back') ) {
               content.parent().css('overflow', 'hidden');
               dataLayer.push({'event':'magCardFlippedToImage'});
           }
       });
       /*
        **  The hover event handler for the excerpt post item for desktop
        */
       // $('#post-items-with-bt').on('mouseover', '.post-item_cart-back-content', function(e){
       $('#post-items-with-bt').on('mouseover', '.post-item_cart-back', function(e){
           // $this = $(this);
           $content = $(this).find('.post-item_cart-back-content');
           $content
               .removeClass('post-item_cart-back-content__bottomhide')
               .css( 'height', $content.attr('data-height') );
       });
       // $('#post-items-with-bt').on('mouseout', '.post-item_cart-back-content', function(e){
       $('#post-items-with-bt').on('mouseout', '.post-item_cart-back', function(e){
           $content = $(this).find('.post-item_cart-back-content');
           $content
               .addClass('post-item_cart-back-content__bottomhide')
               .css( 'height', $content.attr('data-height-container') );
       });
       /*
        ** Click Effect on Post Item
        */
       $('#post-items-with-bt').on('click', '.post-item_cart-front', function(e){
           if( $(e.target).hasClass('post-item_cart-open-back') || $(e.target).parents('.post-item_cart-open-back').length ) return;
           var $block = $(this).parent();
           $block.css('transition', '.1s').css('transform', 'rotateY(-3deg)');
           setTimeout(function(){
               $block.css('transform', 'rotateY(5deg)');
           }, 100);
       } );
   });
});

jQuery(function($){
    /*
     ** Image Swipe On Mobile
      */
    // if( !$('.post-items-wrapper-plus-mobile').length ) return; //Deleted For Production
    if( $(window).width() > 767) return;
    var startX,
        startY,
        currentX,
        currentY,
        move,
        percent,
        blockPosition,
        frontBlock,
        moveY = false,
        windowWidth = $(window).width();

    $('#post-items-with-bt').on('touchstart', '.post-item', function(e){
        // Init Start Data
        moveY = false;
        frontBlock = $(this).find('.post-item_cart-front');
        blockPosition = frontBlock.position().left;
        startX = e.originalEvent.changedTouches[0].pageX;
        startY = e.originalEvent.changedTouches[0].clientY;
    });

    $('#post-items-with-bt').on('touchmove', '.post-item', function(e){
        if( moveY )
            return; // If move Up or Down
        currentX = e.originalEvent.changedTouches[0].pageX;
        currentY = e.originalEvent.changedTouches[0].clientY;
        var y = currentY - startY;
        var absY = y < 0 ? -y : y;
        var x = currentX - startX;
        var absX = x < 0 ? -x : x;
        if( absY > absX ) {
            moveY = true;
            return; // If move Up or Down
        }
        // if( Math.abs(currentY - startY) > Math.abs(currentX - startX) )
        //     return; // If move Up or Down
        var closedClass = frontBlock.hasClass('post-item_cart-front__closed');
        if( x < 0 ) { // Closed
            if( !closedClass )
                return;
            percent = ( 100 / windowWidth ) * blockPosition + x;
            move = blockPosition - (startX - currentX);
            frontBlock.css( 'left', move );
        } else { // Opened
            if( closedClass )
                return;
            move = x;
            frontBlock.css( 'left', move );
            percent = ( 100 / windowWidth ) * move;
        }
    });

    $('#post-items-with-bt').on('touchend', '.post-item', function(e){
        if( !move ) return;
        if( percent >= 40 ) {
            frontBlock.css( 'transition', '.3s' )
                .css( 'left', '60%' )
                .addClass('post-item_cart-front__closed');
            // Custom Event on assignment Arpan
            dataLayer.push({'event':'magCardSwipedToText'});
        } else {
            frontBlock.css( 'transition', '.3s' )
                .css( 'left', 0 )
                .removeClass('post-item_cart-front__closed');
        }
        // Resets
        currentX = 0;
        currentY = 0;
        percent = 0;
        move = false;
        setTimeout(function(){
            frontBlock.css( 'transition', 'unset' );
        }, 500);
    });
});
