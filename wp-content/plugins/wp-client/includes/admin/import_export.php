<?php
 require_once $this->plugin_dir . 'includes/class-import-export.php'; global $wpc_import_export; ?>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <h2></h2>

    <?php echo $wpc_import_export->render_block() ?>

</div>