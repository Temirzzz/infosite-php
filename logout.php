<?php
setcookie('id', $row['id'], time()-30*24*60*60, "./");
setcookie('hash', $hash, time()-30*24*60*60, "./");
header('Location: ./login.php');
?>