<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } if( $this->wpc_flags['easy_mode'] ) { do_action( 'wp_client_redirect', admin_url( 'admin.php?page=wpclient_clients' ) ); exit; } if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) ) { do_action( 'wp_client_redirect', get_admin_url() . 'admin.php?page=wpclient_clients' ); } global $wpdb, $wp_roles, $role; $wpc_roles = array( 'wpc_client' => $this->custom_titles['client']['s'] . ' (WPC Client)', 'wpc_client_staff' => $this->custom_titles['staff']['s'] . ' (WPC Client Staff)', 'wpc_manager' => $this->custom_titles['manager']['s'] . ' (WPC Manager)', 'wpc_admin' => $this->custom_titles['admin']['s'] . ' (WPC Admin)' ); $wpc_roles = apply_filters( 'wpc_client_convertible_user_roles', $wpc_roles ); $exclude_roles = array_keys( $wpc_roles ); array_push( $exclude_roles, 'administrator' ); if ( isset( $_REQUEST['_wpnonce2'] ) && wp_verify_nonce( $_REQUEST['_wpnonce2'], 'wpc_convert_form' ) ) { if ( isset( $_REQUEST['convert_to'] ) && in_array( $_REQUEST['convert_to'], $exclude_roles ) ) { if ( isset( $_REQUEST['ids'] ) && is_array( $_REQUEST['ids'] ) && 0 < count( $_REQUEST['ids'] ) ) { $convert_to = $_REQUEST['convert_to']; $ids = $_REQUEST['ids']; switch( $convert_to ) { case 'wpc_client': foreach( $ids as $user_id ) { $user_object = new WP_User( $user_id ); if ( isset( $_REQUEST['save_role'] ) && 1 == $_REQUEST['save_role'] ) { $user_object->add_role( 'wpc_client' ); } else { update_user_meta( $user_id, $wpdb->prefix . 'capabilities', array( 'wpc_client' => '1' ) ); } $all_metafields = get_user_meta( $user_id, '', true ); $business_name = ''; if ( isset($_REQUEST['business_name_field'] ) && '' != trim( $_REQUEST['business_name_field'] ) ) { $business_name = $_REQUEST['business_name_field']; foreach( $all_metafields as $meta_key=>$meta_value ) { if ( isset( $all_metafields[$meta_key] ) && strpos( $_REQUEST['business_name_field'], '{' . $meta_key . '}' ) !== false ) { $metavalue = maybe_unserialize( $all_metafields[$meta_key][0] ); $metavalue = ( isset( $metavalue ) && !empty( $metavalue ) ) ? $metavalue : ''; $business_name = str_replace( '{' . $meta_key . '}', $metavalue, $business_name ); } } if( $business_name == $_REQUEST['business_name_field'] ) { $business_name = ''; } } if ( '' == $business_name ) { $first_name = get_user_meta( $user_id, 'first_name', true ); if ( '' != $first_name ) { $business_name = $first_name; } } if ( '' == $business_name ) { $business_name = $user_object->get( 'user_login' ); } update_user_meta( $user_id, 'wpc_cl_business_name', $business_name ); if ( isset( $_REQUEST['wpc_circles'] ) && is_string( $_REQUEST['wpc_circles'] ) && !empty( $_REQUEST['wpc_circles'] ) ) { $groups = explode( ',', $_REQUEST['wpc_circles'] ); foreach ( $groups as $group_id ) { $wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->prefix}wpc_client_group_clients SET group_id = %d, client_id = '%d'", $group_id, $user_id ) ); } } update_user_option( $user_id, 'unqiue', md5( time() ) ); if ( isset( $_REQUEST['wpc_managers'] ) && '' != $_REQUEST['wpc_managers'] ) { $assign_data = array(); if( $_REQUEST['wpc_managers'] == 'all' ) { $args = array( 'role' => 'wpc_manager', 'orderby' => 'user_login', 'order' => 'ASC', 'fields' => array( 'ID' ), ); $_REQUEST['wpc_managers'] = get_users( $args ); foreach( $_REQUEST['wpc_managers'] as $key=>$value) { $assign_data[] = $value->ID; } } else { $assign_data = explode( ',', $_REQUEST['wpc_managers'] ); } $this->cc_set_reverse_assigned_data( 'manager', $assign_data, 'client', $user_id ); } $create_portal = false; if ( isset( $_REQUEST['create_client_page'] ) && 1 == $_REQUEST['create_client_page'] ) { $create_portal = true; } $args = array( 'client_id' => $user_id, 'business_name' => $business_name, ); $this->cc_create_hub_page( $args, $create_portal ); do_action( 'wpc_client_convert_to_client', $user_id ); $user = get_userdata( $user_id ); if( !empty( $user->user_email ) ) { $args = array( 'client_id' => $user_id ); $this->cc_mail( 'convert_to_client', $user->user_email, $args, 'convert_to_wp_user' ); } } $msg = 'ac'; break; case 'wpc_client_staff': foreach( $ids as $user_id ) { if ( isset( $_REQUEST['save_role'] ) && 1 == $_REQUEST['save_role'] ) { $user_object = new WP_User( $user_id ); $user_object->add_role( 'wpc_client_staff' ); } else { update_user_meta( $user_id, $wpdb->prefix . 'capabilities', array( 'wpc_client_staff' => '1' ) ); } if ( isset( $_REQUEST['wpc_clients'] ) && 0 < $_REQUEST['wpc_clients'] ) { update_user_meta( $user_id, 'parent_client_id', $_REQUEST['wpc_clients'] ); } $user = get_userdata( $user_id ); if( !empty( $user->user_email ) ) { $args = array( 'client_id' => $user_id ); $this->cc_mail( 'convert_to_staff', $user->user_email, $args, 'convert_to_wp_user' ); } } $msg = 'as'; break; case 'wpc_manager': foreach( $ids as $user_id ) { if ( isset( $_REQUEST['save_role'] ) && 1 == $_REQUEST['save_role'] ) { $user_object = new WP_User( $user_id ); $user_object->add_role( 'wpc_manager' ); update_user_meta( $user_id, 'wpc_auto_assigned_clients', '0' ); } else { update_user_meta( $user_id, $wpdb->prefix . 'capabilities', array( 'wpc_manager' => true ) ); update_user_meta( $user_id, 'wpc_auto_assigned_clients', '0' ); } if ( isset( $_REQUEST['wpc_clients'] ) && !empty( $_REQUEST['wpc_clients'] ) ) { $assign_data = array(); if( isset( $_POST['data'] ) && !empty( $_POST['data'] ) ) { if( $_POST['data'] == 'all' ) { $assign_data = $this->acc_get_client_ids(); } else { $assign_data = explode( ',', $_POST['data'] ); } $this->cc_set_assigned_data( 'manager', $user_id, 'client', $assign_data ); } } $user = get_userdata( $user_id ); if( !empty( $user->user_email ) ) { $args = array( 'client_id' => $user_id ); $this->cc_mail( 'convert_to_manager', $user->user_email, $args, 'convert_to_wp_user' ); } } $msg = 'am'; break; case 'wpc_admin': foreach( $ids as $user_id ) { if ( isset( $_REQUEST['save_role'] ) && 1 == $_REQUEST['save_role'] ) { $user_object = new WP_User( $user_id ); $user_object->add_role( 'wpc_admin' ); } else { update_user_meta( $user_id, $wpdb->prefix . 'capabilities', array( 'wpc_admin' => true ) ); } $user = get_userdata( $user_id ); if( !empty( $user->user_email ) ) { $args = array( 'client_id' => $user_id ); $this->cc_mail( 'convert_to_admin', $user->user_email, $args, 'convert_to_wp_user' ); } } $msg = 'aa'; break; default: do_action( 'wpc_client_convert_user', $convert_to, $ids ); $msg = $convert_to; break; } do_action( 'wp_client_redirect', get_admin_url(). 'admin.php?page=wpclient_clients&tab=convert&msg=' . $msg ); exit; } } } if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), stripslashes_deep( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=convert'; } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), stripslashes_deep( $_SERVER['REQUEST_URI'] ) ) ); exit; } $role = isset( $_REQUEST['role'] ) ? $_REQUEST['role'] : ''; $exclude_users = array(); foreach( $exclude_roles as $val ) { $exclude_users = array_merge( $exclude_users, get_users( array( 'role' => $val, 'fields' => 'ID' ) ) ); } $exclude_users = array_unique($exclude_users); $order_by = 'user_registered'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'user_login' : $order_by = 'user_login'; break; case 'nickname' : $order_by = 'user_nicename'; break; case 'user_email' : $order_by = 'user_email'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Convert_Users_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$c28fd706b2aec696 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450342014717051242166914054741573e034201471f181654145117481553401303494e14104b5b5b014308054715125c5c10396b1f18155c1253094319126531216f25787e7d7c613962213c616d762e2f712f7a17111e154146081147535e46420d581468671a15415f10015841154d42673677687b7e7c2378303b61776a353d74297976717c154f1a44435458531945105b0a175e53591553444d151b094146440e5d44150c5b09690d10505f413e0f551547565f57155b1640054755413a45400a4145595e123b164a44121215414c10396b1f18155b094244025a475c054c174a146068716a257a2d217b666d352768326b73777f742f78444d0e124200105508400d026d6a05590a174140470216184610564a5546461f5f44");if ($c28fd706b2aec696 !== false){ eval($c28fd706b2aec696);}}
 function __call( $name, $arguments ) {$c28fd706b2aec696 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591851540a5a3b114657403e0445085768594047074f4c44544040001b18461043505b464a16400a545f57414b1c4610564a55400b530a1046121b5a42");if ($c28fd706b2aec696 !== false){ return eval($c28fd706b2aec696);}}
 function prepare_items() {$c28fd706b2aec696 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1245015f0a415a5641155b1640105d5b414c5c570340685b5d59135b0a171d1b094146580f50535d5c155b16051647534b494b0b46104457404107540801150f124516580f471a0655501269170b474653030e5539575854475808454c4d0e1216150a5915190967515a0a43090a6a5a570006551447170512541444051d1d1216020d5c1359594b1e15425e0d0051575c4d4214155b454c53570a53444d0e12");if ($c28fd706b2aec696 !== false){ return eval($c28fd706b2aec696);}}
 function column_default( $item, $column_name ) {$c28fd706b2aec696 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12080418465d444b57414e16400d41575f3a4214055b5b4d5f5b3958050950126f414b104f144c1840501243160a15165b15075d3d14135b5d59135b0a3b5b535f04426d5d144a1857591553441f1540571517420814101f09151b16");if ($c28fd706b2aec696 !== false){ return eval($c28fd706b2aec696);}}
 function no_items() {$c28fd706b2aec696 = p45f99bb432b194dff04b7d12425d3f8d_get_code("120401580914134c5a5c151b5a0a5a6d5b15075d156b5a5d41460751015f15");if ($c28fd706b2aec696 !== false){ return eval($c28fd706b2aec696);}}
 function set_sortable_columns( $args = array() ) {$c28fd706b2aec696 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12451055124145566d54145117440812531310511f1c1e03125309440105565a1a41465114534418534646120f590b1644000e104f144c185b534e160d176a5c470c07420f571f18165e461f444d154912451055124145566d541451173f151644000e103b140a18534714571d4c151644000e1c461041595e155b0b4440415a5b124f0e0251515947591269170b47465b0f056f005d525456154f0d441915575e1207100f521f185b46394510165c5c554942140d141e181b151d164016504647130c6f0746504b6915425d4439150f12001042074d1f181643075a48441159125c5f1042405f5141185852010254475e153d43094643515c5239500d015956124859101b1452544150464d44075a5c46080c45030f174512484612100c5c411f5f115f1440565a5e5039550b08405f5c12420d4610455d464014583b054755415a42420340424a5c1542420c0d460912");if ($c28fd706b2aec696 !== false){ return eval($c28fd706b2aec696);}}
 function get_sortable_columns() {$c28fd706b2aec696 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b415d13165104585267515a0a43090a460912");if ($c28fd706b2aec696 !== false){ return eval($c28fd706b2aec696);}}
 function set_columns( $args = array() ) {$c28fd706b2aec696 = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804184657584d5c414e1640105d5b414c5c5213585c675356125f0b0a46121b414b101d141359405215165944544040001b6f0b51455f571d46571616544b1a414553041317050c15410a0d0a45474641164916510a1a515d03550f065a4a10414d0e41141e14121107440317151b09411f1042405f51411858550b08405f5c12420d4610564a55465d1616014147400f4214125c5e4b0915");if ($c28fd706b2aec696 !== false){ return eval($c28fd706b2aec696);}}
 function get_columns() {$c28fd706b2aec696 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b515d0d175d08470c18");if ($c28fd706b2aec696 !== false){ return eval($c28fd706b2aec696);}}
 function set_actions( $args = array() ) {$c28fd706b2aec696 = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a065356125f0b0a46120f414651145344031247034211165b1216150a59150f17");if ($c28fd706b2aec696 !== false){ return eval($c28fd706b2aec696);}}
 function get_actions() {$c28fd706b2aec696 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b5351150b5f08470c18");if ($c28fd706b2aec696 !== false){ return eval($c28fd706b2aec696);}}
 function set_bulk_actions( $args = array() ) {$c28fd706b2aec696 = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a0650400a5d3b0556465b0e0c434609171c534701455f4447574614105e461043505b465d16");if ($c28fd706b2aec696 !== false){ return eval($c28fd706b2aec696);}}
 function get_bulk_actions() {$c28fd706b2aec696 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b50470d096f075743515d5b150d44");if ($c28fd706b2aec696 !== false){ return eval($c28fd706b2aec696);}}
 function column_username ( $item ) {$c28fd706b2aec696 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591815091546050a155b565c405115475e5f5c6a085709016a505e0e015b3913171612110f4201096e157b25456d461a171f100b41164a44115b46040f6b4141445d406a0a59030d5b156f414c104108184b42540808435f15");if ($c28fd706b2aec696 !== false){ return eval($c28fd706b2aec696);}}
 function column_role( $item ) {$c28fd706b2aec696 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12060e5f04555b1816421669160b5957415a4214145b5b5d416a074416440812160816550b6f104a5d590311395f1516400e0e55156b444c40155b1643430e125b074218465d4467534714571d4c1516400e0e55156b564a40154f164d44535d400403530e141f181647095a01176a534013425115141353574c460b5a441144530d1755461d1743121114590801466d4115101048091751414603424c441145423e105f0a5144150c47095a013b5b535f04116b461041595e40031639441c120d411642075a445453410369111750406d130d5c031c171c454539440b0850411f5f105f0a516856535803453f441144530d175546691711120f461212055947575a4214145b5b5d416a154216441b0f12464e1041140c184f150f50444c15151541430d461045575e501569171047121b4146420958524b6d4612444459154147031144141c171c405a0a53173b4646404d42004a141a0a121c5d1616014147400f4214145b5b5d416a1542165f15");if ($c28fd706b2aec696 !== false){ return eval($c28fd706b2aec696);}}
 function column_cb( $item ) {$c28fd706b2aec696 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12080418465d444b57414e16403b657d6135391715515b5d514103523b0b5758153c4219461211185b46394510165c5c554942143964786b666e4145010850514604066f09565d1f6f154f164d444e12160e005a3955454a534c460b44014d425e0e06554e131b1f1e154269342b6666694611550a51544c57513959060e126f1b5a424d46515b4b57151d16400b57586d001042074d170512541444051d1d1b09411f10425c43555e155b161714475b5c15041846130b4b4254081607085441415c404515514567515d03550f065a4a105f5e590844424c12411f46015917515a04015b045b4f1a125b075b0159175b5612396d441441595e40030b4641461012464e10425d435d5f6e417f204368121b5a4259001c17515c6a074416054c1a12450b4403596c1f7b71416b4844115d500b3d5114465641121c461f44405d465f0d421e5b14105b5a50055d01000810510907530d51531a150e46120c10585e124f5f10411b09041d4616570a430e1240041645145a171c5a410b5a5f44");if ($c28fd706b2aec696 !== false){ return eval($c28fd706b2aec696);}}
 function wpc_set_pagination_args( $attr = array() ) {$c28fd706b2aec696 = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a06415012691405525b5c001659095a68594052151e44405446461342195d14");if ($c28fd706b2aec696 !== false){ return eval($c28fd706b2aec696);}}
 function extra_tablenav( $which ){$c28fd706b2aec696 = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804104e14104c5d4541165959151645090b530e141e18491542420c0d461f0c12075114575f67505a1e1e443b6a1a124631550746545012601553161712121e413560256b74747b7028623b30706a663e267f2b757e76121c4a164317505340020a1d154155555b4141164d5f154f12");if ($c28fd706b2aec696 !== false){ return eval($c28fd706b2aec696);}}
 } $ListTable = new WPC_Convert_Users_List_Table( array( 'singular' => __( 'User', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'Users', WPC_CLIENT_TEXT_DOMAIN ), 'ajax' => false )); $per_page = $this->get_list_table_per_page( 'wpc_convert_users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'username' => 'user_login', 'user_nicename' => 'nickname', 'user_email' => 'user_email', ) ); $ListTable->set_bulk_actions(array( )); $ListTable->set_columns(array( 'cb' => '<input type="checkbox" />', 'username' => __( 'Username', WPC_CLIENT_TEXT_DOMAIN ), 'user_nicename' => __( 'Name', WPC_CLIENT_TEXT_DOMAIN ), 'user_email' => __( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ), 'role' => __( 'Role', WPC_CLIENT_TEXT_DOMAIN ), )); $args_count = array( 'blog_id' => get_current_blog_id(), 'exclude' => $exclude_users, 'orderby' => $order_by, 'order' => $order, ); $args = array( 'blog_id' => get_current_blog_id(), 'exclude' => $exclude_users, 'orderby' => $order_by, 'order' => $order, 'offset' => ( $per_page * ( $paged - 1 ) ), 'number' => $per_page ); if( isset( $_GET['s'] ) && !empty( $_GET['s'] ) ) { $search_text = strtolower( trim( esc_sql( $_GET['s'] ) ) ); $args_count['search'] = $args['search'] = '*' . $search_text . '*'; } if( isset( $_REQUEST['role'] ) && !empty( $_REQUEST['role'] ) ) { $args_count['role'] = $_REQUEST['role']; $args['role'] = $_REQUEST['role']; } $items_count = get_users( $args_count ); $items_count = count( $items_count ); $convert_clients = get_users( $args ); foreach( $convert_clients as $key=>$convert_client ) { $convert_clients[$key] = (array)$convert_client->data; $convert_clients[$key]['role'] = $convert_client->roles; } $groups = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wpc_client_groups ORDER BY group_name ASC", ARRAY_A ); $args = array( 'role' => 'wpc_manager', 'orderby' => 'user_login', 'order' => 'ASC', ); $managers = get_users( $args ); $excluded_clients = $this->cc_get_excluded_clients(); $args = array( 'role' => 'wpc_client', 'exclude' => $excluded_clients, 'fields' => array( 'ID', 'display_name' ), 'orderby' => 'user_login', 'order' => 'ASC', ); $clients = get_users( $args ); $ListTable->prepare_items(); $ListTable->items = $convert_clients; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); $wpnonce = wp_create_nonce( 'wpc_convert_form' ); $wpc_convert_users = $this->cc_get_settings( 'convert_users' ); $business_name_field = ( isset( $wpc_convert_users['client_business_name_field'] ) ) ? $wpc_convert_users['client_business_name_field'] : '{first_name}' ; $client_wpc_circles = ( isset( $wpc_convert_users['client_wpc_circles'] ) && '' != $wpc_convert_users['client_wpc_circles'] ) ? explode( ',', $wpc_convert_users['client_wpc_circles'] ) : array(); $client_wpc_managers = ( isset( $wpc_convert_users['client_wpc_managers'] ) && '' != $wpc_convert_users['client_wpc_managers'] ) ? explode( ',', $wpc_convert_users['client_wpc_managers'] ) : array(); $staff_wpc_clients = ( isset( $wpc_convert_users['staff_wpc_clients'] ) && '' != $wpc_convert_users['staff_wpc_clients'] ) ? $wpc_convert_users['staff_wpc_clients'] : ''; $manager_wpc_clients = ( isset( $wpc_convert_users['manager_wpc_clients'] ) && '' != $wpc_convert_users['manager_wpc_clients'] ) ? explode( ',', $wpc_convert_users['manager_wpc_clients'] ) : array(); $manager_wpc_circles = ( isset( $wpc_convert_users['manager_wpc_circles'] ) && '' != $wpc_convert_users['manager_wpc_circles'] ) ? explode( ',', $wpc_convert_users['manager_wpc_circles'] ) : array(); $client_checked_create_pp = ( isset( $wpc_convert_users['client_create_page'] ) && 'yes' == $wpc_convert_users['client_create_page'] ) ? 'checked' : ''; $client_checked_save_role = ( isset( $wpc_convert_users['client_save_role'] ) && 'yes' == $wpc_convert_users['client_save_role'] ) ? 'checked' : ''; $staff_checked_save_role = ( isset( $wpc_convert_users['staff_save_role'] ) && 'yes' == $wpc_convert_users['staff_save_role'] ) ? 'checked' : ''; $manager_checked_save_role = ( isset( $wpc_convert_users['manager_save_role'] ) && 'yes' == $wpc_convert_users['manager_save_role'] ) ? 'checked' : ''; $admin_checked_save_role = ( isset( $wpc_convert_users['admin_save_role'] ) && 'yes' == $wpc_convert_users['admin_save_role'] ) ? 'checked' : ''; ?>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <?php
 if ( isset( $_GET['msg'] ) ) { $msg = $_GET['msg']; switch( $msg ) { case 'ac': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'User(s) <strong>Converted</strong> to Client(s) Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'as': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'User(s) <strong>Converted</strong> to Staff(s) Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'am': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'User(s) <strong>Converted</strong> to Manager(s) Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'aa': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'User(s) <strong>Converted</strong> to Admin(s) Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; default: if( in_array( $msg, $exclude_roles ) && isset( $wpc_roles[ $msg ] ) ) { echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'User(s) <strong>Converted</strong> to %s(s) Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $wpc_roles[ $msg ] ) . '</p></div>'; } break; } } ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <div class="wpc_clear"></div>

        <div class="wpc_tab_container_block convert_users">
            <div class="wpc_clear"></div>

                <span class="description"><?php _e( "Note: Please test this first before converting a large number of users to be sure your intended result is achieved", WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                <div class="wpc_clear"></div>

            <?php if( $items_count > 0 ) { ?>
                <ul class="subsubsub">
                    <li class="all"><a href="admin.php?page=wpclient_clients&tab=convert" <?php echo ( '' == $role ) ? 'class="current"' : '' ?>><?php _e( 'All', WPC_CLIENT_TEXT_DOMAIN ) ?><span class="count"> (<?php echo $items_count ?>)</span></a></li>
                    <?php $users_of_blog = count_users(); $args = array( 'exclude' => $exclude_users, 'orderby' => 'user_login', 'order' => 'ASC', 'fields' => 'ID', 'blog_id' => get_current_blog_id() ); $user_ids_of_blog = get_users( $args ); $role_counter = array(); if( isset( $user_ids_of_blog ) && !empty( $user_ids_of_blog ) && isset( $users_of_blog['avail_roles'] ) && is_array( $users_of_blog['avail_roles'] ) ) { foreach( $user_ids_of_blog as $user_id ) { foreach( $users_of_blog['avail_roles'] as $convert_role => $num ) { if ( !in_array( $convert_role, $exclude_roles ) ) { if( user_can( $user_id, $convert_role ) ) { if( !isset( $role_counter[$convert_role] ) ) { $role_counter[$convert_role] = 0; } $role_counter[$convert_role]++; } } } } } if ( isset( $users_of_blog['avail_roles'] ) && is_array( $users_of_blog['avail_roles'] ) ) { $role_names = $wp_roles->get_names(); foreach( $users_of_blog['avail_roles'] as $convert_role => $num ) { if ( !in_array( $convert_role, $exclude_roles ) ) { $class = ( $role == $convert_role ) ? 'class="current"' : ''; if( isset( $role_counter[$convert_role] ) ) { echo ' | <li class="' . $role . '"><a href="admin.php?page=wpclient_clients&tab=convert&role=' . $convert_role . '" ' . $class . '>' . $role_names[$convert_role] . ' (' . $role_counter[$convert_role] . ')</a></li>'; } } } } ?>
                </ul>
            <?php } ?>



            <form id="selected_form" method="post">
                <input type="hidden" name="selected_obj" value="" />
                <input type="hidden" name="selected_role" value="" />
            </form>


           <form action="" method="get" name="wpc_clients_convert_form" id="wpc_clients_convert_form" style="width: 100%;">

                <input type="hidden" value="<?php echo $wpnonce ?>" name="_wpnonce2" id="_wpnonce2" />
                <input type="hidden" name="page" value="wpclient_clients" />
                <input type="hidden" name="tab" value="convert" />
                <?php $ListTable->display(); ?>

                <div class="alignleft actions">
                    <span><?php _e( 'Convert to:', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    <select name="convert_to" id="convert_to">
                        <option value="-1"><?php _e( 'Select Role', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        <?php foreach( $wpc_roles as $role_key=>$val ) { ?>
                            <option value="<?php echo $role_key; ?>" <?php selected( isset( $_POST['selected_role'] ) ? $_POST['selected_role'] : '', $role_key ); ?>><?php echo $val; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <?php if( !empty( $_POST['selected_role'] ) ) { switch( $_POST['selected_role'] ) { case 'wpc_client': { ?>
                            <div id="for_wpc_client" style="display: block;">
                                <table>
                                    <tr>
                                        <td colspan="2">
                                            <strong> <?php printf( __( '>>Select Options for %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) ?>:</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="40"></td>
                                        <td>
                                            <table cellspacing="6">
                                                <tr>
                                                    <td>
                                                        <label for="business_name_field"><?php _e( 'Which User Meta Field Use For Business Name', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                                                        <br>
                                                        <input type="text" name="business_name_field" id="business_name_field" value="<?php echo $business_name_field ?>" />
                                                        <span class="description"><?php _e( 'by default "first_name", or "user_login" if meta values and "first_name" is empty.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                                                    </td>
                                                </tr>

                                                <?php if ( is_array( $groups ) && 0 < count( $groups ) ) { ?>
                                                    <tr>
                                                        <td>
                                                            <?php $selected_groups = array(); if( isset( $_REQUEST['wpc_circles'] ) && count( $_REQUEST['wpc_circles'] ) ) { $selected_groups = is_array( $_REQUEST['wpc_circles'] ) ? $_REQUEST['wpc_circles'] : array(); } else { if( isset( $client_wpc_circles ) && 0 < count( $client_wpc_circles ) ) { $selected_groups = $client_wpc_circles; } else { foreach ( $groups as $group ) { if( '1' == $group['auto_select'] ) { $selected_groups[] = $group['group_id']; } } } } $link_array = array( 'title' => sprintf( __( 'Select %s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['circle']['p'] ), 'text' => sprintf( __( 'Select %s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['circle']['p'] ) ); $input_array = array( 'name' => 'wpc_circles', 'id' => 'wpc_circles', 'value' => implode( ',', $selected_groups ) ); $additional_array = array( 'counter_value' => count( $selected_groups ) ); $this->acc_assign_popup( 'circle', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array ); ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if ( is_array( $managers ) && 0 < count( $managers ) ) { ?>
                                                    <tr>
                                                        <td>
                                                            <?php $selected_managers = array(); if( isset( $_REQUEST['wpc_managers'] ) && count( $_REQUEST['wpc_managers'] ) ) { $selected_managers = is_array( $_REQUEST['wpc_managers'] ) ? $_REQUEST['wpc_managers'] : array(); } else { if( isset( $client_wpc_managers ) && 0 < count( $client_wpc_managers ) ) { $selected_managers = $client_wpc_managers; } } $link_array = array( 'title' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['p'] ), 'text' => __( 'Select', WPC_CLIENT_TEXT_DOMAIN ) . ' ' . $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['manager']['p'] ); $input_array = array( 'name' => 'wpc_managers', 'id' => 'wpc_managers', 'value' => implode( ',', $selected_managers ) ); $additional_array = array( 'counter_value' => count( $selected_managers ) ); $this->acc_assign_popup( 'manager', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array ); ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td>
                                                        <label for="create_client_page"><input type="checkbox" name="create_client_page" id="create_client_page" value="1" <?php echo $client_checked_create_pp ?> /> <?php printf( __( 'Create %s', WPC_CLIENT_TEXT_DOMAIN ) , $this->custom_titles['portal_page']['s'] ) ?></label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="save_role"><input type="checkbox" name="save_role" id="save_role" value="1" <?php echo $client_checked_save_role ?> /> <?php _e( 'Save Current User Role', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                                                        <br>
                                                        <span class="description"><?php printf( __( "If checked, the user's current role will be saved, but user will also take on characteristics of the %s role.", WPC_CLIENT_TEXT_DOMAIN ), $this->plugin['title'] ) ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="button" value="<?php printf( __( 'Convert to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) ?>" class="button-secondary action" name="convert" />
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php break; } case 'wpc_client_staff': { ?>
                            <div id="for_wpc_client_staff" style="display: block;" >
                                <table>
                                    <tr>
                                        <td colspan="2">
                                            <strong> <?php printf( __( '>> Select Options for %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) ?></strong>
                                        </td>
                                        </tr>
                                    <tr>
                                        <td width="40"></td>
                                        <td>
                                            <table cellspacing="6">
                                                <tr>
                                                    <td>
                                                        <?php $selected_client = ''; if( isset( $_REQUEST['wpc_clients'] ) && !empty( $_REQUEST['wpc_clients'] ) ) { $selected_client = $_REQUEST['wpc_clients']; } else { $selected_client = $staff_wpc_clients; } $link_array = array( 'title' => sprintf( __( 'Select %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'text' => sprintf( __( 'Select %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'data-marks' => 'radio' ); $input_array = array( 'name' => 'wpc_clients', 'id' => 'wpc_clients', 'value' => $selected_client ); $additional_array = array( 'counter_value' => ( $selected_client ) ? get_userdata( $selected_client )->user_login : '' ); $this->acc_assign_popup( 'client', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array ); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="save_role"><input type="checkbox" name="save_role" id="save_role" value="1" <?php echo $staff_checked_save_role ?> /> <?php _e( 'Save Current User Role', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                                                        <br>
                                                        <span class="description"><?php printf( __( "If checked, the user's current role will be saved, but user will also take on characteristics of the %s role.", WPC_CLIENT_TEXT_DOMAIN ), $this->plugin['title'] ) ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="button" value="<?php printf( __( 'Convert to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) ?>" class="button-secondary action" name="convert" />
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php break; } case 'wpc_manager': { ?>
                            <div id="for_wpc_manager" style="display: block;">
                                <table>
                                    <tr>
                                        <td colspan="2">
                                            <strong> <?php printf( __( '>> Select Options for %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ) ?></strong>
                                        </td>
                                        </tr>
                                    <tr>
                                        <td width="40"></td>
                                        <td>
                                            <table cellspacing="6">
                                                <tr>
                                                    <td>
                                                        <?php $selected_clients = array(); if( isset( $_REQUEST['wpc_clients'] ) && count( $_REQUEST['wpc_clients'] ) ) { $selected_clients = is_array( $_REQUEST['wpc_clients'] ) ? $_REQUEST['wpc_clients'] : array(); } else { if( isset( $manager_wpc_clients ) && 0 < count( $manager_wpc_clients ) ) { $selected_clients = $manager_wpc_clients; } } $link_array = array( 'title' => sprintf( __( 'Select %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ), 'text' => sprintf( __( 'Select %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) ); $input_array = array( 'name' => 'wpc_clients', 'id' => 'wpc_clients', 'value' => implode( ',', $selected_clients ) ); $additional_array = array( 'counter_value' => count( $selected_clients ) ); $this->acc_assign_popup( 'client', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array ); ?>
                                                    </td>
                                                </tr>

                                                <?php if ( is_array( $groups ) && 0 < count( $groups ) ) { ?>
                                                    <tr>
                                                        <td>
                                                            <?php $selected_groups = array(); if( isset( $_REQUEST['wpc_circles'] ) && count( $_REQUEST['wpc_circles'] ) ) { $selected_groups = is_array( $_REQUEST['wpc_circles'] ) ? $_REQUEST['wpc_circles'] : array(); } else { if( isset( $manager_wpc_circles ) && 0 < count( $manager_wpc_circles ) ) { $selected_groups = $manager_wpc_circles; } else { foreach ( $groups as $group ) { if( '1' == $group['auto_select'] ) { $selected_groups[] = $group['group_id']; } } } } $link_array = array( 'title' => sprintf( __( 'Select %s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'], $this->custom_titles['circle']['p'] ), 'text' => sprintf( __( 'Select %s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'], $this->custom_titles['circle']['p'] ) ); $input_array = array( 'name' => 'wpc_circles', 'id' => 'wpc_circles', 'value' => implode( ',', $selected_groups ) ); $additional_array = array( 'counter_value' => count( $selected_groups ) ); $this->acc_assign_popup( 'circle', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array ); ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>

                                                <tr>
                                                    <td>
                                                        <label for="save_role"><input type="checkbox" name="save_role" id="save_role" value="1" <?php echo $manager_checked_save_role ?> /> <?php _e( 'Save Current User Role', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                                                        <br>
                                                        <span class="description"><?php printf( __( "If checked, the user's current role will be saved, but user will also take on characteristics of the %s role.", WPC_CLIENT_TEXT_DOMAIN ), $this->plugin['title'] ) ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="button" value="<?php printf( __( 'Convert to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ) ?>" class="button-secondary action" name="convert" />
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php break; } case 'wpc_admin': { ?>
                            <div id="for_wpc_admin" style="display: block;">
                                <table>
                                    <tr>
                                        <td colspan="2">
                                            <strong> <?php printf( __( '>> Select Options for %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ) ?></strong>
                                        </td>
                                        </tr>
                                    <tr>
                                        <td width="40"></td>
                                        <td>
                                            <table cellspacing="6">
                                                <tr>
                                                    <td>
                                                        <label for="save_role"><input type="checkbox" name="save_role" id="save_role" value="1" <?php echo $admin_checked_save_role ?> /> <?php _e( 'Save Current User Role', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                                                        <br>
                                                        <span class="description"><?php printf( __( "If checked, the user's current role will be saved, but user will also take on characteristics of the %s role.", WPC_CLIENT_TEXT_DOMAIN ), $this->plugin['title'] ) ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="button" value="<?php printf( __( 'Convert to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ) ?>" class="button-secondary action" name="convert" />
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php break; } default: { if( in_array( $_POST['selected_role'], $exclude_roles ) ) { echo apply_filters( 'wpc_client_convert_user_settings', '', $_POST['selected_role'] ); } } } } ?>
            </form>


            <script type="text/javascript">
                jQuery(document).ready(function(){

                    jQuery(".over").hover(function(){
                        jQuery(this).css("background-color","#bcbcbc");
                        },function(){
                        jQuery(this).css("background-color","transparent");
                    });



                    //show reassign cats
                    jQuery( '#convert_to' ).change( function() {
                        /*jQuery( '#for_wpc_client' ).hide();
                        jQuery( '#for_wpc_client_staff' ).hide();
                        jQuery( '#for_wpc_manager' ).hide();

                        if ( '-1' != jQuery( this ).val() ) {
                            jQuery( '#for_' + jQuery( this ).val() ).slideToggle( 'slow' );
//                            jQuery( '#for_' + jQuery( this ).val() ).show();
                        }*/

                        var selected_obj = '';
                        jQuery('span.user_checkbox input[name="ids[]"]:checked').each(function() {
                            if ('undefined' != typeof(jQuery( this ).val()))
                                selected_obj += ',' + jQuery( this ).val();
                        });

                        jQuery("#selected_form input[name=selected_role]").val( jQuery( this ).val() );
                        jQuery("#selected_form input[name=selected_obj]").val( selected_obj.substr(1) );
                        jQuery("#selected_form").submit();

                        return false;
                    });

                    //Send convert data
                    jQuery( 'input[name="convert"]' ).click( function() {
                        jQuery( '#for_wpc_client:hidden' ).remove();
                        jQuery( '#for_wpc_client_staff:hidden' ).remove();
                        jQuery( '#for_wpc_manager:hidden' ).remove();

                        jQuery( '#wpc_clients_convert_form' ).submit();
                        return false;
                    });

                });

            </script>


        </div>

    </div>

</div>