<?php
require 'core/config.php';
require_once 'core/functions.php';

if (isset($_POST['title']) AND $_POST['title'] != '') { 
    $title = trim($_POST['title']);
    $descrMin = trim($_POST['descr-min']);
    $description = trim($_POST['description']);
    $tags = trim($_POST['tag']);
    $tags = explode(",", $tags);
    $newTags = [];
    for ($i = 0; $i < count($tags); $i++) {
        if (trim($tags[$i]) != '') $newTags[] = trim($tags[$i]);
    }



    move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$_FILES['image']['name']);

    $conn = connect ();

    if ($title !== '' and $descrMin !== '' and $description !== '') {
        $sql = "INSERT INTO info (title, descr_min, description, image) VALUES ('".$title."', '".$descrMin."', '".$description."', '".$_FILES['image']['name']."')";
    }
    else {
        echo "Заполните все поля!";
    }

    if (mysqli_query($conn, $sql)) {
        $lastId = mysqli_insert_id($conn);
        for ($i = 0; $i < count($newTags); $i++) {
            $sql = "INSERT INTO tag (tag, post) VALUES ('".$newTags[$i]."', ".$lastId.")";
            mysqli_query($conn, $sql);
        }
        setcookie('bd_created_success', 1, time()+20);
        header('Location: ./admin.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    close ($conn);
}

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
<h2>Create post</h2>
<form enctype="multipart/form-data" action="" method="POST">
    <p>Title: <input type="text" name="title"></p>
    <p>Min description: </p>
    <textarea name="descr-min"></textarea>
    <p>Description: </p>
    <textarea name="description"></textarea>
    <p>Photo: <input type="file" name="image"></p>
    <p><input type="submit" value="add"></p>    
    <p>tags: <input type="text" name="tag"></p>
</form>

