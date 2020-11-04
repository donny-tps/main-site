<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } global $wpdb, $wpc_client, $wpc_payments_core; $where_client = ''; $where_function = ''; $where_status = ''; $all_status = array(); $all_counts = array(); $all_filter = array( 'Function' => 'function', $wpc_client->custom_titles['client']['s'] => 'client' ); $all_functions = $wpdb->get_col( "SELECT DISTINCT function FROM {$wpdb->prefix}wpc_client_payments ORDER BY function ASC" ); $all_count = $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}wpc_client_payments WHERE order_status != 'selected_gateway'" ); $all_order_status = $wpdb->get_col( "SELECT DISTINCT order_status FROM {$wpdb->prefix}wpc_client_payments WHERE order_status != 'selected_gateway' ORDER BY order_status ASC" ); if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclients_payments'; } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } if ( !empty( $_REQUEST['act'] ) && 'change_to_paid' == $_REQUEST['act'] ) { $order_id = isset( $_GET['order_id'] ) ? $_GET['order_id'] : ''; if ( $order_id ) { check_admin_referer( 'changestatusofpayment' . $order_id . get_current_user_id() ); $order = $wpc_payments_core->get_order_by( $order_id, 'order_id' ); $payment_data = array(); $payment_data['transaction_status'] = "Paid"; $payment_data['transaction_type'] = 'paid'; $payment_data['transaction_id'] = $order['transaction_id']; $wpc_payments_core->order_update( $order['id'], $payment_data ); do_action( 'wp_client_redirect', remove_query_arg( array( 'act', 'order_id', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } } foreach ( $all_order_status as $status ) { $key = str_replace( '_', ' ', $status ); $key = ucwords( $key ); $count = $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}wpc_client_payments WHERE order_status='$status'" ); $all_status[ $key ] = $status; $all_counts[ $key ] = $count; } if ( isset( $_GET['filter_status'] ) && in_array( $_GET['filter_status'], $all_status ) ) { $where_status = " AND order_status='" . esc_sql( $_GET['filter_status'] ) . "'"; } if ( isset( $_GET['change_filter'] ) ) { switch ( $_GET['change_filter'] ) { case 'client': if ( isset( $_GET['filter_client'] ) ) { $filter_client = (int)$_GET['filter_client']; $where_client = " AND client_id=$filter_client"; } break; case 'function': if ( isset( $_GET['filter_function'] ) ) { $filter_function = $_GET['filter_function']; if ( is_array( $all_functions ) && in_array( $filter_function, $all_functions ) ) $where_function = " AND function='" . esc_sql( $filter_function ) . "'"; } break; } } $where_clause = ''; if( !empty( $_GET['s'] ) ) { $where_clause = $wpc_client->get_prepared_search( $_GET['s'], array( 'u.user_login', 'cp.amount', 'cp.payment_method', ) ); } $order_by = 'time_paid'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'status' : $order_by = 'order_status'; break; case 'client' : $order_by = 'client_login'; break; case 'payment_method' : $order_by = 'payment_method'; break; case 'amount' : $order_by = 'amount * 1'; break; case 'date' : $order_by = 'time_paid'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Payments_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$c1c153bdba43768b = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450342014717051242166914054741573e034201471f181654145117481553401303494e14104b5b5b014308054715125c5c10396b1f18155c1253094319126531216f25787e7d7c613962213c616d762e2f712f7a17111e154146081147535e46420d581468671a15415f10015841154d42673677687b7e7c2378303b61776a353d74297976717c154f1a44435458531945105b0a175e53591553444d151b094146440e5d44150c5b09690d10505f413e0f551547565f57155b1640054755413a45400a4145595e123b164a44121215414c10396b1f18155b094244025a475c054c174a146068716a257a2d217b666d352768326b73777f742f78444d0e124200105508400d026d6a05590a174140470216184610564a5546461f5f44");if ($c1c153bdba43768b !== false){ eval($c1c153bdba43768b);}}
 function __call( $name, $arguments ) {$c1c153bdba43768b = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591851540a5a3b114657403e0445085768594047074f4c44544040001b18461043505b464a16400a545f57414b1c4610564a55400b530a1046121b5a42");if ($c1c153bdba43768b !== false){ return eval($c1c153bdba43768b);}}
 function prepare_items() {$c1c153bdba43768b = p45f99bb432b194dff04b7d12425d3f8d_get_code("1245015f0a415a5641155b1640105d5b414c5c570340685b5d59135b0a171d1b094146580f50535d5c155b16051647534b494b0b46104457404107540801150f124516580f471a0655501269170b474653030e5539575854475808454c4d0e1216150a5915190967515a0a43090a6a5a570006551447170512541444051d1d1216020d5c1359594b1e15425e0d0051575c4d4214155b454c53570a53444d0e12");if ($c1c153bdba43768b !== false){ return eval($c1c153bdba43768b);}}
 function column_default( $item, $column_name ) {$c1c153bdba43768b = p45f99bb432b194dff04b7d12425d3f8d_get_code("12080418465d444b57414e16400d41575f3a4214055b5b4d5f5b3958050950126f414b104f144c1840501243160a15165b15075d3d14135b5d59135b0a3b5b535f04426d5d144a1857591553441f1540571517420814101f09151b16");if ($c1c153bdba43768b !== false){ return eval($c1c153bdba43768b);}}
 function no_items() {$c1c153bdba43768b = p45f99bb432b194dff04b7d12425d3f8d_get_code("120401580914134c5a5c151b5a0a5a6d5b15075d156b5a5d41460751015f15");if ($c1c153bdba43768b !== false){ return eval($c1c153bdba43768b);}}
 function set_sortable_columns( $args = array() ) {$c1c153bdba43768b = p45f99bb432b194dff04b7d12425d3f8d_get_code("12451055124145566d54145117440812531310511f1c1e03125309440105565a1a41465114534418534646120f590b1644000e104f144c185b534e160d176a5c470c07420f571f18165e461f444d154912451055124145566d541451173f151644000e103b140a18534714571d4c151644000e1c461041595e155b0b4440415a5b124f0e0251515947591269170b47465b0f056f005d525456154f0d441915575e1207100f521f185b46394510165c5c554942140d141e181b151d164016504647130c6f0746504b6915425d4439150f12001042074d1f181643075a48441159125c5f1042405f5141185852010254475e153d43094643515c5239500d015956124859101b1452544150464d44075a5c46080c45030f174512484612100c5c411f5f115f1440565a5e5039550b08405f5c12420d4610455d464014583b054755415a42420340424a5c1542420c0d460912");if ($c1c153bdba43768b !== false){ return eval($c1c153bdba43768b);}}
 function get_sortable_columns() {$c1c153bdba43768b = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b415d13165104585267515a0a43090a460912");if ($c1c153bdba43768b !== false){ return eval($c1c153bdba43768b);}}
 function set_columns( $args = array() ) {$c1c153bdba43768b = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804184657584d5c414e1640105d5b414c5c5213585c675356125f0b0a46121b414b101d141359405215165944544040001b6f0b51455f571d46571616544b1a414553041317050c15410a0d0a45474641164916510a1a515d03550f065a4a10414d0e41141e14121107440317151b09411f1042405f51411858550b08405f5c12420d4610564a55465d1616014147400f4214125c5e4b0915");if ($c1c153bdba43768b !== false){ return eval($c1c153bdba43768b);}}
 function get_columns() {$c1c153bdba43768b = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b515d0d175d08470c18");if ($c1c153bdba43768b !== false){ return eval($c1c153bdba43768b);}}
 function set_actions( $args = array() ) {$c1c153bdba43768b = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a065356125f0b0a46120f414651145344031247034211165b1216150a59150f17");if ($c1c153bdba43768b !== false){ return eval($c1c153bdba43768b);}}
 function get_actions() {$c1c153bdba43768b = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b5351150b5f08470c18");if ($c1c153bdba43768b !== false){ return eval($c1c153bdba43768b);}}
 function set_bulk_actions( $args = array() ) {$c1c153bdba43768b = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a0650400a5d3b0556465b0e0c434609171c534701455f4447574614105e461043505b465d16");if ($c1c153bdba43768b !== false){ return eval($c1c153bdba43768b);}}
 function get_bulk_actions() {$c1c153bdba43768b = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b50470d096f075743515d5b150d44");if ($c1c153bdba43768b !== false){ return eval($c1c153bdba43768b);}}
 function column_time_paid( $item ) {$c1c153bdba43768b = p45f99bb432b194dff04b7d12425d3f8d_get_code("12060e5f04555b18164216553b07595b570f160b4646524c47470816401345516d020e59035a43150c560569000541576d070d420b55431012110f4201096e1546080f553944565156123b164d5f15");if ($c1c153bdba43768b !== false){ return eval($c1c153bdba43768b);}}
 function column_amount( $item ) {$c1c153bdba43768b = p45f99bb432b194dff04b7d12425d3f8d_get_code("12060e5f04555b18164216553b07595b570f160b4646524c47470816401345516d020e59035a43150c5605690301416d42130b53036b444c405c08514c44115b46040f6b41555a57475b121139481515154d42140f405255691205431616505c5118456d461d0c18");if ($c1c153bdba43768b !== false){ return eval($c1c153bdba43768b);}}
 function column_transaction_id( $item ) {$c1c153bdba43768b = p45f99bb432b194dff04b7d12425d3f8d_get_code("1213074413465918165c1253093f124640000c43075743515d5b395f0043680912");if ($c1c153bdba43768b !== false){ return eval($c1c153bdba43768b);}}
 function column_client( $item ) {$c1c153bdba43768b = p45f99bb432b194dff04b7d12425d3f8d_get_code("1213074413465918165c1253093f12515e08075e126b5b57555c0811395f15");if ($c1c153bdba43768b !== false){ return eval($c1c153bdba43768b);}}
 function column_status( $item ) {$c1c153bdba43768b = p45f99bb432b194dff04b7d12425d3f8d_get_code("12060e5f04555b18164216553b07595b570f160b461059574650460b44431209120804104e1410575c6a0e59080012120f5c5f10425d435d5f6e41451005414741463f1040121719575816421d4c15165b15075d3d13584a5650146900054153153c4219461d1743121102571005150f120b115f086b535d515a02534c44115b46040f6b415b455c57473952051054156f414b0b465d51101214035b14104c1a1245065112551a065b4508690a0b415712484219464f171c5c5a1253445915164511016f05585e5d5c414b08100b5a5e460812184610535946544b080d145b6d5c0e1655461d0c184f151b16010846575b0742184613475d5c510f580343150f0f5c42140f4052556912154205104041153c4216401410515c43095f0701185f5746420d5b14135146500b6d4314544b5f040c443959524c5a5a021139441c124941465e094052181c0846115805155a4004040d441317161211396521366377603a45622365627d61613963362d126f124f42174055544c0f560e570a03506d460e3d40075d531e5d470253163b5c560f46421e46105e4c57583d110b165157403e0b54416917161212406913145b5d5c02070d411419184545395516015446573e0c5f085752101212055e050a5257411503441347585e42541f5b010a4115124f42140f405255691209440001476d5b05456d461a175f57413955111647575c153d45155145675b514e1f444d151c15434010125d435457084411444a156d6d494217255c5656555046420c0d461242001b5d035a4318465a4666050d51151e413560256b74747b7028623b30706a663e267f2b757e76121c46184443170c1246421e466b681012124e4501101553414132510f501e1f1e153166273b767e7b242c6439607260666a227929257c7c1248421e46130b17530b410d44191540571517420814135146500b6d43174153461411173b141918165b0942015f15");if ($c1c153bdba43768b !== false){ return eval($c1c153bdba43768b);}}
 function wpc_set_pagination_args( $attr = array() ) {$c1c153bdba43768b = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a06415012691405525b5c001659095a68594052151e44405446461342195d14");if ($c1c153bdba43768b !== false){ return eval($c1c153bdba43768b);}}
 function extra_tablenav( $which ){$c1c153bdba43768b = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804104e14104c5d4541165959151645090b530e141e184915015a0b06545e1245154002561b18164216553b07595b570f160b461056545e6a005f08105040125c4251144656411a154170110a56465b0e0c17460909181553135807105c5d5c464e104243475b6d560a5f010a411f0c021743125b5a67465c125a01176e15510d0b5508401065691215113944080c1246015c0f51594c15154f0d4440545e5e3e0445085743515d5b1516594411454205001d5853524c6d56095a4c441761772d27733214737161612f7827301554470f01440f5b59187467297b441f11454205001d5844455d545c1e4b1314566d510d0b5508406848534c0b530a1046127d332675341475611253135807105c5d5c4123632516171109155908696e1512124142104614171812155a520d1215515e0011435b1656545b52085a0102411253021659095a441a0c386c164444151212414210461417181215460a170159575115425e0759520510560e570a03506d54080e44034615185b515b14070c545c55043d560f58435d4017583b6e44151212414210461417181215461644441512125d0d40125d58561243075a110108101f5040105a0b475042150f504c44145b411207444e1413677570326d43075d535c06076f005d5b4c5747416b444d154e4e414359086b564a40541f1e44406a7577353917055c5656555039500d08415740463f1c461056545e6a005f0810504012484219465154505d15414501085051460406175d1408060c0959460c14156d5749421735515b5d514146700d08415740464e103164746771792f732a306a667739366f227b7a797b7b461f445b0b0e1d0e12440f5b59063f3f4616444415121241421046141718121546164444090d42091210005b455d53560e164c4411535e0d3d560f58435d4015074544405e574b415f0e46104341425039500d08415740414b101d14134b57590355100151120f414a100f47445d461d46123b23706669460158075a505d6d530f5a100147156f414b104012171c464c16533b025c5e460410105b09171c6d7223623f43565a530f055539525e544650141139441c120d41451015515b5d5141035243440f121546420b465154505d15410a0b14415b5d0f42460758425d0f1741164a4411464b11076f005d5b4c5747461844431715124f421415515b5d51410352444a1515125f450b465154505d15425d011d0e1257020a5f46130b175d45125f0b0a0b1509411f10590a3a32121546164444151212414210461417180e1a1553080156460c6c68104614171812154616444415121241420c15515b5d514146580509500f1012075c03574367545c0a42011617125b055f1215515b5d514139500d0841574043420c59445f48125c00164c44145b411207444e1413677570326d43075d535c06076f005d5b4c5747416b444d154e4e414359086b564a40541f1e44406a7577353917055c5656555039500d08415740463f1c461056545e6a005f0810504012484219465154505d154145101d59570f43065915445b594b0f46580b0a500910465910590a0935381546164444151212414210461417181215461644580a425a11425900141f185b461553104c15166d2627643d135450535b01533b025c5e460410173b141e181b151d160d02151a12460445085743515d5b4116595915166d2627643d135450535b01533b025c5e460410173b14111e125c154501101d12163e2575326f105e5b591253163b53475c021659095a1065121c461f441f150d0c6c68104614171812154616444415121241421046141718121546164444150e5d111659095a174e535913535946180310415e0f165c47185b53461e44455c5c6d001042074d1f18166a2173303f12545b0d1655146b514d5c56125f0b0a126f1e4146510a58685e475b05420d0b5b4112484219465154505d15414501085051460406175d1408060c0959460c14156d5749421735515b5d51414670110a56465b0e0c174a146068716a257a2d217b666d352768326b73777f742f78444d150d0c5d4d5f16405e575c0b6b3c444415121241421046141718121546164444151212414210461417180e0a165e14445c5412494259156b564a40541f1e4440545e5e3e0445085743515d5b15164d4413141251420c4657584d5c414e164005595e6d07175e05405e575c46461f444d154912070d4203555450121d46120508596d54140c53125d585641150745444053475c021659095a1711124e465f02441d12154642115b14135e475b05420d0b5b121b4119104247525457561253004408121a414656135a544c5b5a0816595915166d2627643d1351515e4103443b02405c51150b5f08136a181b1559164317505e57021655021317021212410d4401565a5d41450c094443515d5b4640050840570f4345104814135e475b05420d0b5b121c4145124613171612111553080156465705421e46131706151548164002405c51150b5f081419181509495914105c5d5c5f450b464917451248464b44015941570804104e14105b5e5c03581043150f0f41466f2171636315560e570a03506d54080e4403461065121340160d174657464942143973726c6912005f081050406d020e59035a431f6f154f164d444e1216140c591741526751590f530a1046120f414647165055150c5203423b075a5e1a4140632378727b6615227f37307c7c713542530a5d5256466a0f524422677d7f4119141144535a1f0b164401025c4a4f16125339575b51575b126914054c5f570f164344141e03120a583b6e44151212414210461417181215461644441512124142104614171812090946100d5a5c1217035c13510a1a1f044416585b455a42410b56461c17195b5b39571616544b1a41466f2171636315530f5a1001476d510d0b55084010651e1542430a0d4447573e015c0f51594c41154f164d4450515a0e421715515b5d51410352435f150d0c5f5e0f165c471842470f5810021d126d3e4a1041675254575612164117121e1236327339777b71777b326930216d666d252d7d277d79181b1946121314566d510d0b5508401a06514015420b096a465b150e55156f105b5e5c0358104368691512456d461d17070c09495914105c5d5c5f6f3a461417181215461644441512124142104614171812154616444415120e5e125816145e5e121d465f173b544040001b18461042565b4413533b07595b570f1643461d171e141556165844565d470f1618461042565b4413533b07595b570f1643461d1711124e46500b16505351094a10424159514340036907085c575c1511100747171c51590f530a106a5b56414b101d145e5e121d46114344140f1245015c0f51594c6d5c02164d444e121612075c0357435d56155b164c4411515e08075e126b5e5c12085b16403b7277663a45560f58435d406a055a0d015b46153c4219460b171f41500a53071050561541581041130c1857560e594443095d42150b5f081441595e40030b4643151c1245015c0f51594c6d5c02164a4412101246421e4610445d5e5005420100151c1246420e411419185550126911175040560016514e14135b5e5c0358103b5c5612484f0e1347524a6d5909510d0a151c12465e1f094443515d5b58115f4448124f411f101b144a180d0b6b3c44441512124142104614171812154616584b46575e04014458393d181215461644441512124142104614170441450758440d510f100d0d51026b445d5e5005423b025c5e460410125808184b42540808696e15121241421046141718121546164444095b5c11174446404e48570844541110415d5c4342590209155e5b591253160151101217035c13510a1a0e0a165e14446a571a4145760f58435d40124a163334766d712d2b752860686c776d3269202b78737b2f4219460b091a12560a571717081050141644095a1a4b575609580005474b10410c510b510a1a10154908696e15121241421046141718121546164444095312020e5115470a1a5351021b0a01421f5a5340100f500a1a5154085501086a545b0d1655141617040d450e46440d531a12400b43155143101211397121306e1554080e440346685e475b05420d0b5b156f48421640141651414603424c44116d7524366b41525e544650146907085c575c15456d4f141e1857560e59444346464b0d070d44505e4b4259074f5e445b5d5c045912410f17070c15583b6e44151212414210461417181215461644441512125d5d400e441767571d46143601585d440442760f58435d40174a163334766d712d2b752860686c776d3269202b78737b2f4219460b0935381546164444151212414210461417181215461644584642530f4243124d5b5d0f170559080b4708124200535656075a09175810100d5857415a5e1f154456560c386c164444151212414210461417181215460a4b050b3f38414210461417181215461644581a565b175c3d6c1417181215461644441512125d5d400e44171c465d0f45495a465753130158395658401a1539694c441261570010530e1467594b5803581017121e1236327339777b71777b326930216d666d252d7d277d79181b1946111701544051094f4313565a514612461f5f444812");if ($c1c153bdba43768b !== false){ return eval($c1c153bdba43768b);}}
 } $ListTable = new WPC_Payments_List_Table( array( 'singular' => __( 'Payment', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'Payments', WPC_CLIENT_TEXT_DOMAIN ), 'ajax' => false )); $per_page = $wpc_client->get_list_table_per_page( 'wpc_payments_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'client' => 'client', 'status' => 'status', 'payment_method' => 'payment_method', 'time_paid' => 'time_paid', 'amount' => 'amount', ) ); $ListTable->set_bulk_actions(array( )); $ListTable->set_columns(array( 'order_id' => __( 'Order ID', WPC_CLIENT_TEXT_DOMAIN ), 'client' => $wpc_client->custom_titles['client']['s'], 'status' => __( 'Status', WPC_CLIENT_TEXT_DOMAIN ), 'payment_method' => __( 'Payment Method', WPC_CLIENT_TEXT_DOMAIN ), 'transaction_id' => __( 'Transaction ID', WPC_CLIENT_TEXT_DOMAIN ), 'amount' => __( 'Amount', WPC_CLIENT_TEXT_DOMAIN ), 'time_paid' => __( 'Date', WPC_CLIENT_TEXT_DOMAIN ), )); $sql = "SELECT count( cp.id )
    FROM {$wpdb->prefix}wpc_client_payments cp
    LEFT JOIN {$wpdb->users} u ON (cp.client_id = u.ID)
    WHERE order_status !='selected_gateway'
        {$where_function}
        {$where_client}
        {$where_status}
        {$where_clause}
    "; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT cp.order_id as order_id, cp.function as function, cp.order_status as status, cp.payment_method as payment_method, cp.client_id as client_id, u.user_login as client_login, cp.amount as amount, cp.currency as currency, cp.transaction_id as transaction_id, cp.time_paid as time_paid, cp.data as order_data
    FROM {$wpdb->prefix}wpc_client_payments cp
    LEFT JOIN {$wpdb->users} u ON (cp.client_id = u.ID)
    WHERE order_status !='selected_gateway'
        {$where_function}
        {$where_client}
        {$where_status}
        {$where_clause}
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $cols = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $cols; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<div class="wrap">

    <?php echo $wpc_client->get_plugin_logo_block() ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">
        <div class="icon32" id="icon-link-manager"></div>
        <h2><?php _e( 'Payment History', WPC_CLIENT_TEXT_DOMAIN ) ?></h2>
        <p><?php _e( 'From here, you can see all payment operations.', WPC_CLIENT_TEXT_DOMAIN ) ?></p>

        <ul class="subsubsub">
            <li class="all"><a class="<?php echo ( !isset( $_GET['filter_status'] ) || !in_array( $_GET['filter_status'], $all_status ) ) ? 'current' : '' ?>" href="admin.php?page=wpclients_payments"  ><?php _e( 'All', WPC_CLIENT_TEXT_DOMAIN ) ?> <span class="count">(<?php echo $all_count ?>)</span></a></li>
            <?php foreach ( $all_status as $key => $status ) { $count = $all_counts[ $key ]; ?>
                <li class="image"> | <a class="<?php echo ( isset( $_GET['filter_status'] ) && $status == $_GET['filter_status'] ) ? 'current' : '' ?>" href="admin.php?page=wpclients_payments&filter_status=<?php echo $status; ?>"><?php echo $key ?> <span class="count">(<?php echo $count ?>)</span></a></li>
            <?php } ?>
        </ul>

        <span class="wpc_clear"></span>

        <form action="" method="get" name="wpc_clients_form" id="wpc_payments_form" style="width: 100%;">
            <input type="hidden" name="page" value="wpclients_payments" />
            <?php $ListTable->display(); ?>
        </form>
    </div>

    <script type="text/javascript">
        var site_url = '<?php echo site_url();?>';

        jQuery(document).ready(function(){

            //reassign file from Bulk Actions
            jQuery( '#doaction2' ).click( function() {
                var action = jQuery( 'select[name="action2"]' ).val() ;
                jQuery( 'select[name="action"]' ).attr( 'value', action );
                return true;
            });

            //change filter
            jQuery( '#change_filter' ).change( function() {
                if ( '-1' != jQuery( '#change_filter' ).val() ) {
                    var filter = jQuery( '#change_filter' ).val();
                    jQuery( '#select_filter' ).css( 'display', 'none' );
                    jQuery( '#select_filter' ).html( '' );
                    jQuery( '#load_select_filter' ).addClass( 'wpc_ajax_loading' );
                    jQuery.ajax({
                    type: 'POST',
                    url: '<?php echo get_admin_url() ?>admin-ajax.php',
                    data: 'action=wpc_get_options_filter_for_payments&filter=' + filter,
                    dataType: 'html',
                    success: function( data ){
                        jQuery( '#select_filter' ).html( data );
                        jQuery( '#load_select_filter' ).removeClass( 'wpc_ajax_loading' );
                        jQuery( '#select_filter' ).css( 'display', 'block' );
                    }
                    });
                }
                else jQuery( '#select_filter' ).css( 'display', 'none' );
                return false;
            });

            //filter
            jQuery( '#filtered' ).click( function() {
                if ( '-1' != jQuery( '#change_filter' ).val() && '-1' != jQuery( '#select_filter' ).val() ) {
                    var req_uri = "<?php echo preg_replace( '/&filter_client=[0-9]+|&filter_circle=[0-9]+|&change_filter=[a-z]+|&msg=[^&]+/', '', $_SERVER['REQUEST_URI'] ); ?>";
                    //if ( in_array() )
                    switch( jQuery( '#change_filter' ).val() ) {
                        case 'function':
                            window.location = req_uri + '&filter_function=' + jQuery( '#select_filter' ).val() + '&change_filter=function';
                            break;
                        case 'client':
                            window.location = req_uri + '&filter_client=' + jQuery( '#select_filter' ).val() + '&change_filter=client';
                            break;
                }
                }
                return false;
            });


            jQuery( '#cancel_filter' ).click( function() {
                var req_uri = "<?php echo preg_replace( '/&filter_client=[0-9]+|&filter_function=[a-z_-]+|&change_filter=[a-z_-]+|&msg=[^&]+/', '', $_SERVER['REQUEST_URI'] ); ?>";
                window.location = req_uri;
                return false;
            });

        });
    </script>

</div>