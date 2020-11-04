<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } global $wpdb, $wpc_client; if ( !current_user_can( 'wpc_archive_clients' ) && !current_user_can( 'wpc_restore_clients' ) && !current_user_can( 'wpc_delete_clients' ) && !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) ) { do_action( 'wp_client_redirect', get_admin_url() . 'admin.php?page=wpclient_clients' ); } if ( isset( $_GET['_wp_http_referer'] ) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), stripslashes_deep( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=archive'; } if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Archive_User_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$c139a7fbcea10a25 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450342014717051242166914054741573e034201471f181654145117481553401303494e14104b5b5b014308054715125c5c10396b1f18155c1253094319126531216f25787e7d7c613962213c616d762e2f712f7a17111e154146081147535e46420d581468671a15415f10015841154d42673677687b7e7c2378303b61776a353d74297976717c154f1a44435458531945105b0a175e535915534844124151130755081317050c15414114076a515e08075e126b564a515d0f400143151b1248591042405f51411858580b3b5c46570c116f0b51444b53520316594411534006116b41445b4d40540a1139441b1215414510481468671a1541580b1015545d140c5448131b186565256927287c777c353d64236c6367767a2b772d2a151b094112511451594c080f3969070b5b4146131753121c171c53470145444d0e12");if ($c139a7fbcea10a25 !== false){ eval($c139a7fbcea10a25);}}
 function __call( $name, $arguments ) {$c139a7fbcea10a25 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591851540a5a3b114657403e0445085768594047074f4c44544040001b18461043505b464a16400a545f57414b1c4610564a55400b530a1046121b5a42");if ($c139a7fbcea10a25 !== false){ return eval($c139a7fbcea10a25);}}
 function prepare_items() {$c139a7fbcea10a25 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1245015f0a415a5641155b1640105d5b414c5c570340685b5d59135b0a171d1b094146580f50535d5c155b16051647534b494b0b46104457404107540801150f124516580f471a0655501269170b474653030e5539575854475808454c4d0e1216150a5915190967515a0a43090a6a5a570006551447170512541444051d1d1216020d5c1359594b1e15425e0d0051575c4d4214155b454c53570a53444d0e12");if ($c139a7fbcea10a25 !== false){ return eval($c139a7fbcea10a25);}}
 function column_default( $item, $column_name ) {$c139a7fbcea10a25 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12080418465d444b57414e16400d41575f3a4214055b5b4d5f5b3958050950126f414b104f144c1840501243160a15165b15075d3d14135b5d59135b0a3b5b535f04426d5d144a1857591553441f15565d3e0353125d58561a15445b050a5455573e1914125c5e4b1f0b15551601505c1f5f0b541b6b435950590369071146465d0c3d53095842555c174a1640075a5e470c0c6f08555a5d1e15425f10015869150806173b141e031247034211165b12154659101b14");if ($c139a7fbcea10a25 !== false){ return eval($c139a7fbcea10a25);}}
 function no_items() {$c139a7fbcea10a25 = p45f99bb432b194dff04b7d12425d3f8d_get_code("120401580914134c5a5c151b5a0a5a6d5b15075d156b5a5d41460751015f15");if ($c139a7fbcea10a25 !== false){ return eval($c139a7fbcea10a25);}}
 function set_sortable_columns( $args = array() ) {$c139a7fbcea10a25 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12451055124145566d54145117440812531310511f1c1e03125309440105565a1a41465114534418534646120f590b1644000e104f144c185b534e160d176a5c470c07420f571f18165e461f444d154912451055124145566d541451173f151644000e103b140a18534714571d4c151644000e1c461041595e155b0b4440415a5b124f0e0251515947591269170b47465b0f056f005d525456154f0d441915575e1207100f521f185b46394510165c5c554942140d141e181b151d164016504647130c6f0746504b6915425d4439150f12001042074d1f181643075a48441159125c5f1042405f5141185852010254475e153d43094643515c5239500d015956124859101b1452544150464d44075a5c46080c45030f174512484612100c5c411f5f115f1440565a5e5039550b08405f5c12420d4610455d464014583b054755415a42420340424a5c1542420c0d460912");if ($c139a7fbcea10a25 !== false){ return eval($c139a7fbcea10a25);}}
 function get_sortable_columns() {$c139a7fbcea10a25 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b415d13165104585267515a0a43090a460912");if ($c139a7fbcea10a25 !== false){ return eval($c139a7fbcea10a25);}}
 function set_columns( $args = array() ) {$c139a7fbcea10a25 = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804184657584d5c414e1640105d5b414c5c5213585c675356125f0b0a46121b414b101d141359405215165944544040001b6f0b51455f571d46571616544b1a414553041317050c15410a0d0a45474641164916510a1a515d03550f065a4a10414d0e41141e14121107440317151b09411f1042405f51411858550b08405f5c12420d4610564a55465d1616014147400f4214125c5e4b0915");if ($c139a7fbcea10a25 !== false){ return eval($c139a7fbcea10a25);}}
 function get_columns() {$c139a7fbcea10a25 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12130744134659185345165a1d3b535b5e150742151c171a5f54085703016a4916150a591519094b514703530a490b5b561c3d4407565b5d6d56095a11095b41104d4214125c5e4b1f0b05590811585c41414b0b46");if ($c139a7fbcea10a25 !== false){ return eval($c139a7fbcea10a25);}}
 function set_actions( $args = array() ) {$c139a7fbcea10a25 = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a065356125f0b0a46120f414651145344031247034211165b1216150a59150f17");if ($c139a7fbcea10a25 !== false){ return eval($c139a7fbcea10a25);}}
 function get_actions() {$c139a7fbcea10a25 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b5351150b5f08470c18");if ($c139a7fbcea10a25 !== false){ return eval($c139a7fbcea10a25);}}
 function set_bulk_actions( $args = array() ) {$c139a7fbcea10a25 = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a0650400a5d3b0556465b0e0c434609171c534701455f4447574614105e461043505b465d16");if ($c139a7fbcea10a25 !== false){ return eval($c139a7fbcea10a25);}}
 function get_bulk_actions() {$c139a7fbcea10a25 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b50470d096f075743515d5b150d44");if ($c139a7fbcea10a25 !== false){ return eval($c139a7fbcea10a25);}}
 function column_cb( $item ) {$c139a7fbcea10a25 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12130744134659184145145f0a10531a12465e590844424c12411f46015917515a04015b045b4f1a125b075b0159175b46040f6b3b16174e535913535946104110414d0e4118171c5b41035b3f435c56153c42195d14");if ($c139a7fbcea10a25 !== false){ return eval($c139a7fbcea10a25);}}
 function column_username( $item ) {$c139a7fbcea10a25 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450353125d585641155b16051647534b494b0b465d51181a1505431616505c463e17430346685b535b4e16431345516d130743125b455d6d560a5f010a414115414b101a48175b474714530a106a474104106f0555591012121146073b54565f080c17461d17444e1505431616505c463e17430346685b535b4e164305515f5b0f0b431246564c5d4741164d441c124941465105405e575c463d11160146465d1307173b140a181509071607085441415c4055025d431a125d1453025917151c410555126b565c5f5c08691116591a1b414c10415553555b5b48460c140a425306070d114454545b5008423b07595b570f16434040565a0f5414550c0d4357140001440f5b5905405015420b1650145b055f17461a171c5b41035b3f435c56153c421e46131167454508590a07500f15414c101144685b40500742013b5b5d5c02071846134048516a055a0d015b466d130743125b455d15154816400d41575f3a455902136a181b15481643460b605712165f14510b17530b410d4419155b54494259156b5a4d5e410f450d10501a1b414b101d145e5e121d4655111647575c153d45155145675154081e44434242513e06550a51435d6d560a5f010a414115414b101a48175b474714530a106a474104106f0555591012121146073b54565f080c17461d17444e1505431616505c463e17430346685b535b4e164305515f5b0f0b431246564c5d4741164d441c124941465105405e575c463d11000159574604456d4609171f0e544655080546410f4306550a51435d6d5405420d0b5b10120503440719565b465c0958594651575e041655395245575f6a045a0b031712560016514b5a585651505b1443441b1245113d531451564c576a08590a07501a12461540056b54545b5008423b00505e57150717461a171c5b41035b3f435c56153c4219461a171f101502571005185b565c4017461a171c5b41035b3f435c56153c421e461315185a47035059465f5344001153145d474c081510590d001d021b5a400e411419186d6a4e164320505e5715071036514555535b035810084c1274130d5d46765b5755124a163334766d712d2b752860686c776d3269202b78737b2f4219461a171f0e1a0708435f151653021659095a44631551035a011050156f415f10410856185159074517591756570d0744036b565b465c09584644515346004f5105405e575c08445b113b51575e0416554414535946544b580b0a56570f434510481440486d5614530510506d5c0e0c53031c171f4545056907085c575c153d540358524c5712461844405c46570c39170f501065121c461844431712560016514b5d53051012461844405c46570c39170f501065121b461146445d4057075f120c5541594156145f14100f12440e0b544e041e03100b41164a446a6d1a4145740358524c571536531609545c570f165c1f14714a5d5846780110425d400a451c4663677b6d762a7f212a616d66243a6439707875737c28164d441b12155d4d5158130c184f151b1601084657121a4214075743515d5b156d4300505e571507173b140a181509071607085441415c40540358524c576a0755100d5a5c1041065112551a565d5b0553594612121c4115403957455d534103690a0b5b51574942171144546751590f530a106a56570d07440313171612110f4201096e155b05456d461d171612124416000541531f08060d4413171612110f4201096e155b05456d461a171f10150e4401020810580014511557455142415c16120b5c561a514b0b440a10181c1539694c441276570d07440314675d40580758010a415e4b464e103164746771792f732a306a667739366f227b7a797b7b461f444a15150e4e030e410f17451247034211165b12411110590840511015105712174410001612451c46105e4c57583d11111750405c000f5541691b1816410e5f17490b405d163d5105405e575c464e16400556465b0e0c43461d17110915");if ($c139a7fbcea10a25 !== false){ return eval($c139a7fbcea10a25);}}
 function column_contact_name( $item ) {$c139a7fbcea10a25 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1213074413465918165c1253093f12515d0f16510540685653580311395f15");if ($c139a7fbcea10a25 !== false){ return eval($c139a7fbcea10a25);}}
 function column_business_name( $item ) {$c139a7fbcea10a25 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1213074413465918165c1253093f125047120b5e034744675c540b5343390e12");if ($c139a7fbcea10a25 !== false){ return eval($c139a7fbcea10a25);}}
 function wpc_set_pagination_args( $attr = array() ) {$c139a7fbcea10a25 = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a06415012691405525b5c001659095a68594052151e44405446461342195d14");if ($c139a7fbcea10a25 !== false){ return eval($c139a7fbcea10a25);}}
 function extra_tablenav( $which ){$c139a7fbcea10a25 = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804104e14104c5d4541165959151645090b530e141e184915015a0b06545e12451540056b54545b5008425f4411465a08111d5847525940560e69060b4d1a121212420f5a435e1a1539694c441261570010530e14124b15154a163334766d712d2b752860686c776d3269202b78737b2f42194a14134f42563955080d505c464c5c53134743575f6a125f100850416946015c0f51594c15683d11144368121b4d42171551564a515d4b451106585b464642195d144a18");if ($c139a7fbcea10a25 !== false){ return eval($c139a7fbcea10a25);}}
 } $ListTable = new WPC_Archive_User_List_Table(array( 'singular' => WPC()->custom_titles['client']['s'], 'plural' => WPC()->custom_titles['client']['p'], 'ajax' => false )); switch ( $ListTable->current_action() ) { case 'delete': case 'delete_from_blog': case 'mu_delete': $clients_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_client_delete' . $_REQUEST['id'] ); $clients_id = ( is_array( $_REQUEST['id'] ) ) ? $_REQUEST['id'] : (array) $_REQUEST['id']; } else if ( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( WPC()->custom_titles['client']['p'] ) ); $clients_id = $_REQUEST['item']; } if ( count( $clients_id ) && ( current_user_can( 'wpc_delete_clients' ) || current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) ) { foreach ( $clients_id as $client_id ) { if( $ListTable->current_action() == 'mu_delete' ) { wpmu_delete_user( $client_id ); } else { wp_delete_user( $client_id ); } } if( 1 == count( $clients_id ) ) do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); else do_action( 'wp_client_redirect', add_query_arg( 'msg', 'ds', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; case 'restore': $clients_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_client_restore' . $_REQUEST['id'] ); $clients_id = ( is_array( $_REQUEST['id'] ) ) ? $_REQUEST['id'] : (array) $_REQUEST['id']; } else if ( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( WPC()->custom_titles['client']['p'] ) ); $clients_id = $_REQUEST['item']; } if ( count( $clients_id ) && ( current_user_can( 'wpc_delete_clients' ) || current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) ) { foreach ( $clients_id as $client_id ) { $this->restore_client( $client_id ); } if( 1 == count( $clients_id ) ) do_action( 'wp_client_redirect', add_query_arg( 'msg', 'r', $redirect ) ); else do_action( 'wp_client_redirect', add_query_arg( 'msg', 'rs', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; default: if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), stripslashes_deep( $_SERVER['REQUEST_URI'] ) ) ); exit; } break; } $per_page = $this->get_list_table_per_page( 'wpc_clients_archive_per_page' ); $paged = $ListTable->get_pagenum(); $where_clause = ''; if( !empty( $_GET['s'] ) ) { $where_clause = $this->get_prepared_search( $_GET['s'], array( 'u.user_login', 'u.display_name', 'u.user_email', ) ); } $order_by = 'u.user_registered'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'user_login' : $order_by = 'user_login'; break; case 'display_name' : $order_by = 'display_name'; break; case 'business_name' : $order_by = 'um2.meta_value'; break; case 'user_email' : $order_by = 'user_email'; break; } } $sql = "SELECT count( u.ID )
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    WHERE um.meta_key = 'archive' AND um.meta_value = 1
    " . $where_clause; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT u.ID as id, u.user_login as username, u.display_name as contact_name, u.user_email as email, um2.meta_value as business_name
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id AND um2.meta_key = 'wpc_cl_business_name'
    LEFT JOIN {$wpdb->usermeta} um3 ON u.ID = um3.user_id
    WHERE um.meta_key = '{$wpdb->prefix}capabilities' AND um.meta_value LIKE '%s:10:\"wpc_client\";%' AND um3.meta_key = 'archive' AND um3.meta_value = 1
    " . $where_clause . "
    ORDER BY $order_by
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $users = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->set_sortable_columns( array( 'username' => 'user_login', 'contact_name' => 'display_name', 'business_name' => 'business_name', 'email' => 'user_email', ) ); $bulk_actions = array( 'restore' => __( 'Restore', WPC_CLIENT_TEXT_DOMAIN ), ); if( is_multisite() ) { $bulk_actions['delete_from_blog'] = __( 'Delete From Blog', WPC_CLIENT_TEXT_DOMAIN ); $bulk_actions['mu_delete'] = __( 'Delete From Network', WPC_CLIENT_TEXT_DOMAIN ); } else { $bulk_actions['delete'] = __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ); } $ListTable->set_bulk_actions( $bulk_actions ); $ListTable->set_columns(array( 'cb' => '<input type="checkbox" />', 'username' => __( 'Username', WPC_CLIENT_TEXT_DOMAIN ), 'contact_name' => __( 'Contact Name', WPC_CLIENT_TEXT_DOMAIN ), 'business_name' => __( 'Business Name', WPC_CLIENT_TEXT_DOMAIN ), 'email' => __( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ), )); $ListTable->prepare_items(); $ListTable->items = $users; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); if ( isset( $_GET['msg'] ) ) { switch( $_GET['msg'] ) { case 'r': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Restored</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), WPC()->custom_titles['client']['s'] ) . '</p></div>'; break; case 'rs': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Restored</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), WPC()->custom_titles['client']['p'] ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), WPC()->custom_titles['client']['s'] ) . '</p></div>'; break; case 'ds': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), WPC()->custom_titles['client']['p'] ) . '</p></div>'; break; } } ?>

<div class="wrap">
    <?php echo $wpc_client->get_plugin_logo_block() ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">
        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <div class="wpc_tab_container_block" style="float:left;width:100%;padding: 0;">
            <form action="" method="get" id="wpc_clients_list_form" style="width: 100%;">
                <input type="hidden" name="page" value="wpclient_clients" />
                <input type="hidden" name="tab" value="archive" />
                <div class="wpc_clear"></div>
                <?php $ListTable->display(); ?>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function(){
        var user_id = 0;
        var nonce = '';
        var action = '';

        jQuery('.delete_action').each( function() {
            var obj = jQuery(this);

            jQuery(this).shutter_box({
                view_type       : 'lightbox',
                width           : '500px',
                type            : 'ajax',
                dataType        : 'json',
                href            : '<?php echo get_admin_url() ?>admin-ajax.php',
                ajax_data       : "action=wpc_get_user_list&exclude=" + obj.data( 'id' ),
                setAjaxResponse : function( data ) {
                    action = obj.data('action') ? obj.data('action') : 'delete';
                    user_id = obj.data( 'id' );
                    nonce = obj.data( 'nonce' );

                    jQuery( '.sb_lightbox_content_title' ).html( data.title );
                    jQuery( '.sb_lightbox_content_body' ).html( data.content );
                }
            });
        });

        jQuery('#wpc_clients_list_form').submit(function() {
            if( jQuery('select[name="action"]').val() == 'delete' || jQuery('select[name="action2"]').val() == 'delete' ||
                jQuery('select[name="action"]').val() == 'mu_delete' || jQuery('select[name="action2"]').val() == 'mu_delete' ||
                jQuery('select[name="action"]').val() == 'delete_from_blog' || jQuery('select[name="action2"]').val() == 'delete_from_blog' ) {

                action = jQuery('select[name="action"]').val();
                user_id = new Array();
                jQuery("input[name^=item]:checked").each(function() {
                    user_id.push( jQuery(this).val() );
                });
                nonce = jQuery('input[name=_wpnonce]').val();
                if( user_id.length ) {

                    jQuery('.delete_action').shutter_box({
                        view_type       : 'lightbox',
                        width           : '500px',
                        type            : 'ajax',
                        dataType        : 'json',
                        href            : '<?php echo get_admin_url() ?>admin-ajax.php',
                        ajax_data       : "action=wpc_get_user_list&exclude=" + user_id.join(','),
                        setAjaxResponse : function( data ) {
                            jQuery( '.sb_lightbox_content_title' ).html( data.title );
                            jQuery( '.sb_lightbox_content_body' ).html( data.content );
                        },
                        self_init       : false
                    });

                    jQuery('.delete_action').shutter_box('show');
                }

                bulk_action_runned = true;
                return false;
            }
        });

        jQuery(document).on('click', '.cancel_delete_button', function() {
            jQuery('.delete_action').shutter_box( 'close' );
            user_id = 0;
            nonce = '';
            action = '';
        });

        jQuery(document).on('click', '.delete_user_button', function() {
            if( user_id instanceof Array ) {
                if( user_id.length ) {
                    var item_string = '';
                    user_id.forEach(function( item, key ) {
                        item_string += '&item[]=' + item;
                    });
                    window.location = '<?php echo admin_url(); ?>admin.php?page=wpclient_clients&tab=archive&action=' + action + item_string + '&_wpnonce=' + nonce + '&' + jQuery('#delete_user_settings').serialize() + '&_wp_http_referer=' + encodeURIComponent( jQuery('input[name=_wp_http_referer]').val() );
                }
            } else {
                window.location = '<?php echo admin_url(); ?>admin.php?page=wpclient_clients&tab=archive&action=' + action + '&id=' + user_id + '&_wpnonce=' + nonce + '&' + jQuery('#delete_user_settings').serialize() + '&_wp_http_referer=<?php echo urlencode( stripslashes_deep( $_SERVER['REQUEST_URI'] ) ); ?>';
            }
            jQuery('.delete_action').shutter_box( 'close' );
            user_id = 0;
            nonce = '';
            action = '';
            return false;
        });

        //reassign file from Bulk Actions
        jQuery( '#doaction2' ).click( function() {
            var action = jQuery( 'select[name="action2"]' ).val() ;
            jQuery( 'select[name="action"]' ).attr( 'value', action );
            return true;
        });

    });
</script>