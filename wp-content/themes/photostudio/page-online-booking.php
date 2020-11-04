<?php
get_header();
$bg = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
$custom_css = '';
wp_enqueue_style('custom-style', get_template_directory_uri() . '/library/css/inline.css');
$custom_css .= ".content-page-header{ background:url('{$bg}') no-repeat center center #ededed;background-size:cover;}";
if(is_page('female-modelling-m')) {
    if (class_exists('MultiPostThumbnails')) {
        $bg_second = '';
        $bg_second = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'secondary-image', NULL, 'large');

        $custom_css .= "@media only screen and (max-width: 576px) { .content-page-header { background-image: url('{$bg_second}'); } } ";
    }
}
wp_add_inline_style('custom-style', $custom_css);
$intro =  get_field('introduction_text', get_the_ID());
$show_bt = false;
?>
<style>

</style>
<div class="content-page-header blog">
    <div class="site-width">
        <div class="intro-wrapper blog">
            <h1><?php echo get_the_title(); ?></h1>
        </div>
    </div>
</div>
<div class="page-wrapper">
    <div class="site-width">
        <!--Please paste this code between the <body> tags in your html.-->
        <div class="online-booking-frame">
            <iframe id="onlineBookingFrame"
                    scrolling="no"
                    frameBorder="0"
                    width="100%"
                    onload="try { GoToTop() } catch (e) {}"
                    style="min-width:300px; min-height:1000px">
                Browser not compatible.
            </iframe>
        </div>
        <script type="text/javascript">
            window.onload = LoadOBFrame;
            function LoadOBFrame() {
                var iFrameURL = 'https://thephotostudio.mystratus.com/onlinebooking.aspx?type=session';
                var finalQueryString = '';
                if (iFrameURL.indexOf("?") >= 0) {
                    finalQueryString = iFrameURL.split("?")[1];
                    iFrameURL = iFrameURL.split("?")[0];
                }
                if (window.location.search != null && window.location.search != '') {
                    if (finalQueryString != '') { finalQueryString += '&'; }
                    finalQueryString += window.location.search.substring(1);
                }
                iFrameURL += '?' + finalQueryString;
                document.getElementById('onlineBookingFrame').src = iFrameURL;
            }
            function GoToTop() {
                scroll(0,0);
            }
        </script>
    </div>
</div>
<?php get_footer(); ?>
