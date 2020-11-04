<?php
/**
 * Template Name: Portal Pages (Tree): Common Part
 * Template Description: This template for [wpc_client_pagel view_type="tree"] shortcode. Main template.
 * Template Tags: Portal Pages, Tree View
 *
 * This template can be overridden by copying it to your_current_theme/wp-client/portal-pages/tree/common.php.
 *
 * HOWEVER, on occasion WP-Client will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @author 	WP-Client
 */

//needs for translation
__( 'Portal Pages (Tree): Common Part', WPC_CLIENT_TEXT_DOMAIN );
__( 'This template for [wpc_client_pagel view_type="tree"] shortcode. Main template', WPC_CLIENT_TEXT_DOMAIN );
__( 'Portal Pages', WPC_CLIENT_TEXT_DOMAIN );
__( 'Tree View', WPC_CLIENT_TEXT_DOMAIN );

if ( ! defined( 'ABSPATH' ) ) exit;

?>

<div class="wpc_client_client_pages_tree" data-form_id="<?php echo $form_id; ?>">

    <div class="wpc_table_nav_top">
        <div class="wpc_nav_wrapper">

            <?php if ( $show_search ) { ?>

                <div class="wpc_pages_search_block">
                    <div class="wpc_pages_search_input_block">
                        <input type="text" class="wpc_pages_search wpc_text" value=""/>
                        <span class="wpc_pages_search_button" title="<?php _e( 'Search Page', WPC_CLIENT_TEXT_DOMAIN ); ?>">&nbsp;</span>
                        <span class="wpc_pages_clear_search" title="<?php _e( 'Clear Search', WPC_CLIENT_TEXT_DOMAIN ); ?>">&nbsp;</span>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>

    <div class="wpc_client_pages wpc_treecontent">

        <div class="wpc_pages_tree_header">
            <table class="wpc_client_pages_tree_header">
                <thead>
                    <tr valign="top">

                        <?php if ( $show_sort ) { ?>

                            <th class="wpc_sortable wpc_th_title <?php echo $sort_type == 'title' ? 'wpc_sort_' . $sort : ''; ?>">
                                <span class="wpc_cust_sort_title wpc_cust_page_sort"><?php _e( 'Title', WPC_CLIENT_TEXT_DOMAIN ); ?></span>
                            </th>

                        <?php } else { ?>

                            <th class="wpc_th_title">
                                <?php _e('Title', WPC_CLIENT_TEXT_DOMAIN) ?>
                            </th>

                        <?php } ?>

                        <?php if ( $show_date ) {
                            if ( $show_sort ) { ?>

                                <th class="wpc_sortable wpc_th_datetime <?php echo $sort_type == 'date' ? 'wpc_sort_' . $sort : ''; ?>">
                                    <span class="wpc_cust_sort_date wpc_cust_page_sort"><?php _e( 'Date', WPC_CLIENT_TEXT_DOMAIN ); ?></span>
                                </th>

                            <?php } else { ?>

                                <th class="wpc_th_datetime">
                                    <?php _e( 'Date', WPC_CLIENT_TEXT_DOMAIN ); ?>
                                </th>

                            <?php }
                        } ?>

                        <th class="wpc_scroll_column"></th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="wpc_client_pages_tree_content">
            <table class="wpc_client_pages_tree">

                <?php WPC()->get_template( 'portal-pages/tree/items.php', '', $t_args, true ); ?>

            </table>

            <div class="wpc_ajax_overflow_tree">
                <div class="wpc_ajax_loading"></div>
            </div>
        </div>
    </div>
</div>