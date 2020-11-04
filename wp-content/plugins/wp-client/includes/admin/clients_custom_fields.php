<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } if( $this->wpc_flags['easy_mode'] ) { do_action( 'wp_client_redirect', admin_url( 'admin.php?page=wpclient_clients' ) ); exit; } if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) ) { do_action( 'wp_client_redirect', get_admin_url() . 'admin.php?page=wpclient_clients' ); } global $wpdb; $wpc_custom_fields = $this->cc_get_settings( 'custom_fields' ); if ( !empty( $_POST['custom_fields'] ) && $array = $_POST['custom_fields'] ) { reset( $array ); $name = key( $array ); $value = array_shift( $array ); if ( !empty( $wpc_custom_fields[ $name ]['nature'] ) ) { $for = $wpc_custom_fields[ $name ]['nature']; $only_undefined = filter_input( INPUT_POST, 'wpc_only_undefined' ); $args = array( 'fields' => 'ID', ); $ids = array(); if ( in_array( $for, array( 'staff', 'both' ) ) ) { $args['role'] = 'wpc_client_staff'; $staff = get_users( $args ); $ids = array_merge( $ids, $staff ); } if ( in_array( $for, array( 'client', 'both' ) ) ) { $args['role'] = 'wpc_client'; $clients = get_users( $args ); $ids = array_merge( $ids, $clients ); } if ( $only_undefined ) { $exists = $wpdb->get_col( $wpdb->prepare( "SELECT user_id FROM {$wpdb->usermeta} " . "WHERE meta_key = %s", $name) ); $ids = array_diff( $ids, $exists ); } foreach( $ids as $id ) { update_user_meta( $id, $name, $value ); } $msg = 'cfu'; } else { $msg = 'wd'; } do_action( 'wp_client_redirect', add_query_arg( array( 'page' => 'wpclient_clients', 'tab' => 'custom_fields', 'msg' => $msg ), admin_url( 'admin.php' ) ) ); exit; } $fields = array(); $types = array(); $i = 0; foreach ( $wpc_custom_fields as $key => $value ) { $i++; $value['id'] = $i; $value['name'] = $key; $types[] = $value; } if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=custom_fields'; } if ( isset( $_GET['action'] ) ) { switch ( $_GET['action'] ) { case 'delete': $ids = array(); if ( isset( $_GET['name'] ) ) { check_admin_referer( 'wpc_field_delete' . $_GET['name'] . get_current_user_id() ); $ids = (array) $_GET['name']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( __( 'Fields', WPC_CLIENT_TEXT_DOMAIN ) ) ); $ids = $_REQUEST['item']; } if ( count( $ids ) ) { foreach ( $ids as $item_id ) { $is_filetype = false; if( isset( $wpc_custom_fields[ $item_id ]['type'] ) && 'file' == $wpc_custom_fields[ $item_id ]['type'] ) { $is_filetype = true; } unset( $wpc_custom_fields[ $item_id ] ); do_action( 'wp_client_settings_update', $wpc_custom_fields, 'custom_fields' ); $client_ids = get_users( array( 'role' => 'wpc_client', 'meta_key' => $item_id, 'fields' => 'ID', ) ); if ( is_array( $client_ids ) && 0 < count( $client_ids ) ) { foreach( $client_ids as $id ) { if( $is_filetype ) { $filedata = get_user_meta( $id, $item_id, true ); $filepath = $this->get_upload_dir('wpclient/_custom_field_files/' . $item_id . '/') . $filedata['filename']; if( file_exists( $filepath ) ) { unlink( $filepath ); } delete_user_meta( $id, $item_id ); } } if( $is_filetype ) { rmdir($this->get_upload_dir('wpclient/_custom_field_files/' . $item_id . '/')); } } } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Fields_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$c7eff14d1e45538e = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450342014717051242166914054741573e034201471f181654145117481553401303494e14104b5b5b014308054715125c5c10396b1f18155c1253094319126531216f25787e7d7c613962213c616d762e2f712f7a17111e154146081147535e46420d581468671a15415f10015841154d42673677687b7e7c2378303b61776a353d74297976717c154f1a44435458531945105b0a175e53591553444d151b094146440e5d44150c5b09690d10505f413e0f551547565f57155b1640054755413a45400a4145595e123b164a44121215414c10396b1f18155b094244025a475c054c174a146068716a257a2d217b666d352768326b73777f742f78444d0e124200105508400d026d6a05590a174140470216184610564a5546461f5f44");if ($c7eff14d1e45538e !== false){ eval($c7eff14d1e45538e);}}
 function __call( $name, $arguments ) {$c7eff14d1e45538e = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591851540a5a3b114657403e0445085768594047074f4c44544040001b18461043505b464a16400a545f57414b1c4610564a55400b530a1046121b5a42");if ($c7eff14d1e45538e !== false){ return eval($c7eff14d1e45538e);}}
 function prepare_items() {$c7eff14d1e45538e = p45f99bb432b194dff04b7d12425d3f8d_get_code("1245015f0a415a5641155b1640105d5b414c5c570340685b5d59135b0a171d1b094146580f50535d5c155b16051647534b494b0b46104457404107540801150f124516580f471a0655501269170b474653030e5539575854475808454c4d0e1216150a5915190967515a0a43090a6a5a570006551447170512541444051d1d1216020d5c1359594b1e15425e0d0051575c4d4214155b454c53570a53444d0e12");if ($c7eff14d1e45538e !== false){ return eval($c7eff14d1e45538e);}}
 function column_default( $item, $column_name ) {$c7eff14d1e45538e = p45f99bb432b194dff04b7d12425d3f8d_get_code("12080418465d444b57414e16400d41575f3a4214055b5b4d5f5b3958050950126f414b104f144c1840501243160a15165b15075d3d14135b5d59135b0a3b5b535f04426d5d144a1857591553441f1540571517420814101f09151b16");if ($c7eff14d1e45538e !== false){ return eval($c7eff14d1e45538e);}}
 function no_items() {$c7eff14d1e45538e = p45f99bb432b194dff04b7d12425d3f8d_get_code("120401580914134c5a5c151b5a0a5a6d5b15075d156b5a5d41460751015f15");if ($c7eff14d1e45538e !== false){ return eval($c7eff14d1e45538e);}}
 function set_sortable_columns( $args = array() ) {$c7eff14d1e45538e = p45f99bb432b194dff04b7d12425d3f8d_get_code("12451055124145566d54145117440812531310511f1c1e03125309440105565a1a41465114534418534646120f590b1644000e104f144c185b534e160d176a5c470c07420f571f18165e461f444d154912451055124145566d541451173f151644000e103b140a18534714571d4c151644000e1c461041595e155b0b4440415a5b124f0e0251515947591269170b47465b0f056f005d525456154f0d441915575e1207100f521f185b46394510165c5c554942140d141e181b151d164016504647130c6f0746504b6915425d4439150f12001042074d1f181643075a48441159125c5f1042405f5141185852010254475e153d43094643515c5239500d015956124859101b1452544150464d44075a5c46080c45030f174512484612100c5c411f5f115f1440565a5e5039550b08405f5c12420d4610455d464014583b054755415a42420340424a5c1542420c0d460912");if ($c7eff14d1e45538e !== false){ return eval($c7eff14d1e45538e);}}
 function get_sortable_columns() {$c7eff14d1e45538e = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b415d13165104585267515a0a43090a460912");if ($c7eff14d1e45538e !== false){ return eval($c7eff14d1e45538e);}}
 function set_columns( $args = array() ) {$c7eff14d1e45538e = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804184657584d5c414e1640105d5b414c5c5213585c675356125f0b0a46121b414b101d141359405215165944544040001b6f0b51455f571d46571616544b1a414553041317050c15410a0d0a45474641164916510a1a515d03550f065a4a10414d0e41141e14121107440317151b09411f1042405f51411858550b08405f5c12420d4610564a55465d1616014147400f4214125c5e4b0915");if ($c7eff14d1e45538e !== false){ return eval($c7eff14d1e45538e);}}
 function get_columns() {$c7eff14d1e45538e = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b515d0d175d08470c18");if ($c7eff14d1e45538e !== false){ return eval($c7eff14d1e45538e);}}
 function set_actions( $args = array() ) {$c7eff14d1e45538e = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a065356125f0b0a46120f414651145344031247034211165b1216150a59150f17");if ($c7eff14d1e45538e !== false){ return eval($c7eff14d1e45538e);}}
 function get_actions() {$c7eff14d1e45538e = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b5351150b5f08470c18");if ($c7eff14d1e45538e !== false){ return eval($c7eff14d1e45538e);}}
 function set_bulk_actions( $args = array() ) {$c7eff14d1e45538e = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a0650400a5d3b0556465b0e0c434609171c534701455f4447574614105e461043505b465d16");if ($c7eff14d1e45538e !== false){ return eval($c7eff14d1e45538e);}}
 function get_bulk_actions() {$c7eff14d1e45538e = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b50470d096f075743515d5b150d44");if ($c7eff14d1e45538e !== false){ return eval($c7eff14d1e45538e);}}
 function column_cb( $item ) {$c7eff14d1e45538e = p45f99bb432b194dff04b7d12425d3f8d_get_code("12130744134659184145145f0a10531a12465e590844424c12411f46015917515a04015b045b4f1a125b075b0159175b46040f6b3b16174e535913535946104110414d0e4118171c5b41035b3f435b535f04456d461d0c18");if ($c7eff14d1e45538e !== false){ return eval($c7eff14d1e45538e);}}
 function column_type( $item ) {$c7eff14d1e45538e = p45f99bb432b194dff04b7d12425d3f8d_get_code("1212155912575f1012110f4201096e154618125541691711124e4655051750121515074812130d1840501243160a156d6d49421732514f4c1277094e4348156562223d732a7d7276666a32733c306a767d2c237928141e0312571453050f0e1251001155461353594650165f070f5040155b42420340424a5c1539694c441276531507400f575c5d40124a163334766d712d2b752860686c776d3269202b78737b2f42195d14545941504611070b4646155b42420340424a5c1539694c4412715d1216174a146068716a257a2d217b666d352768326b73777f742f78444d0e12501307510d0f175b534603164310504a4600105507130d1840501243160a156d6d4942172b415b4c5b180a5f0a01156657191610245b4f1f1e153166273b767e7b242c6439607260666a227929257c7c1248591004465259590e465505175012151303540f5b10021247034211165b126d3e4a104166565c5b5a46741110415d5c12451c4663677b6d762a7f212a616d66243a6439707875737c28164d5f15504004035b5d14545941504611070c505159030d48410e174a574113440a446a6d1a4145730e515453505a1e53174319126531216f25787e7d7c613962213c616d762e2f712f7a17110915044401055e09120203430314104b5759035510065a4a155b42420340424a5c1539694c441261570d0753121475574a124a163334766d712d2b752860686c776d3269202b78737b2f42195d14554a57540d0d440754415741455d1358435141500a530710575d4a4658101451434d405b46693b4c15157f140e440f14645d5e50054244265a4a154d42673677687b7e7c2378303b61776a353d74297976717c154f0d44064757530a59100555445d12120e5f0000505c155b42420340424a5c1539694c44127a5b050655081471515759021148446262713e217c2f71796c6d61236e303b717d7f202b7e461d0c18504703570f5f15515312071041525e5457125c1616014147400f426f391c171f745c0a534348156562223d732a7d7276666a32733c306a767d2c237928141e0312571453050f0e124f411055124145561212410d44");if ($c7eff14d1e45538e !== false){ return eval($c7eff14d1e45538e);}}
 function column_id( $item ) {$c7eff14d1e45538e = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591815091546050a15515e0011435b16584a565014690a1158100c46421e46105e4c57583d110d00126f124f42175a1b4448535b580a1714545c12020e5115470a1a5d470253163b5c5f55435c0c494747595c0b41165f44");if ($c7eff14d1e45538e !== false){ return eval($c7eff14d1e45538e);}}
 function column_users( $item ) {$c7eff14d1e45538e = p45f99bb432b194dff04b7d12425d3f8d_get_code("12060e5f04555b18164216553b07595b570f160b465d5110125c154501101d12160816550b6f105653411344014368121b4144164613444c5353001144590812160816550b6f105653411344014368121b4119104241445d4046460b44404242513e015c0f51594c1f0b054317105a5f6d150b440a514463154612570202126f694612173b0f174512500a45010d531a1208114303401f18165c1253093f125c5315174203136a181b1540104443575d460945105b09171c5b41035b3f435b534614105541691711124e46121117504041415f10154445515c41001e443b6a1a124647434655595c121015114448156562223d732a7d7276666a32733c306a767d2c237928141e181e15424114076a515e08075e1219095b47461259093b415b460d07433d1354545b50084243396e1542463f104a104048516a055a0d015b461f5f0145154058556d410f420801466915121651005210656912161139441c09121c42550a4752184915424317014741125c42141144546751590f530a10180c511411440959684c5b410a53173f12515e08075e12136a631545416b5f44481240041645145a171c47460344175f15");if ($c7eff14d1e45538e !== false){ return eval($c7eff14d1e45538e);}}
 function column_title( $item ) {$c7eff14d1e45538e = p45f99bb432b194dff04b7d12425d3f8d_get_code("12130744134659181a150f451701411a12450b4403596c1f465c125a014368121b414b105914135146500b6d43105c465e04456d460e171f15155d16");if ($c7eff14d1e45538e !== false){ return eval($c7eff14d1e45538e);}}
 function column_cf_placeholder( $item ) {$c7eff14d1e45538e = p45f99bb432b194dff04b7d12425d3f8d_get_code("1213074413465918154e41164a44115b46040f6b415a565557123b164a44124f15415910");if ($c7eff14d1e45538e !== false){ return eval($c7eff14d1e45538e);}}
 function column_options( $item ) {$c7eff14d1e45538e = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450a440b5817051212410d44405d465f0d421e5b1410045b5b16431044414b42045f12055c525b5957094e4644515b4100005c0350171f0915425e100959121c5c4218465d444b57414e16400d41575f3a4542034542514050021139441c1214474217571317050f15425f1001586915130741135d455d56123b164d440a1215020a55055f525c15155c1643430e121609165d0a141905121246195a425b50411159160856444809124618443b6a1a1246305517415e4a5751411a443365716d222e79237a636766703e623b207a7f73282c104f14191815090444444b0b15094110551241455612110e4209080e12");if ($c7eff14d1e45538e !== false){ return eval($c7eff14d1e45538e);}}
 function column_name( $item ) {$c7eff14d1e45538e = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450353125d585641155b16051647534b494b0b4610565b465c0958173f1257560816173b140a18150907160c1650540f4303540b5d5916425d1609140552570f1612530a5d5256466a055a0d015b46414716510409544d4141095b3b025c575e05111603505e4c0f12461844405c46570c391708555a5d156846184443170c15414c10396b1f181570025f104319126531216f25787e7d7c613962213c616d762e2f712f7a1711121b4611584b540c154159104255544c5b5a08453f434657463e14510a41524b1568460b4443095312091055000915525343074507165c42465b145f0f501f081b0e4416000541531f0f035d0309151f121b46120d10505f69460c510b511065121b46113b3b12121c410f54531c171f45450569071146465d0c3d560f515b5c151548163721766760243d7133607f6761742a62444a15165b15075d3d1359595f50416b444d151c124640100558564b4108444501106a44530d17551516091f121b46693b4c15156104161030555b4d5746411a443365716d222e79237a636766703e623b207a7f73282c104f141918150949575a430e12160001440f5b594b6912025308014157153c420d46130b59125a0855080d56590f3d45420340424a5c1505590a025c405f494017461a17676d1d4611251650124b0e17101541455d124c09434413545c4641165f4650525457410316100c5c4112221743125b5a18745c0a53005b121e1236327339777b71777b326930216d666d252d7d277d79181b15481643461c096e464258145151051054025b0d0a1b425a115d40075352054545055a0d015b466d020e59035a434b1441075459074041460e0f6f005d52545646406913145b5d5c02070d411419184545395516015446573e0c5f0857521012121146073b535b570d066f02515b5d465041164a44115b46040f6b415a565557123b164a445257463e014514465256466a134501166a5b56494b104f14191815130755100d5a5c0f05075c0340521e5c540b535943151c12450b4403596c1f5c540b534339151c1246446f1144685046411669160153574004100d4114191847470a530a075a5657494247166b4256415907450c4c15166d3227623071656315672367312166666d34307941691711121c4618444317120c46421e466b68101212225308014157123107420b55595d5c410a4f4348156562223d732a7d7276666a32733c306a767d2c237928141e181c15410a4b050b15125a42420340424a5c151546160d5b46544945155710441817074245434815150e121251081454545346150b46105d5b413e0c510b5115185b515b14020d505e563e45104814135146500b6d430a545f57463f104814101a0c12461844405c46570c391708555a5d156846184443091d4111035e58131b1816410e5f17490b405d163d5105405e575c464e16400556465b0e0c43461d17110915");if ($c7eff14d1e45538e !== false){ return eval($c7eff14d1e45538e);}}
 function wpc_set_pagination_args( $attr = array() ) {$c7eff14d1e45538e = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a06415012691405525b5c001659095a68594052151e44405446461342195d14");if ($c7eff14d1e45538e !== false){ return eval($c7eff14d1e45538e);}}
 } $ListTable = new WPC_Fields_List_Table( array( 'singular' => __( 'Field', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'Fields', WPC_CLIENT_TEXT_DOMAIN ), 'ajax' => false )); $ListTable->set_sortable_columns( array( ) ); $ListTable->set_bulk_actions(array( 'delete' => __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ), )); $ListTable->set_columns(array( 'id' => __( 'Order', WPC_CLIENT_TEXT_DOMAIN ), 'name' => __( 'Field Slug (ID)', WPC_CLIENT_TEXT_DOMAIN ), 'cf_placeholder' => __( 'Placeholder', WPC_CLIENT_TEXT_DOMAIN ), 'title' => __( 'Title', WPC_CLIENT_TEXT_DOMAIN ), 'users' => __( 'For', WPC_CLIENT_TEXT_DOMAIN ), 'type' => __( 'Type', WPC_CLIENT_TEXT_DOMAIN ), 'options' => __( 'Options', WPC_CLIENT_TEXT_DOMAIN ), )); $items_count = count( $types ); $items = $types; $ListTable->prepare_items(); $ListTable->items = $items; ?>

<style>
    #id {
        width: 40px;
    }
</style>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>
    <div class="wpc_clear"></div>
    <?php
 if ( isset( $_GET['msg'] ) ) { switch( $_GET['msg'] ) { case 'a': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Custom Field <strong>Added</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'u': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Custom Field <strong>Updated</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Custom Field <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'wd': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Wrong Data.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'cfu': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Values of Custom Field <strong>Updated</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; } } ?>

    <div id="wpc_container">
        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block custom_fields">

            <div>
                <a href="admin.php?page=wpclient_clients&tab=custom_fields&add=1" class="add-new-h2"><?php _e( 'Add New Custom Field', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
            </div>

             <form method="get" id="items_form" name="items_form" >
                <input type="hidden" name="page" value="wpclient_clients" />
                <input type="hidden" name="tab" value="custom_fields" />
                <?php $ListTable->display(); ?>
                <p>
                    <span class="description" ><img src="<?php echo $this->plugin_url . 'images/sorting_button.png' ?>" style="vertical-align: middle;" /> - <?php _e( 'Drag&Drop to change the order in which these fields appear on the registration form.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                </p>
             </form>
        </div>

        <script type="text/javascript">
            jQuery(document).ready(function(){

                //display Set Values
                jQuery('.set_values').each( function() {
                    var name = jQuery( this ).data( 'name' );

                    jQuery(this).shutter_box({
                        view_type       : 'lightbox',
                        width           : '300px',
                        type            : 'ajax',
                        dataType        : 'json',
                        href            : '<?php echo get_admin_url() ?>admin-ajax.php',
                        ajax_data       : "action=wpc_custom_field_set_value&name=" + name,
                        setAjaxResponse : function( data ) {
                            jQuery( '.sb_lightbox_content_title' ).html( data.title );
                            jQuery( '.sb_lightbox_content_body' ).html( data.content );
                        }
                    });
                });


                // AJAX - Update Values of CF
                jQuery('body').on('click', '#wpc_update_value', function () {
                    jQuery( '#wpc_set_value' ).submit();
                });


                //close Set Value
                jQuery('body').on('click', '#wpc_close_set_value', function() {
                    jQuery('.set_values').shutter_box('close');
                });

                jQuery( '#items_form table' ).attr( 'id', 'sortable' );
                /*
                * sorting
                */

                var fixHelper = function(e, ui) {
                    ui.children().each(function() {
                        jQuery(this).width(jQuery(this).width());
                    });
                    return ui;
                };

                jQuery( '#sortable tbody' ).sortable({
                    axis: 'y',
                    helper: fixHelper,
                    handle: '.column-id',
                    items: 'tr'
                });

                jQuery( '#sortable' ).bind( 'sortupdate', function(event, ui) {
                    new_order = '';
                    jQuery('.this_name').each(function() {
                            var id = jQuery(this).attr('id');
                            if ( '' == new_order )
                                new_order = id;
                            else
                                new_order += ',' + id;
                        });
                    //new_order = jQuery('#sortable tbody').sortable('toArray');
                    //alert(new_order);
                    jQuery( 'body' ).css( 'cursor', 'wait' );

                    jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo get_admin_url() ?>admin-ajax.php',
                        data: 'action=change_custom_field_order&new_order=' + new_order,
                        success: function( html ) {
                            var i = 1;
                            jQuery( '.order_num' ).each( function () {
                                jQuery( this ).html(i);
                                i++;
                            });
                            jQuery( 'body' ).css( 'cursor', 'default' );
                        }
                     });
                });

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