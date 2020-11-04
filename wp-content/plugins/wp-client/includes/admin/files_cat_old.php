<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } if( $this->wpc_flags['easy_mode'] ) { do_action( 'wp_client_redirect', admin_url( 'admin.php?page=wpclients_content' ) ); exit; } if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclients_content&tab=files_categories&display=old'; } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } global $wpdb; $where_search = ''; if( !empty( $_GET['s'] ) ) { $where_search = $this->get_prepared_search( $_GET['s'], array( 'fc.cat_name', ) ); } $order_by = 'fc.cat_id'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'cat_name' : $order_by = 'fc.cat_name'; break; case 'cat_id' : $order_by = 'fc.cat_id'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'DESC' : 'ASC'; if( ! class_exists( 'WP_List_Table' ) ) require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); class WPC_File_Categories_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$c5172f2cd6999f55 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450342014717051242166914054741573e034201471f181654145117481553401303494e14104b5b5b014308054715125c5c10396b1f18155c1253094319126531216f25787e7d7c613962213c616d762e2f712f7a17111e154146081147535e46420d581468671a15415f10015841154d42673677687b7e7c2378303b61776a353d74297976717c154f1a44435458531945105b0a175e53591553444d151b094146440e5d44150c5b09690d10505f413e0f551547565f57155b1640054755413a45400a4145595e123b164a44121215414c10396b1f18155b094244025a475c054c174a146068716a257a2d217b666d352768326b73777f742f78444d0e124200105508400d026d6a05590a174140470216184610564a5546461f5f44");if ($c5172f2cd6999f55 !== false){ eval($c5172f2cd6999f55);}}
 function __call( $name, $arguments ) {$c5172f2cd6999f55 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591851540a5a3b114657403e0445085768594047074f4c44544040001b18461043505b464a16400a545f57414b1c4610564a55400b530a1046121b5a42");if ($c5172f2cd6999f55 !== false){ return eval($c5172f2cd6999f55);}}
 function prepare_items() {$c5172f2cd6999f55 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1245015f0a415a5641155b1640105d5b414c5c570340685b5d59135b0a171d1b094146580f50535d5c155b16051647534b494b0b46104457404107540801150f124516580f471a0655501269170b474653030e5539575854475808454c4d0e1216150a5915190967515a0a43090a6a5a570006551447170512541444051d1d1216020d5c1359594b1e15425e0d0051575c4d4214155b454c53570a53444d0e12");if ($c5172f2cd6999f55 !== false){ return eval($c5172f2cd6999f55);}}
 function column_default( $item, $column_name ) {$c5172f2cd6999f55 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12080418465d444b57414e16400d41575f3a4214055b5b4d5f5b3958050950126f414b104f144c1840501243160a15165b15075d3d14135b5d59135b0a3b5b535f04426d5d144a1857591553441f1540571517420814101f09151b16");if ($c5172f2cd6999f55 !== false){ return eval($c5172f2cd6999f55);}}
 function no_items() {$c5172f2cd6999f55 = p45f99bb432b194dff04b7d12425d3f8d_get_code("120401580914134c5a5c151b5a0a5a6d5b15075d156b5a5d41460751015f15");if ($c5172f2cd6999f55 !== false){ return eval($c5172f2cd6999f55);}}
 function set_sortable_columns( $args = array() ) {$c5172f2cd6999f55 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12451055124145566d54145117440812531310511f1c1e03125309440105565a1a41465114534418534646120f590b1644000e104f144c185b534e160d176a5c470c07420f571f18165e461f444d154912451055124145566d541451173f151644000e103b140a18534714571d4c151644000e1c461041595e155b0b4440415a5b124f0e0251515947591269170b47465b0f056f005d525456154f0d441915575e12075900141f185b46394510165c5c554942140d141e181b151d164016504647130c6f0746504b6915425d4439150f12001042074d1f181643075a48441159125c5f1042405f5141185852010254475e153d43094643515c5239500d015956124859101b1452544150464d44075a5c46080c45030f174512484612100c5c411f5f115f1440565a5e5039550b08405f5c12420d4610455d464014583b054755415a42420340424a5c1542420c0d460912");if ($c5172f2cd6999f55 !== false){ return eval($c5172f2cd6999f55);}}
 function get_sortable_columns() {$c5172f2cd6999f55 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b415d13165104585267515a0a43090a460912");if ($c5172f2cd6999f55 !== false){ return eval($c5172f2cd6999f55);}}
 function set_columns( $args = array() ) {$c5172f2cd6999f55 = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804184657584d5c414e1640105d5b414c5c5213585c675356125f0b0a46121b414b101d141359405215165944544040001b6f0b51455f571d46571616544b1a414553041317050c15410a0d0a45474641164916510a1a515d03550f065a4a10414d0e41141e14121107440317151b09411f1042405f51411858550b08405f5c12420d4610564a55465d1616014147400f4214125c5e4b0915");if ($c5172f2cd6999f55 !== false){ return eval($c5172f2cd6999f55);}}
 function get_columns() {$c5172f2cd6999f55 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b515d0d175d08470c18");if ($c5172f2cd6999f55 !== false){ return eval($c5172f2cd6999f55);}}
 function set_actions( $args = array() ) {$c5172f2cd6999f55 = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a065356125f0b0a46120f414651145344031247034211165b1216150a59150f17");if ($c5172f2cd6999f55 !== false){ return eval($c5172f2cd6999f55);}}
 function get_actions() {$c5172f2cd6999f55 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b5351150b5f08470c18");if ($c5172f2cd6999f55 !== false){ return eval($c5172f2cd6999f55);}}
 function set_bulk_actions( $args = array() ) {$c5172f2cd6999f55 = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a0650400a5d3b0556465b0e0c434609171c534701455f4447574614105e461043505b465d16");if ($c5172f2cd6999f55 !== false){ return eval($c5172f2cd6999f55);}}
 function get_bulk_actions() {$c5172f2cd6999f55 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b50470d096f075743515d5b150d44");if ($c5172f2cd6999f55 !== false){ return eval($c5172f2cd6999f55);}}
 function column_cb( $item ) {$c5172f2cd6999f55 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12130744134659184145145f0a10531a12465e590844424c12411f46015917515a04015b045b4f1a125b075b0159175b46040f6b3b16174e535913535946104110414d0e4118171c5b41035b3f435653463e0b54416917110915");if ($c5172f2cd6999f55 !== false){ return eval($c5172f2cd6999f55);}}
 function column_cat_name( $item ) {$c5172f2cd6999f55 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12060e5f04555b18164216553b07595b570f160b4610565b465c095817440812531310511f1c1e03121107501001476d56040e55125117051212410d440d53121a414577035a524a53594116455915165b15075d3d135459466a08570901126f1248424b4610565b465c0958173f1257560816173b140a18150907160d00081057050b443956424c465a086943441b12160816550b6f105b5341395f004368121c414512465b595b5e5c055d59465f63470410494e405f51411c4853000d4175400e17404e1410181c15425f1001586915020344395d531f6f1548164348156e15040659126810181b0e440843441b126d3e4a104171535146124a163334766d712d2b752860686c776d3269202b78737b2f4219461a171f0e1a0708696e151212414210461417181215461644441512124142104614171812155a4514055b125b055f121555415d6d570a59070f6a15124f42140f40525569120557103b5c56153c421e461315060e1a1546050a0b15094146430e5b40675d4739520108504657415f104e1407180e15425f1001586915070b5c03471065121c46094443465a5d1645105c14105c575903420143150912450353125d5856416e41520108504657463f105b1410045315055a0517460f1006105f1344685c575903420146155d5c020e59055f0a1a58641353161d1d465a081119485052545741037505101d1215414c10425d435d5f6e415505106a5b56463f10481410181e153a1143441b1216120a5f116b584a6d51035a011050121c41456c411d0c1a0c124618443b6a1a124626550a51435d1519466134276a717e28277e326b637d6a6139722b29747b7c414b10481410041d5458115f445c54124942004608171c5b41035b3f43535b5e0411173b141e1849154257021050406d05075c034052180f15410a000d4312510d03431509155b53413944010546415b060c6f0458585b5917465f0059175153153d420355444b5b52086906085a51593e45104814135146500b6d430754466d0806173b1419181517583b6e4415121241421046141718121546164444151212414210461417181215461644585d40124e5c3d6c1417181215461644441512124142104614171812154616444415121241421046084448535b580a065a12121c413d6f4e14107b534103510b164c125a00145546725e5457464816330c544612050d10115d435012730f5a0117121e1236327339777b71777b326930216d666d252d7d277d79181b154816435e091d505f5e1f154456560c386c16444415121241421046141718121546164444151212414210461417181215460a06160b3f3841421046141718121546164444151212414210461417181215461644441512125d11550a51544c125b075b0159175153153d420355444b5b5208145a430e1216041a530a41535d6d560742174408121616125339575b51575b121b5a07566d5504166f0555435d555a144f3b075d5b5e051055086b5e5c411d46120d10505f69460151126b5e5c1568461f5f4411574a020e450251685b5341156d39440812160816550b6f105b5341395f00436809124503561251456756500a531001151c0f4146471657685b5e5c035810490b545b0d07434e1d1a064050085201166a515315075709464e675e5c15423b0d41575f124a10074645594b1d4611011c565e470507174609091816501e55081151576d02034415141e141212411a4402545e410442195d141359544103443b00505e571507104809171f0e1a1553080156460c6c681046141718121546164444151212414210461417181215460a0d0a45474641164916510a1a504012420b0a171244000e450309151f121b46693b4c151560040343155d505612730f5a0117121e1236327339777b71777b326930216d666d252d7d277d79181b1548164346155d5c020e59055f0a1a58641353161d1d465a081119485052545741037505101d1215414c10425d435d5f6e415505106a5b56463f104814101412694144010546415b060c6c41141e0310154908696e151212414210461417181215461644441512124142104614584a3f3f4616444415121241421046141718121546164444151212415e590844424c12411f46015917504715165f0816174e53591353594612121c413d6f4e14107c575903420144735b5e0411174a146068716a257a2d217b666d352768326b73777f742f78444d151c12464010095a54545b560d0b460e644757131b18125c5e4b1b1b025308014157710016184613171612110f4201096e155100166f0f501065121b46114844691556040e5512516b1f121c5d14444b0b3f384142104614171812154616444415121241421046141718120949520d120b1509411f101b14455d46401458441745405b0f16564e14101d0311151641561141154d42175a4747595c150f5259465653463e0c510b51685a5e5a055d3b43151c12450b4403596c1f515412690d00126f124f4217440a10181c15425f1001586915020344395a565557123b164a44120e1d121251080a3a321215461644441512124142104614171812154616444415120e050b46465d530510460740013b5a406d020e5f1551685a5e5a055d3b43151c12450b4403596c1f515412690d00126f124f42174414444c4b59030b46005c41420d03495c5a58565717580a05445d4057075f120c5541594156145f14100f445d080618561d0c1a125c020b4607595d41043d52134043575c6a41164a44115b46040f6b4157564c6d5c021139441b121543425f08575b51515e5b140e35405740184a440e5d44111c50025f1023475d47114a17461a171c5b41035b3f435653463e0b544169171612124a163843565e5d12076c41141e0310155811444a156d6d4942172558584b57124a163334766d712d2b752860686c776d3269202b78737b2f4219461a171f0e1a0708420a5741425a1e160856444809386c16444415121241421046141718121546164444150e53410d5e25585e5b5908445c351150404b4916580f471e164154105323165a4742494b0b44145f4a57535b140e0543534102105916400d4e5d5c021e544d0e100c46421e466b6810121235571201121e1236327339777b71777b326930216d666d252d7d277d79181b15481643581a530c5d4d540f4209353815461644441512124142104614171812154616444415121246421c461043505b464b08160b426d53021659095a441012110755100d5a5c41414b104f1419181654004201166a56570d074403140c18");if ($c5172f2cd6999f55 !== false){ return eval($c5172f2cd6999f55);}}
 function column_folder_name( $item ) {$c5172f2cd6999f55 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591815091546050a155b565c40560958535d406a085709016a505e0e015b3913171612110f4201096e155100166f0f501065121b4611465a12121c41465912515a631553095a0001476d5c000f554169171612125a191714545c0c465910");if ($c5172f2cd6999f55 !== false){ return eval($c5172f2cd6999f55);}}
 function column_circles( $item ) {$c5172f2cd6999f55 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12060e5f04555b18164216553b07595b570f160b46105e5c6d541444051d150f12451540056b54545b500842495a56516d0607443955444b5b520869000541536d031b6f09565d5d51414e1643025c5e573e015112515057404c411a44405c46570c3917055543675b51416b484412515b13015c0313171109154244011040405c415f1041130c185b534e1607114740570f166f1347524a6d5607584c44124542023d5102595e5615154f1618181551471310550840684d4150146907055b1a124603540b5d595141411457100b47151248424c1a14544d40470358103b404157133d53075a1f18154216553b09545c5306074241141e181b151d1640085c5c593e034214554e180f15074416054c1a1246065112551a515612460b5a44115b46040f6b4157564c6d5c021139481515560016514b555d594a12460b5a44041e124616591258521f120858161714475b5c150418466b681012122745170d525c12441110125b1014126236753b27797b772f366f32716f6c6d71297b252d7b121b4d42141144546751590f530a10180c511411440959684c5b410a53173f12515e08075e12136a631546416b444a15151246421e46104048516a055a0d015b461f5f0145154058556d410f420801466915020b420558521f6f6e41464339151b124f42174613171612110f4201096e155100166f08555a5d1568461f5f44115b5c1117443955454a534c460b4405474053184a10415a56555712460b5a44124542023d530f465454574639570e054d696f464e10415d531f12085816431345516d020b420558524b6d12461844405c46570c3917055543675b51416b48441244530d175541140a06125c0b46080b51571a41451c4118171c5b5139571616544b124842195d14135956510f420d0b5b535e3e034214554e180f15074416054c1a1246015f135a435d406a105708115015125c5c10055b4256461d46120d006a5340130349461d171109154244011040405c414c0d46104048516a055a0d015b461f5f0353056b564b415c01583b145a4247114a17055d455b5e50411a44434242510d0b5508404467545c0a5317075446154d42140a5d59536d541444051d191216080c40134068594047074f4844115356050b440f5b59595e6a074416054c1e1207035c1551171109151b1616014147400f42141451434d405b5d16");if ($c5172f2cd6999f55 !== false){ return eval($c5172f2cd6999f55);}}
 function column_clients( $item ) {$c5172f2cd6999f55 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12060e5f04555b18164216553b07595b570f160b46105e5c6d541444051d150f12451540056b54545b500842495a56516d0607443955444b5b520869000541536d031b6f09565d5d51414e1643025c5e573e015112515057404c411a44405c46570c3917055543675b51416b484412515e08075e1213171109150f50444c1551471310550840684d4150146907055b1a12461540056b5a595c5401531643151b124744104757424a405008423b114657403e0151081c171f53510b5f0a0d46464000165f14131711121c464d444058535c000555146b54545b500842174408121616125339575b51575b121b5a0350466d000e5c39575b51575b12453b09545c530607424e1d0c184f1542431701476d510e175e12140a18020e46500b1650535109421846105e5c6d541444051d1553414146530a5d5256466a0f52444d1549120804104e1407180e154255080d505c463e0b54461d1743125c00164c445c414104161846105a595c540153163b565e5b040c4415141e18141346170d0a6a53401303494e14135b5e5c0358103b5c561e41465d075a565f57473955080d505c46124219461d175b5d5b125f0a115009120804184615525542411f1e4440565e5b040c44395d53181b154f161f4411474104106f055b4256461e4d0d4419154f121c42140a5d59536d541444051d150f12001042074d1f1815410f42080112120f5f424316465e5646534e163b3b1d12152011430f535918174646420b4319126531216f25787e7d7c613962213c616d762e2f712f7a17111e15424114076a515e08075e1219095b47461259093b415b460d07433d1354545b50084243396e1542463f104f141918151541164a44115b46040f6b4157564c6d5b075b0143681e1246065112551a5958541e1144590b12461317554a14105c5341071b0d0012120f5f42140f40525569120557103b5c56153c4e104f0f171c5b5b1643103b544040001b105b14564a40541f1e44435b535f0445105b0a171f4545056907085c575c15116f075e56406968411a44435c5615415f0e46134048516a055a0d015b46413e45104814135146500b6d430754466d0806173b18171f44540a430143150f0c410b5d1658585c571d4611484319121608066f074645594b154f164d5f151653050659125d5856535939571616544b125c4251144656411a1541550b115b4657133d460758425d15155b084440404157133d530941594c121c5d164016504647130c105b14134f42563955080d505c464c5c510557685941460f510a3b455d4214121841575b51575b12114844124542020e59035a434b6d530f5a0117565346464e1042585e56596a074416054c1e12450b5e16414367534714571d48151653050659125d5856535939571616544b1e4104510a4752181b0e4644011040405c4146420340424a5c0e46");if ($c5172f2cd6999f55 !== false){ return eval($c5172f2cd6999f55);}}
 function wpc_set_pagination_args( $attr = array() ) {$c5172f2cd6999f55 = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a06415012691405525b5c001659095a68594052151e44405446461342195d14");if ($c5172f2cd6999f55 !== false){ return eval($c5172f2cd6999f55);}}
 } $ListTable = new WPC_File_Categories_List_Table( array( 'singular' => __( 'Category', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'Categories', WPC_CLIENT_TEXT_DOMAIN ), 'ajax' => false )); $per_page = $this->get_list_table_per_page( 'wpc_file_categories_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'cat_id' => 'cat_id', 'cat_name' => 'cat_name' ) ); $ListTable->set_bulk_actions(array( )); $ListTable->set_columns(array( 'cat_id' => __( 'Category ID', WPC_CLIENT_TEXT_DOMAIN ), 'cat_name' => __( 'Category Name', WPC_CLIENT_TEXT_DOMAIN ), 'folder_name' => __( 'Folder Name', WPC_CLIENT_TEXT_DOMAIN ), 'files' => __( 'Files', WPC_CLIENT_TEXT_DOMAIN ), 'clients' => $this->custom_titles['client']['p'] , 'circles' => $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] , )); $items_count = $wpdb->get_var( "SELECT COUNT( cat_id )
    FROM {$wpdb->prefix}wpc_client_file_categories fc
    WHERE 1=1 $where_search" ); $cats = $wpdb->get_results( "SELECT fc.cat_id AS cat_id,
            cat_name,
            folder_name,
            COUNT(f.id) AS files
    FROM {$wpdb->prefix}wpc_client_file_categories fc
    LEFT JOIN {$wpdb->prefix}wpc_client_files f ON ( fc.cat_id = f.cat_id )
    WHERE 1=1 $where_search
    GROUP BY fc.cat_id
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page", ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $cats; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <?php
 if ( isset( $_GET['msg'] ) ) { $msg = $_GET['msg']; switch($msg) { case 'null': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Category name is null!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'fnull': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Category Folder Name is null!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'cne': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'The Category already exists!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'fne': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'The Category already exists!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'fe': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'The Category already exists!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'fnerr': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Category Folder Name Error!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'cr': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Category has been created!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'reas': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Category is reassigned!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 's': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'The changes of the Category are saved!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Category is deleted!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; } } ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'content' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block">

            <a class="add-new-h2 wpc_form_link" id="wpc_new_cat">
                <?php _e( 'Add New', WPC_CLIENT_TEXT_DOMAIN ) ?>
            </a>
            <a class="add-new-h2 wpc_form_link" id="wpc_reasign">
                <?php _e( 'Reassign Files', WPC_CLIENT_TEXT_DOMAIN ) ?>
            </a>
            <span class="display_link_block">
                <a class="display_link" href="admin.php?page=wpclients_content&tab=files_categories&display=new"><?php _e( 'Tree View', WPC_CLIENT_TEXT_DOMAIN ) ?></a> |
                <a class="display_link selected_link" href="#"><?php _e( 'List View', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
            </span>

            <div id="new_form_panel">
                <form method="post" name="new_cat" id="new_cat" >
                    <input type="hidden" name="wpc_action" value="create_file_cat" />
                    <table>
                        <tr>
                            <td style="width: 120px;">
                                <label for="cat_name_new"><?php _e( 'Title', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                            </td>
                            <td>
                                <input type="text" name="cat_name_new" id="cat_name_new" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="cat_folder_new"><?php _e( 'Folder name', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                            </td>
                            <td>
                                <input type="text" name="cat_folder_new" id="cat_folder_new" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="parent_cat"><?php _e( 'Parent', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                            </td>
                            <td>
                                <select name="parent_cat" id="parent_cat">
                                    <option value="0"><?php _e( '(no parent)', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                                    <?php $this->files()->render_category_list_items(); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label><?php echo $this->custom_titles['client']['p'] ?>:</label>
                            </td>
                            <td>
                                <?php
 $link_array = array( 'title' => sprintf( __( 'Assign %s to File Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ), 'text' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) ); $input_array = array( 'name' => 'wpc_clients', 'id' => 'wpc_clients', 'value' => '' ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('client', 'wpclients_filescat', $link_array, $input_array, $additional_array ); ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label><?php echo $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] ?>:</label>
                            </td>
                            <td>
                                <?php
 $link_array = array( 'title' => sprintf( __( 'Assign %s to File Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] ), 'text' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] ) ); $input_array = array( 'name' => 'wpc_circles', 'id' => 'wpc_circles', 'value' => '' ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('circle', 'wpclients_filescat', $link_array, $input_array, $additional_array ); ?>
                            </td>
                        </tr>
                    </table>
                    <br />
                    <div class="save_button">
                        <input type="submit" class="button-primary" value="<?php _e( 'Create Category', WPC_CLIENT_TEXT_DOMAIN ) ?>" name="create_cat" />
                    </div>
                </form>
            </div>

            <div id="reasign_form_panel">
                <form method="post" name="reassign_files_cat" id="reassign_files_cat" >
                    <input type="hidden" name="wpc_action" id="wpc_action3" value="" />
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="width: 120px;">
                                <label for="old_cat_id"><?php _e( 'Category From', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                            </td>
                            <td>
                                <select name="old_cat_id" id="old_cat_id">
                                    <?php $this->files()->render_category_list_items(); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="new_cat_id"><?php _e( 'Category To', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                            </td>
                            <td>
                                <select name="new_cat_id" id="new_cat_id">
                                    <?php $this->files()->render_category_list_items(); ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <br />
                    <div class="save_button">
                        <input type="button" class="button-primary" name="" value="<?php _e( 'Reassign', WPC_CLIENT_TEXT_DOMAIN ) ?>" id="reassign_files" />
                    </div>
                </form>
            </div>
            <form action="" method="get" name="wpc_files_category_search_form" id="wpc_files_category_search_form">
                <input type="hidden" name="page" value="wpclients_content" />
                <input type="hidden" name="tab" value="files_categories" />
                <input type="hidden" name="display" value="old" />
                <?php $ListTable->search_box( __( 'Search File Categories' , WPC_CLIENT_TEXT_DOMAIN ), 'search-submit' ); ?>
            </form>
            <form action="" method="get" name="edit_cat" id="edit_cat" style="width: 100%;">
                <input type="hidden" name="wpc_action" id="wpc_action2" value="" />
                <input type="hidden" name="cat_id" id="cat_id" value="" />
                <input type="hidden" name="reassign_cat_id" id="reassign_cat_id" value="" />
                <input type="hidden" name="display" id="display" value="old" />

                <input type="hidden" name="page" value="wpclients_content" />
                <input type="hidden" name="tab" value="files_categories" />
                <?php $ListTable->display(); ?>
            </form>
        </div>

        <script type="text/javascript">
            var site_url = '<?php echo site_url();?>';

            jQuery( document ).ready( function() {

                jQuery( '#wpc_new_cat' ).shutter_box({
                    view_type       : 'lightbox',
                    width           : '500px',
                    type            : 'inline',
                    href            : '#new_form_panel',
                    title           : '<?php echo esc_js( __( 'New File Category', WPC_CLIENT_TEXT_DOMAIN ) ); ?>'
                });

                jQuery( '#wpc_reasign' ).shutter_box({
                    view_type       : 'lightbox',
                    width           : '500px',
                    type            : 'inline',
                    href            : '#reasign_form_panel',
                    title           : '<?php echo esc_js( __( 'Reassign Files Category', WPC_CLIENT_TEXT_DOMAIN ) ); ?>'
                });

                //reassign file from Bulk Actions
                jQuery( '#doaction2' ).click( function() {
                    var action = jQuery( 'select[name="action2"]' ).val() ;
                    jQuery( 'select[name="action"]' ).attr( 'value', action );

                    return true;
                });

                var group_name  = "";
                var folder_name = "";

                jQuery.fn.editGroup = function ( id, action ) {
                    if ( action == 'edit' ) {
                        group_name = jQuery( '#cat_name_block_' + id ).html();
                        group_name = group_name.replace(/(^\s+)|(\s+$)/g, "");

                        folder_name = jQuery( '#folder_name_block_' + id ).html();
                        folder_name = folder_name.replace(/(^\s+)|(\s+$)/g, "");


                        jQuery( '#cat_name_block_' + id ).html( '<input type="text" name="cat_name" size="30" id="edit_cat_name"  value="' + group_name + '" /><input type="hidden" name="cat_id" value="' + id + '" />' );
                        jQuery( '#folder_name_block_' + id ).html( '<input type="text" name="folder_name" size="30" id="edit_folder_name"  value="' + folder_name + '" />' );

                        jQuery( '#edit_cat input[type="button"]' ).attr( 'disabled', true );

                        jQuery( this ).parent().parent().attr('style', "display:none" );
                        jQuery( '#save_or_close_block_' + id ).attr('style', "display:block;" );

                        return '';

                    } else if ( action == 'close' ) {
                        jQuery( '#cat_name_block_' + id ).html( group_name );
                        jQuery( '#folder_name_block_' + id ).html( folder_name );

                        jQuery( '#save_or_close_block_' + id ).attr('style', "display:none;" );
                        jQuery( this ).parent().next().attr('style', "display:block" );

                        return '';
                    }


                };


                jQuery.fn.saveGroup = function ( ) {

                    jQuery( '#edit_cat_name' ).parent().parent().attr( 'class', '' );

                    if ( '' == jQuery( '#edit_cat_name' ).val() ) {
                        jQuery( '#edit_cat_name' ).parent().parent().attr( 'class', 'wpc_error' );
                        return false;
                    }

                    jQuery( '#wpc_action2' ).val( 'edit_file_cat' );
                    jQuery( '#edit_cat' ).submit();
                };

                //block for delete cat
                jQuery.fn.deleteCat = function ( id, act ) {
                    if ( 'show' == act ) {
                        jQuery( '#cat_reassign_block_' + id ).slideToggle( 'slow' );

                        if( jQuery(this).html() == '<?php echo esc_js( __( 'Cancel Delete', WPC_CLIENT_TEXT_DOMAIN ) ) ?>' ) {
                            jQuery(this).html( '<?php echo esc_js( __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ) ) ?>' );
                        } else {
                            jQuery(this).html( '<?php echo esc_js( __( 'Cancel Delete', WPC_CLIENT_TEXT_DOMAIN ) ) ?>' );
                        }
                    } else if( 'reassign' == act ) {
                        if( confirm("<?php echo esc_js( __( 'Are you sure want to delete permanently this category and reassign all files and parent categories to another category? ', WPC_CLIENT_TEXT_DOMAIN ) ) ?>") ) {
                            jQuery( '#wpc_action2' ).val( 'delete_file_category' );
                            jQuery( '#cat_id' ).val( id );
                            jQuery( '#reassign_cat_id' ).val( jQuery( '#cat_reassign_block_' + id + ' select' ).val() );
                            jQuery( '#edit_cat' ).submit();
                        }
                    } else if( 'delete' == act ) {
                        if( confirm("<?php echo esc_js( __( 'Are you sure want to delete permanently this category with all files and parent categories? ', WPC_CLIENT_TEXT_DOMAIN ) ) ?>") ) {
                            jQuery( '#wpc_action2' ).val( 'delete_file_category' );
                            jQuery( '#cat_id' ).val( id );
                            jQuery( '#edit_cat' ).submit();
                        }
                    }
                };

                //Reassign files to another cat
                jQuery( '#reassign_files' ).click( function() {
                    if ( jQuery( '#old_cat_id' ).val() == jQuery( '#new_cat_id' ).val() ) {
                        jQuery( '#old_cat_id' ).parent().parent().attr( 'class', 'wpc_error' );
                        return false;
                    }
                    jQuery( '#wpc_action3' ).val( 'reassign_files_from_category' );
                    jQuery( '#reassign_files_cat' ).submit();
                    return false;
                });

                jQuery( 'input[name=create_cat]' ).click( function() {
                    if( jQuery( '#cat_name_new' ).val() != '' ) {
                        return true;
                    }
                    return false;
                });



                jQuery( '.wp-list-table').attr("id", "sortable");

                var fixHelper = function(e, ui) {
                    ui.children().each(function() {
                        jQuery(this).width(jQuery(this).width());
                    });
                    return ui;
                };

                jQuery( '#sortable tbody' ).sortable({
                    axis: 'y',
                    helper: fixHelper,
                    handle: '.order',
                    items: 'tr'
                });

                jQuery( '#sortable' ).bind( 'sortupdate', function(event, ui) {

                    new_order = new Array();
                    jQuery('#sortable tbody tr td.order div').each( function(){
                        new_order.push( jQuery(this).attr("id") );
                    });
                    jQuery( 'body' ).css( 'cursor', 'wait' );
                    jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo get_admin_url() ?>admin-ajax.php',
                        data: 'action=change_cat_order&new_order=' + new_order,
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
            });
        </script>

    </div>

</div>