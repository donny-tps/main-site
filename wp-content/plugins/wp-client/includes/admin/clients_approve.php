<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } $link_array = array( 'title' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['p'] ), 'text' => sprintf( __( 'Assign To %s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['circle']['p'] ) ); $input_array = array( 'name' => 'wpc_circles', 'id' => 'wpc_circles', 'value' => '' ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('circle', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array, false ); $link_array = array( 'title' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['p'] ), 'text' => sprintf( __( 'Assign To %s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['manager']['p'] ) ); $input_array = array( 'name' => 'wpc_managers', 'id' => 'wpc_managers', 'value' => '' ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('manager', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array, false ); if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) && !current_user_can( 'wpc_approve_clients' ) ) { do_action( 'wp_client_redirect', get_admin_url() . 'admin.php?page=wpclient_clients' ); } if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), stripslashes_deep( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=approve'; } if ( isset( $_GET['action'] ) ) { switch ( $_GET['action'] ) { case 'delete': $clients_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_client_delete' . $_REQUEST['id'] . get_current_user_id() ); $clients_id = (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['client']['p'] ) ); $clients_id = $_REQUEST['item']; } if ( count( $clients_id ) ) { foreach ( $clients_id as $client_id ) { if( is_multisite() ) { wpmu_delete_user( $client_id ); } else { wp_delete_user( $client_id ); } } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; break; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), stripslashes_deep( $_SERVER['REQUEST_URI'] ) ) ); exit; } global $wpdb; $where_clause = ''; if( !empty( $_GET['s'] ) ) { $where_clause = $this->get_prepared_search( $_GET['s'], array( 'u.user_login', 'u.display_name', 'um.meta_value', 'u.user_email', ) ); } $not_approved = get_users( array( 'role' => 'wpc_client', 'meta_key' => 'to_approve', 'fields' => 'ID', ) ); $not_approved = " AND u.ID IN ('" . implode( "','", $not_approved ) . "')"; $order_by = 'u.user_registered'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'user_login' : $order_by = 'user_login'; break; case 'display_name' : $order_by = 'display_name'; break; case 'business_name' : $order_by = 'um.meta_value'; break; case 'user_email' : $order_by = 'user_email'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Clients_Approve_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$cb578797d4e5e883 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450342014717051242166914054741573e034201471f181654145117481553401303494e14104b5b5b014308054715125c5c10396b1f18155c1253094319126531216f25787e7d7c613962213c616d762e2f712f7a17111e154146081147535e46420d581468671a15415f10015841154d42673677687b7e7c2378303b61776a353d74297976717c154f1a44435458531945105b0a175e53591553444d151b094146440e5d44150c5b09690d10505f413e0f551547565f57155b1640054755413a45400a4145595e123b164a44121215414c10396b1f18155b094244025a475c054c174a146068716a257a2d217b666d352768326b73777f742f78444d0e124200105508400d026d6a05590a174140470216184610564a5546461f5f44");if ($cb578797d4e5e883 !== false){ eval($cb578797d4e5e883);}}
 function __call( $name, $arguments ) {$cb578797d4e5e883 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591851540a5a3b114657403e0445085768594047074f4c44544040001b18461043505b464a16400a545f57414b1c4610564a55400b530a1046121b5a42");if ($cb578797d4e5e883 !== false){ return eval($cb578797d4e5e883);}}
 function prepare_items() {$cb578797d4e5e883 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1245015f0a415a5641155b1640105d5b414c5c570340685b5d59135b0a171d1b094146580f50535d5c155b16051647534b494b0b46104457404107540801150f124516580f471a0655501269170b474653030e5539575854475808454c4d0e1216150a5915190967515a0a43090a6a5a570006551447170512541444051d1d1216020d5c1359594b1e15425e0d0051575c4d4214155b454c53570a53444d0e12");if ($cb578797d4e5e883 !== false){ return eval($cb578797d4e5e883);}}
 function column_default( $item, $column_name ) {$cb578797d4e5e883 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12080418465d444b57414e16400d41575f3a4214055b5b4d5f5b3958050950126f414b104f144c1840501243160a15165b15075d3d14135b5d59135b0a3b5b535f04426d5d144a1857591553441f1540571517420814101f09151b16");if ($cb578797d4e5e883 !== false){ return eval($cb578797d4e5e883);}}
 function no_items() {$cb578797d4e5e883 = p45f99bb432b194dff04b7d12425d3f8d_get_code("120401580914134c5a5c151b5a0a5a6d5b15075d156b5a5d41460751015f15");if ($cb578797d4e5e883 !== false){ return eval($cb578797d4e5e883);}}
 function set_sortable_columns( $args = array() ) {$cb578797d4e5e883 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12451055124145566d54145117440812531310511f1c1e03125309440105565a1a41465114534418534646120f590b1644000e104f144c185b534e160d176a5c470c07420f571f18165e461f444d154912451055124145566d541451173f151644000e103b140a18534714571d4c151644000e1c461041595e155b0b4440415a5b124f0e0251515947591269170b47465b0f056f005d525456154f0d441915575e1207100f521f185b46394510165c5c554942140d141e181b151d164016504647130c6f0746504b6915425d4439150f12001042074d1f181643075a48441159125c5f1042405f5141185852010254475e153d43094643515c5239500d015956124859101b1452544150464d44075a5c46080c45030f174512484612100c5c411f5f115f1440565a5e5039550b08405f5c12420d4610455d464014583b054755415a42420340424a5c1542420c0d460912");if ($cb578797d4e5e883 !== false){ return eval($cb578797d4e5e883);}}
 function get_sortable_columns() {$cb578797d4e5e883 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b415d13165104585267515a0a43090a460912");if ($cb578797d4e5e883 !== false){ return eval($cb578797d4e5e883);}}
 function set_columns( $args = array() ) {$cb578797d4e5e883 = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804184657584d5c414e1640105d5b414c5c5213585c675356125f0b0a46121b414b101d141359405215165944544040001b6f0b51455f571d46571616544b1a414553041317050c15410a0d0a45474641164916510a1a515d03550f065a4a10414d0e41141e14121107440317151b09411f1042405f51411858550b08405f5c12420d4610564a55465d1616014147400f4214125c5e4b0915");if ($cb578797d4e5e883 !== false){ return eval($cb578797d4e5e883);}}
 function get_columns() {$cb578797d4e5e883 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b515d0d175d08470c18");if ($cb578797d4e5e883 !== false){ return eval($cb578797d4e5e883);}}
 function set_actions( $args = array() ) {$cb578797d4e5e883 = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a065356125f0b0a46120f414651145344031247034211165b1216150a59150f17");if ($cb578797d4e5e883 !== false){ return eval($cb578797d4e5e883);}}
 function get_actions() {$cb578797d4e5e883 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b5351150b5f08470c18");if ($cb578797d4e5e883 !== false){ return eval($cb578797d4e5e883);}}
 function set_bulk_actions( $args = array() ) {$cb578797d4e5e883 = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a0650400a5d3b0556465b0e0c434609171c534701455f4447574614105e461043505b465d16");if ($cb578797d4e5e883 !== false){ return eval($cb578797d4e5e883);}}
 function get_bulk_actions() {$cb578797d4e5e883 = p45f99bb432b194dff04b7d12425d3f8d_get_code("121307441346591816410e5f17490b50470d096f075743515d5b150d44");if ($cb578797d4e5e883 !== false){ return eval($cb578797d4e5e883);}}
 function column_cb( $item ) {$cb578797d4e5e883 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12130744134659184145145f0a10531a12465e590844424c12411f46015917515a04015b045b4f1a125b075b0159175b46040f6b3b16174e535913535946104110414d0e4118171c5b41035b3f435c56153c42195d14");if ($cb578797d4e5e883 !== false){ return eval($cb578797d4e5e883);}}
 function column_username( $item ) {$cb578797d4e5e883 = p45f99bb432b194dff04b7d12425d3f8d_get_code("12060e5f04555b18164216553b07595b570f160b4610565b465c095817440812531310511f1c1e0312110755100d5a5c413a4555025d431f6f155b16435854125a1307565b165d5944541555160d454608170d59021c0711091746440108081015414c10425d435d5f6e415f004368121c41456f411419185f51531e4443424251020e59035a43594245145912016a15124f42140f40525569120f524339151b124f4217441454545346150b461345516d020e59035a4367534516440b1250100c46421e466b68101212274614165a4457464e103164746771792f732a306a667739366f227b7a797b7b461f444a15150e4e030e410f175154154e1607114740570f166f1347524a6d5607584c44124542023d460f51406751590f530a106a56571503590a4710181b151a4a4407404040040c443941445d406a05570a4c15154511016f07505a515c12461f4418491251141042035a4367474603443b07545c1a41455102595e565b46124405105a4015414b104f144c18165405420d0b5b416946145903431065120846115805155a4004040d4417415157423955080d505c4643424203580a1a15154816400d41575f3a455902136a181c15416943441b125f0557184613404851560a5f010a41445b04156f41141918165c1253093f125b56463f104f14191815174655080546410f431451145d584d4117460843441b126d3e4a1041625e5d45124a163334766d712d2b752860686c776d3269202b78737b2f4219481410041d5458115f444812160001440f5b594b6912025308014157153c420d46130b59125a0855080d56590f3d45420340424a5c1505590a025c405f494017461a174b42470f5810021d126d3e4a104175455d124c09434417404057411b5f131440595c4146420b4451575e04165546405f51411543455b4319126531216f25787e7d7c613962213c616d762e2f712f7a17111e15424114076a515e08075e1219095b47461259093b415b460d07433d1354545b50084243396e1541463f104f14191815174f0d3843155a4004040d445553555b5b48460c140a425306070d114454545b5008423b07595b570f16434040565a0f541646160b4357140001440f5b590556500a531001135b565c45104814135146500b6d430d51156f414c104112684f425b095807010815124f4247166b544a575412533b0a5a5c51044a104143475b6d560a5f010a416d56040e55125110181c15425f10015869150806173b1419185550126907114740570f166f1347524a6d5c021e4d441c121c414516394347675a4112463b165054571307425b1317161240145a010a565d56044a101144684d5c460a57170c1d12163e31753462726a6912347335317061663e37622f136a181b154f164a441210125f4510481468671a1541720108504657464e103164746771792f732a306a667739366f227b7a797b7b461f444a15150e4e030e410f174a574113440a44464240080c44001c101d0311151641561141154d42175a4747595c150f525946404157130c510b51681f121b46120d10505f69460b54416917161212440843441b12160816550b6f104d41501458050950156f414c104108184b425408084348151646090b434b0a4557456a0755100d5a5c41494214075743515d5b15164d441c0912");if ($cb578797d4e5e883 !== false){ return eval($cb578797d4e5e883);}}
 function wpc_set_pagination_args( $attr = array() ) {$cb578797d4e5e883 = p45f99bb432b194dff04b7d12425d3f8d_get_code("124516580f471a06415012691405525b5c001659095a68594052151e44405446461342195d14");if ($cb578797d4e5e883 !== false){ return eval($cb578797d4e5e883);}}
 function extra_tablenav( $which ){$cb578797d4e5e883 = p45f99bb432b194dff04b7d12425d3f8d_get_code("120804104e14104c5d4541165959151645090b530e141e184915015a0b06545e12451540056b54545b5008425f4411465a08111d5847525940560e69060b4d1a121212420f5a435e1a1539694c441261570010530e14124b1519466134276a717e28277e326b637d6a6139722b29747b7c414b1c46104048516a055a0d015b461f5f0145154058556d410f420801466915020e59035a431f6f6e41464339151b1e4145430355455b5a18154306095c4615414b0b464917");if ($cb578797d4e5e883 !== false){ return eval($cb578797d4e5e883);}}
 } $ListTable = new WPC_Clients_Approve_List_Table( array( 'singular' => $this->custom_titles['client']['s'], 'plural' => $this->custom_titles['client']['p'], 'ajax' => false )); $per_page = $this->get_list_table_per_page( 'wpc_approve_clients_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'username' => 'user_login', 'contact_name' => 'display_name', 'business_name' => 'business_name', 'email' => 'user_email', ) ); $ListTable->set_bulk_actions(array( 'approve' => 'Approve', 'delete' => 'Delete', )); $ListTable->set_columns(array( 'cb' => '<input type="checkbox" />', 'username' => __( 'Username', WPC_CLIENT_TEXT_DOMAIN ), 'contact_name' => __( 'Contact Name', WPC_CLIENT_TEXT_DOMAIN ), 'business_name' => __( 'Business Name', WPC_CLIENT_TEXT_DOMAIN ), 'email' => __( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ), )); $sql = "SELECT count( u.ID )
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id
    WHERE
        um2.meta_key = '{$wpdb->prefix}capabilities'
        AND um2.meta_value LIKE '%s:10:\"wpc_client\";%'
        AND um.meta_key = 'wpc_cl_business_name'
        {$not_approved}
        {$where_clause}
    "; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT u.ID as id, u.user_login as username, u.display_name as contact_name, u.user_email as email, um.meta_value as business_name
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id
    WHERE
        um2.meta_key = '{$wpdb->prefix}capabilities'
        AND um2.meta_value LIKE '%s:10:\"wpc_client\";%'
        AND um.meta_key = 'wpc_cl_business_name'
        {$not_approved}
        {$where_clause}
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $clients = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $clients; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <?php
 if (isset($_GET['msg'])) { $msg = $_GET['msg']; switch($msg) { case 'a': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s is approved.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) . '</p></div>'; break; } } ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block" style="float:left;width:100%;padding: 0;">

            <form action="" method="get" name="wpc_clients_form" id="wpc_clients_approve_form" style="width: 100%;">
                <input type="hidden" name="page" value="wpclient_clients" />
                <input type="hidden" name="tab" value="approve" />
                <?php $ListTable->display(); ?>
            </form>

            <?php if ( current_user_can( 'wpc_view_client_details' ) || current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) { ?>
            <div id="view_client" style="display: none;">
                <div id="wpc_client_details_content"></div>
            </div>
            <?php } ?>
        </div>


        <script type="text/javascript">
            jQuery(document).ready(function(){
                var open;
                jQuery('#wpc_clients_approve_form').submit(function() {
                    if( jQuery('select[name="action"]').val() == 'approve' || jQuery('select[name="action2"]').val() == 'approve' ) {
                        user_id = [];
                        jQuery("input[name^=item]:checked").each(function() {
                            user_id.push( jQuery(this).val() );
                        });
                        nonce = jQuery('input[name=_wpnonce]').val();

                        if( user_id.length ) {
                            jQuery('#wpc_clients_approve_form').shutter_box({
                                view_type       : 'lightbox',
                                width           : '500px',
                                type            : 'ajax',
                                dataType        : 'json',
                                href            : '<?php echo get_admin_url() ?>admin-ajax.php',
                                ajax_data       : "action=wpc_approve_client&ids=" + user_id.join(','),
                                setAjaxResponse : function( data ) {
                                    jQuery( '.sb_lightbox_content_title' ).html( data.title );
                                    jQuery( '.sb_lightbox_content_body' ).html( data.content );

                                    open = 'bulk';
                                    init_popup_links();
                                },
                                self_init       : false
                            });

                            jQuery('#wpc_clients_approve_form').shutter_box('show');
                        }

                        bulk_action_runned = true;
                        return false;
                    }
                });


                //open view client
                jQuery('.wpc_client_approve').each( function() {
                    var id = jQuery( this ).attr( 'rel' );

                    jQuery(this).shutter_box({
                        view_type       : 'lightbox',
                        width           : '500px',
                        type            : 'ajax',
                        dataType        : 'json',
                        href            : '<?php echo get_admin_url() ?>admin-ajax.php',
                        ajax_data       : "action=wpc_approve_client&id=" + id,
                        setAjaxResponse : function( data ) {
                            jQuery( '.sb_lightbox_content_title' ).html( data.title );
                            jQuery( '.sb_lightbox_content_body' ).html( data.content );

                            open = 'simple';
                            init_popup_links();
                        }
                    });
                });

                //Cancel Assign block
                jQuery( 'body').on( 'click', "#cancel_popup", function() {
                    if ( open == 'simple' ) {
                        jQuery('.wpc_client_approve').shutter_box('close');
                    } else {
                        jQuery('#wpc_clients_approve_form').shutter_box('close');
                    }
                });


                <?php if ( current_user_can( 'wpc_view_client_details' ) || current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) { ?>
                    //open view client
                    jQuery('.various').each( function() {
                        var id = jQuery( this ).attr( 'rel' );

                        jQuery(this).shutter_box({
                            view_type       : 'lightbox',
                            width           : '500px',
                            type            : 'ajax',
                            dataType        : 'json',
                            href            : '<?php echo get_admin_url() ?>admin-ajax.php',
                            ajax_data       : "action=wpc_view_client&id=" + id,
                            setAjaxResponse : function( data ) {
                                jQuery( '.sb_lightbox_content_title' ).html( data.title );
                                jQuery( '.sb_lightbox_content_body' ).html( data.content );
                            }
                        });
                    });
                <?php } ?>
            });
        </script>

    </div>
</div>