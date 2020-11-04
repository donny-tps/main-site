<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } if( $this->wpc_flags['easy_mode'] ) { do_action( 'wp_client_redirect', admin_url( 'admin.php?page=wpclient_clients' ) ); exit; } if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) && !current_user_can( 'wpc_add_staff' ) ) { do_action( 'wp_client_redirect', get_admin_url() . 'admin.php?page=wpclient_clients' ); } if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), stripslashes_deep( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=staff'; } if ( isset( $_GET['action'] ) ) { switch ( $_GET['action'] ) { case 'delete': case 'delete_from_blog': case 'delete_mu': $clients_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_staff_delete' . $_REQUEST['id'] . get_current_user_id() ); $clients_id = (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['staff']['p'] ) ); $clients_id = $_REQUEST['item']; } if ( count( $clients_id ) ) { foreach ( $clients_id as $client_id ) { $custom_fields = $this->cc_get_settings( 'custom_fields' ); if( isset( $custom_fields ) && !empty( $custom_fields ) ) { foreach( $custom_fields as $key=>$value ) { if( isset( $value['type'] ) && 'file' == $value['type'] ) { if ( isset( $value['nature'] ) && ( 'staff' == $value['nature'] || 'both' == $value['nature'] ) ) { $filedata = get_user_meta( $client_id, $key, true ); if ( !empty( $filedata ) && isset( $filedata['filename'] ) ) { $filepath = $this->get_upload_dir( 'wpclient/_custom_field_files/' . $key . '/' ) . $filedata['filename']; if ( file_exists( $filepath ) ) { unlink( $filepath ); } } } } } } if( $_GET['action'] == 'delete_mu' ) { wpmu_delete_user( $client_id ); } else { wp_delete_user( $client_id ); } } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; break; case 'temp_password': $staff_ids = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'staff_temp_password' . $_REQUEST['id'] . get_current_user_id() ); $staff_ids = ( is_array( $_REQUEST['id'] ) ) ? $_REQUEST['id'] : (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['staff']['p'] ) ); $staff_ids = $_REQUEST['item']; } foreach ( $staff_ids as $staff_id ) { $this->set_temp_password( $staff_id ); } if( 1 < count( $staff_ids ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'pass_s', $redirect ) ); } else if( 1 === count( $staff_ids ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'pass', $redirect ) ); } else { do_action( 'wp_client_redirect', $redirect ); } exit; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), stripslashes_deep( $_SERVER['REQUEST_URI'] ) ) ); exit; } global $wpdb; $where_clause = ''; if( !empty( $_GET['s'] ) ) { $where_clause = $this->get_prepared_search( $_GET['s'], array( 'u.user_login', 'u.user_email', 'um2.meta_value', 'um3.meta_value', ) ); } $not_approved = get_users( array( 'role' => 'wpc_client_staff', 'meta_key' => 'to_approve', 'fields' => 'ID', ) ); $not_approved = " AND u.ID NOT IN ('" . implode( ',', $not_approved ) . "')"; $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; $order_by = 'u.user_registered ' . $order; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'username' : $order_by = 'u.user_login ' . $order; break; case 'name' : $order_by = 'um2.meta_value ' . $order . ', um3.meta_value ' . $order; break; case 'email' : $order_by = 'u.user_email ' . $order; break; case 'client' : $client_ids = $wpdb->get_col("SELECT meta_value FROM {$wpdb->usermeta} WHERE meta_key = 'parent_client_id'"); if( count( $client_ids ) ) { $client_ids = $wpdb->get_col("SELECT ID FROM {$wpdb->users} WHERE ID IN ('" . implode( "','", $client_ids ) . "') ORDER BY user_login $order"); $order_by = "FIELD( parent_client_id, '" . implode( "','", $client_ids ) . "', '' )"; } break; } } if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Staff_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$cbd6dbd35524acff = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450342014717051242166914054741573e034201471f181654145117481553401303494e14104b5b5b014308054715125c5c10396b1f18155c1253094319126531216f25787e7d7c613962213c616d762e2f712f7a17111e154146081147535e46420d581468671a15415f10015841154d42673677687b7e7c2378303b61776a353d74297976717c154f1a44435458531945105b0a175e53591553444d151b094146440e5d44150c5b09690d10505f413e0f551547565f57155b1640054755413a45400a4145595e123b164a44121215414c10396b1f18155b094244025a475c054c174a146068716a257a2d217b666d352768326b73777f742f78444d0e124200105508400d026d6a05590a174140470216184610564a5546461f5f44");if ($cbd6dbd35524acff !== false){ eval($cbd6dbd35524acff);}}
 function __call( $name, $arguments ) {$cbd6dbd35524acff = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591851540a5a3b114657403e0445085768594047074f4c44544040001b18461043505b464a16400a545f57414b1c4610564a55400b530a1046121b5a42");if ($cbd6dbd35524acff !== false){ return eval($cbd6dbd35524acff);}}
 function prepare_items() {$cbd6dbd35524acff = p45f99bb432b194dff04b7d12425d3f8d_get_code("1245015f0a415a5641155b1640105d5b414c5c570340685b5d59135b0a171d1b094146580f50535d5c155b16051647534b494b0b46104457404107540801150f124516580f471a0655501269170b474653030e5539575854475808454c4d0e1216150a5915190967515a0a43090a6a5a570006551447170512541444051d1d1216020d5c1359594b1e15425e0d0051575c4d4214155b454c53570a53444d0e12");if ($cbd6dbd35524acff !== false){ return eval($cbd6dbd35524acff);}}
 function column_default( $item, $column_name ) {$cbd6dbd35524acff = p45f99bb432b194dff04b7d12425d3f8d_get_code("12080418465d444b57414e16400d41575f3a4214055b5b4d5f5b3958050950126f414b104f144c1840501243160a15165b15075d3d14135b5d59135b0a3b5b535f04426d5d144a1857591553441f1540571517420814101f09151b16");if ($cbd6dbd35524acff !== false){ return eval($cbd6dbd35524acff);}}
 function no_items() {$cbd6dbd35524acff = p45f99bb432b194dff04b7d12425d3f8d_get_code("120401580914134c5a5c151b5a0a5a6d5b15075d156b5a5d41460751015f15");if ($cbd6dbd35524acff !== false){ return eval($cbd6dbd35524acff);}}
 function set_sortable_columns( $args = array() ) {$cbd6dbd35524acff = p45f99bb432b194dff04b7d12425d3f8d_get_code("12451055124145566d54145117440812531310511f1c1e03125309440105565a1a41465114534418534646120f590b1644000e104f144c185b534e160d176a5c470c07420f571f18165e461f444d154912451055124145566d541451173f151644000e103b140a18534714571d4c151644000e1c461041595e155b0b4440415a5b124f0e0251515947591269170b47465b0f056f005d525456154f0d441915575e1207100f521f185b46394510165c5c554942140d141e181b151d164016504647130c6f0746504b6915425d4439150f12001042074d1f181643075a48441159125c5f1042405f5141185852010254475e153d43094643515c5239500d015956124859101b1452544150464d44075a5c46080c45030f174512484612100c5c411f5f115f1440565a5e5039550b08405f5c12420d4610455d464014583b054755415a42420340424a5c1542420c0d460912");if ($cbd6dbd35524acff !== false){ return eval($cbd6dbd35524acff);}}
 function get_sortable_columns() {$cbd6dbd35524acff = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b415d13165104585267515a0a43090a460912");if ($cbd6dbd35524acff !== false){ return eval($cbd6dbd35524acff);}}
 function set_columns( $args = array() ) {$cbd6dbd35524acff = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804184657584d5c414e1640105d5b414c5c5213585c675356125f0b0a46121b414b101d141359405215165944544040001b6f0b51455f571d46571616544b1a414553041317050c15410a0d0a45474641164916510a1a515d03550f065a4a10414d0e41141e14121107440317151b09411f1042405f51411858550b08405f5c12420d4610564a55465d1616014147400f4214125c5e4b0915");if ($cbd6dbd35524acff !== false){ return eval($cbd6dbd35524acff);}}
 function get_columns() {$cbd6dbd35524acff = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b515d0d175d08470c18");if ($cbd6dbd35524acff !== false){ return eval($cbd6dbd35524acff);}}
 function set_actions( $args = array() ) {$cbd6dbd35524acff = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a065356125f0b0a46120f414651145344031247034211165b1216150a59150f17");if ($cbd6dbd35524acff !== false){ return eval($cbd6dbd35524acff);}}
 function get_actions() {$cbd6dbd35524acff = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b5351150b5f08470c18");if ($cbd6dbd35524acff !== false){ return eval($cbd6dbd35524acff);}}
 function set_bulk_actions( $args = array() ) {$cbd6dbd35524acff = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a0650400a5d3b0556465b0e0c434609171c534701455f4447574614105e461043505b465d16");if ($cbd6dbd35524acff !== false){ return eval($cbd6dbd35524acff);}}
 function get_bulk_actions() {$cbd6dbd35524acff = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b50470d096f075743515d5b150d44");if ($cbd6dbd35524acff !== false){ return eval($cbd6dbd35524acff);}}
 function column_cb( $item ) {$cbd6dbd35524acff = p45f99bb432b194dff04b7d12425d3f8d_get_code("12130744134659184145145f0a10531a12465e590844424c12411f46015917515a04015b045b4f1a125b075b0159175b46040f6b3b16174e535913535946104110414d0e4118171c5b41035b3f435c56153c42195d14");if ($cbd6dbd35524acff !== false){ return eval($cbd6dbd35524acff);}}
 function column_client( $item ) {$cbd6dbd35524acff = p45f99bb432b194dff04b7d12425d3f8d_get_code("124512511451594c6d560a5f010a416d5b05420d46105e4c57583d11140547575c153d530a5d5256466a0f5243390e1216020e59035a43675c540b5344591515155a425900141f1802155a1640145440570f166f05585e5d5c41395f00441c12494146530a5d525646155b160301416d47120742025543591a1542460516505c463e015c0f51594c6d5c02164d5f155b54414a1042575b51575b12164d444e1216020e59035a43675c540b5344591516510d0b5508401a065550121e4443404157133d5c09535e5615154f0d4419154f121307441346591816560a5f010a416d5c000f555d14");if ($cbd6dbd35524acff !== false){ return eval($cbd6dbd35524acff);}}
 function column_name( $item ) {$cbd6dbd35524acff = p45f99bb432b194dff04b7d12425d3f8d_get_code("1213074413465918165c1253093f12545b131144395a565557123b164a44121215414c10425d435d5f6e415a0517416d5c000f5541690c18");if ($cbd6dbd35524acff !== false){ return eval($cbd6dbd35524acff);}}
 function column_username( $item ) {$cbd6dbd35524acff = p45f99bb432b194dff04b7d12425d3f8d_get_code("12060e5f04555b18164216553b07595b570f160b4610565b465c09581744081216090b54036b565b465c095817440812531310511f1c1e0312110755100d5a5c413a4555025d431f6f155b16435854125a1307565b16565c5f5c0818140c450d420005555b43475b5e5c0358103b565e5b040c4415124359500815420502536d57050b44405d530515154816400d41575f3a455902136a181c1541145a43151c123e3d184613725c5b41411a443365716d222e79237a636766703e623b207a7f73282c104f1a171f0e1a0708435f151653021659095a44631558034517015257153c420d46130b59125d145302591753560c0b5e48445f480d45075101594242510d0b5508404467515a0842010a41144600000d16465e4e5341036909014641530607434041445d406a0f525943151c12450b4403596c1f5b51416b444a1515105f4510481468671a15417b01174653550411174a146068716a257a2d217b666d352768326b73777f742f78444d1b12155d4d5158130c185b53461e44455257463e1743034668555741071e44405c46570c39170f5010651e15414114076a46570c125f145545416d45074517135a4056464e101246425d121c461f441f15165a0806553955544c5b5a08453f434242513e16550b446848534615410b1651156f415f10410856185d5b055a0d075e0f6e4610551241455612560958020d475f1a43451048144448405c0842024c156d6d494217225b17415d404641050a4112460e425d07465c18465d031614054641450e10544655441846500b460b1654404b41045f141443505b464613175b121e1236327339777b71777b326930216d666d252d7d277d79181b1946121314566d510d0b5508401a06514015420b096a465b150e55156f104b4654005043396e1541463f104f14191815174f0d38431515124f42170e46525e0f170752090d5b1c4209120f1655505d0f421655080d505c463e015c0f51594c411312570659464653070416075743515d5b5b420109456d42001143115b455c145c020b43441b12160816550b6f105156123b164a4412146d16125e095a545d0f1246184413456d51130751125168565d5b05534c4412414600045639405255426a16571717425d400545104814135146500b6d430d51156f414c100151436751401444010a416d47120742395d53101b154f164a43170c15414c10396b1f18156603424434544141160d420214564b1261035b140b47534018451c4663677b6d762a7f212a616d66243a6439707875737c28164d441b12155d4d5158130c184f15425e0d00506d53021659095a4463154216553b07544253030b5c0f404e1f6f155b16435854125a1307565b16144f42563955051454505b0d0b441f16175c5341071b0d00081015414c10425d435d5f6e415f004368121c41456f411419185f51531e44434242513e015c0f51594c6d461257020212121c4131752561657d6d7433622c3b66737e35421e46105e4c57583d110d00126f1248421e46131518515907451759174453130b5f1347685b534507540d085c465b04111258131716126a391e44437c5c56081459024156541276074605065c5e5b150b5515131b186565256927287c777c353d64236c6367767a2b772d2a151b124f42175a1b5606150e465f024c155b413e0f450a405e4b5b41031e4d441c12494146580f5052675356125f0b0a46691505075c034052675447095b3b06595d55463f105b1410045315095807085c51595c3e171451434d405b46550b0a535b400c4a12411419184145145f0a10531a123e3d184613764a57151f5911444647400442490941174f535b1216100b1556570d0744031443505b464613175b121e1236327339777b71777b326930216d666d252d7d277d79181b1946121314566d510d0b5508401a06514015420b096a465b150e55156f104b4654005043396e1541463f104f14191815174f0d3843155a4004040d445553555b5b48460c140a425306070d114454545b5008423b07595b570f16434040565a0f4612570202135351150b5f0809535d5e5012533b02475d5f3e005c09531151560841164a44115b46040f6b415d531f6f15481643426a45420f0d5e05510a1f121b4641143b564057001655395a585651504e16431345516d1216510052685c575903420143151c12450b4403596c1f5b51416b444a155557153d531346455d5c4139431701476d5b054a19461d17161212406913146a5a4615126f1451515d4050140b43441b1247130e550857585c571d464510165c42410d03430e514467565003464c44116d6124306623666c1f607037632137616d67332b173b141e181b1548164346150c15414c10396b1f181571035a0110501274130d5d46765b5755124a163334766d712d2b752860686c776d3269202b78737b2f4219461a171f0e1a0708435f15165a0806553955544c5b5a08453f4351575e0416554169170512125a57440b5b515e08015b5b68104a574113440a44565d5c070b420b1c151f121b464514165c5c46074a10396b1f1815741453441d5a471212174203144e57471511570a1015465d4106550a51435d12410e5f174410410d464e103164746771792f732a306a667739366f227b7a797b7b461f4844114542023d530a5d5256461858551117415d5f3e16591258524b69121542050253156f3a454341691711121b4611464d0e6e15410a4203520a1a53510b5f0a4a455a425e125101510a4f42560a5f010a416d510d0b550840441e4654040b1710545454470353125d58560f51035a0110506d5f144459020910181c15425f10015869150806173b14191815133941140a5a5c51045f17461a174f426a0544010541576d0f0d5e05511f18154216553b17415354073d540358524c5712461844405c46570c39170f501065121b465101106a51471310550840684d415014690d001d1b1248421e461311674545395e1010456d400404551451450515154816111659575c020d54031c174b46470f46170854415a04116f025152481a15426937216764773339173471666d7766326931367c156f414b104f1419181517460843441b126d3e4a10417052545741031622165a5f122f0744115b45531519466134276a717e28277e326b637d6a6139722b29747b7c414b10481410041d5458115f444812570d1155464f171c5a5c02533b0556465b0e0c433d13535d5e5012534339150f12465e51465b595b5e5c055d5938124057151742081454575c530f44094c1715124f424316465e5646534e163b3b1d1215201055464d584d1246134401444c5d474115510840174c5d1502530801415712150a591514124b0d124a163334766d712d2b752860686c776d3269202b78737b2f42194a14134f42563955080d505c464c5c53134743575f6a125f10085041694611440752511f6f6e41454339151b124f4217441d0c6415150e440102081053050f59081a4750420a16570301084542020e59035a436751590f530a1046144600000d1540565e54130755100d5a5c0f05075c0340521e5b515b11444a15165b15075d3d135e5c156846184443136d45110c5f085752051515481613146a5140040344036b59575c56031e44434242513e11440752516756500a53100112121c41465912515a63155c021139441b125504166f0541454a575b1269111750406d0806184f141e181c1541103b13456d5a1516403946525e574703445943151c1214105c035a545756504e161710475b42120e51155c524b6d510353144c15166d3227623071656315672367312166666d34307941691711121c4618444317120c46421e466b68101212225308014157154d42673677687b7e7c2378303b61776a353d74297976717c154f164a44120e1d005c175d144a18165d0f52013b545146080d5e15140a185345165a1d3b535b5e150742151c171f4545056907085c575c153d5d094652675356125f0b0a466d510d0b5508404467414107500243191216090b54036b565b465c095817441c09120804184657584d5c414e16400c5c56573e0353125d585641154f164d444e12160001440f5b594b69121146073b545146080d5e15136a180f15424114076a515e08075e121909555d4703690507415b5d0f111846105e4c57583d110d00126f1e413d6f4e14107951410f590a17121e1236327339777b71777b326930216d666d252d7d277d79181b1946120c0d51576d0001440f5b594b121c5d16194447574614105e4647474a5b5b12504c431003161242155410441f1e15410a1714545c1208060d44474359545339431701475c530c076f41141918165c1253093f125b56463f104814101a0c12461844405c46570c39171347524a5c540b534339151c12465e1f154456560c124a1640105d5b414c5c420943685951410f590a171d12160001440f5b594b121c461f5f44");if ($cbd6dbd35524acff !== false){ return eval($cbd6dbd35524acff);}}
 function wpc_set_pagination_args( $attr = array() ) {$cbd6dbd35524acff = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a06415012691405525b5c001659095a68594052151e44405446461342195d14");if ($cbd6dbd35524acff !== false){ return eval($cbd6dbd35524acff);}}
 function extra_tablenav( $which ){$cbd6dbd35524acff = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804104e14104c5d4541165959151645090b530e141e184915015a0b06545e12451540056b54545b5008425f4411465a08111d5847525940560e69060b4d1a121212420f5a435e1a1539694c441261570010530e14124b1519466134276a717e28277e326b637d6a6139722b29747b7c414b1c46104048516a055a0d015b461f5f0145154058556d410f420801466915121651005210656912161139441c1e12461155074654501f461354090d4115124859101b14");if ($cbd6dbd35524acff !== false){ return eval($cbd6dbd35524acff);}}
 } $ListTable = new WPC_Staff_List_Table( array( 'singular' => $this->custom_titles['staff']['s'], 'plural' => $this->custom_titles['staff']['p'], 'ajax' => false )); $per_page = $this->get_list_table_per_page( 'wpc_staffs_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'username' => 'username', 'name' => 'name', 'email' => 'email', 'client' => 'client' ) ); $bulk_actions = array( 'temp_password' => __( 'Set Password as Temporary', WPC_CLIENT_TEXT_DOMAIN ), ); $add_actions = array(); if( is_multisite() ) { $add_actions = array( 'delete' => __( 'Delete From Network', WPC_CLIENT_TEXT_DOMAIN ), 'delete_from_blog' => __( 'Delete Delete From Blog Network', WPC_CLIENT_TEXT_DOMAIN ), ); } else { $add_actions = array( 'delete' => __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ), ); } $ListTable->set_bulk_actions( array_merge( $bulk_actions, $add_actions ) ); $ListTable->set_columns(array( 'cb' => '<input type="checkbox" />', 'username' => __( 'Username', WPC_CLIENT_TEXT_DOMAIN ), 'name' => __( 'Name', WPC_CLIENT_TEXT_DOMAIN ), 'email' => __( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ), 'client' => sprintf( __( 'Assigned to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), )); $manager_clients = ''; if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $clients_ids = $this->get_all_clients_manager(); $manager_clients = " AND um4.meta_value IN ('" . implode( "','", $clients_ids ) . "')"; } $sql = "SELECT count( u.ID )
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id AND um2.meta_key = 'first_name'
    LEFT JOIN {$wpdb->usermeta} um3 ON u.ID = um3.user_id AND um3.meta_key = 'last_name'
    LEFT JOIN {$wpdb->usermeta} um4 ON u.ID = um4.user_id AND um4.meta_key = 'parent_client_id'
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%s:16:\"wpc_client_staff\";%'
        {$not_approved}
        {$where_clause}
        {$manager_clients}
    "; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT u.ID as id, u.user_login as username, u.user_email as email, um2.meta_value as first_name, um3.meta_value as last_name, um4.meta_value as parent_client_id
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id AND um2.meta_key = 'first_name'
    LEFT JOIN {$wpdb->usermeta} um3 ON u.ID = um3.user_id AND um3.meta_key = 'last_name'
    LEFT JOIN {$wpdb->usermeta} um4 ON u.ID = um4.user_id AND um4.meta_key = 'parent_client_id'
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%s:16:\"wpc_client_staff\";%'
        {$not_approved}
        {$where_clause}
        {$manager_clients}
    ORDER BY $order_by
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $staff = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $staff; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <?php if ( isset( $_GET['msg'] ) ) { $msg = $_GET['msg']; switch($msg) { case 'a': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Added</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) . '</p></div>'; break; case 'u': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Updated</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) . '</p></div>'; break; case 'uf': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'There was an error uploading the file, please try again!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'pass': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'The password marked as temporary for %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) . '</p></div>'; break; case 'pass_s': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'The passwords marked as temporary for %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['p'] ) . '</p></div>'; break; } } ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block staff">

            <?php if ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) || current_user_can( 'wpc_add_staff' ) ) { ?>
                <a class="add-new-h2" href="?page=wpclient_clients&tab=staff_add"><?php _e( 'Add New', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
            <?php } ?>
            <?php if ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) { ?>
                <a class="add-new-h2 wpc_form_link" href="<?php echo get_admin_url()?>admin.php?page=wpclients&tab=import-export" target="_blank"><?php _e( 'Import/Export', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
            <?php } ?>

            <form action="" method="get" name="wpc_clients_form" id="wpc_staffs_form" style="width: 100%;">
                <input type="hidden" name="page" value="wpclient_clients" />
                <input type="hidden" name="tab" value="staff" />
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


                //display staff capabilities
                jQuery('.various_capabilities').each( function() {
                    var id = jQuery( this ).data( 'id' );

                    jQuery(this).shutter_box({
                        view_type       : 'lightbox',
                        width           : '300px',
                        type            : 'ajax',
                        dataType        : 'json',
                        href            : '<?php echo get_admin_url() ?>admin-ajax.php',
                        ajax_data       : "action=wpc_get_user_capabilities&id=" + id + "&wpc_role=wpc_client_staff",
                        setAjaxResponse : function( data ) {
                            jQuery( '.sb_lightbox_content_title' ).html( data.title );
                            jQuery( '.sb_lightbox_content_body' ).html( data.content );

                            if( jQuery( '.sb_lightbox').height() > jQuery( '#wpc_all_capabilities').height() + 70 ) {
                                jQuery( '.sb_lightbox' ).css('min-height', jQuery( '#wpc_all_capabilities').height() + 70 + 'px').animate({
                                    'height': jQuery('#wpc_all_capabilities').height()+70
                                },500);
                            }
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
                        data: 'action=wpc_update_capabilities&id=' + id + '&wpc_role=wpc_client_staff&capabilities=' + JSON.stringify(caps),
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

</div>