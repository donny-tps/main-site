<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } if( $this->wpc_flags['easy_mode'] ) { do_action( 'wp_client_redirect', admin_url( 'admin.php?page=wpclients_content' ) ); exit; } global $wpdb; if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), stripslashes_deep( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclients_content&tab=tags'; } if( !empty( $_POST['wpc_action'] ) ) { switch( $_POST['wpc_action'] ) { case 'reassign_tag': if ( empty( $_POST['old_tag_id'] ) || empty( $_POST['new_tag_id'] ) || $_POST['old_tag_id'] === $_POST['new_tag_id'] ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'n_rat', $redirect ) ); exit; } $file_ids = $wpdb->get_col("SELECT DISTINCT object_id
                FROM {$wpdb->term_relationships}
                WHERE term_taxonomy_id = '" . $wpdb->_real_escape( $_POST['old_tag_id'] ) . "' AND object_id NOT IN (
                    SELECT DISTINCT object_id
                    FROM {$wpdb->term_relationships}
                    WHERE term_taxonomy_id = '" . $wpdb->_real_escape( $_POST['new_tag_id'] ) . "'
                )"); $wpdb->delete( $wpdb->term_relationships, array( 'term_taxonomy_id' => $_POST['old_tag_id'] ) ); foreach( $file_ids as $val ) { $wpdb->insert( $wpdb->term_relationships, array( 'term_taxonomy_id' => $_POST['new_tag_id'], 'object_id' => $val ) ); } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'rat', $redirect ) ); break; case 'create_file_tag': $term = $_POST['tag_name_new']; if ( !strlen( trim( $term ) ) ) do_action( 'wp_client_redirect', add_query_arg( 'msg', 'wt', $redirect ) ); if ( !$term_info = term_exists($term, 'wpc_tags') ) $term_info = wp_insert_term($term, 'wpc_tags'); else do_action( 'wp_client_redirect', add_query_arg( 'msg', 'aet', $redirect ) ); do_action( 'wp_client_redirect', add_query_arg( 'msg', 'st', $redirect ) ); break; } } if ( isset( $_GET['action'] ) ) { switch ( $_GET['action'] ) { case 'delete': $ids = array(); if ( isset( $_GET['tag_id'] ) ) { check_admin_referer( 'wpc_file_tag_delete' . $_GET['tag_id'] . get_current_user_id() ); $ids = (array) $_GET['tag_id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( __( 'Tags', WPC_CLIENT_TEXT_DOMAIN ) ) ); $ids = $_REQUEST['item']; } if ( count( $ids ) && ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) || current_user_can( 'wpc_delete_file_tags' ) ) ) { foreach ( $ids as $tag_id ) { wp_delete_term( $tag_id, 'wpc_tags' ); } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), stripslashes_deep( $_SERVER['REQUEST_URI'] ) ) ); exit; } $where_search = ''; $where_manager = ''; if( !empty( $_GET['s'] ) ) { $where_search = $this->get_prepared_search( $_GET['s'], array( 't.name', ) ); } $order_by = 'tt.term_id'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'name' : $order_by = 't.name'; break; case 'count' : $order_by = 'count'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $manager_clients = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'client' ); $manager_circles = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'circle' ); $client_files = $this->cc_get_assign_data_by_assign( 'file', 'client', $manager_clients ); $circle_files = $this->cc_get_assign_data_by_assign( 'file', 'circle', $manager_circles ); $files = array_merge( $client_files, $circle_files ); $files = array_unique( $files ); if ( current_user_can( 'wpc_view_admin_managers_files' ) ) { $ids_files_manager = $wpdb->get_col( "SELECT id FROM {$wpdb->prefix}wpc_client_files WHERE page_id = 0 OR id IN('" . implode( "','", $files ) . "')" ) ; } else { $ids_files_manager = $wpdb->get_col( "SELECT id FROM {$wpdb->prefix}wpc_client_files WHERE user_id = " . get_current_user_id() . " OR id IN('" . implode( "','", $files ) . "')" ); } $where_manager = " AND tr.object_id IN('" . implode( "','", $ids_files_manager ) . "')" ; } if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Tags_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $columns = array(); var $bulk_actions = array(); function __construct( $args = array() ){$c459747fbeb7826c = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450342014717051242166914054741573e034201471f181654145117481553401303494e14104b5b5b014308054715125c5c10396b1f18155c1253094319126531216f25787e7d7c613962213c616d762e2f712f7a17111e154146081147535e46420d581468671a15415f10015841154d42673677687b7e7c2378303b61776a353d74297976717c154f1a44435458531945105b0a175e53591553444d151b094146440e5d44150c5b09690d10505f413e0f551547565f57155b1640054755413a45400a4145595e123b164a44121215414c10396b1f18155b094244025a475c054c174a146068716a257a2d217b666d352768326b73777f742f78444d0e124200105508400d026d6a05590a174140470216184610564a5546461f5f44");if ($c459747fbeb7826c !== false){ eval($c459747fbeb7826c);}}
 function __call( $name, $arguments ) {$c459747fbeb7826c = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591851540a5a3b114657403e0445085768594047074f4c44544040001b18461043505b464a16400a545f57414b1c4610564a55400b530a1046121b5a42");if ($c459747fbeb7826c !== false){ return eval($c459747fbeb7826c);}}
 function prepare_items() {$c459747fbeb7826c = p45f99bb432b194dff04b7d12425d3f8d_get_code("1245015f0a415a5641155b1640105d5b414c5c570340685b5d59135b0a171d1b094146580f50535d5c155b16051647534b494b0b46104457404107540801150f124516580f471a0655501269170b474653030e5539575854475808454c4d0e1216150a5915190967515a0a43090a6a5a570006551447170512541444051d1d1216020d5c1359594b1e15425e0d0051575c4d4214155b454c53570a53444d0e12");if ($c459747fbeb7826c !== false){ return eval($c459747fbeb7826c);}}
 function column_default( $item, $column_name ) {$c459747fbeb7826c = p45f99bb432b194dff04b7d12425d3f8d_get_code("12080418465d444b57414e16400d41575f3a4214055b5b4d5f5b3958050950126f414b104f144c1840501243160a15165b15075d3d14135b5d59135b0a3b5b535f04426d5d144a1857591553441f1540571517420814101f09151b16");if ($c459747fbeb7826c !== false){ return eval($c459747fbeb7826c);}}
 function no_items() {$c459747fbeb7826c = p45f99bb432b194dff04b7d12425d3f8d_get_code("120401580914134c5a5c151b5a0a5a6d5b15075d156b5a5d41460751015f15");if ($c459747fbeb7826c !== false){ return eval($c459747fbeb7826c);}}
 function set_sortable_columns( $args = array() ) {$c459747fbeb7826c = p45f99bb432b194dff04b7d12425d3f8d_get_code("12451055124145566d54145117440812531310511f1c1e03125309440105565a1a41465114534418534646120f590b1644000e104f144c185b534e160d176a5c470c07420f571f18165e461f444d154912451055124145566d541451173f151644000e103b140a18534714571d4c151644000e1c461041595e155b0b4440415a5b124f0e0251515947591269170b47465b0f056f005d525456154f0d441915575e1207100f521f185b46394510165c5c554942140d141e181b151d164016504647130c6f0746504b6915425d4439150f12001042074d1f181643075a48441159125c5f1042405f5141185852010254475e153d43094643515c5239500d015956124859101b1452544150464d44075a5c46080c45030f174512484612100c5c411f5f115f1440565a5e5039550b08405f5c12420d4610455d464014583b054755415a42420340424a5c1542420c0d460912");if ($c459747fbeb7826c !== false){ return eval($c459747fbeb7826c);}}
 function get_sortable_columns() {$c459747fbeb7826c = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b415d13165104585267515a0a43090a460912");if ($c459747fbeb7826c !== false){ return eval($c459747fbeb7826c);}}
 function set_columns( $args = array() ) {$c459747fbeb7826c = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804184657584d5c414e1640105d5b414c5c5213585c675356125f0b0a46121b414b101d141359405215165944544040001b6f0b51455f571d46571616544b1a414553041317050c15410a0d0a45474641164916510a1a515d03550f065a4a10414d0e41141e14121107440317151b09411f1042405f51411858550b08405f5c12420d4610564a55465d1616014147400f4214125c5e4b0915");if ($c459747fbeb7826c !== false){ return eval($c459747fbeb7826c);}}
 function get_columns() {$c459747fbeb7826c = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b515d0d175d08470c18");if ($c459747fbeb7826c !== false){ return eval($c459747fbeb7826c);}}
 function set_actions( $args = array() ) {$c459747fbeb7826c = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a065356125f0b0a46120f414651145344031247034211165b1216150a59150f17");if ($c459747fbeb7826c !== false){ return eval($c459747fbeb7826c);}}
 function get_actions() {$c459747fbeb7826c = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b5351150b5f08470c18");if ($c459747fbeb7826c !== false){ return eval($c459747fbeb7826c);}}
 function set_bulk_actions( $args = array() ) {$c459747fbeb7826c = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a0650400a5d3b0556465b0e0c434609171c534701455f4447574614105e461043505b465d16");if ($c459747fbeb7826c !== false){ return eval($c459747fbeb7826c);}}
 function get_bulk_actions() {$c459747fbeb7826c = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b50470d096f075743515d5b150d44");if ($c459747fbeb7826c !== false){ return eval($c459747fbeb7826c);}}
 function column_cb( $item ) {$c459747fbeb7826c = p45f99bb432b194dff04b7d12425d3f8d_get_code("12130744134659184145145f0a10531a12465e590844424c12411f46015917515a04015b045b4f1a125b075b0159175b46040f6b3b16174e535913535946105610414d0e4118171c5b41035b3f435c56153c42195d14");if ($c459747fbeb7826c !== false){ return eval($c459747fbeb7826c);}}
 function column_name( $item ) {$c459747fbeb7826c = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450353125d585641155b16051647534b494b0b465d511012110f4201096e15510e175e12136a180c1556164d444e12160001440f5b594b6912105f0113126f125c42175a55175b5e5415455946435340080d451516174c534701531059176d500d035e0d1617504050000b4605515f5b0f4c400e4408485352030b1314565e5b040c44156b54575c41035810424153555c45104814135146500b6d430d51156f414c104116174c5b410a53594617120c46421e466b68101212305f0113121e1236327339777b71777b326930216d666d252d7d277d79181b1b4611584b540c155a424d465d51181a1505431616505c463e17430346685b535b4e16431345516d00065d0f5a10181b151a4a4407404040040c443941445d406a05570a4c151553050f59085d444c405412591643151b121d1e100541454a575b1269111750406d02035e4e14104f4256395201085046573e04590a51684c53521511444d151b121a4214075743515d5b156d4300505e571507173b140a18150907160b0a565e5b02090d3a13455d4640145844075a5c5408105d4e1610181c1539694c441273400442490941174b474703161d0b401245000c444640581856500a53100115465a081110325550071519466134276a717e28277e326b637d6a6139722b29747b7c414b104814101a1b0e3a11440c4757545c405102595e561c450e465b145455575c154005585e5d5c411569070b5b46570f16161255550546540145420556465b0e0c0d02515b5d4650404205036a5b565c45104814135146500b6d430d51156f414c104112684f425b095807010815124f4247166b544a575412533b0a5a5c51044a104143475b6d530f5a013b4153553e06550a51435d15154816400d41575f3a455902136a181c150153103b56474013075e126b424b5747395f004c1c121b414c104112684f426a0e4210146a405707074203460a1f121b46431608505c510e06554e14444c405c16450805465a57123d54035147101211396521366377603a45622365627d61613963362d126f12484219461a171f10155811444a156d6d49421722515b5d46504666011658535c040c440a4d1014126236753b27797b772f366f32716f6c6d71297b252d7b121b414c10410818590c125d16194447574614105e4647474a5b5b12504c431003161242155410441f1e15410a1714545c1208060d4443475b6d530f5a013b4153553e45104814135146500b6d430d51156f414c104116091f121b46120d10505f69460c510b511065121b4611584b4642530f5c174a14134c5a5c151b5a165a456d0001440f5b594b1a15425707105c5d5c124219461d0c18");if ($c459747fbeb7826c !== false){ return eval($c459747fbeb7826c);}}
 function wpc_set_pagination_args( $attr = array() ) {$c459747fbeb7826c = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a06415012691405525b5c001659095a68594052151e44405446461342195d14");if ($c459747fbeb7826c !== false){ return eval($c459747fbeb7826c);}}
 function extra_tablenav( $which ){$c459747fbeb7826c = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804104e14104c5d4541165959151645090b530e141e18491542420c0d461f0c12075114575f67505a1e1e443b6a1a124631550746545012610751174319126531216f25787e7d7c613962213c616d762e2f712f7a17111e154145010547515a4c114504595e4c15154f0d441915");if ($c459747fbeb7826c !== false){ return eval($c459747fbeb7826c);}}
 } $ListTable = new WPC_Tags_Table( array( 'singular' => __( 'Tag', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'Tags', WPC_CLIENT_TEXT_DOMAIN ), 'ajax' => false )); $per_page = $this->get_list_table_per_page( 'wpc_tags_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'name' => 'name', 'count' => 'count', ) ); if ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) || current_user_can( 'wpc_delete_file_tags' ) ) { $ListTable->set_bulk_actions( array( 'delete' => __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ), )); } $ListTable->set_columns(array( 'name' => __( 'Tag Name', WPC_CLIENT_TEXT_DOMAIN ), 'count' => __( 'Count', WPC_CLIENT_TEXT_DOMAIN ), )); $items_count = $wpdb->get_var( "SELECT COUNT( tt.term_id )
    FROM {$wpdb->term_taxonomy} tt
    LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
    WHERE tt.taxonomy='wpc_tags' " . $where_search ); $tags_list = $wpdb->get_results( "SELECT tt.term_id as id,
            ( SELECT COUNT(*) FROM {$wpdb->term_relationships} tr WHERE tt.term_taxonomy_id = tr.term_taxonomy_id " . $where_manager . " ) as count,
            t.name as name
    FROM {$wpdb->term_taxonomy} tt
    LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
    WHERE tt.taxonomy='wpc_tags'
    GROUP BY tt.term_id", ARRAY_A ); $all_file_tags = $wpdb->get_results( "SELECT tt.term_id as id,
            ( SELECT COUNT(*) FROM {$wpdb->term_relationships} tr WHERE tt.term_taxonomy_id = tr.term_taxonomy_id " . $where_manager . " ) as count,
            t.name as name
    FROM {$wpdb->term_taxonomy} tt
    LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
    WHERE tt.taxonomy='wpc_tags' ". $where_search . "
    GROUP BY tt.term_id
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", {$per_page}
    ", ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $all_file_tags; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery( '#wpc_new' ).shutter_box({
            view_type       : 'lightbox',
            width           : '400px',
            type            : 'inline',
            href            : '#new_form_panel',
            title           : '<?php echo esc_js( __( 'New Tag', WPC_CLIENT_TEXT_DOMAIN ) ); ?>'
        });

        jQuery( '#wpc_reasign' ).shutter_box({
            view_type       : 'lightbox',
            width           : '400px',
            type            : 'inline',
            href            : '#reasign_form_panel',
            title           : '<?php echo esc_js( __( 'Reassign Tag', WPC_CLIENT_TEXT_DOMAIN ) ); ?>'
        });
    });
</script>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">
        <?php echo $this->gen_tabs_menu( 'content' ) ?>

        <span class="wpc_clear"></span>

        <?php if ( isset( $_GET['msg'] ) ) { switch( $_GET['msg'] ) { case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Tag(s) are Deleted.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'rat': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Tag reassigned successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'n_rat': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Tag was not reassigned.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'wt': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Wrong Tag name.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'aet': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Tag already exists.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'st': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Tag was added successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; } } ?>

        <div class="wpc_tab_container_block">

            <a class="add-new-h2 wpc_form_link" id="wpc_new">
                <?php _e( 'Add New', WPC_CLIENT_TEXT_DOMAIN ) ?>
            </a>
            <a class="add-new-h2 wpc_form_link" id="wpc_reasign">
                <?php _e( 'Reassign Tags', WPC_CLIENT_TEXT_DOMAIN ) ?>
            </a>

            <div id="new_form_panel">
                <form method="post" name="new_tag" id="new_tag">
                    <input type="hidden" name="wpc_action" value="create_file_tag">
                    <table border="0">
                        <tbody>
                            <tr>
                                <td style="width: 100px;">
                                    <label for="tag_name_new"><?php _e( 'Title', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </td>
                                <td>
                                    <input type="text" name="tag_name_new" id="tag_name_new"  style="width: 250px;">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="save_button">
                        <input type="submit" class="button-primary" value="Create Tag" name="create_tag" />
                    </div>
                </form>
            </div>

            <div id="reasign_form_panel">
                <form method="post" name="reassign_files_cat" id="reassign_files_tag">
                    <input type="hidden" name="wpc_action" id="wpc_action3" value="reassign_tag">
                    <table cellpadding="0" cellspacing="0">
                        <tbody><tr>
                            <td style="width: 100px;">
                                <label for="old_tag_id"><?php _e( 'Tag From', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                            </td>
                            <td>
                                <select name="old_tag_id" id="old_tag_id" style="min-width: 200px;">
                                    <?php foreach( $tags_list as $tag ) { if( (int)$tag['count'] > 0 ) { ?>
                                        <option value="<?php echo $tag['id']; ?>"><?php echo $tag['name']; ?></option>
                                    <?php } } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="new_tag_id"><?php _e( 'Tag To', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                            </td>
                            <td>
                                <select name="new_tag_id" id="new_tag_id" style="min-width: 200px;">
                                    <?php foreach( $tags_list as $tag ) { ?>
                                        <option value="<?php echo $tag['id']; ?>"><?php echo $tag['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                    </tbody></table>
                    <br>
                    <div class="save_button">
                        <input type="submit" class="button-primary" name="" value="Reassign" id="reassign_files">
                    </div>
                </form>
            </div>

            <form action="" method="get" name="wpc_file_form" id="wpc_tags_form">
                <input type="hidden" name="page" value="wpclients_content" />
                <input type="hidden" name="tab" value="tags" />
                <?php $ListTable->display(); ?>
            </form>
        </div>
    </div>
</div>