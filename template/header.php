<?php
require_once('core/config.php');
require_once('core/functions.php');
$conn = connect();
$cat = get_all_cat_info($conn);
require_once('template/header_html.php');
?>
