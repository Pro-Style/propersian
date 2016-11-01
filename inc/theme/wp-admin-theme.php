<?php
function wb_admin_css() {
    echo '<link rel="stylesheet" type="text/css" href="' .plugins_url('wp-admin.css  ', __FILE__). '" />';
}
add_action('admin_head','wb_admin_css', 1000);

?>
