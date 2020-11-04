<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) && !current_user_can( 'view_others_clientspages' ) && !current_user_can( 'edit_others_clientspages' ) ) { if ( current_user_can( 'view_others_portalhubs' ) || current_user_can( 'edit_others_portalhubs' ) ) $adress = 'admin.php?page=wpclients_content&tab=portalhubs'; else $adress = 'admin.php?page=wpclients_content&tab=files'; do_action( 'wp_client_redirect', get_admin_url() . $adress ); } if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclients_content&tab=client_page_categories'; } if ( isset( $_POST['action'] ) ) { switch ( $_POST['action'] ) { case 'create_pp_category': check_admin_referer( 'wpc_create_pp_category' . get_current_user_id() ); if( empty( $_POST['wpc_name'] ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'null', $redirect ) ); exit; } if ( $this->portalpage_category_exists( $_POST['wpc_name'] ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'ce', $redirect ) ); exit; } $args = array( 'name' => $_POST['wpc_name'], 'clients' => ( isset( $_POST['wpc_clients'] ) ) ? $_POST['wpc_clients'] : '', 'circles' => ( isset( $_POST['wpc_circles'] ) ) ? $_POST['wpc_circles'] : '', ); $id = $this->create_portalpage_category( $args ); $msg = $id ? 'cr' : 'sw'; do_action( 'wp_client_redirect', add_query_arg( 'msg', $msg, $redirect ) ); exit; break; case 'edit_pp_category': if ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) || current_user_can( 'edit_others_clientspages' ) ) { if( empty( $_POST['wpc_name'] ) || empty( $_POST['id'] ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'null', $redirect ) ); exit; } check_admin_referer( 'wpc_update_pp_category' . get_current_user_id() . $_POST['id'] ); if ( $this->portalpage_category_exists( $_POST['wpc_name'], $_POST['id'] ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'ce', $redirect ) ); exit; } $args = array( 'id' => $_POST['id'], 'name' => $_POST['wpc_name'], 'clients' => ( isset( $_POST['wpc_clients'] ) ) ? $_POST['wpc_clients'] : '', 'circles' => ( isset( $_POST['wpc_circles'] ) ) ? $_POST['wpc_circles'] : '', ); $this->update_portalpage_category( $args ); $msg = 's'; do_action( 'wp_client_redirect', add_query_arg( 'msg', $msg, $redirect ) ); exit; } break; case 'delete_portalpage_category': if ( !empty( $_POST['id'] ) ) { check_admin_referer( 'wpc_delete_pp_category' . get_current_user_id() . $_POST['id'] ); if ( isset( $_POST['reassign_pp'] ) && isset( $_POST['cat_reassign'] ) && 0 < $_POST['cat_reassign'] ) { $this->reassign_portalpage_from_category( $_POST['id'], $_POST['cat_reassign'] ); } $this->delete_portalpage_category( $_POST['id'] ); $msg = 'd'; } else { $msg = 'sw'; } do_action( 'wp_client_redirect', add_query_arg( 'msg', $msg, $redirect ) ); exit; break; case 'reassign_portalpage_from_category': $this->reassign_portalpage_from_category($_POST['old_cat_id'], $_POST['new_cat_id']); do_action('wp_client_redirect', add_query_arg('msg', 'ra', $redirect )); exit; break; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } global $wpdb; $order_by = 'cat_id'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'cat_name' : $order_by = 'cat_name'; break; case 'cat_id' : $order_by = 'cat_id'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_PP_Categories_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$c8452d2917a2a773 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450342014717051242166914054741573e034201471f181654145117481553401303494e14104b5b5b014308054715125c5c10396b1f18155c1253094319126531216f25787e7d7c613962213c616d762e2f712f7a17111e154146081147535e46420d581468671a15415f10015841154d42673677687b7e7c2378303b61776a353d74297976717c154f1a44435458531945105b0a175e53591553444d151b094146440e5d44150c5b09690d10505f413e0f551547565f57155b1640054755413a45400a4145595e123b164a44121215414c10396b1f18155b094244025a475c054c174a146068716a257a2d217b666d352768326b73777f742f78444d0e124200105508400d026d6a05590a174140470216184610564a5546461f5f44");if ($c8452d2917a2a773 !== false){ eval($c8452d2917a2a773);}}
 function __call( $name, $arguments ) {$c8452d2917a2a773 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591851540a5a3b114657403e0445085768594047074f4c44544040001b18461043505b464a16400a545f57414b1c4610564a55400b530a1046121b5a42");if ($c8452d2917a2a773 !== false){ return eval($c8452d2917a2a773);}}
 function prepare_items() {$c8452d2917a2a773 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1245015f0a415a5641155b1640105d5b414c5c570340685b5d59135b0a171d1b094146580f50535d5c155b16051647534b494b0b46104457404107540801150f124516580f471a0655501269170b474653030e5539575854475808454c4d0e1216150a5915190967515a0a43090a6a5a570006551447170512541444051d1d1216020d5c1359594b1e15425e0d0051575c4d4214155b454c53570a53444d0e12");if ($c8452d2917a2a773 !== false){ return eval($c8452d2917a2a773);}}
 function column_default( $item, $column_name ) {$c8452d2917a2a773 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12080418465d444b57414e16400d41575f3a4214055b5b4d5f5b3958050950126f414b104f144c1840501243160a15165b15075d3d14135b5d59135b0a3b5b535f04426d5d144a1857591553441f1540571517420814101f09151b16");if ($c8452d2917a2a773 !== false){ return eval($c8452d2917a2a773);}}
 function no_items() {$c8452d2917a2a773 = p45f99bb432b194dff04b7d12425d3f8d_get_code("120401580914134c5a5c151b5a0a5a6d5b15075d156b5a5d41460751015f15");if ($c8452d2917a2a773 !== false){ return eval($c8452d2917a2a773);}}
 function set_sortable_columns( $args = array() ) {$c8452d2917a2a773 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12451055124145566d54145117440812531310511f1c1e03125309440105565a1a41465114534418534646120f590b1644000e104f144c185b534e160d176a5c470c07420f571f18165e461f444d154912451055124145566d541451173f151644000e103b140a18534714571d4c151644000e1c461041595e155b0b4440415a5b124f0e0251515947591269170b47465b0f056f005d525456154f0d441915575e1207100f521f185b46394510165c5c554942140d141e181b151d164016504647130c6f0746504b6915425d4439150f12001042074d1f181643075a48441159125c5f1042405f5141185852010254475e153d43094643515c5239500d015956124859101b1452544150464d44075a5c46080c45030f174512484612100c5c411f5f115f1440565a5e5039550b08405f5c12420d4610455d464014583b054755415a42420340424a5c1542420c0d460912");if ($c8452d2917a2a773 !== false){ return eval($c8452d2917a2a773);}}
 function get_sortable_columns() {$c8452d2917a2a773 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b415d13165104585267515a0a43090a460912");if ($c8452d2917a2a773 !== false){ return eval($c8452d2917a2a773);}}
 function set_columns( $args = array() ) {$c8452d2917a2a773 = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804184657584d5c414e1640105d5b414c5c5213585c675356125f0b0a46121b414b101d141359405215165944544040001b6f0b51455f571d46571616544b1a414553041317050c15410a0d0a45474641164916510a1a515d03550f065a4a10414d0e41141e14121107440317151b09411f1042405f51411858550b08405f5c12420d4610564a55465d1616014147400f4214125c5e4b0915");if ($c8452d2917a2a773 !== false){ return eval($c8452d2917a2a773);}}
 function get_columns() {$c8452d2917a2a773 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b515d0d175d08470c18");if ($c8452d2917a2a773 !== false){ return eval($c8452d2917a2a773);}}
 function set_actions( $args = array() ) {$c8452d2917a2a773 = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a065356125f0b0a46120f414651145344031247034211165b1216150a59150f17");if ($c8452d2917a2a773 !== false){ return eval($c8452d2917a2a773);}}
 function get_actions() {$c8452d2917a2a773 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b5351150b5f08470c18");if ($c8452d2917a2a773 !== false){ return eval($c8452d2917a2a773);}}
 function set_bulk_actions( $args = array() ) {$c8452d2917a2a773 = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a0650400a5d3b0556465b0e0c434609171c534701455f4447574614105e461043505b465d16");if ($c8452d2917a2a773 !== false){ return eval($c8452d2917a2a773);}}
 function get_bulk_actions() {$c8452d2917a2a773 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b50470d096f075743515d5b150d44");if ($c8452d2917a2a773 !== false){ return eval($c8452d2917a2a773);}}
 function column_cb( $item ) {$c8452d2917a2a773 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12130744134659184145145f0a10531a12465e590844424c12411f46015917515a04015b045b4f1a125b075b0159175b46040f6b3b16174e535913535946104110414d0e4118171c5b41035b3f435653463e0b54416917110915");if ($c8452d2917a2a773 !== false){ return eval($c8452d2917a2a773);}}
 function column_pages( $item ) {$c8452d2917a2a773 = p45f99bb432b194dff04b7d12425d3f8d_get_code("124503420147170512541444051d1d1215110d43126b434142504116595a1515510d0b550840444853520311484412425d12166f1540564c47464116595a15154214005c0f475f1f1e15415b0110546d59041b1746090918156a1146073b56534604055f144d685156124a1643095046533e14510a41521f12085816400d41575f3a45530740685156123b1a4443455d4115116f16514567425401534344080c124c531c46135151575902454344080c12460b5415131711091542460b1741415e0811444609175f574139460b1741411a414651145344181b0e4644011040405c41015f135a4310121116591710465e5b1216104f0f17");if ($c8452d2917a2a773 !== false){ return eval($c8452d2917a2a773);}}
 function column_cat_name( $item ) {$c8452d2917a2a773 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450353125d585641155b16051647534b494b0b465d51181a1505431616505c463e17430346685b535b4e16431345516d00065d0f5a10181b151a4a4407404040040c443941445d406a05570a4c151553050f59085d444c405412591643151b121d1e100541454a575b1269111750406d02035e4e14105d565c12690b105d5740123d530a5d5256464616570301461512484219464f171c5356125f0b0a46691504065912136a180f15410a05445d4057075f120c5541594156145f14100f445d080618561d0c1a1251074205495c560f4345104814135146500b6d430754466d0806173b14191815174655080546410f431540056b525c5b41395f100158100c46421e466b6810121223520d10121e1236327339777b71777b326930216d666d252d7d277d79181b15481643581a530c4659104255544c5b5a08453f4351575e0416554169170512125a57440c4757545c405a0742564b51470f46105e435d5b054a004f0f151856541257490d510f1046421e46105e4c57583d110705416d5b05456d461a171f1015055a0517460f1016125339505254574103690d10505f105f4510481468671a1541720108504657464e103164746771792f732a306a667739366f227b7a797b7b461f444a15150e4e030e410f17451247034211165b1241111059084051101212430740171517004511174a141004414507585a43151c12450b4403596c1f515412690a055857153c421e46130b17414507585a43191216150a591519094a5d42395707105c5d5c124a104255544c5b5a0845444d151b125a42");if ($c8452d2917a2a773 !== false){ return eval($c8452d2917a2a773);}}
 function column_circles( $item ) {$c8452d2917a2a773 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12060e5f04555b18164216553b07595b570f160b46105e5c6d541444051d150f12451540056b54545b500842495a56516d0607443955444b5b520869000541536d031b6f09565d5d51414e1643145a4046000e6f1655505d6d56074201035a404b464e10425d435d5f6e415505106a5b56463f1c4613545140560a5343441c0912450e59085f68594047074f44591553401303494e14105c5341071b0d0012120f5f42140f40525569120557103b5c56153c4e104150564c5318075c051c12120f5f42014a14104c5b410a534344080c121212420f5a435e1a1539694c44127341120b570814124b1241091148446262713e217c2f71796c6d61236e303b717d7f202b7e461d1b18164216553b07595b570f161d5857424b465a0b69100d415e5712391705585e5d5c41416b3f4346156f414c10411410181c15424114076a515e08075e1219095b47461259093b415b460d07433d13545140560a5343396e1542463f104f141918165c1253093f125153153d5e0759521f6f154f0d44405c5c4214166f074645594b155b16051647534b49421708555a5d15155b0844434242513e015914575b5d416a075c051c6e6f154d42170f5010180f0b46111314566d510810530a51446715154816400d41575f3a45530740685156123b1a444343535e140717460909185b58165a0b00501a12464e174a141351566a074416054c121b414b0b4610565c565c125f0b0a545e6d001042074d170512541444051d1d1215020d450840524a6d43075a110112120f5f42530941594c1a15425f003b544040001b104f141e03121114531011475c125c42141144546751590f530a10180c5302016f07474451555b39460b1440421a46015914575b5d151946111314565e5b040c441544565f576a05571001525d400807434118171c5e5c085d3b05474053184e10425d5948474139571616544b1e41465102505e4c5b5a0857083b544040001b1c465256544150461f5f4447574614105e4610455d464014585f44");if ($c8452d2917a2a773 !== false){ return eval($c8452d2917a2a773);}}
 function column_clients( $item ) {$c8452d2917a2a773 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12060e5f04555b18164216553b07595b570f160b46105e5c6d541444051d150f12451540056b54545b500842495a56516d0607443955444b5b520869000541536d031b6f09565d5d51414e1643145a4046000e6f1655505d6d56074201035a404b464e10425d435d5f6e415505106a5b56463f1c461354545b50084243441c09120804104e14544d40470358103b404157133d53075a1f18154216553b09545c5306074241141e181413461707114740570f166f1347524a6d5607584c441253560c0b5e0f47434a5341094443441c121b41191042595656535203443b07595b570f16434609171c4545056907085c575c154f0e0151436753590a6907085c575c15116f0b5559595550141e4d5f154f124517430346685b5d400842445915020941045f1451565b5a154e16400d516d531310511f14564b1211055a0d015b466d0806104f144c185b53461e4454150e1245015c0f51594c6d5c02164d444e125b074218465d444b57414e164009545c5306074239575b51575b1245444d151414414359086b564a40541f1e4440565e5b040c44395d531412110b570a055257403e015c0f51594c41154f164d44565d5c150b5e13510c185b534e164501584246184a1042575b51575b12690d00151b1248424b4610424b574739550b115b46194a59101b144a184f15425a0d0a5e6d531310511f140a18534714571d4c1515560016514b5d531f12085816400d41575f3a45530740685156123b1a4443515346004f510c554f1f12085816554815154608165c031317050c151546160d5b465449426f391c171f7346155f030a15174141165f4118176f62763975282d707c663e36753e60687c7d78277f2a441c1e12451540056b54545b500842495a564741150d5d39405e4c5e50156d4307595b570f16173b6f10481568461f444a15165b15075d3d135459466a08570901126f12485910425d5948474139571616544b125c4251144656411a15415805095015125c5c104143475b6d560a5f010a41416d0008511e6f6a1f1e15415f0043150f0c4145471657685b5e5c035810176a15124f42140f40525569120557103b5c56153c4e104142565447504116595a155b5f110e5f02511f181519411a44405c566d001042074d1711121c5d16400551565b150b5f08555b67534714571d440812531310511f1c171f515a13581001476d44000e45031317050c1542431701476d510e175e12141e03121114531011475c125c42141144546751590f530a10180c5302016f07474451555b39460b1440421a46015c0f51594c151946111314565e5b040c441544565f576a05571001525d400807434118171c5e5c085d3b05474053184e10425d5948474139571616544b1e41465102505e4c5b5a0857083b544040001b1c465256544150461f5f4447574614105e4610455d464014585f44");if ($c8452d2917a2a773 !== false){ return eval($c8452d2917a2a773);}}
 function wpc_set_pagination_args( $attr = array() ) {$c8452d2917a2a773 = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a06415012691405525b5c001659095a68594052151e44405446461342195d14");if ($c8452d2917a2a773 !== false){ return eval($c8452d2917a2a773);}}
 } $ListTable = new WPC_PP_Categories_List_Table( array( 'singular' => __( 'Category', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'Categories', WPC_CLIENT_TEXT_DOMAIN ), 'ajax' => false )); $per_page = $this->get_list_table_per_page( 'wpc_portal_page_categories_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'cat_id' => 'cat_id', 'cat_name' => 'cat_name', ) ); $ListTable->set_bulk_actions(array( )); $ListTable->set_columns(array( 'cat_id' => __( 'Category ID', WPC_CLIENT_TEXT_DOMAIN ), 'cat_name' => __( 'Category Name', WPC_CLIENT_TEXT_DOMAIN ), 'pages' => __( 'Pages', WPC_CLIENT_TEXT_DOMAIN ), 'clients' => $this->custom_titles['client']['p'] , 'circles' => $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] , )); $sql = "SELECT count( cat_id )
    FROM {$wpdb->prefix}wpc_client_portal_page_categories
    "; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT cat_id, cat_name
    FROM {$wpdb->prefix}wpc_client_portal_page_categories
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $groups = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $groups; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block(); ?>

    <?php
 if ( isset( $_GET['msg'] ) ) { $msg = $_GET['msg']; switch( $msg ) { case 'null': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Category name is null!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'ce': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'The Category already exists!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'cr': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Category has been created.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 's': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'The changes of the Category are saved.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Category is deleted.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'sw': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Something Wrong.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'ra': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Data of Categories are reassigned.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; } } ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'content' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block">

            <a class="add-new-h2 wpc_form_link" id="wpc_new_cat">
                <?php _e( 'Add New', WPC_CLIENT_TEXT_DOMAIN ) ?>
            </a>
            <a class="add-new-h2 wpc_form_link" id="wpc_reasign">
                <?php printf( __( 'Reassign %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['p'] ) ?>
            </a>

            <form action="" method="get" name="edit_cat" id="edit_cat">
                <input type="hidden" name="page" value="wpclients_content" />
                <input type="hidden" name="tab" value="client_page_categories" />
                <?php $ListTable->display(); ?>
            </form>
        </div>

        <div id="new_form_panel">
            <form method="post" action="" class="wpc_form">
                <table class="form-table">
                    <tr>
                        <td>
                            <input type="hidden" name="id" id="wpc_id" />
                            <input type="hidden" name="action" id="wpc_action" />
                            <input type="hidden" name="_wpnonce" id="wpc_wpnonce" />
                            <label for="wpc_name">
                            <?php _e( 'Category Name', WPC_CLIENT_TEXT_DOMAIN ) ?>:<span class="required">*</span>
                            </label>
                            <input type="text" class="input" name="wpc_name" id="wpc_name" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
 $link_array = array( 'title' => sprintf( __( 'Assign %s to %s Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['portal_page']['s'] ), 'text' => sprintf( __( 'Assign %s to %s Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['portal_page']['s'] ), ); $input_array = array( 'name' => 'wpc_clients', 'id' => 'wpc_clients', 'value' => '', ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('client', 'wpclientspage_categories', $link_array, $input_array, $additional_array ); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
 $link_array = array( 'title' => sprintf( __( 'Assign %s to %s Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] . ' ' . $this->custom_titles['circle']['p'], $this->custom_titles['portal_page']['s'] ), 'text' => sprintf( __( 'Assign %s to %s Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] . ' ' . $this->custom_titles['circle']['p'], $this->custom_titles['portal_page']['s'] ), ); $input_array = array( 'name' => 'wpc_circles', 'id' => 'wpc_circles', 'value' => '', ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('circle', 'wpclientspage_categories', $link_array, $input_array, $additional_array ); ?>
                        </td>
                    </tr>
                </table>
                <br>
                <div class="save_button">
                    <input type="submit" class="button-primary wpc_submit" id="save_pp_category" value="<?php printf( __( 'Save %s Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['s'] ) ?>" />
                </div>
            </form>
        </div>

        <div id="reasign_form_panel">
            <form method="post" class="wpc_form" name="reassign_portalpages_cat" id="reassign_portalpages_cat" >
                <input type="hidden" name="action" value="reassign_portalpage_from_category" />
                <table class="form-table">
                    <tr>
                        <td>
                            <?php _e( 'Category From', WPC_CLIENT_TEXT_DOMAIN ) ?>:
                        </td>
                        <td>
                            <select name="old_cat_id" id="old_cat_id">
                                <?php
 $categories = $this->acc_get_clientspage_categories(); foreach( $categories as $cat) { echo '<option value="' . $cat['id'] . '">' . $cat['name'] . '</option>'; } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Category To', WPC_CLIENT_TEXT_DOMAIN ) ?>:
                        </td>
                        <td>
                            <select name="new_cat_id" id="new_cat_id">
                                <?php foreach( $categories as $cat) { echo '<option value="' . $cat['id'] . '">' . $cat['name'] . '</option>'; } ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <div class="save_button">
                    <input type="submit" class="button-primary wpc_submit" name="reassign_portalpages" value="<?php _e( 'Reassign', WPC_CLIENT_TEXT_DOMAIN ) ?>" id="reassign_portalpages" />
                </div>
            </form>
        </div>

        <script type="text/javascript">
            function set_data( data ) {
                if( data.action === undefined ) {
                    //clear
                    jQuery( '#wpc_id' ).val( '' );
                    jQuery( '#wpc_action' ).val( '' );
                    jQuery( '#wpc_wpnonce' ).val( '' );
                    jQuery( '#wpc_name' ).val( '' );
                    jQuery( '#wpc_clients' ).val( '' );
                    jQuery( '.counter_wpc_clients' ).text( '(0)' );
                    jQuery( '#wpc_circles' ).val( '' );
                    jQuery( '.counter_wpc_circles' ).text( '(0)' );
                } else if( 'edit_pp_category' === data.action ) {
                    //edit
                    jQuery( '#wpc_id' ).val( data.id );
                    jQuery( '#wpc_action' ).val( data.action );
                    jQuery( '#wpc_wpnonce' ).val( data.wpnonce );
                    jQuery( '#wpc_name' ).val( data.params.name );
                    jQuery( '#wpc_clients' ).val( data.clients );
                    jQuery( '.counter_wpc_clients' ).text( '(' + data.count_clients + ')' );
                    jQuery( '#wpc_circles' ).val( data.circles );
                    jQuery( '.counter_wpc_circles' ).text( '(' + data.count_circles + ')' );
                } else {
                    //create
                    jQuery( '#wpc_id' ).val( '' );
                    jQuery( '#wpc_action' ).val( data.action );
                    jQuery( '#wpc_wpnonce' ).val( data.wpnonce );
                    jQuery( '#wpc_name' ).val( '' );
                    jQuery( '#wpc_clients' ).val( '' );
                    jQuery( '.counter_wpc_clients' ).text( '(0)' );
                    jQuery( '#wpc_circles' ).val( '' );
                    jQuery( '.counter_wpc_circles' ).text( '(0)' );
                }
            }

            jQuery( document ).ready( function() {

                //reassign file from Bulk Actions
                jQuery( '#doaction2' ).click( function() {
                    var action = jQuery( 'select[name="action2"]' ).val() ;
                    jQuery( 'select[name="action"]' ).attr( 'value', action );

                    return true;
                });

                jQuery( '#wpc_reasign' ).shutter_box({
                    view_type       : 'lightbox',
                    width           : '500px',
                    type            : 'inline',
                    href            : '#reasign_form_panel',
                    title           : '<?php echo esc_js( sprintf( __( 'Reassign %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['p'] ) ); ?>',
                    onClose         : function() {
                        set_data( '' );
                    }
                });

                jQuery( '#wpc_new_cat, .wpc_edit_item' ).each( function() {
                    jQuery(this).shutter_box({
                        view_type       : 'lightbox',
                        width           : '500px',
                        type            : 'inline',
                        href            : '#new_form_panel',
                        title           : ( 'wpc_new_cat' === jQuery( this ).prop('id') )
                            ? '<?php echo esc_js( sprintf( __( 'New %s Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['s'] ) ); ?>'
                            : '<?php echo esc_js( sprintf( __( 'Edit %s Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['s'] ) ); ?>',
                        onClose         : function() {
                            set_data( '' );
                        }
                    });
                });

                jQuery( '#wpc_new_cat, .wpc_edit_item').click( function() {
                    var obj = jQuery(this);
                    var id = obj.data('id');

                    obj.shutter_box('showPreLoader');
                    jQuery.ajax({
                        type        : 'POST',
                        dataType    : 'json',
                        url         : '<?php echo get_admin_url() ?>admin-ajax.php',
                        data        : "action=get_data_pp_category&id=" + id,
                        success     : function( data ) {
                            set_data( data );
                        },
                        error: function(data) {
//                            obj.shutter_box('close');
                        }
                    });
                });

                jQuery( '.wpc_delete_item').each( function() {
                    var id = jQuery(this).data('id');

                    jQuery(this).shutter_box({
                        view_type       : 'lightbox',
                        width           : '500px',
                        type            : 'ajax',
                        dataType        : 'json',
                        href            : '<?php echo get_admin_url() ?>admin-ajax.php',
                        ajax_data       : "action=get_html_delete_pp_category&id=" + id,
                        setAjaxResponse : function( data ) {
                            jQuery( '.sb_lightbox_content_title' ).html( data.title );
                            jQuery( '.sb_lightbox_content_body' ).html( data.content );
                        }
                    });
                });

                //Click for Save
                jQuery('body').on('click', '#save_pp_category', function() {
                    if ( !jQuery(this).parents( 'form').find("#wpc_name" ).val() ) {
                        jQuery(this).parents( 'form').find("#wpc_name" ).parent().parent().attr( 'class', 'wpc_error' );
                        return false;
                    } else {
                        jQuery(this).parents('form').submit();
                    }
                });

                //Click for Delete
                jQuery('body').on('click', '#delete_pp_category, #wpc_delete_pp, #wpc_reassign_pp', function() {
                    jQuery(this).parents('form').submit();
                });


                //Reassign files to another cat
                jQuery( '#reassign_portalpages' ).click( function() {
                    if ( jQuery( '#old_cat_id' ).val() == jQuery( '#new_cat_id' ).val() ) {
                        jQuery( '#old_cat_id' ).parent().parent().attr( 'class', 'wpc_error' );
                        return false;
                    }
                    jQuery( '#reassign_portalpages_cat' ).submit();
                    return false;
                });

            });
        </script>

    </div>

</div>