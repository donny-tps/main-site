<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } if( $this->wpc_flags['easy_mode'] ) { do_action( 'wp_client_redirect', admin_url( 'admin.php?page=wpclient_clients' ) ); exit; } if ( !( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) ) { do_action( 'wp_client_redirect', get_admin_url( 'index.php' ) ); exit; } global $wpdb; $where_clause = ''; if( !empty( $_GET['s'] ) ) { $where_clause = $this->get_prepared_search( $_GET['s'], array( 'u.user_login', 'u.user_email', 'u.user_nicename', ) ); } $include_managers = array(); if ( isset( $_GET['change_filter'] ) ) { if ( 'client' == $_GET['change_filter'] && isset( $_GET['filter_client'] ) ) { $client = $_GET['filter_client']; if ( is_numeric( $client ) && 0 < $client ) { $include_managers = $this->cc_get_client_managers( $client ); } } if ( 'circle' == $_GET['change_filter'] && isset( $_GET['filter_circle'] ) ) { $circle = $_GET['filter_circle']; if ( is_numeric( $circle ) && 0 < $circle ) { $include_managers = $this->cc_get_assign_data_by_assign( 'manager', 'circle', $circle ); } } } if ( count( $include_managers ) ) $include_managers = " AND u.ID IN ('" . implode( "','", $include_managers ) . "')"; else $include_managers = ''; $order_by = 'u.user_registered'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'username' : $order_by = 'u.user_login'; break; case 'nickname' : $order_by = 'u.user_nicename'; break; case 'email' : $order_by = 'u.user_email'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Managers_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$cf21aced3bbf1e9a = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450342014717051242166914054741573e034201471f181654145117481553401303494e14104b5b5b014308054715125c5c10396b1f18155c1253094319126531216f25787e7d7c613962213c616d762e2f712f7a17111e154146081147535e46420d581468671a15415f10015841154d42673677687b7e7c2378303b61776a353d74297976717c154f1a44435458531945105b0a175e53591553444d151b094146440e5d44150c5b09690d10505f413e0f551547565f57155b1640054755413a45400a4145595e123b164a44121215414c10396b1f18155b094244025a475c054c174a146068716a257a2d217b666d352768326b73777f742f78444d0e124200105508400d026d6a05590a174140470216184610564a5546461f5f44");if ($cf21aced3bbf1e9a !== false){ eval($cf21aced3bbf1e9a);}}
 function __call( $name, $arguments ) {$cf21aced3bbf1e9a = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591851540a5a3b114657403e0445085768594047074f4c44544040001b18461043505b464a16400a545f57414b1c4610564a55400b530a1046121b5a42");if ($cf21aced3bbf1e9a !== false){ return eval($cf21aced3bbf1e9a);}}
 function prepare_items() {$cf21aced3bbf1e9a = p45f99bb432b194dff04b7d12425d3f8d_get_code("1245015f0a415a5641155b1640105d5b414c5c570340685b5d59135b0a171d1b094146580f50535d5c155b16051647534b494b0b46104457404107540801150f124516580f471a0655501269170b474653030e5539575854475808454c4d0e1216150a5915190967515a0a43090a6a5a570006551447170512541444051d1d1216020d5c1359594b1e15425e0d0051575c4d4214155b454c53570a53444d0e12");if ($cf21aced3bbf1e9a !== false){ return eval($cf21aced3bbf1e9a);}}
 function column_default( $item, $column_name ) {$cf21aced3bbf1e9a = p45f99bb432b194dff04b7d12425d3f8d_get_code("12080418465d444b57414e16400d41575f3a4214055b5b4d5f5b3958050950126f414b104f144c1840501243160a15165b15075d3d14135b5d59135b0a3b5b535f04426d5d144a1857591553441f1540571517420814101f09151b16");if ($cf21aced3bbf1e9a !== false){ return eval($cf21aced3bbf1e9a);}}
 function no_items() {$cf21aced3bbf1e9a = p45f99bb432b194dff04b7d12425d3f8d_get_code("120401580914134c5a5c151b5a0a5a6d5b15075d156b5a5d41460751015f15");if ($cf21aced3bbf1e9a !== false){ return eval($cf21aced3bbf1e9a);}}
 function set_sortable_columns( $args = array() ) {$cf21aced3bbf1e9a = p45f99bb432b194dff04b7d12425d3f8d_get_code("12451055124145566d54145117440812531310511f1c1e03125309440105565a1a41465114534418534646120f590b1644000e104f144c185b534e160d176a5c470c07420f571f18165e461f444d154912451055124145566d541451173f151644000e103b140a18534714571d4c151644000e1c461041595e155b0b4440415a5b124f0e0251515947591269170b47465b0f056f005d525456154f0d441915575e1207100f521f185b46394510165c5c554942140d141e181b151d164016504647130c6f0746504b6915425d4439150f12001042074d1f181643075a48441159125c5f1042405f5141185852010254475e153d43094643515c5239500d015956124859101b1452544150464d44075a5c46080c45030f174512484612100c5c411f5f115f1440565a5e5039550b08405f5c12420d4610455d464014583b054755415a42420340424a5c1542420c0d460912");if ($cf21aced3bbf1e9a !== false){ return eval($cf21aced3bbf1e9a);}}
 function get_sortable_columns() {$cf21aced3bbf1e9a = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b415d13165104585267515a0a43090a460912");if ($cf21aced3bbf1e9a !== false){ return eval($cf21aced3bbf1e9a);}}
 function set_columns( $args = array() ) {$cf21aced3bbf1e9a = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804184657584d5c414e1640105d5b414c5c5213585c675356125f0b0a46121b414b101d141359405215165944544040001b6f0b51455f571d46571616544b1a414553041317050c15410a0d0a45474641164916510a1a515d03550f065a4a10414d0e41141e14121107440317151b09411f1042405f51411858550b08405f5c12420d4610564a55465d1616014147400f4214125c5e4b0915");if ($cf21aced3bbf1e9a !== false){ return eval($cf21aced3bbf1e9a);}}
 function get_columns() {$cf21aced3bbf1e9a = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b515d0d175d08470c18");if ($cf21aced3bbf1e9a !== false){ return eval($cf21aced3bbf1e9a);}}
 function set_actions( $args = array() ) {$cf21aced3bbf1e9a = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a065356125f0b0a46120f414651145344031247034211165b1216150a59150f17");if ($cf21aced3bbf1e9a !== false){ return eval($cf21aced3bbf1e9a);}}
 function get_actions() {$cf21aced3bbf1e9a = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b5351150b5f08470c18");if ($cf21aced3bbf1e9a !== false){ return eval($cf21aced3bbf1e9a);}}
 function set_bulk_actions( $args = array() ) {$cf21aced3bbf1e9a = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a0650400a5d3b0556465b0e0c434609171c534701455f4447574614105e461043505b465d16");if ($cf21aced3bbf1e9a !== false){ return eval($cf21aced3bbf1e9a);}}
 function get_bulk_actions() {$cf21aced3bbf1e9a = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b50470d096f075743515d5b150d44");if ($cf21aced3bbf1e9a !== false){ return eval($cf21aced3bbf1e9a);}}
 function column_cb( $item ) {$cf21aced3bbf1e9a = p45f99bb432b194dff04b7d12425d3f8d_get_code("12130744134659184145145f0a10531a12465e590844424c12411f46015917515a04015b045b4f1a125b075b0159175b46040f6b3b16174e535913535946104110414d0e4118171c5b41035b3f435c56153c42195d14");if ($cf21aced3bbf1e9a !== false){ return eval($cf21aced3bbf1e9a);}}
 function column_auto_add_clients( $item ) {$cf21aced3bbf1e9a = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804184613061f12085b16400d41575f3a4551134058675351026907085c575c1511173b141e1840501243160a156d6d4942173f51441f1e153166273b767e7b242c6439607260666a227929257c7c124859100358445d1247034211165b126d3e4a10417a581f1e153166273b767e7b242c6439607260666a227929257c7c12485910");if ($cf21aced3bbf1e9a !== false){ return eval($cf21aced3bbf1e9a);}}
 function column_clients( $item ) {$cf21aced3bbf1e9a = p45f99bb432b194dff04b7d12425d3f8d_get_code("12060e5f04555b18164216553b07595b570f160b461054545b500842174408121616125339575b51575b121b5a07566d5504166f07474451555b39520510546d50183d5f045e525b461d461109055b53550410174a14135146500b6d430d51156f4d421705585e5d5c4141164d5f1516510d0b55084044675b5115165944565d470f1618461054545b50084217441c0912450e59085f68594047074f44591553401303494e14104c5b410a534344080c121212420f5a435e1a1539694c44127341120b570814124b1241091148446262713e217c2f71796c6d61236e303b717d7f202b7e461d1b18164216553b07595b570f161d5857424b465a0b69100d415e5712391705585e5d5c41416b3f4345156f414b104814101815154816400d41575f3a4545155145565358031139481515560016514b555d594a12460b5a44414047044e104150564c53180f524344080c12450b4403596c1f5b51416b48441c0912450b5e16414367534714571d440812531310511f1c171f5c540b534344080c12461540056b54545b500842173b54585319396d4118171f5b514116595a15154511016f05585e5d5c41156943441b12160816550b6f105156123b1a444343535e140717460909185b58165a0b00501a12464e174a14135b5e5c03581017151b124859104255535c5b410f590a05596d531310511f140a18534714571d4c1515510e175e1251456744540a430143150f0c4146530a5d52564646395f0017151b0941465812595b180f15424114076a515e08075e121909595156395717175c555c3e125f1641471015560a5f010a41151e41454716575b51575b12453b09545c5306074215131b1816590f580f3b544040001b1c46105e5642401269051647534b4d421407505351465c095805086a53401303494a1451595e4603164d5f1540571517420814135046580a0d44");if ($cf21aced3bbf1e9a !== false){ return eval($cf21aced3bbf1e9a);}}
 function column_circles( $item ) {$cf21aced3bbf1e9a = p45f99bb432b194dff04b7d12425d3f8d_get_code("12060e5f04555b18164216553b07595b570f160b461054545b5008423b03475d471111105b14134f42563955080d505c464c5c53056b505d466a0745170d525c6d050344076b55416d5a045c0107411a12460f510855505d40124a16400d41575f3a455902136a141212055f1607595715414b0b46105457475b12165944565d470f1618461054545b5008423b03475d471111104f0f171c5e5c085d3b0547405318420d4655454a534c4e1643005446534c0b5441140a0612110f4201096e155b05456d4a14105c5341071b050e544a15415f0e46051b1815410f42080112120f5f424316465e5646534e163b3b1d12152011430f535918174646420b4319126531216f25787e7d7c613962213c616d762e2f712f7a17111e15424114076a515e08075e1219095b47461259093b415b460d07433d1354545b50084243396e1541463f104814101815154816401345516d020e59035a43150c561345100b586d4608165c03476c1f515c14550801126f694612173b141e181c15411643441b12160816550b6f104d41501458050950156f414b0b46105e5642401269051647534b415f10074645594b1d46110a05585715415f0e46134048516a055f16075957413e035a074c6c65151946110d0012120f5f421711445467515c14550801466d15414c10425d435d5f6e415f0043681e124614510a41521f120858160d09455e5d05071846131b1f1e154255080d505c463e05420941474b121c461f5f44115356050b440f5b59595e6a074416054c120f41034214554e1012120559110a4157403e14510a41521f1208581640075a475c1542195d14135046580a165944114542023d530a5d52564618585707076a5341120b57086b47574240161e43075c40510d07174a14104f42560a5f010a41416d0c035e0753524a41124a1640085c5c593e034214554e1412110f581411416d531310511f18171c5351025f100d5a5c530d3d51144656411e150057081750121b5a42420340424a5c15425e1009590912");if ($cf21aced3bbf1e9a !== false){ return eval($cf21aced3bbf1e9a);}}
 function column_username( $item ) {$cf21aced3bbf1e9a = p45f99bb432b194dff04b7d12425d3f8d_get_code("12060e5f04555b18164216553b07595b570f160b4610565b465c09581744081216090b54036b565b465c095817440812531310511f1c1e0312110755100d5a5c413a4555025d431f6f155b16435854125a1307565b16565c5f5c0818140c450d420005555b43475b5e5c0358103b565e5b040c441512435950080b570a05525740123d55025d431e5b515b11444a15165b15075d3d135e5c156846184443170c15414c10396b1f181570025f104319126531216f25787e7d7c613962213c616d762e2f712f7a17111c15410a4b050b15094146580f5052675356125f0b0a4669151612533957564853570f5a0d104c156f415f10410856185a4703505946164542023d530744565a5b590f421d4615565315031d0f500a1a15154816400d41575f3a455902136a181c15416943441b125f05571846134048516a0b570a0552574046421e4667727b676723692531617a6d32237c32141918165c1253093f125b56463f104f14191815174655080546410f431451145d584d416a05571405575b5e08165903471506151548163b3b1d1215280c540f425e5c47540a162705455350080e59125d524b1519466134276a717e28277e326b637d6a6139722b29747b7c414b10481410041d5458115f445c541249421101514367474603443b095046534942140f40525569120f52433919121516125339405255425a1457161d6a42531211470946531f1e1512441101151b1248424b46105f515650395707105c5d5c1239171144546746500b463b14544141160d4202136a180f15410a05445a5c510d0b530d096b1f40501243160a15515d0f045914591f1a151548161714475b5c150418466b681012122259441d5a471216035e12144357125807440f44415a574112511547405740514657174441575f110d4207464e18545a1416100c5c411244110f4118176f62763975282d707c663e36753e60687c7d78277f2a441c1e12451540056b54545b500842495a564741150d5d39405e4c5e50156d4309545c5306074241696c1f41123b164d441b1215434b0b3a13171f121b46110c1650540f4303540b5d5916425d1609140552570f1612530a5d5256466a055a0d015b464147165104095a595c5401531617135351150b5f0809435d5f453946051746455d1306160f500a1f121b46120d10505f69460b54416917161212406913145b5d5c02070d411419184545395516015446573e0c5f0857521012120b570a055257403e16550b446848534615410b165115124f42140f40525569120f524339151c120607443957424a405008423b114657403e0b544e1d1711121b41145a43151c123e3d184613645d461536571717425d400542511514635d5f45094405164c151e413560256b74747b7028623b30706a663e267f2b757e76121c46184443091d535f450b4649175154154e16450d464157154a10425d435d5f6e41420d09506d4004115508501065121c464a18441d12160816550b6f104c5b580369160146575c05456d461f170b0405561c5657151b125d42440f5952101b154f161f44115a5b05076f075743515d5b156d431345516d130743035a536745500a550b0950156f415f10410856185d5b055a0d075e0f6e4610551241455612560958020d475f1a434510481468671a1541771601154b5d144243134652184b5a131613055b4612150d1034511a6b575b0216330159515d0c0710235956515e0a411a443365716d222e79237a636766703e623b207a7f73282c104f14191815174f0d3843155a4004040d445553555b5b48460c140a425306070d114454545b5008423b07595b570f16434040565a0f5807580503504041470353125d58560f460358003b42575e020d5d0312424b5747395f005912121c41465912515a63155c021139441b1215473d47165a585651505b11444a1545423e01420355435d6d5b095807011d121516125339465267415008523b13505e510e0f5541141918165c1253093f125b56463f104814505d466a05431616505c463e174303466851561d4f164d441b15105f4510481468671a154164014966575c054267035854575f50467309055c5e154d42673677687b7e7c2378303b61776a353d74297976717c154f164a44120e1d005c175d144a1857591553441f15165a0806553955544c5b5a08453f434242513e10551551595c6d42035a070b5857153c420d46130b4b42540816100d415e575c4017461a174b42470f5810021d126d3e4a1041635651461507440b115b56124411100e5b424a41150059164447571f12075e02145e4c1c124a163334766d712d2b752860686c776d3269202b78737b2f42194a144557475b021e444c151a12450b4403596c1f465c0b533b165041570f06173b141c18010356064e5601121b414f10125d5a5d1a1c461f444b1501045152104f141e181c1541145a43151c123e3d184613655d1f660358004462575e020d5d03147255535c0a1148446262713e217c2f71796c6d61236e303b717d7f202b7e461d171612125a191714545c0c4659101b1413505b5103690507415b5d0f116b415052545741031139440812155d03100558564b4108445201085046573e0353125d5856101502571005185c5d0f01555b1610181c1511463b0747575315076f085b595b571d46111314566d5f000c510151456756500a53100112121c41465912515a63155c021139441b125504166f0541454a575b1269111750406d0806184f141e181c15411444005446534c0b545b1610181c15425f10015869150806173b1419181517465e1601530f100b03460747544a5b45120c44125a5b564952195d16091f121b46693b4c151576040e5512511014126236753b27797b772f366f32716f6c6d71297b252d7b121b414c10410818590c125d16400c5c56573e0353125d585641155b160514455e4b3e04590a40524a411d46111314566d510d0b55084068555d4703690507415b5d0f116f0b55595955501445434815165a0806553955544c5b5a0845444d0e125b074a10055b4256461d46120c0d51576d0001440f5b594b121c461f441f151653021659095a4463154216553b0556465b0e0c434169170512111146073b565e5b040c444b0a5a574050395707105c5d5c124a10425d435d5f6e415f0043681e123e3d184613765b465c0958174319126531216f25787e7d7c613962213c616d762e2f712f7a17111e15425e0d00506d53021659095a44181b0e464b4416504647130c10154445515c41001e43410416414147024247101412125a4514055b125b055f1205585e5d5c4139431701475c530c076f41141918165c1253093f125b56463f104814101a0c12461844405c46570c39171347524a5c540b534339151c12465e1f154456560c124a1640105d5b414c5c420943685951410f590a171d12160001440f5b594b121c461f5f44");if ($cf21aced3bbf1e9a !== false){ return eval($cf21aced3bbf1e9a);}}
 function extra_tablenav( $which ){$cf21aced3bbf1e9a = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804104e14104c5d4541165959151645090b530e141e184915015a0b06545e1245154002561b18164216553b07595b570f160b461056545e6a005f08105040125c4251144656411a15424114076a515e08075e1219095b47461259093b415b460d07433d1354545b50084243396e1541463f105b0a171f51590f530a10121e12451540056b54545b500842495a564741150d5d39405e4c5e50156d43075c40510d07173b6f104b1568460b5a4412515b13015c03131b181b0e46120508596d55130d451647170512541444051d1d1b094146510a58685b5b47055a01176a55400e174015140a181642165206490b5557153d420347425446464e164637707e772236100146584d426a0f52484452405d14126f08555a5d1273347929444e16451106524b0a474a57530f4e191345516d020e59035a4367554709431417171e1243236234756e677317461f5f44535d400403530e141f1816540a5a3b075c40510d074339534557474515160517151644000e4503141e184915425708086a55400e1740156f171c44540a43013f1255400e1740395d531f6f153b1659441144530d17553d13504a5d4016690a055857153c59101b1408063f3f6b3c4444151212414210461417180e510f404407595341125f1207585e5f5c5903501044545146080d5e15160935381546164444151212414210461417181209155308015646120f035d0309155b5a540851013b535b5e15074244145e5c0f17055e050a52576d070b5c1251451a1246124f08010810540d0d51120e17545753120d465a383812414210461417181215461644441512124142105a5b474c5b5a081612055947575c401d571617040d450e46440d531a12400b43155143101211397121306e155109035e0151685e5b591253164368121b411e4c46155e566d541444051d1d12163e2575326f105b5a540851013b535b5e15074241691b1816540a5a3b025c5e460410104f141e1857560e59444346575e04014403501003120a5808585b455a42413d554e14106b575903551044735b5e1507424118176f62763975282d707c663e36753e60687c7d78277f2a441c120d5f5e1f094443515d5b583b6e44151212414210461417181215461644441512125d5d400e443a32125309440105565a1249421407585b67545c0a42011615534141465b034d17050c1542421d14506d54080e4403461711124e4612170159575115075446091710125c154501101d12163e2575326f105b5a540851013b535b5e150742416917111213401640104c42573e04590a40524a12085b16403b7277663a45530e55595f576a005f08105040153c4219460b171f1246035a010741575646420a46131018091503550c0b15150e0e12440f5b591844540a4301591715124f4214124d475d6d530f5a100147121c414512411419181646035a0107415756414c104114091f091503550c0b151659041b0b465154505d15410a4b0b45465b0e0c0e410f1745120a583b6e44151212414210461417181215461644581a41570d0753120a3a32121546164444151212414210461417180e46035a010741125c000f555b16445d5e5005423b025c5e46041012465d53051046035a0107416d54080e440346151841411f5a015917545e0e03445c145b5d54415d16585b455a42410b56461c17195b461553104c15166d2627643d135450535b01533b025c5e460410173b141e184e4946170d0a6a53401303494e1413677570326d43075d535c06076f005d5b4c5747416b484411535e0d3d560f58435d40154f164d4450515a0e4217025d44485e541f0c440a5a5c575a450b460b091a0c386c16444415121241421046141718121546164444150e0d110a406b3e175154154e160d174657464942143973726c6912055e050a52576d070b5c1251451f6f154f164d444e125b074218461354545b5008424344080f12453d7723606c1f515d075803016a545b0d165514136a181413465f171750461a41466f2171636315530f5a1001476d510d0b5508401065121c461f441f1516470f0b411351685b5e5c03581017150f12451540056b54545b500842495a56516d0607443955444b5b520869000541536d031b6f09565d5d5141395717175c555c4942170b55595955501411484412515e08075e1213171109155908696e383812414210461417181215461644441512124142104614171812154616444415120e0e12440f5b591844540a430159171f0343420c59445f48125c00164c44145b5c3e034214554e101211397121306e1554080e440346685b5e5c03581043681e1245175e0f45425d6d560a5f010a414112484219465154505d15414501085051460406175d1408060c0959460c14154240080c44001c17676d1d4611370159575115421515131b186565256927287c777c353d64236c6367767a2b772d2a151b1e4146471657685b5e5c035810490b514712165f0b6b4351465903453f43565e5b040c4441696c1f41123b164d440a0c0e4e0d40125d58560c386c3b6e4415121241421046141718121546164444151212414210461417181215461644580a425a11425900141f185b4639571616544b1a414645085d464d576a055a0d015b4641414b1040121708120946550b115b461a414645085d464d576a055a0d015b4641414b104f145157405007550c4c1516470f0b411351685b5e5c035810171553414146530a5d5256466a0f52444d1549120804104e14101f12145b164007595b570f166f0f501711124e46121701595751150754460917101211055a0d015b466d0806105b09171c6d7223623f43535b5e15074239575b51575b121139441c120d4145430358525b46500211445e1515155a4255055c581815090946100d5a5c1217035c13510a1a151548164007595b570f166f0f5017161212441643441b121612075c0357435d5615481643440b15124f42570340684d415014520510541a1245015c0f51594c6d5c02164d490b474104106f0a5b50515c15481643581a5d42150b5f080a10031248464b441915575e12075900141f1815560f4407085015125c5f10426b707d666e41550c055b55573e04590a40524a1568461042445c41410416184610687f77613d11020d594657133d530f46545457123b164d441c1249414645085d464d576a055f1607595741415f104243475b6d560a5f010a411f0c02016f015143675346155f030a6a565315036f044d6857505f0355103b54414108055e4e141055535b07510116121e1246015914575b5d15154f0d4440545e5e3e015914575b5d416a01440b114541125c42141144535a1f0b0153103b475741140e44151c171a61702a7327301555400e1740395d53141252145911146a5c530c071020667875124e42411400571f0c111055005d4f454545056907085c575c153d57145b424841174a164625676073383d7144141e03125309440105565a1249421407585b67515c14550801466d55130d451647175941154240050840571248424b461056545e6a01440b114541694146460758425d691201440b11456d5b05456d4669170512111057081150691506105f1344685653580311395f154f125e5c3d6c393d1812154616444415121241421046141718121546164444151212414210461417045d45125f0b0a1544530d17555b161a0910155a09140c45125b07421846155e566d541444051d1d12163e2575326f105e5b591253163b565b40020e5541691b181640085f1511506d510810530a5144181b154f1601075d5d124611550a51544c5751410d445b0b0c0e5e12581614474a5b5b12504c446a6d1a4145630358525b461543454348156562223d732a7d7276666a32733c306a767d2c237928141e1412111146073b565e5b040c444b0a544d4141095b3b105c465e04116b41575e4a51590311393f1241153c4219460b09041d5a16420d0b5b0c3f6b6f3a46141718121546164444151212414210461417181215461644441512124142105a0b475042150059160154515a494214135a5e49475039550d16565e571242511514135b5b47055a013b5c561248424b4610445d5e5005420100150f12494214055d455b5e50395f0044080f12453d7723606c1f545c0a4201166a515b13015c03136a181b1559164317505e57021655021317021212410d4401565a5d41450c094443515d5b4640050840570f4345104814135b5b47055a013b5c56124f4217441410181c1542450108505146040610481410180c1246184440545e5e3e05420941474b691542550d16565e573e0b544669171612125a190b14415b5d0f5c175d144a184f151b165b5a3838124142104614171812154616444415120e4e11550a51544c0c386c164444151212414210461417181215460a1714545c1208060d44585859566a1553080156466d070b5c1251451a1246124f08010810540d0d51120e17545753120d465a091d4111035e58393d18121546164444151212414210461417045b5b16431044414b42045f120441434c5d5b441617104c5e575c40560a5b564c08150a5302100e101217035c13510a1a0e0a165e14446a571a4145760f58435d40124a163334766d712d2b752860686c776d3269202b78737b2f4219460b091a12560a571717081050141644095a1a4b575609580005474b10410b545b1651515e410344010017125c000f555b1615181d0b6b3c44441512124142104614171812154616580515515e0011435b16565c5618085313495d001202035e05515b67545c0a42011617125b055f120555595b575939500d08415740434243124d5b5d0f175a09140c45125b074a10475d444b57414e16403b7277663a45560f58435d406a0743100c5a40153c4b10401217195b461553104c15166d2627643d1351515e4103443b07595b570f16173b1d171e1415475f171750461a453d7723606c1f545c0a4201166a515b13015c03136a11121c4653070c5a1215050b4316585641081508590a010e1509415d0e440a3a321215461644441512124142104614171812154616585b455a42413d554e14106a575809400144735b5e1507424118176f62763975282d707c663e36753e60687c7d78277f2a441c120d5f6f3a46141718121546164444151212414210461417180e4616570a4446464b0d070d445758545d475c16470656025051000b440a114c5b5803455f581a4142000c0e6b3e171812154616444415121241421046140b17530b6b3c4444151212414210461417180e1a025f125a38383f6b421046141718121546164444090d4209121042405f5141185845010547515a3e005f1e1c174b42470f5810021d126d3e4a104167525940560e164117121e1236327339777b71777b326930216d666d252d7d277d79181b1946121314566d510d0b5508401a06514015420b096a465b150e55156f1055535b07510116126f694612173b141e14121215530516565a1f1217520b5d431f121c5d161944");if ($cf21aced3bbf1e9a !== false){ return eval($cf21aced3bbf1e9a);}}
 function wpc_set_pagination_args( $attr = array() ) {$cf21aced3bbf1e9a = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a06415012691405525b5c001659095a68594052151e44405446461342195d14");if ($cf21aced3bbf1e9a !== false){ return eval($cf21aced3bbf1e9a);}}
 } $ListTable = new WPC_Managers_List_Table( array( 'singular' => $this->custom_titles['manager']['s'], 'plural' => $this->custom_titles['manager']['p'], 'ajax' => false )); $per_page = $this->get_list_table_per_page( 'wpc_managers_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'username' => 'username', 'nickname' => 'nickname', 'email' => 'email', ) ); $ListTable->set_bulk_actions(array( 'temp_password' => __( 'Set Password as Temporary', WPC_CLIENT_TEXT_DOMAIN ), 'send_welcome' => __( 'Re-Send Welcome Email', WPC_CLIENT_TEXT_DOMAIN ), 'delete' => __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ), )); $ListTable->set_columns(array( 'cb' => '<input type="checkbox" />', 'username' => __( 'Username', WPC_CLIENT_TEXT_DOMAIN ), 'nickname' => __( 'Nickname', WPC_CLIENT_TEXT_DOMAIN ), 'email' => __( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ), 'auto_add_clients' => sprintf( __( 'Auto-Add %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ), 'clients' => $this->custom_titles['client']['p'], 'circles' => $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'], )); $sql = "SELECT count( u.ID )
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%\"wpc_manager\"%'
        {$where_clause}
        {$include_managers}
    "; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT u.ID as id, u.user_login as username, u.user_nicename as nickname, u.user_email as email, um2.meta_value as auto_add_clients, um3.meta_value as time_resend
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id AND um2.meta_key = 'wpc_auto_assigned_clients'
    LEFT JOIN {$wpdb->usermeta} um3 ON ( u.ID = um3.user_id AND um3.meta_key = 'wpc_send_welcome_email' )
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%\"wpc_manager\"%'
        {$where_clause}
        {$include_managers}
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $managers = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $managers; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), stripslashes_deep( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=managers'; } switch ( $ListTable->current_action() ) { case 'delete': $clients_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_manager_delete' . $_REQUEST['id'] . get_current_user_id() ); $clients_id = (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['manager']['p'] ) ); $clients_id = $_REQUEST['item']; } if ( count( $clients_id ) && ( current_user_can( 'wpc_archive_clients' ) || current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) ) { foreach ( $clients_id as $client_id ) { if( is_multisite() ) { wpmu_delete_user( $client_id ); } else { wp_delete_user( $client_id ); } } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; break; case 'temp_password': $managers_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'manager_temp_password' . $_REQUEST['id'] . get_current_user_id() ); $managers_id = ( is_array( $_REQUEST['id'] ) ) ? $_REQUEST['id'] : (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['manager']['p'] ) ); $managers_id = $_REQUEST['item']; } foreach ( $managers_id as $manager_id ) { $this->set_temp_password( $manager_id ); } if( 1 < count( $managers_id ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'pass_s', $redirect ) ); } else if( 1 === count( $managers_id ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'pass', $redirect ) ); } else { do_action( 'wp_client_redirect', $redirect ); } exit; case 'send_welcome': $managers_id = array(); if ( isset( $_REQUEST['user_id'] ) ) { check_admin_referer( 'wpc_re_send_welcome' . $_REQUEST['user_id'] . get_current_user_id() ); $managers_id = ( is_array( $_REQUEST['user_id'] ) ) ? $_REQUEST['user_id'] : (array) $_REQUEST['user_id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['manager']['p'] ) ); $managers_id = $_REQUEST['item']; } if ( count( $managers_id ) ) { foreach ( $managers_id as $manager_id ) { $this->resend_welcome_email( $manager_id ); } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'wel', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; break; default: if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), stripslashes_deep( $_SERVER['REQUEST_URI'] ) ) ); exit; } break; } ?>

<div class="wrap">
    <?php echo $this->get_plugin_logo_block() ?>
    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'clients' ) ?>
        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block">
            <?php if ( isset( $_GET['msg'] ) ) { $msg = $_GET['msg']; switch( $msg ) { case 'a': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Added</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ) . '</p></div>'; break; case 'u': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Updated</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ) . '</p></div>'; break; case 'wel': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'Re-Sent Email for %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ) . '</p></div>'; break; case 'pass': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'The password marked as temporary for %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ) . '</p></div>'; break; case 'pass_s': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'The passwords marked as temporary for %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['p'] ) . '</p></div>'; break; } } ?>

            <a class="add-new-h2" href="admin.php?page=wpclient_clients&tab=managers_add"><?php _e( 'Add New', WPC_CLIENT_TEXT_DOMAIN ) ?></a>

            <form action="" method="get" name="wpc_clients_form" id="wpc_managers_form" style="width: 100%;">
                <input type="hidden" name="page" value="wpclient_clients" />
                <input type="hidden" name="tab" value="managers" />
                <?php $ListTable->display(); ?>
            </form>
        </div>

        <script type="text/javascript">
            var site_url = '<?php echo site_url();?>';

            jQuery(document).ready(function(){
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


                jQuery('#wpc_managers_form').submit(function() {
                    if( jQuery('select[name="action"]').val() == 'delete' ) {
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
                            window.location = '<?php echo admin_url(); ?>admin.php?page=wpclient_clients&tab=managers&action=delete' + item_string + '&_wpnonce=' + nonce + '&' + jQuery('#delete_user_settings').serialize() + '&_wp_http_referer=' + encodeURIComponent( jQuery('input[name=_wp_http_referer]').val() );
                        }
                    } else {
                        window.location = '<?php echo admin_url(); ?>admin.php?page=wpclient_clients&tab=managers&action=delete&id=' + user_id + '&_wpnonce=' + nonce + '&' + jQuery('#delete_user_settings').serialize() + '&_wp_http_referer=<?php echo urlencode( stripslashes_deep( $_SERVER['REQUEST_URI'] ) ); ?>';
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
                            data: 'action=wpc_get_options_filter_for_managers&filter=' + filter,
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
                        switch( jQuery( '#change_filter' ).val() ) {
                            case 'client':
                                window.location = req_uri + '&filter_client=' + jQuery( '#select_filter' ).val() + '&change_filter=client';
                                break;
                            case 'circle':
                                window.location = req_uri + '&filter_circle=' + jQuery( '#select_filter' ).val() + '&change_filter=circle';
                                break;
                    }
                    }
                    return false;
                });


                jQuery( '#cancel_filter' ).click( function() {
                    var req_uri = "<?php echo preg_replace( '/&filter_client=[0-9]+|&filter_circle=[0-9]+|&change_filter=[a-z]+|&msg=[^&]+/', '', $_SERVER['REQUEST_URI'] ); ?>";
                    window.location = req_uri;
                    return false;
                });


                //open view Capabilities
                jQuery('.various_capabilities').each( function() {
                    var id = jQuery( this ).data( 'id' );

                    jQuery(this).shutter_box({
                        view_type       : 'lightbox',
                        width           : '300px',
                        type            : 'ajax',
                        dataType        : 'json',
                        href            : '<?php echo get_admin_url() ?>admin-ajax.php',
                        ajax_data       : "action=wpc_get_user_capabilities&id=" + id + "&wpc_role=wpc_manager",
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
                        data: 'action=wpc_update_capabilities&id=' + id + '&wpc_role=wpc_manager&capabilities=' + JSON.stringify(caps),
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