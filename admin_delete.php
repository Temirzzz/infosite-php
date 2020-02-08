<?php
require 'core/config.php';
require_once 'core/functions.php';


$conn = connect ();


if (isset($_GET['id'])) {
    var_dump($_GET['id']); // val1
}
$id = $_GET['id'];

$sql = "DELETE FROM info WHERE id= '$id'";
mysqli_query($conn, $sql);

if (mysqli_query($conn, $sql)) {
    header('Location: ./admin.php');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

close ($conn);
?>

