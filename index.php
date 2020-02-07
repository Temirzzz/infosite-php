<?php
require 'core/config.php';
require_once 'core/functions.php';

$conn = connect();
$data = select_main($conn);
$countPage = pagination_count ($conn);
$tag = get_all_tags($conn);

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

for ($i = 0; $i < count($data); $i++) {
    $out .= "<img src='./images/{$data[$i]['image']}'>";
    $out .= "<h2>{$data[$i]['title']}</h2>";
    $out .= "<p>{$data[$i]['descr_min']}</p>";
    $out .= '<p><a href="./article.php?id='.$data[$i]['id'].'">Read more</a></p>';
    $out .= '<hr>';
}
echo $out;

for ($i = 0; $i < $countPage; $i++) {
    $j = $i + 1;
    echo "<a href='./index.php?page={$i}' style='padding: 5px;'>{$j}</a>";
}

echo '<hr>';

for ($i = 0; $i < count($tag); $i++) {
    echo "<a href='./tag.php?tag={$tag[$i]}' style='padding: 5px;'>{$tag[$i]}</a>";
}

?>