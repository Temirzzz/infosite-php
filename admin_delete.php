<?php
require_once('template/header.php');

if (isset($_GET['id'])) {
    var_dump($_GET['id']); // val1
}
$id = $_GET['id'];

delete_article ($conn, $id);
header('Location: ./admin.php');


close($conn);

