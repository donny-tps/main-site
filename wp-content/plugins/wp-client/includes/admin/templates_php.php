<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) && !current_user_can( 'wpc_view_shortcode_templates' ) && !current_user_can( 'wpc_edit_shortcode_templates' ) ) { do_action( 'wp_client_redirect', get_admin_url( 'index.php' ) ); } $can_edit = ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) || current_user_can( 'wpc_edit_shortcode_templates' ) ) ? true : false; function wpc_get_diff_templates( $template_slug = '', $temp_dir = '' ) {$c0d07b508a6fe9e3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12060e5f04555b18164216553b07595b570f160b465d51181a1547530914414b1a41464403594754534103691708405512484219464f171c45450569170c5a4046020d54036b435d5f450a571001150f12451540056b54545b500842495a56516d0607443947524c465c0851174c151541090d421257585c576a12530914595346043d17461a171c46500b46080541576d120e4501141e03121102543b10505f420d034403140a1815125d164010505f420d0344036b5e5c12084612100158425e00165539475b4d55154816433b515b54073d40094442486d570a59070f1209124516550b445b5946501569000d47120f414a10411317190f1542420109456d560810104f1408181641035b143b515b404158104243475b6d560a5f010a411f0c110e45015d5967565c14164a44125b5c020e450251441746500b4608054157414e450b465d51181a15035b14104c1a12451540056b44505d4712550b00506d46040f400a55435d121c461f441f155b54414a10005d5b5d6d501e5f1710461a124516550b445b5946501569000d47121c414644035947545341036917084055124f42174840475415154f164d444e121605006f12515a485e541253445915545b0d076f01514367515a0842010a41411a41464403594754534103453b005c40124f421412515a485e5412533b17594755414c10411a43485e12461f5f4448124f41075c15511743121102543b10505f420d034403140a18164216553b175d5d4015015f0251684c5758165a05105009121c425900141f18545c0a533b014d5b411511184610435d5f450a571001466d560810104814134c5758165a0510506d410d1757461a171f1c41165a43441c121b41191042525e54576a1253091459534604420d46525e54576a0153103b565d5c15075e12471f181641035b1408544657123d540f461716121112530914595346043d430a4150181c15411810145915124859101b1452544150464d4440535b5e043d4403594754534103165944121509411f100956684b465414424c4d0e120d5f6f3a6b3e171812154616444409565b174259020915040d450e464401565a5d41464403594754534103690d00150d0c434243124d5b5d0f17025f171459534b5b425e095a520312420f52100c0f1203515700164c0c1a0c386c16444415121241421046141704565c101607085441415c40400947435a5d4d46520646154146180e555b1651545d54120c44085054465a425d074650515c0f460754144d0912160b54125c0d18070556461c5f170c3f6b421046141718121546164444151212415e585514444c4b59030b46074040410e100a4650525e53400a425f44455356050b5e010e1700424d4606445c454a125912485d1609040d450e46443b501a12463b5f1346176c5758165a051050151e413560256b74747b7028623b30706a663e267f2b757e76121c46095a5e091d5a525c3d6c14171812154616444415121241421046085e5642401216101d45570f43004512405856101510570811500f105d5d400e441767571d4611311451534604451c4663677b6d762a7f212a616d66243a6439707875737c28164d440a0c1041015c0747440510571342100b5b1f42130b5d07464e184745025710016a46570c125c0740521a121a583b6e441512124142104614171812154616445841574a1503420355175b5e541545594651506d15075d1658564c5717580a5b145d42120401580914135c506a1253091459534604420f5808184c574d12571601540c3f6b421046141718121546164444091d5608140e6b3e1718121546164444151212415e540f42175b5e5415455946455d4115005f1e1451515e50441617104c5e575c40560a5b564c08150a5302100e125f0010570f5a0d180305164e5f44425b56150a0a46010708424d5d145a693f121241421046141718121546164444150e5a524243124d5b5d0f17054316175a400841065500554254460e46460500515b5c0658105e444f1802155e461c440d424a5a400e5a0b4750421539534c441276570703450a40176c5758165a051050151e413560256b74747b7028623b30706a663e267f2b757e76121c46095a5e091d5a525c3d6c1417181215461644441512124142104608435d4a410744010515515e0011435b1651515e5039420109455e5315071246465259565a085a1d5917405700065f08584e1a12510f4505065957565c40540f47565a5e5002145a580a425a114255055c581816530f5a013b41575f110e51125117070c094942011c41534004030e6b3e1718121546164444151212415e1f025d41063f3f4616444415121241421046140b5a40154908696e1512124142104614171812155a520d1215515e0011435b164757414104591c44565d5f1103420316174b464c0a535946535e5d00160a4658525e460e465b0516525b5c5b420156444f0312420f52100c0f1203515000164c0c1a0c386c164444151212414210461417181215460a0c57154146180e555b16544d404609445e4451575400175c120f17485351025f0a030f120a111a1056140f484a155e461c5f170c0e5e12581614685d1a1541750b0945534004451c4663677b6d762a7f212a616d66243a6439707875737c28164d440a0c085d4d58550a3a32121546164444151212414210461417180e510f404407595341125f12055b5a4853470369100158425e001655440a0b17565c1008696e1512124142104614171812155a19000d430c3f6b421046141718121546164444095040414d0e6b3e1718121546164444151212415e52141418063f3f46164444151212415e1f025d41063f3f6b3c44441512124142105a0b475042386c16400a50456d020d5e1251594c12084659063b5257463e015f0840525646464e1f5f445c541a410d523953524c6d59035803105d1a1b414b101d14585a6d5008523b075957530f4a195d144a1840501243160a15165c04156f055b594c575b120d441915575e1207101d14455d4640145844431209121c42");if ($c0d07b508a6fe9e3 !== false){ return eval($c0d07b508a6fe9e3);}}
 if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclients_templates&tab=php_templates'; } if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Shortcode_Templates_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $columns = array(); var $bulk_actions = array(); var $template_tags = array(); function __construct( $args = array() ){$c0d07b508a6fe9e3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450342014717051242166914054741573e034201471f181654145117481553401303494e14104b5b5b014308054715125c5c10396b1f181561035b1408544657464e103164746771792f732a306a667739366f227b7a797b7b461f484412425e1410510a1317050c1539694c441266570c125c0740524b1519466134276a717e28277e326b637d6a6139722b29747b7c414b1c46135652534d4116595a1546401407104f141e031211125e0d17180c5c0e3d5912515a4b6d58034517055257125c42140746504b6912165a1116545e153c421e4613171f121b46693b4c15155c0e1610005b4256561b411a443365716d222e79237a636766703e623b207a7f73282c104f0f174853470358105e0f6d6d020d5e1540454d51414e164005475541414b0b46");if ($c0d07b508a6fe9e3 !== false){ eval($c0d07b508a6fe9e3);}}
 function __call( $name, $arguments ) {$c0d07b508a6fe9e3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591851540a5a3b114657403e0445085768594047074f4c44544040001b18461043505b464a16400a545f57414b1c4610564a55400b530a1046121b5a42");if ($c0d07b508a6fe9e3 !== false){ return eval($c0d07b508a6fe9e3);}}
 function prepare_items() {$c0d07b508a6fe9e3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1245015f0a415a5641155b1640105d5b414c5c570340685b5d59135b0a171d1b094146580f50535d5c155b16051647534b494b0b46104457404107540801150f124516580f471a0655501269170b474653030e5539575854475808454c4d0e1216150a5915190967515a0a43090a6a5a570006551447170512541444051d1d1216020d5c1359594b1e15425e0d0051575c4d4214155b454c53570a53444d0e12");if ($c0d07b508a6fe9e3 !== false){ return eval($c0d07b508a6fe9e3);}}
 function column_default( $item, $column_name ) {$c0d07b508a6fe9e3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12080418465d444b57414e16400d41575f3a4214055b5b4d5f5b3958050950126f414b104f144c1840501243160a15165b15075d3d14135b5d59135b0a3b5b535f04426d5d144a1857591553441f1540571517420814101f09151b16");if ($c0d07b508a6fe9e3 !== false){ return eval($c0d07b508a6fe9e3);}}
 function no_items() {$c0d07b508a6fe9e3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("120401580914134c5a5c151b5a0a5a6d5b15075d156b5a5d41460751015f15");if ($c0d07b508a6fe9e3 !== false){ return eval($c0d07b508a6fe9e3);}}
 function set_sortable_columns( $args = array() ) {$c0d07b508a6fe9e3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12451055124145566d54145117440812531310511f1c1e03125309440105565a1a41465114534418534646120f590b1644000e104f144c185b534e160d176a5c470c07420f571f18165e461f444d154912451055124145566d541451173f151644000e103b140a18534714571d4c151644000e1c461041595e155b0b4440415a5b124f0e0251515947591269170b47465b0f056f005d525456154f0d441915575e1207100f521f185b46394510165c5c554942140d141e181b151d164016504647130c6f0746504b6915425d4439150f12001042074d1f181643075a48441159125c5f1042405f5141185852010254475e153d43094643515c5239500d015956124859101b1452544150464d44075a5c46080c45030f174512484612100c5c411f5f115f1440565a5e5039550b08405f5c12420d4610455d464014583b054755415a42420340424a5c1542420c0d460912");if ($c0d07b508a6fe9e3 !== false){ return eval($c0d07b508a6fe9e3);}}
 function get_sortable_columns() {$c0d07b508a6fe9e3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b415d13165104585267515a0a43090a460912");if ($c0d07b508a6fe9e3 !== false){ return eval($c0d07b508a6fe9e3);}}
 function get_columns() {$c0d07b508a6fe9e3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b515d0d175d08470c18");if ($c0d07b508a6fe9e3 !== false){ return eval($c0d07b508a6fe9e3);}}
 function set_actions( $args = array() ) {$c0d07b508a6fe9e3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a065356125f0b0a46120f414651145344031247034211165b1216150a59150f17");if ($c0d07b508a6fe9e3 !== false){ return eval($c0d07b508a6fe9e3);}}
 function get_actions() {$c0d07b508a6fe9e3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b5351150b5f08470c18");if ($c0d07b508a6fe9e3 !== false){ return eval($c0d07b508a6fe9e3);}}
 function set_bulk_actions( $args = array() ) {$c0d07b508a6fe9e3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a0650400a5d3b0556465b0e0c434609171c534701455f4447574614105e461043505b465d16");if ($c0d07b508a6fe9e3 !== false){ return eval($c0d07b508a6fe9e3);}}
 function get_bulk_actions() {$c0d07b508a6fe9e3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b50470d096f075743515d5b150d44");if ($c0d07b508a6fe9e3 !== false){ return eval($c0d07b508a6fe9e3);}}
 public function single_row( $item ) {$c0d07b508a6fe9e3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1245015c0747445d41155b1643430e125b0742184615175d5f45124f4c44115b46040f6b4140565f41123b164d441c124941464407534467534714571d4408125719125c0950521012124a114844115b46040f6b4140565f41123b164d5f15545d130751055c17101211125703176a53401303494655441816410751444d15491245015c0747445d4115480b4417545c5b150b4a036b43514659031e4410475b5f494214125550181b154f164a44126d46000510410f174512484653070c5a12155d164246575b5941465b1443441b1216020e511547524b121b4611465a1209124516580f471a06415c085108016a405d163d53095842555c464e16400d41575f414b0b465154505d15410a4b10470c155a42");if ($c0d07b508a6fe9e3 !== false){ return eval($c0d07b508a6fe9e3);}}
 function set_columns( $args = array() ) {$c0d07b508a6fe9e3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804184657584d5c414e1640105d5b414c5c5213585c675356125f0b0a46121b414b101d141359405215165944544040001b6f0b51455f571d46571616544b1a414553041317050c15410a0d0a45474641164916510a1a515d03550f065a4a10414d0e41141e14121107440317151b09411f1042405f51411858550b08405f5c12420d4610564a55465d1616014147400f4214125c5e4b0915");if ($c0d07b508a6fe9e3 !== false){ return eval($c0d07b508a6fe9e3);}}
 function column_template( $item ) {$c0d07b508a6fe9e3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450353125d585641155b16051647534b494b0b465d511012110f4201096e15570f0640095d594c6d510f444339150f0f41465912515a6315510f444339151b121a4214075743515d5b156d43125c57453e16550b445b594650416b445915150e00425814515105105f0740051756405b11160a46425851561d561f5f460b15124f426f391c171f645c03414430505f420d034403131b186565256927287c777c353d64236c6367767a2b772d2a151b124f42175a1b5606150e46120507415b5d0f116b415758484b6a12593b105d575f04456d4609171f0e54465e1601530f100b03460747544a5b45120c44125a5b564952195d16091f121b46693b4c1515710e124946405818665d035b0144715b4004014409464e1f1e153166273b767e7b242c6439607260666a227929257c7c1248421e46130b17530b410d441915575e1207101d14135951410f590a176e1557050b443940525542590742014368120f41450c07145f4a57535b140e0543534102105916400d18445a0f524c541c09105f4510481468671a154173000d411266040f400a55435d1519466134276a717e28277e326b637d6a6139722b29747b7c414b10481410041d5458115f44115351150b5f08476c1f56500a531001126f125c42175a5517504050000b460e5444531201420f4443021243095f004c051b09435c17461a17676d1d46112001595746044264035947545341031602165a5f12350a550b51177c5b470355100b474b154d42673677687b7e7c2378303b61776a353d74297976717c154f164a44120e1d005c175d144a1840501243160a15150e050b4646575b5941465b14100158425e001655395d54575c150257170c5c515d0f1110411419181a15425f1001586915040c54165b5e56466a025f164368120f5c42140f4052556912025f164368120d41455407475f51515a0845490950565b004f540352564d5e41465116014c15125b4217025544505b560958174942575e020d5d0319404a5b41031b06085a55120e10510853521f121c4618444317123f6b4210461417181215125f1008500f1046421e461c171c5b41035b3f43505c56110d590840685c5b47416b44590812160816550b6f105c5b47416b445b156d6d49421732515a485e54125344175c46470016550214564c12450a43030d5b12560810174a146068716a257a2d217b666d352768326b73777f742f78444d1508123e3d184613635d5f450a57100115415b15175112515318534146420c01585712050b424655595c125607584406501257050b444118176f62763975282d707c663e36753e60687c7d78277f2a441c121b414c1041163a321215461644441512560016514b58585b596a125f1008500f1046421e466b68101212325309145953460442430f40425946500216051015425e1405590814535140124a163334766d712d2b752860686c776d3269202b78737b2f4219461a171f10156b3c4444151212414210025543591f40085a0b075e6d4608165c0309151f121b46693b4c151566040f400a55435d12460f42110541575641034446405f5d5f5046520d1615535c054253075a175a571503520d10121e1236327339777b71777b326930216d666d252d7d277d79181b15481643460b0e1d050b4658393d18121546164444150e5608141015404e5457084450080b5446080d0756120f405156410e0c070559511a41530056111715120156461c441c09105f6f3a4614171812154616581745535c41015c07474405104216553b175d5d4015015f0251684c5758165a0510501012050344071959595f505b1443441b12160816550b6f105e5b590358050950156f414c104116175c5341071b1405415a0f4345104814135146500b6d431454465a463f104814101a1215463b6e44151212414210461417181251074205495b5d5c02070d44131716124216690716505346043d5e095a545d1a15425f10015869151103440e136a181c15425f1001586915070b5c035a565557123b164d441b1215435c17461a171c5b41035b3f43415b460d07173b1419181509494514055b0c1246421e461043505b464b08160b426d53021659095a441012110755100d5a5c41414b10481410041d510f405a430e12");if ($c0d07b508a6fe9e3 !== false){ return eval($c0d07b508a6fe9e3);}}
 function column_description( $item ) {$c0d07b508a6fe9e3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1245015f0840525646155b1643430e125b0742184615175d5f45124f4c44115b46040f6b4140565f41123b164d441c124941464407534467534714571d4408125719125c0950521012124a114844115b46040f6b4140565f41123b164d5f15545d130751055c17101211125703176a53401303494655441816410751444d15491245165101140a1846470f5b4c441146530642195d14135b5d5b12530a10151c0f41450c025d41185159074517591746570c125c07405267465401691005575e57434254074056154654010b4643151c1212035e0f405e42576a125f1008501a1245165101141e181c1541145a43151c1245165101141918150949520d120b1509411f101b14455d464014584443094142000c1015404e5457084450080b5446080d0756120f54545754140c060b415a09160b54125c0d090205430d465a12121c41465912515a631551034507165c4246080d5e4169171612125a191714545c0c5d0659101454545346150b4610545541434243124d5b5d0f17005a0b05410840080558120f54545754140c060b415a090c0342015d5915465a160c53144d09105f45104814135b5d5b12530a10151c12465e1f025d4106150e46");if ($c0d07b508a6fe9e3 !== false){ return eval($c0d07b508a6fe9e3);}}
 function wpc_set_pagination_args( $attr = array() ) {$c0d07b508a6fe9e3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a06415012691405525b5c001659095a68594052151e44405446461342195d14");if ($c0d07b508a6fe9e3 !== false){ return eval($c0d07b508a6fe9e3);}}
 function extra_tablenav( $which ) {$c0d07b508a6fe9e3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804104e14104c5d4541165959151645090b530e141e1849155908696e1512124142104614171812155a520d1215515e0011435b1656545b52085a0102411253021659095a441a0c386c164444151212414210461417181215460a000d4312510d03431509154c5758165a0510506d460005100757435144504416000541531f1503575b1615060e0a165e14446a571a4145710a581014126236753b27797b772f366f32716f6c6d71297b252d7b121b415d0e5a1b5351440b6b3c44441512124142104614171812154616585b455a4241045f1451565b5a154e1640105d5b414c5c44035947545341036910055241120011104240565f121c464d445b0b3f3841421046141718121546164444151212414210460853514415055a0517460f1015075d1658564c576a1257034615565315031d12555005100959460c14155751090d1015555951465c1c533b105c465e044a104240565f121c46095a460b0e0d110a40465154505d1542420503150d0c5d4d540f42093538154616444415121241421046141718120959460c14154f125e5c3d6c1417181215461644441512125d4d540f4209353815461644441512125d5d400e44174512");if ($c0d07b508a6fe9e3 !== false){ return eval($c0d07b508a6fe9e3);}}
 } $ListTable = new WPC_Shortcode_Templates_List_Table(); $per_page = 99999; $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'template' => 'template', ) ); $ListTable->set_columns(array( 'template' => __( 'Template Name', WPC_CLIENT_TEXT_DOMAIN ), 'description' => __( 'Description', WPC_CLIENT_TEXT_DOMAIN ) )); $wpc_shortcodes_array = $this->get_php_templates(); if ( ! empty( $_GET['s'] ) ) { $wpc_shortcodes_array = array_filter( $wpc_shortcodes_array, function( $innerArray ) {$c0d07b508a6fe9e3 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450c5503505b5d120846451016415d5e0e1555141c174c405c0b1e44406a757735391715136a181b154f0d440d53121a4143100359474c4b1d46120d0a5b5740201042074d6c1f465c125a014368121b414b101d145e5e121d46451016455d41494243124643575e5a1153164c15165b0f0c551475454a534c3d11100d415e57463f104f18171c5c5003520801151b12405f0d465256544150464a1844464640110d434e14444c4041095a0b1350401a414659085a524a734714571d3f1256571201420f4443515d5b416b444d1912160f0755025852181b15470b594453535e1207104f144c1840501243160a15165b0f0c551475454a534c5d1619444812");if ($c0d07b508a6fe9e3 !== false){ return eval($c0d07b508a6fe9e3);}}
); } $tags = array(); foreach ( $wpc_shortcodes_array as $php_template ) { if ( ! empty( $php_template['tags'] ) ) { foreach ( explode( ',', $php_template['tags'] ) as $tag ) { $tags[] = trim( $tag ); } } } $ListTable->template_tags = array_unique( $tags ); $ListTable->prepare_items(); $ListTable->items = array_slice( $wpc_shortcodes_array, ( $paged - 1 ) * $per_page, $per_page ); $ListTable->wpc_set_pagination_args( array( 'total_items' => count( $wpc_shortcodes_array ), 'per_page' => $per_page ) ); ?>

<style type="text/css">
    .dashicons.grey {
        color: #cfcfcf;
    }

    .dashicons.orange {
        color: #d54e21;
    }

    .template_icon {
        float:left;
        width:30px;
        line-height:30px;
        font-size:24px;
        margin-right:10px;
    }

    .column-description {
        width:65%;
    }
</style>
<script type="text/javascript" language="javascript">
    jQuery(document).ready(function($) {
        var lock_unlock = {};

        jQuery('body').on('click', ".template_tag", function() {
            var tag = jQuery(this).data('tag');
            var disp_arr;
            if ( tag == '' ) {
                clear_hash();
                jQuery(".template_tag").removeClass('active');
                var tag_rows = jQuery( 'table.templates tbody tr' );
                tag_rows.show();

                disp_arr = jQuery( '.displaying-num' ).html().split(' ');
                disp_arr[0] = tag_rows.length;
                jQuery( '.displaying-num' ).html( disp_arr.join(' ') );
                jQuery( this ).toggleClass('active');
                return;
            }

            jQuery('.template_tag[data-tag=""]').removeClass('active');
            jQuery( this ).toggleClass('active');
            jQuery( 'table.templates tbody tr' ).hide();
            hash_data = {};

            if ( ! jQuery('.template_tag.active').length ) {
                jQuery('.template_tag[data-tag=""]').trigger('click');
                return;
            }

            jQuery('.template_tag.active').each( function(e) {
                var tag = jQuery(this).data('tag');
                var tag_rows;

                tag_rows = jQuery( 'table.templates tbody tr.' + tag + '_tag' );
                hash_data[tag] = 1;
                tag_rows.show();
            });

            window.location.hash = get_hash_string();

            disp_arr = jQuery( '.displaying-num' ).html().split(' ');
            disp_arr[0] = jQuery('table.templates tbody tr:visible').length;
            jQuery( '.displaying-num' ).html( disp_arr.join(' ') );
        });


        //click at tag in table
        jQuery(".template_tag_table").click( function() {
            var tag = jQuery(this).data('tag');

            if ( ! jQuery('.template_tag.active[data-tag="' + tag + '"]').length )
                jQuery('.template_tag[data-tag="' + tag + '"]').trigger('click');
        });

        function init_view_template() {
            $('.wp-list-table .view_template a:not(.inited)').each( function() {
                var name = $(this).closest('.row-actions').siblings('.wpc_shortcode_template').data('name'),
                    path = $(this).closest('.row-actions').siblings('.wpc_shortcode_template').data('path'),
                    nonce = $(this).closest('.row-actions').siblings('.wpc_shortcode_template').data('nonce'),
                    $obj = $(this);

                $(this).addClass('inited');

                $(this).shutter_box({
                    view_type       : 'lightbox',
                    width           : '10000px',
                    height          : '10000px',
                    type            : 'ajax',
                    dataType        : 'json',
                    href            : '<?php echo get_admin_url() ?>admin-ajax.php',
                    ajax_data       : {
                        action : 'wpc_shortcode_templates',
                        operation : 'view_template',
                        filename : name,
                        path : path,
                        nonce : nonce
                    },
                    setAjaxResponse : function( data ) {
                        if( data.success ) {
                            $('.sb_lightbox_content_title').text(name);
                            $('.sb_lightbox_content_body').css('position', 'relative').html($('.wpc_template_form').html());
                            $('.sb_lightbox_content_body').find('.wpc_save_template').hide();
                            $('.sb_lightbox_content_body').find('.remove_from_theme').hide();
                            $('.sb_lightbox_content_body').find('.wpc_template_content').prop('disabled', true)
                                .data( 'name', name )
                                .data( 'path', path )
                                .data( 'nonce', nonce )
                                .val( data.data.content );
                        } else {
                            alert( data.data[0].message );
                        }
                    },
                    afterClose : function() {
                        if ( lock_unlock.hasOwnProperty(name)  ) {
                            if ( lock_unlock[name] == 'lock' ) {
                                jQuery('.wpc_shortcode_template[data-name="' + name + '"]').siblings('.row-actions').html(
                                    '<span class="view_template"><a href="javascript: void(0);"><?php _e( 'View Template', WPC_CLIENT_TEXT_DOMAIN ) ?></a> | </span>' +
                                    '<span class="copy_to_theme"><a href="javascript: void(0);"><?php _e( 'Copy to Theme Directory', WPC_CLIENT_TEXT_DOMAIN ) ?></a></span>'
                                );
                                init_view_template();
                            } else if ( lock_unlock[name] == 'unlock' ) {
                                jQuery('.wpc_shortcode_template[data-name="' + name + '"]').siblings('.row-actions').html(
                                    '<span class="edit_template"><a href="javascript: void(0);"><?php _e( 'Edit Template', WPC_CLIENT_TEXT_DOMAIN ) ?></a> | </span>' +
                                    '<span class="delete"><a href="javascript: void(0);"><?php _e( 'Delete Template from Theme Directory', WPC_CLIENT_TEXT_DOMAIN ) ?></a></span>'
                                );
                                init_edit_template();
                            }
                        }
                    }
                });
            });
        }

        function init_edit_template() {
            $('.wp-list-table .edit_template a:not(.inited)').each( function() {
                var name = $(this).closest('.row-actions').siblings('.wpc_shortcode_template').data('name'),
                    path = $(this).closest('.row-actions').siblings('.wpc_shortcode_template').data('path'),
                    nonce = $(this).closest('.row-actions').siblings('.wpc_shortcode_template').data('nonce'),
                    $obj = $(this);

                $(this).addClass('inited');

                $(this).shutter_box({
                    view_type       : 'lightbox',
                    width           : '10000px',
                    height          : '10000px',
                    type            : 'ajax',
                    dataType        : 'json',
                    href            : '<?php echo get_admin_url() ?>admin-ajax.php',
                    ajax_data       : {
                        action : 'wpc_shortcode_templates',
                        operation : 'edit_template',
                        filename : name,
                        path : path,
                        nonce : nonce
                    },
                    setAjaxResponse : function( data ) {
                        if( data.success ) {
                            $('.sb_lightbox_content_title').text(name);
                            $('.sb_lightbox_content_body').css('position', 'relative').html($('.wpc_template_form').html());
                            $('.sb_lightbox_content_body').find('.copy_to_theme').hide();
                            $('.sb_lightbox_content_body').find('.wpc_template_content')
                                .data( 'name', name )
                                .data( 'path', path )
                                .data( 'nonce', nonce ).val( data.data.content );
                        } else {
                            alert( data.data[0].message );
                        }
                    },
                    afterClose : function() {
                        if ( lock_unlock.hasOwnProperty(name)  ) {
                            if ( lock_unlock[name] == 'lock' ) {
                                jQuery('.wpc_shortcode_template[data-name="' + name + '"]').siblings('.row-actions').html(
                                    '<span class="view_template"><a href="javascript: void(0);"><?php _e( 'View Template', WPC_CLIENT_TEXT_DOMAIN ) ?></a> | </span>' +
                                    '<span class="copy_to_theme"><a href="javascript: void(0);"><?php _e( 'Copy to Theme Directory', WPC_CLIENT_TEXT_DOMAIN ) ?></a></span>'
                                );
                                init_view_template();
                            } else if ( lock_unlock[name] == 'unlock' ) {
                                jQuery('.wpc_shortcode_template[data-name="' + name + '"]').siblings('.row-actions').html(
                                    '<span class="edit_template"><a href="javascript: void(0);"><?php _e( 'Edit Template', WPC_CLIENT_TEXT_DOMAIN ) ?></a> | </span>' +
                                    '<span class="delete"><a href="javascript: void(0);"><?php _e( 'Delete Template from Theme Directory', WPC_CLIENT_TEXT_DOMAIN ) ?></a></span>'
                                );
                                init_edit_template();
                            }
                        }
                    }
                });
            });
        }

        $('body').on( 'click', '.wp-list-table .copy_to_theme a', function() {
            var name = $(this).closest('.row-actions').siblings('.wpc_shortcode_template').data('name'),
                path = $(this).closest('.row-actions').siblings('.wpc_shortcode_template').data('path'),
                nonce = $(this).closest('.row-actions').siblings('.wpc_shortcode_template').data('nonce'),
                $obj = $(this);
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo get_admin_url() ?>admin-ajax.php',
                data: {
                    action : 'wpc_shortcode_templates',
                    operation : 'copy_to_theme',
                    filename : name,
                    path : path,
                    nonce : nonce
                },
                success: function( data ) {
                    if( data.success ) {
                        window.location = '<?php echo $this->cc_get_current_url() ?>';
                    } else {
                        alert( data.data[0].message );
                    }
                }
            });
        });

        $('body').on('click', '.sb_lightbox_content_body .copy_to_theme', function() {
            var name = $(this).closest('.sb_lightbox_content_body').find('.wpc_template_content').data('name'),
                path = $(this).closest('.sb_lightbox_content_body').find('.wpc_template_content').data('path'),
                nonce = $(this).closest('.sb_lightbox_content_body').find('.wpc_template_content').data('nonce'),
                $obj = $(this);
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo get_admin_url() ?>admin-ajax.php',
                data: {
                    action : 'wpc_shortcode_templates',
                    operation : 'copy_to_theme',
                    filename : name,
                    path : path,
                    nonce : nonce
                },
                success: function( data ) {
                    if( data.success ) {
                        $obj.hide();
                        $obj.closest('.sb_lightbox_content_body').find('.wpc_save_template').show();
                        $obj.closest('.sb_lightbox_content_body').find('.remove_from_theme').show();
                        $obj.closest('.sb_lightbox_content_body').find('.wpc_template_content').prop('disabled', false);

                        var icon = jQuery('.wpc_shortcode_template[data-name="' + name + '"]').parents('.column-template').find('.template_icon');
                        icon.removeClass('dashicons-media-default grey').addClass('dashicons-welcome-write-blog orange').attr('title',icon.data('unlock_title'));

                        lock_unlock[name] = 'unlock';
                    } else {
                        alert( data.data[0].message );
                    }
                }
            });
        });

        $('body').on('click', '.sb_lightbox_content_body .remove_from_theme', function() {
            var name = $(this).closest('.sb_lightbox_content_body').find('.wpc_template_content').data('name'),
                path = $(this).closest('.sb_lightbox_content_body').find('.wpc_template_content').data('path'),
                nonce = $(this).closest('.sb_lightbox_content_body').find('.wpc_template_content').data('nonce'),
                $obj = $(this);
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo get_admin_url() ?>admin-ajax.php',
                data: {
                    action : 'wpc_shortcode_templates',
                    operation : 'delete',
                    filename : name,
                    path : path,
                    nonce : nonce
                },
                success: function( data ) {
                    if( data.success ) {
                        $obj.hide();
                        $obj.closest('.sb_lightbox_content_body').find('.wpc_save_template').hide();
                        $obj.closest('.sb_lightbox_content_body').find('.copy_to_theme').show();
                        $obj.closest('.sb_lightbox_content_body').find('.wpc_template_content').prop('disabled', true);
                        $obj.closest('.sb_lightbox_content_body').find('.wpc_template_content').val( data.data );

                        var icon = jQuery('.wpc_shortcode_template[data-name="' + name + '"]').parents('.column-template').find('.template_icon');
                        icon.addClass('dashicons-media-default grey').removeClass('dashicons-welcome-write-blog orange').attr('title',icon.data('lock_title'));

                        lock_unlock[name] = 'lock';
                    } else {
                        alert( data.data[0].message );
                    }
                }
            });
        });

        $('body').on('click', '.sb_lightbox_content_body .wpc_save_template', function() {
            var name = $(this).closest('.sb_lightbox_content_body').find('.wpc_template_content').data('name'),
                path = $(this).closest('.sb_lightbox_content_body').find('.wpc_template_content').data('path'),
                nonce = $(this).closest('.sb_lightbox_content_body').find('.wpc_template_content').data('nonce'),
                content = $(this).closest('.sb_lightbox_content_body').find('.wpc_template_content').val(),
                $obj = $(this);
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo get_admin_url() ?>admin-ajax.php',
                data: {
                    action : 'wpc_shortcode_templates',
                    operation : 'save_template',
                    filename : name,
                    path : path,
                    nonce : nonce,
                    content : jQuery.base64Encode( content )
                },
                success: function( data ) {
                    if( data.success ) {
                        $obj.parent().append('<span class="wpc_success_message" style="color: green;">Saved</span>');
                        setTimeout(function() {
                            $('.wpc_success_message').remove();
                        }, 2000 );
                    } else {
                        alert( data.data[0].message );
                    }
                }
            });
        });

        $('body').on('click', '.wp-list-table .delete a', function() {
            var name = $(this).closest('.row-actions').siblings('.wpc_shortcode_template').data('name'),
                path = $(this).closest('.row-actions').siblings('.wpc_shortcode_template').data('path'),
                nonce = $(this).closest('.row-actions').siblings('.wpc_shortcode_template').data('nonce'),
                $obj = $(this);
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo get_admin_url() ?>admin-ajax.php',
                data: {
                    action : 'wpc_shortcode_templates',
                    operation : 'delete',
                    filename : name,
                    path : path,
                    nonce : nonce
                },
                success: function( data ) {
                    if( data.success ) {
                        window.location = '<?php echo $this->cc_get_current_url() ?>';
                    } else {
                        alert( data.data[0].message );
                    }
                }
            });
        });

        //init shutter boxes at first page load for "Edit Template" and "View Template" buttons
        init_view_template();
        init_edit_template();

        /**
         * history events when back/forward and change window.location.hash handler
         */
        window.addEventListener("popstate", function(e) {
            hash_data = parse_hash();

            jQuery(".template_tag").removeClass('active');
            //jQuery( this ).toggleClass('active');
            jQuery( 'table.templates tbody tr' ).hide();

            var disp_arr;
            jQuery.each( hash_data, function( e ) {
                jQuery('.template_tag[data-tag="' + e + '"]').toggleClass('active');
                var tag_rows;

                tag_rows = jQuery( 'table.templates tbody tr.' + e + '_tag' );
                tag_rows.show();
            });

            disp_arr = jQuery( '.displaying-num' ).html().split(' ');
            disp_arr[0] = jQuery('table.templates tbody tr:visible').length;
            jQuery( '.displaying-num' ).html( disp_arr.join(' ') );
        });


        //at first page load set tags from hash
        hash_data = parse_hash();
        jQuery.each( hash_data, function( e ) {
            jQuery('.template_tag[data-tag="' + e + '"]').trigger('click');
        });


        /**
         * Build hash string, using global variable "hash_data"
         */
        function get_hash_string() {
            var hash_array = [];
            for( var index in hash_data ) {
                hash_array.push( index + '=' + hash_data[index] );
            }
            hash_string = hash_array.join('&');

            if ( hash_string == '' )
                return '';

            return '#' + hash_string;
        }


        /**
         * Parse URLs hash
         */
        function parse_hash() {
            var hash_obj = {};
            var hash = window.location.hash.substring( 1, window.location.hash.length );

            if ( hash == '' ) {
                return hash_obj;
            }

            var hash_array = hash.split('&');

            for ( var index in hash_array ) {
                var temp = hash_array[index].split('=');
                hash_obj[temp[0]] = temp[1];
            }

            return hash_obj;
        }


        /**
         * Clear hash for remove tags
         */
        function clear_hash() {
            hash_data = {};
            window.location.hash = get_hash_string();
        }
    });
</script>

<div class="icon32" id="icon-link-manager"></div>
<p><?php _e( 'To customize any shortcode templates, you will first want to copy the desired template to your theme directory (click on "Copy to Theme Directory"). You will then be able to edit the corresponding template.', WPC_CLIENT_TEXT_DOMAIN ) ?></p>

<form action="" method="get" id="other_tab_form" style="width: 100%;">
    <input type="hidden" name="page" value="wpclients_templates" />
    <input type="hidden" name="tab" value="php_templates" />
    <?php $ListTable->search_box( __( 'Search Templates', WPC_CLIENT_TEXT_DOMAIN ), 'search-submit' ); ?>
    <?php $ListTable->display(); ?>
</form>
<div class="wpc_template_form" style="display: none;">
    <textarea name="wpc_template_content" class="wpc_template_content"></textarea>
    <div class="wpc_shortcode_templates_actions_btn">
        <input type="button" class="button-primary wpc_save_template" value="<?php _e( 'Save Template', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
        <input type="button" class="button remove_from_theme" value="<?php _e( 'Delete Template From Theme', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
        <input type="button" class="button copy_to_theme" value="<?php _e( 'Copy Template To Theme', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
    </div>
</div>