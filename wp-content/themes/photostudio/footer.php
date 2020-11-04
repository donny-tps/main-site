<div class="subscribe-wrap">
    <div class="site-width">
        <span class="subscribe-text">Subscribe for updates</span>
        <span class="social-wrapper">
            <a href="https://www.facebook.com/ThePhotoStudioAustralia" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="https://www.instagram.com/thephotostudioaustralia/" target="_blank"><i class="fa fa-instagram"></i></a>
            <a href="https://www.youtube.com/channel/UC9hZxYDuoJnUMfQj1TPg9_w" target="_blank"><i class="fa fa-youtube"></i></a>
            <a href="https://au.pinterest.com/TPSAU/" target="_blank"><i class="fa fa-pinterest"></i></a>
        </span>
        <div class="form-wrapper">
            <?php echo do_shortcode('[gravityform id=3 title=false description=false ajax=true tabindex=100]'); ?>
        </div>
		
		<?php //ubermenu( 'main' , array( 'menu' => 3 ) ); ?>
    </div>
	
</div>


<!--footer class="footer" role="contentinfo"-->
    <!--div class="site-width"-->
        <!--nav role="navigation"-->
            <?php
          /* wp_nav_menu(array(
                'container' => '', // remove nav container
                'container_class' => 'footer-links cf', // class of container (should you choose to use it)
                'menu' => __('Footer Links', 'bonestheme'), // nav name
                'menu_class' => 'footer-nav', // adding custom nav class
                'theme_location' => 'footer-links', // where it's located in the theme
                'before' => '', // before the menu
                'after' => '', // after the menu
                'link_before' => '', // before each link
                'link_after' => '', // after each link
                'depth' => 0, // limit the depth of the nav
                'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
            )); */
            ?>
        <!--/nav>
    </div>
</footer-->
<div class="sub-footer">
    <div class="site-width">
        <p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> | <a href="/privacy/">Privacy</a> |

            <!--<a href="https://clickersonline.com.au" title="Website Design by ClickersOnline" target="_blank" class="clickers">Website by ClickersOnline</a> -->
		</p> 

    </div>
</div>
<?php // all js scripts are loaded in library/bones.php  ?>
<?php wp_footer(); ?>
      <!--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"> -->
        <script src="https://use.typekit.net/owj5ocn.js" defer='defer'></script>

<script>
	
	    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:868216,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');


</script>

			<!-- Facebook Pixel Code -->
				<script>
					!function(f,b,e,v,n,t,s)
					{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
					n.callMethod.apply(n,arguments):n.queue.push(arguments)};
					if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
					n.queue=[];t=b.createElement(e);t.async=!0;
					t.src=v;s=b.getElementsByTagName(e)[0];
					s.parentNode.insertBefore(t,s)}(window,document,'script',
					'https://connect.facebook.net/en_US/fbevents.js');
					 fbq('init', '694986541337603'); 
					fbq('track', 'PageView');
				</script>
				<noscript>
					 <img height="1" width="1" 
					src="https://www.facebook.com/tr?id=694986541337603&ev=PageView
					&noscript=1"/>
				</noscript>
			<!-- End Facebook Pixel Code -->

<script data-cfasync="false" defer type="text/javascript" src="https://embed.videodelivery.net/embed/r4xu.fla9.latest.js?video=38cf60a1345f9d12ff06d66e877cdb5b"></script>


</body>
</html> <!-- end of site. what a ride! -->
