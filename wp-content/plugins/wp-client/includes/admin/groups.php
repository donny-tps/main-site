<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } if ( !( current_user_can( 'wpc_show_circles' ) || current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) ) { do_action( 'wp_client_redirect', get_admin_url( 'index.php' ) ); exit; } if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclients_content&tab=circles'; } global $wpdb; if ( isset( $_REQUEST['action'] ) ) { switch ( $_REQUEST['action'] ) { case 'delete': $groups_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_group_delete' . $_REQUEST['id'] . get_current_user_id() ); $groups_id = (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['circle']['p'] ) ); $groups_id = $_REQUEST['item']; } if ( count( $groups_id ) ) { if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $manager_groups = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'circle' ); } foreach ( $groups_id as $group_id ) { if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { if( !in_array( $group_id, $manager_groups ) ) { continue; } } $this->delete_group( $group_id ); } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; break; case 'create_group': if ( !empty( $_REQUEST['group_name'] ) && isset( $_REQUEST['_wpnonce'] ) && wp_verify_nonce( $_REQUEST['_wpnonce'], 'wpc_create_circle' . get_current_user_id() ) ) { $args = array( 'group_name' => ( isset( $_REQUEST['group_name'] ) ) ? $_REQUEST['group_name'] : '', 'auto_select' => ( isset( $_REQUEST['auto_select'] ) ) ? '1' : '0', 'auto_add_files' => ( isset( $_REQUEST['auto_add_files'] ) ) ? '1' : '0', 'auto_add_pps' => ( isset( $_REQUEST['auto_add_pps'] ) ) ? '1' : '0', 'auto_add_manual' => ( isset( $_REQUEST['auto_add_manual'] ) ) ? '1' : '0', 'auto_add_self' => ( isset( $_REQUEST['auto_add_self'] ) ) ? '1' : '0', 'assign' => ( isset( $_REQUEST['wpc_clients'] ) ) ? $_REQUEST['wpc_clients'] : '' ); $result = $this->create_circle( $args ); if( is_numeric( $result ) && current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->prefix}wpc_client_objects_assigns SET" . " `object_type` = 'manager'" . ", `object_id` = %d" . ", `assign_type` = 'circle'" . ", `assign_id` = %d" , get_current_user_id(), $result ) ); } if ( $result ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'c', get_admin_url(). 'admin.php?page=wpclients_content&tab=circles' ) ); exit; } else { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'ae', get_admin_url(). 'admin.php?page=wpclients_content&tab=circles' ) ); exit; } } break; case 'edit_group': if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $manager_groups = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'circle' ); if( !empty( $_REQUEST['id'] ) && !in_array( $_REQUEST['id'], $manager_groups ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'ae', get_admin_url(). 'admin.php?page=wpclients_groups' ) ); exit; } } if ( !empty( $_REQUEST['group_name'] ) && !empty( $_REQUEST['id'] ) && !empty( $_REQUEST['_wpnonce'] ) && wp_verify_nonce( $_REQUEST['_wpnonce'], 'wpc_update_circle' . get_current_user_id() . $_REQUEST['id'] ) ) { $args = array( 'id' => ( $id = filter_input( INPUT_POST, 'id' ) ) ? $id : '0', 'group_name' => $_REQUEST['group_name'], 'auto_select' => ( isset( $_REQUEST['auto_select'] ) ) ? '1' : '0', 'auto_add_files' => ( isset( $_REQUEST['auto_add_files'] ) ) ? '1' : '0', 'auto_add_pps' => ( isset( $_REQUEST['auto_add_pps'] ) ) ? '1' : '0', 'auto_add_manual' => ( isset( $_REQUEST['auto_add_manual'] ) ) ? '1' : '0', 'auto_add_self' => ( isset( $_REQUEST['auto_add_self'] ) ) ? '1' : '0', 'assign' => ( isset( $_REQUEST['wpc_clients'] ) ) ? $_REQUEST['wpc_clients'] : '', ); $result = $this->update_circle( $args ); if ( $result ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 's', get_admin_url(). 'admin.php?page=wpclients_content&tab=circles' ) ); exit; } else { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'ae', get_admin_url(). 'admin.php?page=wpclients_content&tab=circles' ) ); exit; } } break; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } $order_by = 'id'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'group_name' : $order_by = 'group_name'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Group_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450342014717051242166914054741573e034201471f181654145117481553401303494e14104b5b5b014308054715125c5c10396b1f18155c1253094319126531216f25787e7d7c613962213c616d762e2f712f7a17111e154146081147535e46420d581468671a15415f10015841154d42673677687b7e7c2378303b61776a353d74297976717c154f1a44435458531945105b0a175e53591553444d151b094146440e5d44150c5b09690d10505f413e0f551547565f57155b1640054755413a45400a4145595e123b164a44121215414c10396b1f18155b094244025a475c054c174a146068716a257a2d217b666d352768326b73777f742f78444d0e124200105508400d026d6a05590a174140470216184610564a5546461f5f44");if ($c552c4b957f3e66d !== false){ eval($c552c4b957f3e66d);}}
 function __call( $name, $arguments ) {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591851540a5a3b114657403e0445085768594047074f4c44544040001b18461043505b464a16400a545f57414b1c4610564a55400b530a1046121b5a42");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 function prepare_items() {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("1245015f0a415a5641155b1640105d5b414c5c570340685b5d59135b0a171d1b094146580f50535d5c155b16051647534b494b0b46104457404107540801150f124516580f471a0655501269170b474653030e5539575854475808454c4d0e1216150a5915190967515a0a43090a6a5a570006551447170512541444051d1d1216020d5c1359594b1e15425e0d0051575c4d4214155b454c53570a53444d0e12");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 function column_default( $item, $column_name ) {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("12080418465d444b57414e16400d41575f3a4214055b5b4d5f5b3958050950126f414b104f144c1840501243160a15165b15075d3d14135b5d59135b0a3b5b535f04426d5d144a1857591553441f1540571517420814101f09151b16");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 function no_items() {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("120401580914134c5a5c151b5a0a5a6d5b15075d156b5a5d41460751015f15");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 function set_sortable_columns( $args = array() ) {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("12451055124145566d54145117440812531310511f1c1e03125309440105565a1a41465114534418534646120f590b1644000e104f144c185b534e160d176a5c470c07420f571f18165e461f444d154912451055124145566d541451173f151644000e103b140a18534714571d4c151644000e1c461041595e155b0b4440415a5b124f0e0251515947591269170b47465b0f056f005d525456154f0d441915575e12075900141f185b46394510165c5c554942140d141e181b151d164016504647130c6f0746504b6915425d4439150f12001042074d1f181643075a48441159125c5f1042405f5141185852010254475e153d43094643515c5239500d015956124859101b1452544150464d44075a5c46080c45030f174512484612100c5c411f5f115f1440565a5e5039550b08405f5c12420d4610455d464014583b054755415a42420340424a5c1542420c0d460912");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 function get_sortable_columns() {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b415d13165104585267515a0a43090a460912");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 function set_columns( $args = array() ) {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804184657584d5c414e1640105d5b414c5c5213585c675356125f0b0a46121b414b101d141359405215165944544040001b6f0b51455f571d46571616544b1a414553041317050c15410a0d0a45474641164916510a1a515d03550f065a4a10414d0e41141e14121107440317151b09411f1042405f51411858550b08405f5c12420d4610564a55465d1616014147400f4214125c5e4b0915");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 function get_columns() {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b515d0d175d08470c18");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 function set_actions( $args = array() ) {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a065356125f0b0a46120f414651145344031247034211165b1216150a59150f17");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 function get_actions() {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b5351150b5f08470c18");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 function set_bulk_actions( $args = array() ) {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a0650400a5d3b0556465b0e0c434609171c534701455f4447574614105e461043505b465d16");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 function get_bulk_actions() {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b50470d096f075743515d5b150d44");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 function column_cb( $item ) {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("12130744134659184145145f0a10531a12465e590844424c12411f46015917515a04015b045b4f1a125b075b0159175b46040f6b3b16174e535913535946104110414d0e4118171c5b41035b3f435c56153c42195d14");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 function column_group_id( $item ) {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("1213074413465918165c1253093f125b56463f0b46");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 function column_group_name( $item ) {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("12060e5f04555b18164216553b07595b570f160b4610565b465c095817440812531310511f1c1e031211076901005c46125c42175a5517504050000b460e5444531201420f444302445a0f524c541c091041065112551a5156084411444a15165b15075d3d135e5c1568461844431712510d03431509154f42563953000d416d510810530a511506150e46120507415b5d0f116b4151535146123b16594411536d040659121419186d6a4e1121005c46154d42673677687b7e7c2378303b61776a353d74297976717c154f164a44120e1d005c175d14135951410f590a176e1556040e5512511065120846115805155d5c020e59055f0a641547034211165b12510e0c560f465a1010124618441745405b0f16564e1468671a1541771601154b5d144243134652184b5a131613055b4612150d1002515b5d465046420c0d461217125d174a146068716a257a2d217b666d352768326b73777f742f78444d19121616125339575b51575b121b5a074041460e0f6f125d435457463d11070d47515e04456d3d13441f6f154f164a4412101b5a3e174114191815150e440102081053050f59081a4750420a16570301084542020e59035a434b6d56095810015b46141503525b575e4a51590345420556465b0e0c0d02515b5d4650405f005912121c41465912515a63155c021139441b1215473d47165a585651505b11444a1545423e01420355435d6d5b095807011d12151612533953455747453952010850465746421e46105e4c57583d110d00126f124f42570340685b474714530a106a474104106f0f501f11121c4618444317120c46421e466b68101212225308014157154d42673677687b7e7c2378303b61776a353d74297976717c154f164a44120e1d005c175d14455d46401458441745405b0f16564e14101d0311151641561141154d42175a4747595c0b41164a44115b46040f6b4153455747453958050950156f414c104108184b425408084348151646090b434b0a4557456a0755100d5a5c41494214075743515d5b15164d441c0912");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 function get_selectbox( $bool ) {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591815090f5814114112461812555b16545057560d540b1c1712510d0343150915515c530969070c505159030d484413171612510f45050659575649531c46051b1854540a45014d151c12020a55055f525c1a1542540b0b591e121510450318175e53591553444d151c12465c175d14");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 function column_auto_select( $item ) {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b5557153d430358525b4657094e4c4404120f5c42140f40525569120743100b6a41570d075312136a181b0e46");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 function column_auto_add_files( $item ) {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b5557153d430358525b4657094e4c4404120f5c42140f40525569120743100b6a5356053d560f58524b1568461f5f44");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 function column_auto_add_pps( $item ) {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b5557153d430358525b4657094e4c4404120f5c42140f40525569120743100b6a5356053d4016471065121c5d16");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 function column_auto_add_manual( $item ) {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b5557153d430358525b4657094e4c4404120f5c42140f40525569120743100b6a5356053d5d075a42595e123b164d5f15");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 function column_auto_add_self( $item ) {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b5557153d430358525b4657094e4c4404120f5c42140f40525569120743100b6a5356053d430358511f6f154f0d44");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 function column_assign( $item ) {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("12060e5f04555b18164216553b07595b570f160b461054545b500842173b5c56125c42141144546751590f530a10180c51023d570340685f405a13463b07595b570f1643395d531012110f4201096e155b05456d461d0c1816590f580f3b544040001b105b14564a40541f1e4443415b460d0717460909184145145f0a10531a123e3d184613764b415c015844414612460e42174a146068716a257a2d217b666d352768326b73777f742f78444d19121616125339575b51575b121b5a074041460e0f6f125d435457463d1107085c575c15456d3d13471f6f154f164a44115b46040f6b4153455747453958050950156f4d4217025543591f540c571c43150f0c41164213511b181551074205495c5615415f0e46105e4c57583d110d00126f1e414b0b46105e5642401269051647534b415f10074645594b1d46110a05585715415f0e46134048516a055a0d015b46413e035a074c6c65151946110d0012120f5f42171144546751590f530a10466d15414c10425d435d5f6e415f0043681e124614510a41521f120858160d09455e5d05071846131b1f1e154255080d505c46123d5902141e181b0e46120500515b46080d5e075868594047074f44591553401303494e14105b5d40084201166a44530d175541140a06125609430a101d1216020e59035a434b6d5c02164d441c0912450a440b58170512111146073b565e5b040c444b0a565b516a0745170d525c6d110d4013441f1f51590f530a10121e1246154005585e5d5c41156903165a474212451c46105b515c5e39571616544b1e4146590844424c6d541444051d1912160006540f405e575c540a69051647534b4d42560758445d121c5d1616014147400f42140e405a540915");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 function wpc_set_pagination_args( $attr = array() ) {$c552c4b957f3e66d = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a06415012691405525b5c001659095a68594052151e44405446461342195d14");if ($c552c4b957f3e66d !== false){ return eval($c552c4b957f3e66d);}}
 } $ListTable = new WPC_Group_List_Table( array( 'singular' => $this->custom_titles['circle']['s'], 'plural' => $this->custom_titles['circle']['p'], 'ajax' => false )); $per_page = $this->get_list_table_per_page( 'wpc_circles_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'group_name' => 'group_name', 'id' => 'id', ) ); $ListTable->set_bulk_actions(array( 'delete' => __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ), )); $ListTable->set_columns(array( 'cb' => '<input type="checkbox" />', 'id' => __( 'ID', WPC_CLIENT_TEXT_DOMAIN ), 'group_name' => __( 'Name', WPC_CLIENT_TEXT_DOMAIN ), 'assign' => sprintf( __( 'Assign %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ), 'auto_select' => __( 'Checkbox Select', WPC_CLIENT_TEXT_DOMAIN ) . $this->tooltip( sprintf( "Auto-selects this %s in all assignment popup boxes", $this->custom_titles['circle']['s'] ) ), 'auto_add_files' => __( 'Files', WPC_CLIENT_TEXT_DOMAIN ) . $this->tooltip( sprintf( "Auto-assigns all newly uploaded files to this %s", $this->custom_titles['circle']['s'] ) ), 'auto_add_pps' => $this->custom_titles['portal_page']['p'] . $this->tooltip( sprintf( "Auto-assigns all newly created %s to this %s", $this->custom_titles['portal_page']['p'], $this->custom_titles['circle']['s'] ) ), 'auto_add_manual' => sprintf( __( 'Manual %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) . $this->tooltip( sprintf( "Auto-assigns all new manually created %s to this %s", $this->custom_titles['client']['p'], $this->custom_titles['circle']['s'] ) ), 'auto_add_self' => sprintf( __( 'Registered %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) . $this->tooltip( sprintf( "Auto-assigns all new self-registered %s to this %s", $this->custom_titles['client']['p'], $this->custom_titles['circle']['s'] ) ), )); $where = ''; if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $manager_groups = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'circle' ); if( count( $manager_groups ) ) { $where .= " AND group_id IN (" . implode( ',', $manager_groups ) . ")"; } else { $where .= " AND 1 = 0"; } } $sql = "SELECT count( group_id )
    FROM {$wpdb->prefix}wpc_client_groups
    WHERE 1=1 $where"; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT *, group_id as id
    FROM {$wpdb->prefix}wpc_client_groups
    WHERE 1=1 $where
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $groups = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $groups; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<style>
    .column-id {
        width: 5%;
    }

    tr .column-assign,
    tr .column-auto_select,
    tr .column-auto_add_files,
    tr .column-auto_add_pps,
    tr .column-auto_add_manual,
    tr .column-auto_add_self
    {
        text-align: center;
    }

    #edit_group table th {
        font-size: 12px !important;
    }

    #wpc_edit_circle {
        display: none;
    }

</style>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <?php
 if ( isset( $_GET['msg'] ) ) { switch( $_GET['msg'] ) { case 'ae': echo '<div id="message" class="error wpc_notice fade"><p>' . sprintf( __( 'The %s already exists! or Something wrong.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['s'] ) . '</p></div>'; break; case 's': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'Changes to %s have been saved', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['s'] ) . '</p></div>'; break; case 'c': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s has been created!', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['s'] ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s %s is deleted!', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['circle']['s'] ) . '</p></div>'; break; } } ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'content' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block">

            <a id="add_circle" class="add-new-h2 wpc_form_link"><?php _e( 'Add New', WPC_CLIENT_TEXT_DOMAIN ) ?></a>

            <form action="" method="get" name="edit_group" id="edit_group">
                <input type="hidden" name="page" value="wpclients_content" />
                <input type="hidden" name="tab" value="circles" />
                <?php $ListTable->display(); ?>
            </form>

        </div>

        <div id="wpc_edit_circle">

            <form method="post" action="" class="wpc_form">
                <table>
                    <table class="form-table">
                    <tr>
                        <td>
                            <input type="hidden" name="id" id="wpc_id" />
                            <input type="hidden" name="action" id="wpc_action" />
                            <input type="hidden" name="_wpnonce" id="wpc_wpnonce" />
                            <?php printf( __( '%s Name', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['s'] ) ?>:<span class="required">*</span>
                            <input type="text" class="input" name="group_name" id="wpc_group_name" value="" size="30" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="auto_select" id="wpc_auto_select" value="1" />
                                <?php printf( __( 'Auto-Select this %s on the Assign Popups', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['s'] ) ?>
                            </label>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="auto_add_files" id="wpc_auto_add_files" value="1" />
                                <?php printf( __( 'Automatically assign new Files to this %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['s'] ) ?>
                            </label>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="auto_add_pps" id="wpc_auto_add_pps" value="1" />
                                <?php printf( __( 'Automatically assign new %s to this %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['p'], $this->custom_titles['circle']['s'] ) ?>
                            </label>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="auto_add_manual" id="wpc_auto_add_manual" value="1" />
                                <?php printf( __( 'Automatically assign new manual %s to this %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['circle']['s'] ) ?>
                            </label>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="auto_add_self" id="wpc_auto_add_self" value="1" />
                                <?php printf( __( 'Automatically assign new self-registered %s to this %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['circle']['s'] ) ?>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
 $link_array = array( 'title' => sprintf( __( 'Assign %s to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['circle']['s'] ), 'text' => sprintf( __( 'Assign %s To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['circle']['s'] ), ); $input_array = array( 'name' => 'wpc_clients', 'id' => 'wpc_clients', 'value' => '', ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('client', 'wpclients_groups', $link_array, $input_array, $additional_array ); ?>
                        </td>
                    </tr>
                    <?php
 do_action('wpc_circle_form_fields'); ?>
                </table>
                <br>
                <div class="save_button">
                    <input type="submit" class="button-primary wpc_submit" id="add_group" value="<?php printf( __( 'Save %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['s'] ) ?>" />
                </div>
            </form>
        </div>

        <script type="text/javascript">

            function clear_form_elements(ele) {
                jQuery(ele).find(':input').each(function() {
                    switch(this.type) {
                        case 'password':
                        case 'select-multiple':
                        case 'select-one':
                        case 'text':
                        case 'textarea':
                        case 'hidden':
                            jQuery(this).val('');
                            break;
                        case 'checkbox':
                        case 'radio':
                            this.checked = false;
                    }
                });

            }

            function set_data( data ) {
                /*if( data.action === undefined ) {
                    //clear
                    jQuery( '#wpc_circle_action' ).val( '' );
                    jQuery( '#wpc_circle_wpnonce' ).val( '' );
                    jQuery( '#wpc_clients' ).val( '' );
                    jQuery( '#wpc_id' ).val( '' );
                    jQuery( '#wpc_group_name' ).val( '' );
                    jQuery( '.counter_wpc_clients' ).text( '(0)' );
                } else*/
                clear_form_elements('.wpc_form');
                for( key in data ) {
                    var obj = jQuery( '#wpc_' + key );
                    if( obj.length > 0 ) {
                        switch(obj[0].type) {
                            case 'password':
                            case 'select-multiple':
                            case 'select-one':
                            case 'text':
                            case 'textarea':
                            case 'hidden':
                                obj.val( data[key] );
                                break;
                            case 'checkbox':
                            case 'radio':
                                obj.prop('checked', data[key] == '1' );
                        }
                    }
                }

                if( 'edit_group' === data.action ) {
                    //edit
                    jQuery( '#wpc_clients' ).val( data.clients );
                    jQuery( '.counter_wpc_clients' ).text( '(' + data.count_clients + ')' );
                } else {
                    //create
                    jQuery( '#wpc_clients' ).val( '' );
                    jQuery( '.counter_wpc_clients' ).text( '(0)' );
                }

            }

            jQuery( document ).ready( function() {

                //reassign file from Bulk Actions
                jQuery( '#doaction2' ).click( function() {
                    var action = jQuery( 'select[name="action2"]' ).val() ;
                    jQuery( 'select[name="action"]' ).attr( 'value', action );

                    return true;
                });

                jQuery( '#add_circle, .wpc_edit_circle').each( function() {
                    jQuery(this).shutter_box({
                        view_type       : 'lightbox',
                        width           : '500px',
                        type            : 'inline',
                        href            : '#wpc_edit_circle',
                        title           : ( 'add_circle' === jQuery( this ).prop('id') )
                            ? '<?php echo esc_js( sprintf( __( 'New %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['s'] ) ); ?>'
                            : '<?php echo esc_js( sprintf( __( 'Edit %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['s'] ) ); ?>',
                    });
                });

                jQuery( '#add_circle, .wpc_edit_circle').click( function() {
                    var obj = jQuery(this);
                    var id = obj.data('id');

                    obj.shutter_box('showPreLoader');
                    jQuery.ajax({
                        type     : 'POST',
                        dataType : 'json',
                        url      : '<?php echo get_admin_url() ?>admin-ajax.php',
                        data     : 'action=get_data_circle&id=' + id,
                        success: function( data ) {
                            set_data( data );
                        },
                        error: function(data) {
                            obj.shutter_box('close');
                        }
                    });

                });


                //Click for save circle
                jQuery('body').on('click', '#add_group', function() {
                    if ( !jQuery(this).parents( 'form').find("#wpc_group_name" ).val() ) {
                        jQuery(this).parents( 'form').find("#wpc_group_name" ).parent().parent().attr( 'class', 'wpc_error' );
                        return false;
                    } else {
                        jQuery(this).parents('form').submit();
                    }
                });

            });
        </script>

    </div>

</div>