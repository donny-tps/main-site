<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } if( $this->wpc_flags['easy_mode'] ) { do_action( 'wp_client_redirect', admin_url( 'admin.php?page=wpclient_clients' ) ); exit; } global $wpdb; if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=admins'; } if ( isset( $_GET['action'] ) ) { switch ( $_GET['action'] ) { case 'delete': $admins_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_admin_delete' . $_REQUEST['id'] . get_current_user_id() ); $admins_id = (array)$_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['admin']['p'] ) ); $admins_id = $_REQUEST['item']; } if ( count( $admins_id ) ) { foreach ( $admins_id as $admin_id ) { $admin_data = get_userdata( $admin_id ); $wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->prefix}wpc_client_login_redirects WHERE rul_value=%s", $admin_data->user_login ) ); if( is_multisite() ) { wpmu_delete_user( $admin_id ); } else { wp_delete_user( $admin_id ); } } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); break; case 'temp_password': $admins_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'admin_temp_password' . $_REQUEST['id'] . get_current_user_id() ); $admins_id = ( is_array( $_REQUEST['id'] ) ) ? $_REQUEST['id'] : (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['admin']['p'] ) ); $admins_id = $_REQUEST['item']; } foreach ( $admins_id as $admin_id ) { $this->set_temp_password( $admin_id ); } if( 1 < count( $admins_id ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'pass_s', $redirect ) ); } else if( 1 === count( $admins_id ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'pass', $redirect ) ); } else { do_action( 'wp_client_redirect', $redirect ); } exit; case 'send_welcome': $admins_id = array(); if ( isset( $_REQUEST['user_id'] ) ) { check_admin_referer( 'wpc_re_send_welcome' . $_REQUEST['user_id'] . get_current_user_id() ); $admins_id = ( is_array( $_REQUEST['user_id'] ) ) ? $_REQUEST['user_id'] : (array) $_REQUEST['user_id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['admin']['p'] ) ); $admins_id = $_REQUEST['item']; } if ( count( $admins_id ) ) { foreach ( $admins_id as $admin_id ) { $this->resend_welcome_email( $admin_id ); } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'wel', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; break; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } $where_clause = ''; if( !empty( $_GET['s'] ) ) { $where_clause = $this->get_prepared_search( $_GET['s'], array( 'u.user_login', 'u.user_nicename', 'u.user_email', ) ); } $order_by = 'u.user_registered'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'username' : $order_by = 'u.user_login'; break; case 'nickname' : $order_by = 'u.user_nicename'; break; case 'email' : $order_by = 'u.user_email'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Admins_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$c7f14332c5dc76a3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450342014717051242166914054741573e034201471f181654145117481553401303494e14104b5b5b014308054715125c5c10396b1f18155c1253094319126531216f25787e7d7c613962213c616d762e2f712f7a17111e154146081147535e46420d581468671a15415f10015841154d42673677687b7e7c2378303b61776a353d74297976717c154f1a44435458531945105b0a175e53591553444d151b094146440e5d44150c5b09690d10505f413e0f551547565f57155b1640054755413a45400a4145595e123b164a44121215414c10396b1f18155b094244025a475c054c174a146068716a257a2d217b666d352768326b73777f742f78444d0e124200105508400d026d6a05590a174140470216184610564a5546461f5f44");if ($c7f14332c5dc76a3 !== false){ eval($c7f14332c5dc76a3);}}
 function __call( $name, $arguments ) {$c7f14332c5dc76a3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591851540a5a3b114657403e0445085768594047074f4c44544040001b18461043505b464a16400a545f57414b1c4610564a55400b530a1046121b5a42");if ($c7f14332c5dc76a3 !== false){ return eval($c7f14332c5dc76a3);}}
 function prepare_items() {$c7f14332c5dc76a3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1245015f0a415a5641155b1640105d5b414c5c570340685b5d59135b0a171d1b094146580f50535d5c155b16051647534b494b0b46104457404107540801150f124516580f471a0655501269170b474653030e5539575854475808454c4d0e1216150a5915190967515a0a43090a6a5a570006551447170512541444051d1d1216020d5c1359594b1e15425e0d0051575c4d4214155b454c53570a53444d0e12");if ($c7f14332c5dc76a3 !== false){ return eval($c7f14332c5dc76a3);}}
 function column_default( $item, $column_name ) {$c7f14332c5dc76a3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12080418465d444b57414e16400d41575f3a4214055b5b4d5f5b3958050950126f414b104f144c1840501243160a15165b15075d3d14135b5d59135b0a3b5b535f04426d5d144a1857591553441f1540571517420814101f09151b16");if ($c7f14332c5dc76a3 !== false){ return eval($c7f14332c5dc76a3);}}
 function no_items() {$c7f14332c5dc76a3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("120401580914134c5a5c151b5a0a5a6d5b15075d156b5a5d41460751015f15");if ($c7f14332c5dc76a3 !== false){ return eval($c7f14332c5dc76a3);}}
 function set_sortable_columns( $args = array() ) {$c7f14332c5dc76a3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12451055124145566d54145117440812531310511f1c1e03125309440105565a1a41465114534418534646120f590b1644000e104f144c185b534e160d176a5c470c07420f571f18165e461f444d154912451055124145566d541451173f151644000e103b140a18534714571d4c151644000e1c461041595e155b0b4440415a5b124f0e0251515947591269170b47465b0f056f005d525456154f0d441915575e1207100f521f185b46394510165c5c554942140d141e181b151d164016504647130c6f0746504b6915425d4439150f12001042074d1f181643075a48441159125c5f1042405f5141185852010254475e153d43094643515c5239500d015956124859101b1452544150464d44075a5c46080c45030f174512484612100c5c411f5f115f1440565a5e5039550b08405f5c12420d4610455d464014583b054755415a42420340424a5c1542420c0d460912");if ($c7f14332c5dc76a3 !== false){ return eval($c7f14332c5dc76a3);}}
 function get_sortable_columns() {$c7f14332c5dc76a3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b415d13165104585267515a0a43090a460912");if ($c7f14332c5dc76a3 !== false){ return eval($c7f14332c5dc76a3);}}
 function set_columns( $args = array() ) {$c7f14332c5dc76a3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804184657584d5c414e1640105d5b414c5c5213585c675356125f0b0a46121b414b101d141359405215165944544040001b6f0b51455f571d46571616544b1a414553041317050c15410a0d0a45474641164916510a1a515d03550f065a4a10414d0e41141e14121107440317151b09411f1042405f51411858550b08405f5c12420d4610564a55465d1616014147400f4214125c5e4b0915");if ($c7f14332c5dc76a3 !== false){ return eval($c7f14332c5dc76a3);}}
 function get_columns() {$c7f14332c5dc76a3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b515d0d175d08470c18");if ($c7f14332c5dc76a3 !== false){ return eval($c7f14332c5dc76a3);}}
 function set_actions( $args = array() ) {$c7f14332c5dc76a3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a065356125f0b0a46120f414651145344031247034211165b1216150a59150f17");if ($c7f14332c5dc76a3 !== false){ return eval($c7f14332c5dc76a3);}}
 function get_actions() {$c7f14332c5dc76a3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b5351150b5f08470c18");if ($c7f14332c5dc76a3 !== false){ return eval($c7f14332c5dc76a3);}}
 function set_bulk_actions( $args = array() ) {$c7f14332c5dc76a3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a0650400a5d3b0556465b0e0c434609171c534701455f4447574614105e461043505b465d16");if ($c7f14332c5dc76a3 !== false){ return eval($c7f14332c5dc76a3);}}
 function get_bulk_actions() {$c7f14332c5dc76a3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b50470d096f075743515d5b150d44");if ($c7f14332c5dc76a3 !== false){ return eval($c7f14332c5dc76a3);}}
 function column_cb( $item ) {$c7f14332c5dc76a3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12130744134659184145145f0a10531a12465e590844424c12411f46015917515a04015b045b4f1a125b075b0159175b46040f6b3b16174e535913535946104110414d0e4118171c5b41035b3f435c56153c42195d14");if ($c7f14332c5dc76a3 !== false){ return eval($c7f14332c5dc76a3);}}
 function column_username( $item ) {$c7f14332c5dc76a3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12060e5f04555b18164216553b07595b570f160b4610565b465c09581744081216090b54036b565b465c095817440812531310511f1c1e0312110755100d5a5c413a4555025d431f6f155b16435854125a1307565b16565c5f5c0818140c450d420005555b43475b5e5c0358103b565e5b040c441512435950080752090d5b416d04065912125e5c0f12461844405c46570c39170f501065121b4611465a12121c413d6f4e14107d565c121148446262713e217c2f71796c6d61236e303b717d7f202b7e461d1918150949575a430e1216090b54036b565b465c0958173f124542023d530744565a5b590f421d4368120f41450c07145f4a57535b14471345516d02034007565e545b411f1444005446534c0b545b1610181c15425f10015869150806173b141918156a41164a445856074942171144546753510b5f0a43151c12322773336672677360327e3b37747e66414c10425d435d5f6e415f004368121b414c104116175b5e5415455946435340080d45156b54594254045f080d415b5712400e411419186d6a4e16432d5b565b170b5413555b1871541657060d595b460807434118176f62763975282d707c663e36753e60687c7d78277f2a441c121c41450c4955091f09150f50444c15135504166f1347524a6d580342054c15165b15075d3d135e5c15684a16431345516d15075d165b4559404c3946051746455d1306174a14434a4750461f444d154912450a590251685951410f590a176e154511016f12515a486d45074517135a4056463f105b1410045315095807085c51595c3e171451434d405b46550b0a535b400c4a12411419184145145f0a10531a123e3d1846137357124c09434413545c4641165f4659564a5915125e014445534112155f145017594115125309145a4053131b10005b4518465d0f454441460d154d42673677687b7e7c2378303b61776a353d74297976717c154f1a44404242513e015c0f51594c1f0b054317105a5f6d150b440a5144631554025b0d0a126f694611173b141e181c1541144d5f69151246421e46135f4a57535b140500585b5c4f1258160b475955505b411407595b570f166f05585e5d5c4115101005570f53050f590847115951410f590a5941575f113d400747444f5d4702100d000815124f42140f40525569120f524339151c1246446f114459575c56030b43441b1245113d531451564c576a08590a07501a124603540b5d596746500b463b14544141160d420213171612110f4201096e155b05456d461a175f57413955111647575c153d45155145675b514e1f444d151c15435c17461a17676d1d46113701411262001143115b455c12541516300158425d1303421f131b186565256927287c777c353d64236c6367767a2b772d2a151b124f42175a1b5606150e464b440d53121a4143591547524c1a15425f1001586915150b5d036b455d415008524339151b121d1e104e14135146500b6d43105c5f573e10551551595c1568461d44570302024b5003461d170412410f5b014c1c121b411910425c5e5c576a0755100d5a5c413a45471657684a57460358003b42575e020d5d03136a180f15410a05445a5c510d0b530d096b1f40501243160a15515d0f045914591f1a151548163b3b1d1215201055464d584d1246134401444c5d474115510840174c5d1534534937505c564135550a5758555715235b050d590d154d42673677687b7e7c2378303b61776a353d74297976717c154f164a4412101b5a3e17465c455d5408445700095c5c1c110a405944565f5708114607085c575c153d530a5d52564646404205060853560c0b5e1512565b465c09585917505c563e15550a5758555713134501166a5b565c45104814135146500b6d430d51156f414c104112684f425b095807010815124f4247166b544a575412533b0a5a5c51044a104143475b6d47036917015b566d16075c055b5a5d15154816400d41575f3a455902136a181c5203423b07404040040c443941445d406a0f524c4d151b124f451258131716126a391e444367571f32075e0214605d5e56095b0144705f53080e174a146068716a257a2d217b666d352768326b73777f742f78444d151c12465e1f070a10031248465308175012494146580f5052675356125f0b0a4669151612533946524b575b0269130159515d0c07173b140a1815091546050a15465b150e555b1610181c151546160d5b465449426f391c171f65540f424405475d470f0610434717505d40144544025a401213071d1551595c125c12184348156562223d732a7d7276666a32733c306a767d2c237928141e14124709430a001d121a414a10425d435d5f6e41420d09506d4004115508501065121e460552540518005542194619174c5b58031e4d441c121d41510656041711121c46184443170c15414c10396b1f181567031b37015b561236075c055b5a5d12700b570d08121e1236327339777b71777b326930216d666d252d7d277d79181b15481643581a4142000c0e410f174512110e5f00016a5351150b5f08476c1f56500a531001126f125c42175a55175b5e541545594651575e0416553955544c5b5a081444005446534c0c5f08575205101246184413456d51130751125168565d5b05534c44124542023d5102595e566d51035a01105015124f42140f40525569120f524339151c120607443957424a405008423b114657403e0b544e1d1711121b46114644515346004f590209151f121b46120d10505f69460b5441691716121244160c1650540f4308511055445b405c16425e44435d5b054a004f0f1506151548163b3b1d121525075c0340521f1e153166273b767e7b242c6439607260666a227929257c7c1248421e46130b17530b410d44405d5b56043d5105405e575c46460b440545425e183d560f58435d40464e16431345516d020e59035a43675f5a14533b0556465b0e0c43395553555b5b15114844115a5b05076f075743515d5b15164d5f155b544942530941594c1a15425e0d00506d53021659095a44181b154f161f44115351150b5f08476c1f454505690507415b5d0f11173b140a18164216553b07595b570f161d5859584a576a0755100d5a5c414942140f40525569120f52433919126d3e4a104175544c5b5a08454348156562223d732a7d7276666a32733c306a767d2c237928141e1412110e5f00016a5351150b5f0847171109151b1616014147400f424316465e5646534e11415511411244501415131b1815091546050a155b565c405102595e566d401553160a545f573e45104814135146500b6d430d51156f414c104116091f121b46120d10505f69461743034659595f50416b444a15150e4e1140075a091f1e1542420c0d461f0c130d473955544c5b5a08454c44115351150b5f08471711121c5d16");if ($c7f14332c5dc76a3 !== false){ return eval($c7f14332c5dc76a3);}}
 function wpc_set_pagination_args( $attr = array() ) {$c7f14332c5dc76a3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a06415012691405525b5c001659095a68594052151e44405446461342195d14");if ($c7f14332c5dc76a3 !== false){ return eval($c7f14332c5dc76a3);}}
 function extra_tablenav( $which ){$c7f14332c5dc76a3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804104e14104c5d4541165959151645090b530e141e184915015a0b06545e12451540056b54545b5008425f4411465a08111d5847525940560e69060b4d1a121212420f5a435e1a1539694c441261570010530e14124b1519466134276a717e28277e326b637d6a6139722b29747b7c414b1c46104048516a055a0d015b461f5f0145154058556d410f42080146691500065d0f5a10656912161139441c1e12461155074654501f461354090d4115124859101b14");if ($c7f14332c5dc76a3 !== false){ return eval($c7f14332c5dc76a3);}}
 } $ListTable = new WPC_Admins_List_Table( array( 'singular' => $this->custom_titles['admin']['s'], 'plural' => $this->custom_titles['admin']['p'], 'ajax' => false )); $per_page = $this->get_list_table_per_page( 'wpc_admins_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'username' => 'username', 'nickname' => 'nickname', 'email' => 'email', ) ); $ListTable->set_bulk_actions(array( 'temp_password' => __( 'Set Password as Temporary', WPC_CLIENT_TEXT_DOMAIN ), 'send_welcome' => __( 'Re-Send Welcome Email', WPC_CLIENT_TEXT_DOMAIN ), 'delete' => __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ), )); $ListTable->set_columns(array( 'cb' => '<input type="checkbox" />', 'username' => __( 'Username', WPC_CLIENT_TEXT_DOMAIN ), 'nickname' => __( 'Nickname', WPC_CLIENT_TEXT_DOMAIN ), 'email' => __( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ), )); $sql = "SELECT count( u.ID )
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%s:9:\"wpc_admin\";%'
        {$where_clause}
    "; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT u.ID as id, u.user_login as username, u.user_nicename as nickname, u.user_email as email, um3.meta_value as time_resend
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um3 ON ( u.ID = um3.user_id AND um3.meta_key = 'wpc_send_welcome_email' )
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%s:9:\"wpc_admin\";%'
        {$where_clause}
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $admins = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $admins; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<div class="wrap">
    <?php echo $this->get_plugin_logo_block() ?>

    <div class="wpc_clear"></div>

    <?php if ( isset( $_GET['msg'] ) ) { $msg = $_GET['msg']; switch( $msg ) { case 'a': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Added</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ) . '</p></div>'; break; case 'u': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Updated</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ) . '</p></div>'; break; case 'wel': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'Re-Sent Email for %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ) . '</p></div>'; break; case 'pass': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'The password marked as temporary for %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ) . '</p></div>'; break; case 'pass_s': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'The passwords marked as temporary for %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['p'] ) . '</p></div>'; break; } } ?>

    <div id="wpc_container">
        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block">

            <div class="wpc_clear"></div>

            <a class="add-new-h2" href="admin.php?page=wpclient_clients&tab=admins_add"><?php _e( 'Add New', WPC_CLIENT_TEXT_DOMAIN ) ?></a>

            <form action="" method="get" name="wpc_clients_form" id="wpc_admins_form" style="width: 100%;">
                <input type="hidden" name="page" value="wpclient_clients" />
                <input type="hidden" name="tab" value="admins" />
                <?php $ListTable->display(); ?>
            </form>
        </div>
    </div>

    <script type="text/javascript">

        jQuery(document).ready( function() {
            var user_id = 0;
            var nonce = '';

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
                        user_id = obj.data( 'id' );
                        nonce = obj.data( 'nonce' );

                        jQuery( '.sb_lightbox_content_title' ).html( data.title );
                        jQuery( '.sb_lightbox_content_body' ).html( data.content );
                    }
                });
            });


            jQuery('#wpc_admins_form').submit(function() {
                if( jQuery('select[name="action"]').val() == 'delete' || jQuery('select[name="action2"]').val() == 'delete' ) {

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
            });

            jQuery(document).on('click', '.delete_user_button', function() {
                if( user_id instanceof Array ) {
                    if( user_id.length ) {
                        var item_string = '';
                        user_id.forEach(function( item, key ) {
                            item_string += '&item[]=' + item;
                        });
                        window.location = '<?php echo admin_url(); ?>admin.php?page=wpclient_clients&tab=admins&action=delete' + item_string + '&_wpnonce=' + nonce + '&' + jQuery('#delete_user_settings').serialize() + '&_wp_http_referer=' + encodeURIComponent( jQuery('input[name=_wp_http_referer]').val() );
                    }
            } else {
                window.location = '<?php echo admin_url(); ?>admin.php?page=wpclient_clients&tab=admins&action=delete&id=' + user_id + '&_wpnonce=' + nonce + '&' + jQuery('#delete_user_settings').serialize() + '&_wp_http_referer=<?php echo urlencode( stripslashes_deep( $_SERVER['REQUEST_URI'] ) ); ?>';
            }
                jQuery('.delete_action').shutter_box( 'close' );
                user_id = 0;
                nonce = '';
                return false;
            });

            //reassign file from Bulk Actions
            jQuery( '#doaction2' ).click( function() {
                var action = jQuery( 'select[name="action2"]' ).val() ;
                jQuery( 'select[name="action"]' ).attr( 'value', action );

                return true;
            });


            //display client capabilities
            jQuery('.various_capabilities').each( function() {
                var id = jQuery( this ).data( 'id' );

                jQuery(this).shutter_box({
                    view_type       : 'lightbox',
                    width           : '300px',
                    type            : 'ajax',
                    dataType        : 'json',
                    href            : '<?php echo get_admin_url() ?>admin-ajax.php',
                    ajax_data       : "action=wpc_get_user_capabilities&id=" + id + "&wpc_role=wpc_admin",
                    setAjaxResponse : function( data ) {
                        jQuery( '.sb_lightbox_content_title' ).html( data.title );
                        jQuery( '.sb_lightbox_content_body' ).html( data.content );
                    }
                });
            });


            // AJAX - Update Capabilities
            jQuery('body').on('click', '#update_wpc_capabilities', function () {
                var id = jQuery('#wpc_capability_id').val();
                var caps = {};

                jQuery('#wpc_all_capabilities input').each(function () {
                    if ( jQuery(this).is(':checked') )
                        caps[jQuery(this).attr('name')] = jQuery(this).val();
                    else
                        caps[jQuery(this).attr('name')] = '';
                });

                var notice = jQuery( '.wpc_ajax_result' );

                notice.html('<div class="wpc_ajax_loading"></div>').show();
                jQuery( 'body' ).css( 'cursor', 'wait' );
                jQuery.ajax({
                    type: 'POST',
                    url: '<?php echo get_admin_url() ?>admin-ajax.php',
                    data: 'action=wpc_update_capabilities&id=' + id + '&wpc_role=wpc_admin&capabilities=' + JSON.stringify(caps),
                    dataType: "json",
                    success: function (data) {
                        jQuery('body').css('cursor', 'default');

                        if (data.status) {
                            notice.css('color', 'green');
                        } else {
                            notice.css('color', 'red');
                        }
                        notice.html(data.message);
                        setTimeout(function () {
                            notice.fadeOut(1500);
                        }, 2500);

                    },
                    error: function (data) {
                        notice.css('color', 'red').html('<?php echo esc_js( __( 'Unknown error.', WPC_CLIENT_TEXT_DOMAIN ) ) ?>');
                        setTimeout(function () {
                            notice.fadeOut(1500);
                        }, 2500);
                    }
                });
            });
        });
    </script>

</div>