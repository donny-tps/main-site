<?php
//Template Name: Portal-Page

get_header();

the_content();






?>


  <script>
    jQuery(".portal-accordion").accordion({
      collapsible: true,
      heightStyle: "content"
    });
	  
jQuery('._wpc_client_files_list').isotope({
  itemSelector: '._file_item',
  masonry: {
    columnWidth: 100
  }
});
  </script>



<style><?php // stylesheet to override the css for wp-client portal.?>

	@media only screen and (max-width: 760px) {
  .portal-accordion { width:100% !important; }
}
	
	.file_item{
		border-radius: 10px;
    	background: #e6e6e6;
    	padding: 20px;
		box-shadow: 5px 5px 5px #888888;
	}
	
	.wpc_thumbnail_wrapper {}
	
	.wpc_filedata_wrapper{}
	
	.wpc_nav_wrapper{
		display:none;
	}
	
	.wpc_img_file_icon{
		width:60px;
	}
	.wpc_category_line{
		display:none;
	}
	
	
	.wpc_page{
		border-radius: 10px;
    	background: #e6e6e6;
    	padding: 20px;
		box-shadow: 5px 5px 5px #888888;
	}
	.wpc_pagelist{
		width:auto;
		
	}
	
</style>

<?php

get_footer();
?>
