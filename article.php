<?php
require 'core/config.php';
require_once 'core/functions.php';

$conn = connect();
$data = select_article($conn);
$tag = get_article_tags($conn);
close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php 

$out = '';
$out .= "<h1>{$data['title']}</h1>";
$out .= "<img src='./images/{$data['image']}'>";
$out .= "<div>{$data['description']}</div>";
echo $out;

for ($i = 0; $i < count($tag); $i++) {
    echo "<a href='./tag.php?tag={$tag[$i]['tag']}' style='padding-right: 5px;'>{$tag[$i]['tag']}</a>";
}

?>