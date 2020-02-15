<?php
require_once('core/config.php');
require_once('core/functions.php');
$conn = connect();
$data = select($conn);
require_once('template/check_login.php');
require_once('template/header_html.php');
close($conn);
?>

<?php
$flash = '';
if (isset($_COOKIE['bd_created_success']) AND $_COOKIE['bd_created_success'] != '') {
    if ($_COOKIE['bd_created_success'] == 1) {
        setcookie('bd_created_success', 1, time()-20);
        $flash =  "New record created successfully";
    }
}
