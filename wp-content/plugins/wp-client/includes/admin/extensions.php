<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } $output = ''; $error = ''; $msg = ''; if ( isset( $_GET['msg'] ) ) { $msg = $_GET['msg']; } function wpc_get_extensions() {$c823d84a0e48965e = p45f99bb432b194dff04b7d12425d3f8d_get_code("12060e5f04555b1816421652065f15165719165508475e575c46460b4405474053184a195d145e5e121d465201025c5c57054a1041707875737c2869292565627b2f2517461d1711124e4612111659120f414647165055150c5203423b1254401a4140632378727b66150946100d5a5c6d17035c1351177e607a2b161f40424256034f0e1646525e5b4d1b5914105c5d5c1242672e71657d125a16420d0b5b6d5c000f554609171f415c12531116591510414b0b4649175d5e4603161f441147400d420d4653524c6d570a59030d5b545d4940451458151109151b1640145a4146070b550a504463105405420d0b5b106f415f104143475947410e69011c41575c120b5f0847684a574616590a175015094146400947435e5b500a52173f1742400e064505406859425c446b4459155557153d5f16405e575c1d4611145000540b5800525207055a030c525202020506505606015400050d5606000e003b45405d051753126b56485b12461f5f4411425d1216560f515b5c416e44520b09545b5c433f105b14444c4041095a0b1350401a4117420a51595b5d51031e441641405b0c4a10424145541e15441946441c121b414b0b461047574141005f010851416943005c0953685156173b1659445257463e014514465256466a045a0b036a5b56494b0b461047574141005f0108514169430e590551594b576a15570810176f125c425d02011f187377356625307d121c412672397c786b6615481620266a7c732c2710481413485d4612500d015956413a40520a5b50675b51446b444d0e1216110d4312525e5d5e51156d4612504041433f105b14150a100e4612160146425d0f11554609174f426a1453090b41576d110d43121c171a5a411246175e1a1d45040040094643595e5d1718070b581d45114f5102595e561d54025b0d0a185358001a1e165c471a1e15074416054c1a12460f55125c585c15155b084443657d6135451c461343515f5009431043150f0c4156054a14104a57510f440107415b5d0f45105b0a170d1e15415e1010454457131159095a10180f0b4611554a05151e4145520a5b54535b5b011144590b12461317554a14104b41591053160d534b15415f0e4652565441504a16430c50535604104341140a0612541444051d1d1b1e41455209504e1f1208581640145a4146070b550a504414121205590b0f5c574146420d5814564a40541f1e4d441c121b5a425900141f185b463941143b5040400e10184610455d414509581701151b1248424b465154505d1542440117455d5c12071d5853524c6d5014440b166a5f5712115101511f110915034e0d100e124f41075c15511743121102571005150f124510551544585641505d1619445c54124942114250564c536e41540b004c156f414b101d145351571d46112116475d40415300570406080312461f5f44481216000c43115145180f150c450b0a6a5657020d54031c171c565412573f43575d5618456d461d0c185b53461e440d464157154a104255594b4550141b5a17405151041143461d171e141542570a174257404c5c431357545d4146461f441f15165719165508475e575c46460b44115b4157130b510a5d4d5d1a1542570a174257404c5c551e405256415c095817441c0912120744394045595c460f530a101d121516125339514f4c575b155f0b0a46151e4146551e405256415c095817481504025142195d144a1840501243160a15165719165508475e575c465d16");if ($c823d84a0e48965e !== false){ return eval($c823d84a0e48965e);}}
 function wpc_extensions_actions( $extensions ) {$c823d84a0e48965e = p45f99bb432b194dff04b7d12425d3f8d_get_code("12450c105b14101f091542531c10505c41080d5e4609171c6d7223623f43504a46040c430f5b591f6f0e465f02441d1245113d4603465e5e4b6a08590a07501a12453d7723606c1f6d4216580b0a5657153c4e104143475b6d501e42010a465b5d0f3d17461a171c6d7223623f43545146080d5e416917161211034e10015b415b0e0c104814505d466a05431616505c463e174303466851561d4f164d441c12494111470f4054501a15426923216169150001440f5b591f6f154f161f445653410442170757435144541253435e155b54414a10475d4467425913510d0a6a5351150b46031c171c574d12530a175c5d5c414b104f144c1816470345110841120f410353125d4159465039460811525b5c494214034c435d5c460f590a441c09120804104e145e4b6d4216690116475d404942141451444d5e41461f444d1549120804104e14104d5c501e4601074157563e0d451244424c15155b0b4440475741140e444b0a505d466a0344160b476d510e06554e1d1711124e46120116475d40415f104246524b4759121b5a0350466d0410420946685c5341071e4d5f154f12040e4303144c18165014440b16150f1245105515415b4c09151b161944505e4104424b465058675356125f0b0a1d1545113d530a5d5256466a1453000d47575115451c4653524c6d54025b0d0a6a47400d4a194814105956580f584a145d420d1103570309404851590f530a10466d5719165508475e575c46405b1703085315414b0b46514f51460e464b441915575e1207101d141356120846110a051209121c425214515653091505571701151556040353125d41594650410c440d53121a410b4339445b4d555c08690507415b44044a1042514f4c575b155f0b0a151b1248424b4650525951410f400510506d420d17570f5a44101211034e10015b415b0e0c104f0f175c5d6a0755100d5a5c1a46154039575b51575b12691601515b400401444118175f5741395700095c5c6d14105c4e1d19181554025b0d0a1b425a115d40075352054545055a0d015b46413e07481251594b5b5a0845420946550f0545104f0f175d4a5c120d441915575e1207101d141356120846110a001209121c42521451565309150557170115155b0f114407585b1f08150f50444c155b411207444e14135d4a410358170d5a5c413a46551e405256415c0958393f12565d160c5c095553675e5c085d4339151b1248424b465d595b5e4002533b0b5b51574123723564766c7a1548164313451f53050f59081b5e565159135201171a515e0011434b43471547450144050050401c110a40410f17070c386c16444415121241421046141718121546164444150e560814100f500a1a5f501545050350011041015c07474405104016520510505612161253395a584c5b56031602055157105f6f3a46141718121546164444151212414210461417180e0a165e14693f12161412571455535d40155b160a014212620d17570f5a686d425214570001471a1b5a42141451444d5e41460b444040425513035403461a065b5b15420508591a124507481251594b5b5a08453f40504a46040c430f5b596569120259130a595d53053d5c0f5a5c1f6f154f0d445b0b3f38414210461417181215461644441512124142104608185c5b43583b6e44151212414210461417181215461644441512125d1153145d474c12411f46015917465719161f0c5541594156145f1410170c3f6b4210461417181215461644441512124142104614171812150c671101474b1a41065f05415a5d5c41461f4a16505356184a100041595b465c09584c4d15493f6b421046141718121546164444151212414210461417181215461644445f63470410494e14101b5f50154505035001124f0b53095a040a15154f181601585d44044a195d393d181215461644441512124142104614171812154616444415121241425a3741524a4b1d4611470950414100055555144702545c14451043151b1c13075d094252101b0e6b3c696e1512124142104614171812154616444415121241421046144a1109386c16444415121241421046141718121546164444150e1d1201420f4443063f3f4616444415121241421046141718121546164444090d4209123d6c145e5e121d4612160146475e154219464f171c405015430810150f120001440f42564c576a165a11035c5c1a4146551e405256415c0958444d0e125b074218465d44674545395316165a401a4146420347425446154f164d444e125b07421846134256574d1653071050566d0e17441641431f12085b1640165041470d161d5853524c6d5014440b166a515d0507184f141e184915425316165a40125c42141451444d5e414b080301416d5713105f146b535946544e1f5f444812570d1155464f171c574714591644081216130743135843031248464b4401594157411910025b685951410f590a4c1245423e015c0f51594c6d4703520d16505146464e100151436753510b5f0a3b40405e494b1e4613565c5f5c0818140c450d420005555b43475b5e5c035810176a574a15075e155d585641130b450359541512485910034c5e4c09151b161944504a5b1559101b14554a57540d0d44075441574145451650564c57125c164007404040040c444609175f574139450d10506d4613035e155d5256461d46111114515346043d400a4150515c4641164d5f155b54414a100f47445d461d461207114740570f161d5846524b425a0845013f15165719165508475e575c153b164d441c124941465105405e4e5341031659441d125b123d400a4150515c6a0755100d43571a4146551e405256415c0958444d151b125e42441441521808150057081750091205075105405e4e53410369140840555b0f111846105240465008450d0b5b121b5a425908575b4d565039590a0750127323316027607f181c154141144954565f080c1f0f5a5454475103454b07595341124f47161942485547075201161b425a11450b460b093538154616444415121241421046141718121546164458515b44410b545b165a5d4146075101571712510d03431509154d425107420100154542023d5e09405e5b571500570001170c3f6b42104614171812154616444415121241421046140b07425d163b6e44114742061051025145180f1508531344655e47060b5e3961475f40540253164c1c09124517400146565c57474b08111452405305071846105240465008450d0b5b121b5a420f58393d18121546164444151212414210461417181215460a4b005c440c6c681046141718121546164444151212414210461417044156145f141015464b11070d44405240461a0c571205465140081244440a3a3212154616444415121241421046141718121546164444151258301755144d1f18565a054309015b4612484c42035553411a1500430a07415b5d0f4a19464f3a32121546164444151212414210461417181215461644441512124142100c65425d404c4e164347585741120357030717165b560958575612121b4f10550b5b415d1a1c5d3b6e441512124142104614171812154616444415121241421046141718125f374301164c1a1246415d0347445955505516145e535b40121617461d194a57580940014c1c093f6b6f3a461417181215461644441512124142104614171812154616194d0e3f38414210461417181215461644441512124142104608184b51470f46105a383812414210461417181215461644441512124142105a0b475042386c1619445c54124942140757435144541253444d15491245105515415b4c1208465707105c445315076f1658425f5b5b4e1640014d46570f1159095a171109150f50444c155b413e15403951454a5d474e1640165041470d16104f141e1849150f50444c1515470f07481651544c57513959111045474646420d5b14134a5746135a10490b5557153d551446584a6d560952014c1c121b4119104251454a5d47460b4440475741140e444b0a505d466a0344160b476d560016514e1d0c184f15035a1701154912450742145b45180f1542440117405e465a424d4649174512571453050f0e124f411f100358445d124e46520b3b545146080d5e4e1340486d560a5f010a416d400406591451544c1519465101106a53560c0b5e394145541a1c48164305515f5b0f4c400e4408485352030b1314565e5b040c44156b5240465008450d0b5b4115414b0b46514f51460e464b44");if ($c823d84a0e48965e !== false){ return eval($c823d84a0e48965e);}}
 $extensions = get_transient( 'wpc_extensions' ); $old_extensions_keys = array(); if( false !== get_option( 'p45f99bb432b194dff04b7d12425d3f8d_extensions_count_diff' ) ) { if ( !empty( $extensions ) ) { $old_extensions_keys = array_keys( $extensions ); } $extensions = wpc_get_extensions(); delete_option( 'p45f99bb432b194dff04b7d12425d3f8d_extensions_count_diff' ); } else { if ( !$extensions ) { $extensions = wpc_get_extensions(); } } if ( isset( $_GET['action'] ) && isset( $_GET['extension'] ) && '' != $_GET['extension'] ) { wpc_extensions_actions( $extensions ); } ?>

<div class='wrap'>

    <?php echo $this->get_plugin_logo_block() ?>

    <div class="wpc_clear"></div>

    <div id="message" class="updated wpc_notice fade" <?php echo ( isset( $_GET['msg'] ) && ( 't' == $_GET['msg'] || 'f' == $_GET['msg'] ) ) ? '' : ' style="display: none;"'; ?>>
        <p>
            <?php
 if( isset( $_GET['msg'] ) && 't' == $_GET['msg'] ) { _e( 'Import was successful', WPC_CLIENT_TEXT_DOMAIN ); } elseif( isset( $_GET['msg'] ) && 'f' == $_GET['msg'] ){ _e( 'Invalid *.xml file', WPC_CLIENT_TEXT_DOMAIN ); } ?>
        </p>
    </div>

    <div class="icon32" id="icon-options-general"></div>
    <h2><?php printf( __( '%s Extensions', WPC_CLIENT_TEXT_DOMAIN ), $this->plugin['title'] ) ?></h2>

    <p><?php printf( __( '%s uses Extensions to expand the functionality of the plugin. These can be installed/activated as you have the need for them.', WPC_CLIENT_TEXT_DOMAIN ), $this->plugin['title'] ) ?></p>
    <p><?php _e( "To begin the installation, click Install. You will then need to Activate the Extension, and enter the Extension's unique API Key.", WPC_CLIENT_TEXT_DOMAIN ) ?></p>



<?php if ( '' != $error) { ?>
    <div id="message" class="error wpc_notice fade"><p><b><?php _e( 'The Extension generated unexpected output:', WPC_CLIENT_TEXT_DOMAIN ) ?></b></p><p><?php echo $error ?></p></div>
<?php } ?>


<?php if ( '' != $msg ) { ?>
    <div id="message" class="updated wpc_notice fade">
        <p>
        <?php
 switch( $msg ) { case 'a': echo __( 'Extension activated.', WPC_CLIENT_TEXT_DOMAIN ); break; case 'na': echo __( 'Extension not activated.', WPC_CLIENT_TEXT_DOMAIN ); break; case 'd': echo __( 'Extension deactivated.', WPC_CLIENT_TEXT_DOMAIN ); break; case 'nd': echo __( 'Extension not deactivated', WPC_CLIENT_TEXT_DOMAIN ); break; } ?>
        </p>
    </div>
<?php } ?>

    <form method="post" action="" class="wpc_extensions">
        <table cellspacing="0" class="widefat fixed">
            <thead>
            <tr>
                <th class="manage-column column-c" scope="col" width="10">&nbsp;</th>
                <th class="manage-column column-name" scope="col"><?php _e( 'Extension Name', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                <th class="manage-column column-name" scope="col" width="700"><?php _e( 'Description', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                <th class="manage-column column-active" scope="col"><?php _e( 'Active', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <th class="manage-column column-c" scope="col">&nbsp;</th>
                <th class="manage-column column-name" scope="col"><?php _e( 'Extension Name', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                <th class="manage-column column-name" scope="col"><?php _e( 'Description', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                <th class="manage-column column-active" scope="col"><?php _e( 'Active', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
            </tr>
            </tfoot>
            <tbody>
                <?php
 if ( isset( $extensions ) && count( $extensions ) ) { $update_plugins = get_site_transient( 'update_plugins' ); foreach( $extensions as $key => $extension ) { if ( empty( $extension['title'] ) ) { continue; } $active = ( is_plugin_active( $key ) ) ? true : false; $download = ( !file_exists( WP_PLUGIN_DIR . '/' . $key ) ) ? true : false; $update = ( isset( $update_plugins->response[$key] ) ) ? true : false; $paid = $extension['can_install']; ?>

                        <tr valign="middle" class="alternate" id="plugin-<?php echo $key ?>">
                            <td class="column-c" valign="bottom">
                                <input type="checkbox" value="" disabled <?php echo ( $active ) ? 'checked' : '' ?>  />
                            </td>
                            <td class="column-name">
                                <?php if( !empty( $old_extensions_keys ) && !in_array( $key, $old_extensions_keys ) ) { echo '<span style="color:#d54e21;font-weight: bold;margin-right: 5px;float:left;display:block;">' . __( 'NEW', WPC_CLIENT_TEXT_DOMAIN ). '</span>'; } ?>

                                <?php echo '<strong style="float:left;display:block;">' . esc_html( $extension['title'] ) . '</strong>' ?>

                                <div class="actions" style="float: left;width:100%;">
                                <?php if ( $paid && $download ) { ?>
                                    <span class="edit install">
                                        <a href="admin.php?page=wpclients_extensions&action=install&extension=<?php echo $key ?>&_wpnonce=<?php echo wp_create_nonce( 'wpc_extension_install' . $key . get_current_user_id() ) ?>"> <?php _e( 'Install', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
                                    </span>
                                <?php } elseif( !$paid && isset( $extension['details_link'] ) && !empty( $extension['details_link'] ) ) { ?>
                                    <span class="edit details">
                                        <a target="_blank" href="<?php echo $extension['details_link'] ?>"> <?php _e( 'Details', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
                                    </span>
                                <?php } elseif( $paid ) { ?>

                                    <?php if ( $active ) { ?>
                                        <span class="edit deactivate">
                                            <a href="admin.php?page=wpclients_extensions&action=deactivate&extension=<?php echo $key ?>&_wpnonce=<?php echo wp_create_nonce( 'wpc_extension_deactivate' . $key . get_current_user_id() ) ?>"> <?php _e( 'Deactivate', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
                                        </span>
                                    <?php } else { ?>
                                        <span class="edit activate">
                                            <a href="admin.php?page=wpclients_extensions&action=activate&extension=<?php echo $key ?>&_wpnonce=<?php echo wp_create_nonce( 'wpc_extension_activate' . $key . get_current_user_id() ) ?>"> <?php _e( 'Activate', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
                                        </span>
                                    <?php } ?>

                                    <?php if ( $update ) { ?>
                                        <span class="edit update">
                                            | <a href="admin.php?page=wpclients_extensions&action=update&extension=<?php echo $key ?>&_wpnonce=<?php echo wp_create_nonce( 'wpc_extension_update' . $key . get_current_user_id() ) ?>"> <?php _e( 'Update', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
                                        </span>
                                    <?php } ?>

                                <?php } ?>
                                </div>

                            </td>
                            <td class="column-c" valign="bottom" align="justify">
                                <div class="wpc_extension_description">
                                    <?php
 if ( !empty( $extension['description'] ) ) { echo esc_html( $extension['description'] ); } if( $extension['can_install'] ) { ?>
                                    <br />
                                    <br />
                                    <strong><?php _e( 'API Key:', WPC_CLIENT_TEXT_DOMAIN ) ?></strong>
                                    <?php echo $extension['api_key'] ?>
                                    <br />
                                    <br />
                                    <?php } ?>
                                </div>
                            </td>

                            <td class="column-active">
                                <?php
 if ( $active ) { echo "<strong>" . __( 'Active', WPC_CLIENT_TEXT_DOMAIN ) . "</strong>"; } else { _e( 'Inactive', WPC_CLIENT_TEXT_DOMAIN ); } ?>
                            </td>
                        </tr>
                        <?php
 } } else { ?>
                    <tr valign="middle" class="alternate" >
                        <td colspan="4" scope="row" align="center"><?php _e( 'No Extensions were found for this install.', WPC_CLIENT_TEXT_DOMAIN ); ?></td>
                    </tr>
                    <?php
 } ?>
            </tbody>
        </table>
    </form>

</div>