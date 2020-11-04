<?php

/*
 * Shortcode For PopUp Download
 */

function create_shortcode_popup_download( $atts = [], $text = '' ){
    if( isset($atts['timer']) ) {
        $timer = $atts['temer'] * 1000;
    }
    if( isset($atts['image_id']) ) {
        $image_url = wp_get_attachment_url( $atts['image_id'] );
    }
    $content = '';
    $content .= <<<HTML
    <div class="download-modal">
    <div class="download-modal_window">
        <div class="download-modal_close">
            <i class="fa fa-times-circle-o" aria-hidden="true"></i>
        </div>
        <div class="download-modal_content">
            <div class="download-modal_content-image">
                <img src="{$image_url}" alt="ThePhotostudio">
            </div>
            <div class="download-modal_content-text">{$text}</div>
        </div>
        <form id="downloadModalForm" action="#" class="download-modal_form">
            <div class="download-modal_fields">
                <label class="download-modal_label">
                    <input name="name" type="name" class="download-modal_field" placeholder="Name">
                </label>
                <label class="download-modal_label">
                    <input name="email" type="email" class="download-modal_field" placeholder="Email">
                </label>
            </div>
            <input type="submit" class="download-modal_button" value="Send">
        </form>
    </div>
</div>
\n\n
HTML;
    $content .= <<<SCRIPT
<script>
    jQuery(document).ready(function($){
        /*
        **  Download Form Modal
         */
        if( !$('#downloadModalForm').length || !$('.download-modal').length )
            return;
    
        // Opened Modal
        setTimeout(function(){
            $('.download-modal').fadeIn();
        }, {$timer});
    
        // Closed Model
        $('.download-modal_close').on('click', function(e){
            $(this).parents('.download-modal').fadeOut();
        });
    
        // Validate Download Form Modal
        $('#downloadModalForm').on('submit', function(e){

            var name = $(this).find('input[type="name"]');
            var validate = false;
            if( name.val().length < 3 ) {
                name.addClass('no-validate');
                validate = false;
            } else if( name.hasClass('no-validate') ) {
                name.removeClass('no-validate');
                name.addClass('validate');
                validate = true;
            } else {
                validate = true;
            }
    
            var email = $(this).find('input[type="email"]');
            var patternEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            var emailValidate = patternEmail.test(String(email.val()).toLowerCase());
            if( !emailValidate ) {
                email.addClass('no-validate');
                validate = false;
            } else if( email.hasClass('no-validate') && emailValidate ) {
                email.removeClass('no-validate');
                email.addClass('validate');
                validate = true;
            } else {
                validate = true;
            }
            e.preventDefault();
            if( !validate ) {
                console.log('no validate')
            } else {
                console.log( 'Name: ' + name.val() + ' Email: ' + email.val() );
            }
        });
    });
</script>
\n\n
SCRIPT;

    $content .= <<<STYLE

<style>
    .download-modal {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 9;
      display: none;
      background-color: rgba(0,0,0,.5);
    }
    .download-modal_window {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      min-width: 320px;
      max-width: 800px;
      width: 80%;
      padding: 25px;
      border: 1px solid #75787b;
      border-radius: 5px;
      background-color: #fff;
      box-shadow: 0 0 50px 10px rgba(0,0,0,.5);
    }
    .download-modal_close {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 25px;
      cursor: pointer;
    }
    .download-modal_content {
      display: flex;
      margin-bottom: 20px;
    }
    @media(max-width: 767px) {
      .download-modal_content {
        flex-direction: column;
        margin-bottom: 10px;
      }
    }
    .download-modal_content-image {
      width: 30%;
    }
    @media(max-width: 767px) {
      .download-modal_content-image {
        width: 60%;
        margin: 0 auto 10px;
      }
    }
    .download-modal_content-image > img {
      display: block;
      width: 100%;
      max-width: 100%;
      height: auto;
      margin: 0 auto;
    }
    .download-modal_content-text {
      width: 70%;
      padding: 0 20px;
      text-align: justify;
    }
    @media(max-width: 767px) {
      .download-modal_content-text  {
        width: 100%;
        padding: 0;
        line-height: 20px;
      }
    }
    .download-modal_form {
    
    }
    .download-modal_fields {
      display: flex;
      justify-content: space-between;
    }
    @media(max-width: 575px) {
      .download-modal_fields {
        flex-direction: column;
      }
    }
    .download-modal_label {
      display: block;
      width: 48%;
    }
    @media(max-width: 575px) {
      .download-modal_label {
        width: 100%;
      }
    }
    .download-modal_title {
      display: block;
      text-align: center;
    }
    input[type="email"].download-modal_field,
    input[type="name"].download-modal_field {
      display: block;
      width: 100%;
      max-width: 100%;
      margin: 5px auto 15px;
      padding: 10px;
      color: #000;
      transition: .5s;
      border: 1px solid transparent;
      border-radius: 3px;
      background-color: #eaedf2;
      font-family: "Lato", "Helvetica Neue", Helvetica, Arial, sans-serif;
    }
    @media(max-width: 575px) {
      input[type="email"].download-modal_field,
      input[type="name"].download-modal_field {
        margin-bottom: 5px;
      }
    }
    input[type="email"].download-modal_field:active,
    input[type="email"].download-modal_field:focus,
    input[type="name"].download-modal_field:active,
    input[type="name"].download-modal_field:focus{
      background-color: #f7f8fa;
      outline: 1px solid #75787b;
      border-radius: 3px;
    }
    input[type="submit"].download-modal_button {
      display: block;
      padding: 5px 25px;
      margin: 20px auto 0;
      background-color: #eaedf2;
      border: 1px solid #75787b;
      border-radius: 3px;
    }
    @media(max-width: 575px) {
      input[type="submit"].download-modal_button {
        margin-top: 10px;
      }
    }
    .download-modal_label > input.no-validate {
      border: 1px solid #ff0023;
    }
    .download-modal_label > input.validate {
      border: 1px solid #389807;
    }
</style>
\n\n
STYLE;

    return $content;
}
add_shortcode('popup_download', 'create_shortcode_popup_download' );


/*
Element Description: VC Info Box
*/

// Element Class
class vcPopupDownload extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_informationbox_mapping' ) );
        add_shortcode( 'vc_informationbox', array( $this, 'vc_informationbox_html' ) );
    }

// Element Mapping
    public function vc_informationbox_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(

            array(
                'name' => __('PopUp Download', 'thephotostudio'),
                'base' => 'vc_informationbox',
                'description' => __('PopUp Download Window', 'thephotostudio'),
                'category' => __('Content', 'thephotostudio'),
//                'icon' => 'https://thephotostudio.com.au/wp-content/themes/photostudio/favicon.ico',
                'icon' => get_template_directory_uri().'/library/images/app-icons/email-black.png',
                'params' => array(

                    array(
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                        'heading' => __( 'Seconds to display', 'thephotostudio' ),
                        'param_name' => 'second',
                        'value' => __( '', 'thephotostudio' ),
                        'description' => __( 'Seconds to display PopUp', 'thephotostudio' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Settings',
                    ),

                    array(
                        'type' => 'textarea',
                        'holder' => 'div',
                        'class' => '',
                        'heading' => __( 'Your Message', 'thephotostudio' ),
                        'param_name' => 'text',
                        'value' => __( '', 'thephotostudio' ),
                        'description' => __( 'Your Message', 'thephotostudio' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Settings',
                    ),

                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => '',
                        'heading' => __( 'Image', 'thephotostudio' ),
                        'param_name' => 'image',
                        'value' => __( '', 'thephotostudio' ),
                        'description' => __( 'Image', 'thephotostudio' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Settings',
                    )

                )
            )
        );
    }


// Element HTML
    public function vc_informationbox_html( $atts ) {

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'second'   => '',
                    'text' => '',
                    'image' => '',
                ),
                $atts
            )
        );
        $timer = $second * 1000;
        $image_url = wp_get_attachment_url( $image );

        $content = '';
        $content .= <<<HTML
    <div class="download-modal-icon">
        PopUp Download
        <img src="https://thephotostudio.com.au/wp-content/themes/photostudio/library/images/app-icons/email-black.png" alt="...">
    </div>
    <div class="download-modal">
        <div class="download-modal_window">
            <div class="download-modal_close">
                <i class="fa fa-times-circle-o" aria-hidden="true"></i>
            </div>
            <div class="download-modal_content">
                <div class="download-modal_content-image">
                    <img src="{$image_url}" alt="ThePhotostudio">
                </div>
                <div class="download-modal_content-text">{$text}</div>
            </div>
            <form id="downloadModalForm" action="#" class="download-modal_form">
                <div class="download-modal_fields">
                    <label class="download-modal_label">
                        <input name="name" type="name" class="download-modal_field" placeholder="Name">
                    </label>
                    <label class="download-modal_label">
                        <input name="email" type="email" class="download-modal_field" placeholder="Email">
                    </label>
                </div>
                <input type="submit" class="download-modal_button" value="Send">
            </form>
        </div>
    </div>
    \n
HTML;
$content .= <<<SCRIPT
    <script>
        jQuery(document).ready(function($){
            /*
            **  Download Form Modal
             */
            if( !$('#downloadModalForm').length || !$('.download-modal').length )
                return;
        
            // Opened Modal
            setTimeout(function(){
                $('.download-modal').fadeIn();
            }, {$timer});
        
            // Closed Model
            $('.download-modal_close').on('click', function(e){
                $(this).parents('.download-modal').fadeOut();
            });
        
            // Validate Download Form Modal
            $('#downloadModalForm').on('submit', function(e){
    
                var name = $(this).find('input[type="name"]');
                var validate = false;
                if( name.val().length < 3 ) {
                    name.addClass('no-validate');
                    validate = false;
                } else if( name.hasClass('no-validate') ) {
                    name.removeClass('no-validate');
                    name.addClass('validate');
                    validate = true;
                } else {
                    validate = true;
                }
        
                var email = $(this).find('input[type="email"]');
                var patternEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                var emailValidate = patternEmail.test(String(email.val()).toLowerCase());
                if( !emailValidate ) {
                    email.addClass('no-validate');
                    validate = false;
                } else if( email.hasClass('no-validate') && emailValidate ) {
                    email.removeClass('no-validate');
                    email.addClass('validate');
                    validate = true;
                } else {
                    validate = true;
                }
                e.preventDefault();
                if( !validate ) {
                    console.log('no validate')
                } else {
                    console.log( 'Name: ' + name.val() + ' Email: ' + email.val() );
                }
            });
        });
    </script>
    \n
SCRIPT;

$content .= <<<STYLE
    
    <style>
        .download-modal-icon {
            display: none;
            padding: 15px 0;
            text-align: center;
        }
        .vc_editor .download-modal-icon {
            display: block;
            text-align: center;
        } 
        .vc_editor .download-modal-icon > img {
            display: block;
            width: 32px;
            height: 32px; 
            margin: 15px auto;
        }
        .download-modal {
          position: fixed;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          z-index: 9;
          display: none;
          background-color: rgba(0,0,0,.5);
        }
        .download-modal_window {
          position: absolute;
          left: 50%;
          top: 50%;
          transform: translate(-50%, -50%);
          min-width: 320px;
          max-width: 800px;
          width: 80%;
          padding: 25px;
          border: 1px solid #75787b;
          border-radius: 5px;
          background-color: #fff;
          box-shadow: 0 0 50px 10px rgba(0,0,0,.5);
        }
        .download-modal_close {
          position: absolute;
          top: 10px;
          right: 15px;
          font-size: 25px;
          cursor: pointer;
        }
        .download-modal_content {
          display: flex;
          margin-bottom: 20px;
        }
        @media(max-width: 767px) {
          .download-modal_content {
            flex-direction: column;
            margin-bottom: 10px;
          }
        }
        .download-modal_content-image {
          width: 30%;
        }
        @media(max-width: 767px) {
          .download-modal_content-image {
            width: 60%;
            margin: 0 auto 10px;
          }
        }
        .download-modal_content-image > img {
          display: block;
          width: 100%;
          max-width: 100%;
          height: auto;
          margin: 0 auto;
        }
        .download-modal_content-text {
          width: 70%;
          padding: 0 20px;
          text-align: justify;
        }
        @media(max-width: 767px) {
          .download-modal_content-text  {
            width: 100%;
            padding: 0;
            line-height: 20px;
          }
        }
        .download-modal_form {
        
        }
        .download-modal_fields {
          display: flex;
          justify-content: space-between;
        }
        @media(max-width: 575px) {
          .download-modal_fields {
            flex-direction: column;
          }
        }
        .download-modal_label {
          display: block;
          width: 48%;
        }
        @media(max-width: 575px) {
          .download-modal_label {
            width: 100%;
          }
        }
        .download-modal_title {
          display: block;
          text-align: center;
        }
        input[type="email"].download-modal_field,
        input[type="name"].download-modal_field {
          display: block;
          width: 100%;
          max-width: 100%;
          margin: 5px auto 15px;
          padding: 10px;
          color: #000;
          transition: .5s;
          border: 1px solid transparent;
          border-radius: 3px;
          background-color: #eaedf2;
          font-family: "Lato", "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
        @media(max-width: 575px) {
          input[type="email"].download-modal_field,
          input[type="name"].download-modal_field {
            margin-bottom: 5px;
          }
        }
        input[type="email"].download-modal_field:active,
        input[type="email"].download-modal_field:focus,
        input[type="name"].download-modal_field:active,
        input[type="name"].download-modal_field:focus{
          background-color: #f7f8fa;
          outline: 1px solid #75787b;
          border-radius: 3px;
        }
        input[type="submit"].download-modal_button {
          display: block;
          padding: 5px 25px;
          margin: 20px auto 0;
          background-color: #eaedf2;
          border: 1px solid #75787b;
          border-radius: 3px;
        }
        @media(max-width: 575px) {
          input[type="submit"].download-modal_button {
            margin-top: 10px;
          }
        }
        .download-modal_label > input.no-validate {
          border: 1px solid #ff0023;
        }
        .download-modal_label > input.validate {
          border: 1px solid #389807;
        }
    </style>
    \n
STYLE;

    return $content;

    }

} // End Element Class

// Element Class Init
new vcPopupDownload();

