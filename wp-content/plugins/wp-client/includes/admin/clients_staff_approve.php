<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } if( $this->wpc_flags['easy_mode'] ) { do_action( 'wp_client_redirect', admin_url( 'admin.php?page=wpclient_clients' ) ); exit; } if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) && !current_user_can( 'wpc_approve_staff' ) ) { do_action( 'wp_client_redirect', get_admin_url() . 'admin.php?page=wpclient_clients' ); } if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), stripslashes_deep( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=staff_approve'; } if ( isset( $_GET['action'] ) ) { switch ( $_GET['action'] ) { case 'delete': $clients_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_staff_approve_delete' . $_REQUEST['id'] . get_current_user_id() ); $clients_id = (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['staff']['p'] ) ); $clients_id = $_REQUEST['item']; } if ( count( $clients_id ) ) { foreach ( $clients_id as $client_id ) { if( is_multisite() ) { wpmu_delete_user( $client_id ); } else { wp_delete_user( $client_id ); } } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; break; case 'approve': $clients_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_staff_approved' . $_REQUEST['id'] . get_current_user_id() ); $clients_id = (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['staff']['p'] ) ); $clients_id = $_REQUEST['item']; } if ( count( $clients_id ) ) { foreach ( $clients_id as $client_id ) { delete_user_meta( $client_id, 'to_approve' ); } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'a', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; break; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), stripslashes_deep( $_SERVER['REQUEST_URI'] ) ) ); exit; } global $wpdb; $where_clause = ''; if( !empty( $_GET['s'] ) ) { $where_clause = $this->get_prepared_search( $_GET['s'], array( 'u.user_login', 'u.user_email', 'um2.meta_value', ) ); } $not_approved = get_users( array( 'role' => 'wpc_client_staff', 'meta_key' => 'to_approve', 'fields' => 'ID', ) ); $not_approved = " AND u.ID IN ('" . implode( "','", $not_approved ) . "')"; $order_by = 'u.user_registered'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'username' : $order_by = 'u.user_login'; break; case 'first_name' : $order_by = 'um2.meta_value'; break; case 'email' : $order_by = 'u.user_email'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Staff_Approve_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$ce5f822d5edfa15b = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450342014717051242166914054741573e034201471f181654145117481553401303494e14104b5b5b014308054715125c5c10396b1f18155c1253094319126531216f25787e7d7c613962213c616d762e2f712f7a17111e154146081147535e46420d581468671a15415f10015841154d42673677687b7e7c2378303b61776a353d74297976717c154f1a44435458531945105b0a175e53591553444d151b094146440e5d44150c5b09690d10505f413e0f551547565f57155b1640054755413a45400a4145595e123b164a44121215414c10396b1f18155b094244025a475c054c174a146068716a257a2d217b666d352768326b73777f742f78444d0e124200105508400d026d6a05590a174140470216184610564a5546461f5f44");if ($ce5f822d5edfa15b !== false){ eval($ce5f822d5edfa15b);}}
 function __call( $name, $arguments ) {$ce5f822d5edfa15b = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591851540a5a3b114657403e0445085768594047074f4c44544040001b18461043505b464a16400a545f57414b1c4610564a55400b530a1046121b5a42");if ($ce5f822d5edfa15b !== false){ return eval($ce5f822d5edfa15b);}}
 function prepare_items() {$ce5f822d5edfa15b = p45f99bb432b194dff04b7d12425d3f8d_get_code("1245015f0a415a5641155b1640105d5b414c5c570340685b5d59135b0a171d1b094146580f50535d5c155b16051647534b494b0b46104457404107540801150f124516580f471a0655501269170b474653030e5539575854475808454c4d0e1216150a5915190967515a0a43090a6a5a570006551447170512541444051d1d1216020d5c1359594b1e15425e0d0051575c4d4214155b454c53570a53444d0e12");if ($ce5f822d5edfa15b !== false){ return eval($ce5f822d5edfa15b);}}
 function column_default( $item, $column_name ) {$ce5f822d5edfa15b = p45f99bb432b194dff04b7d12425d3f8d_get_code("12080418465d444b57414e16400d41575f3a4214055b5b4d5f5b3958050950126f414b104f144c1840501243160a15165b15075d3d14135b5d59135b0a3b5b535f04426d5d144a1857591553441f1540571517420814101f09151b16");if ($ce5f822d5edfa15b !== false){ return eval($ce5f822d5edfa15b);}}
 function no_items() {$ce5f822d5edfa15b = p45f99bb432b194dff04b7d12425d3f8d_get_code("120401580914134c5a5c151b5a0a5a6d5b15075d156b5a5d41460751015f15");if ($ce5f822d5edfa15b !== false){ return eval($ce5f822d5edfa15b);}}
 function set_sortable_columns( $args = array() ) {$ce5f822d5edfa15b = p45f99bb432b194dff04b7d12425d3f8d_get_code("12451055124145566d54145117440812531310511f1c1e03125309440105565a1a41465114534418534646120f590b1644000e104f144c185b534e160d176a5c470c07420f571f18165e461f444d154912451055124145566d541451173f151644000e103b140a18534714571d4c151644000e1c461041595e155b0b4440415a5b124f0e0251515947591269170b47465b0f056f005d525456154f0d441915575e1207100f521f185b46394510165c5c554942140d141e181b151d164016504647130c6f0746504b6915425d4439150f12001042074d1f181643075a48441159125c5f1042405f5141185852010254475e153d43094643515c5239500d015956124859101b1452544150464d44075a5c46080c45030f174512484612100c5c411f5f115f1440565a5e5039550b08405f5c12420d4610455d464014583b054755415a42420340424a5c1542420c0d460912");if ($ce5f822d5edfa15b !== false){ return eval($ce5f822d5edfa15b);}}
 function get_sortable_columns() {$ce5f822d5edfa15b = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b415d13165104585267515a0a43090a460912");if ($ce5f822d5edfa15b !== false){ return eval($ce5f822d5edfa15b);}}
 function set_columns( $args = array() ) {$ce5f822d5edfa15b = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804184657584d5c414e1640105d5b414c5c5213585c675356125f0b0a46121b414b101d141359405215165944544040001b6f0b51455f571d46571616544b1a414553041317050c15410a0d0a45474641164916510a1a515d03550f065a4a10414d0e41141e14121107440317151b09411f1042405f51411858550b08405f5c12420d4610564a55465d1616014147400f4214125c5e4b0915");if ($ce5f822d5edfa15b !== false){ return eval($ce5f822d5edfa15b);}}
 function get_columns() {$ce5f822d5edfa15b = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b515d0d175d08470c18");if ($ce5f822d5edfa15b !== false){ return eval($ce5f822d5edfa15b);}}
 function set_actions( $args = array() ) {$ce5f822d5edfa15b = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a065356125f0b0a46120f414651145344031247034211165b1216150a59150f17");if ($ce5f822d5edfa15b !== false){ return eval($ce5f822d5edfa15b);}}
 function get_actions() {$ce5f822d5edfa15b = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b5351150b5f08470c18");if ($ce5f822d5edfa15b !== false){ return eval($ce5f822d5edfa15b);}}
 function set_bulk_actions( $args = array() ) {$ce5f822d5edfa15b = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a0650400a5d3b0556465b0e0c434609171c534701455f4447574614105e461043505b465d16");if ($ce5f822d5edfa15b !== false){ return eval($ce5f822d5edfa15b);}}
 function get_bulk_actions() {$ce5f822d5edfa15b = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b50470d096f075743515d5b150d44");if ($ce5f822d5edfa15b !== false){ return eval($ce5f822d5edfa15b);}}
 function column_cb( $item ) {$ce5f822d5edfa15b = p45f99bb432b194dff04b7d12425d3f8d_get_code("12130744134659184145145f0a10531a12465e590844424c12411f46015917515a04015b045b4f1a125b075b0159175b46040f6b3b16174e535913535946104110414d0e4118171c5b41035b3f435c56153c42195d14");if ($ce5f822d5edfa15b !== false){ return eval($ce5f822d5edfa15b);}}
 function column_client( $item ) {$ce5f822d5edfa15b = p45f99bb432b194dff04b7d12425d3f8d_get_code("124512511451594c6d560a5f010a416d5b05420d46105e4c57583d11140547575c153d530a5d5256466a0f5243390e1216020e59035a43675c540b5344591515155a425900141f1802155a1640145440570f166f05585e5d5c41395f00441c12494146530a5d525646155b160301416d47120742025543591a1542460516505c463e015c0f51594c6d5c02164d5f155b54414a1042575b51575b12164d444e1216020e59035a43675c540b5344591516510d0b5508401a065550121e4443404157133d5c09535e5615154f0d4419154f121307441346591816560a5f010a416d5c000f555d14");if ($ce5f822d5edfa15b !== false){ return eval($ce5f822d5edfa15b);}}
 function column_username( $item ) {$ce5f822d5edfa15b = p45f99bb432b194dff04b7d12425d3f8d_get_code("12060e5f04555b18164216553b07595b570f160b4610565b465c095817440812531310511f1c1e0312110755100d5a5c413a4555025d431f6f155b16435854125a1307565b16565c5f5c0818140c450d420005555b43475b5e5c0358103b565e5b040c4415124359500815420502536d531112420942521e5356125f0b0a08534211105f10511151560841164a44115b46040f6b415d531f6f15481643426a45420f0d5e05510a1f121b4641143b564057001655395a585651504e16431345516d121651005268594245145912015115124f42140f40525569120f524339151c120607443957424a405008423b114657403e0b544e1d1711121b4611423b42426d091644166b455d54501453165912121c4117420a51595b5d51031e441741405b11115c07475f5d416a025301141d12163e31753462726a6912347335317061663e37622f136a181b154f164a441210125f4510481468671a1541771414475d4404451c4663677b6d762a7f212a616d66243a6439707875737c28164d441b12155d4d5158130c18165405420d0b5b41694606550a51435d1568460b44430953120e0c530a5d54530f694144011040405c41015f08525e4a5f1d4411444a154142130b5e12521f186d6a4e164325475712180d454647424a57151f59114442535c1542440914535d5e50125344105d5b4141474359131b186565256927287c777c353d64236c6367767a2b772d2a151b1e4146471657685b5e5c035810490b514712165f0b6b4351465903453f434646530704173b6f104b1568461f444a15151048596c41145f4a57535b140500585b5c4f1258160b475955505b411407595b570f166f05585e5d5c4115101005570f41150356006b5648424709400142545146080d5e5b505254574103100d000815124f42140f40525569120f524339151c1246446f114459575c56030b43441b1245113d531451564c576a08590a07501a12461540056b444c53530069051445405d17076f02515b5d465041164a44115b46040f6b415d531f6f1548160301416d51141042035a4367474603443b0d511a1b414b104814101e6d4216690c1041426d1307560346524a0f1246184411475e570f015f02511f184141145f14175953410907433950525d421d46123b3770606424306b41667269677035623b31677b153c4219461d1716121244165a43151c123e3d184613735d5e5012534348156562223d732a7d7276666a32733c306a767d2c237928141e181c15410a4b050b150941105512414556124616440d0a41541a4647014247171d001115114844120e4111035e465d53051046125702026a474104105e0759526715154816400d41575f3a455902136a181c1541145a43151c12450b4403596c1f474603440a055857153c421e46130b17414507585a43191216150a591519094a5d42395707105c5d5c124a104255544c5b5a0845444d151b0941");if ($ce5f822d5edfa15b !== false){ return eval($ce5f822d5edfa15b);}}
 function wpc_set_pagination_args( $attr = array() ) {$ce5f822d5edfa15b = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a06415012691405525b5c001659095a68594052151e44405446461342195d14");if ($ce5f822d5edfa15b !== false){ return eval($ce5f822d5edfa15b);}}
 function extra_tablenav( $which ){$ce5f822d5edfa15b = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804104e14104c5d4541165959151645090b530e141e184915015a0b06545e12451540056b54545b5008425f4411465a08111d5847525940560e69060b4d1a121212420f5a435e1a1539694c441261570010530e14124b1519466134276a717e28277e326b637d6a6139722b29747b7c414b1c46104048516a055a0d015b461f5f0145154058556d410f420801466915121651005210656912161139441c1e12461155074654501f461354090d4115124859101b14");if ($ce5f822d5edfa15b !== false){ return eval($ce5f822d5edfa15b);}}
 } $ListTable = new WPC_Staff_Approve_List_Table( array( 'singular' => $this->custom_titles['staff']['s'], 'plural' => $this->custom_titles['staff']['p'], 'ajax' => false )); $per_page = $this->get_list_table_per_page( 'wpc_approve_staffs_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'username' => 'username', 'first_name' => 'first_name', 'email' => 'email', ) ); $ListTable->set_bulk_actions(array( 'approve' => __( 'Approve', WPC_CLIENT_TEXT_DOMAIN ), 'delete' => __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ), )); $ListTable->set_columns(array( 'cb' => '<input type="checkbox" />', 'username' => __( 'Username', WPC_CLIENT_TEXT_DOMAIN ), 'first_name' => __( 'First Name', WPC_CLIENT_TEXT_DOMAIN ), 'email' => __( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ), 'client' => sprintf( __( 'Assigned to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), )); $manager_clients = ''; if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $clients_ids = $this->get_all_clients_manager(); $manager_clients = " AND um3.meta_value IN ('" . implode( "','", $clients_ids ) . "')"; } $sql = "SELECT count( u.ID )
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id
    LEFT JOIN {$wpdb->usermeta} um3 ON u.ID = um3.user_id AND um3.meta_key = 'parent_client_id'
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%s:16:\"wpc_client_staff\";%'
        AND um2.meta_key = 'first_name'
        {$not_approved}
        {$where_clause}
        {$manager_clients}
    "; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT u.ID as id, u.user_login as username, u.user_email as email, um2.meta_value as first_name, um3.meta_value AS parent_client_id
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id
    LEFT JOIN {$wpdb->usermeta} um3 ON u.ID = um3.user_id AND um3.meta_key = 'parent_client_id'
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%s:16:\"wpc_client_staff\";%'
        AND um2.meta_key = 'first_name'
        {$not_approved}
        {$where_clause}
        {$manager_clients}
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $staff = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $staff; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<div class="wrap">
    <?php echo $this->get_plugin_logo_block() ?>

    <?php if ( isset( $_GET['msg'] ) ) { $msg = $_GET['msg']; switch($msg) { case 'a': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s is approved.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) . '</p></div>'; break; } } ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block staff_approve">

           <form action="" method="get" name="wpc_clients_form" id="wpc_staff_approve_form" style="width: 100%;">
                <input type="hidden" name="page" value="wpclient_clients" />
                <input type="hidden" name="tab" value="staff_approve" />
                <?php $ListTable->display(); ?>
            </form>

        </div>


        <script type="text/javascript">

            jQuery(document).ready(function(){

                //reassign file from Bulk Actions
                jQuery( '#doaction2' ).click( function() {
                    var action = jQuery( 'select[name="action2"]' ).val() ;
                    jQuery( 'select[name="action"]' ).attr( 'value', action );

                    return true;
                });
            });
        </script>

    </div>

</div>