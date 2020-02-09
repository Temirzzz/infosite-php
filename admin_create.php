<?php
require_once('template/header.php');

if (isset($_POST['title']) AND $_POST['title'] != '') { 
    $title = trim($_POST['title']);
    $descrMin = trim($_POST['descr-min']);
    $description = trim($_POST['description']);
    $category = trim($_POST['category']);
    $tags = trim($_POST['tag']);
    $tags = explode(",", $tags);
    $newTags = [];
    for ($i = 0; $i < count($tags); $i++) {
        if (trim($tags[$i]) != '') $newTags[] = trim($tags[$i]);
    }

    move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$_FILES['image']['name']);

    $conn = connect ();

    if ($title !== '' and $descrMin !== '' and $description !== '') {
        $sql = "INSERT INTO info (title, category, descr_min, description, image) VALUES ('".$title."', '".$category."', '".$descrMin."', '".$description."', '".$_FILES['image']['name']."')";
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
<div class="container">
    <div class="row">
        <div class="col-lg-12">
        <h2>Create post</h2>
            <form enctype="multipart/form-data" action="" method="POST">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title"  name="title" >
                </div>
                <div class="form-group">
                    <label for="min-descr">Min description</label>
                    <textarea class="form-control" id="min-descr"  name="descr-min"></textarea>
                </div>
                <div class="form-group">
                    <label for="description">Title</label>
                    <textarea class="form-control" id="description"  name="description" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <input type="text" class="form-control" id="category"  name="category" >
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <input type="text" class="form-control" id="tags"  name="tag" >
                </div>
                <div class="form-group">
                    <label for="addFile">Image</label>
                    <input type="file" class="form-control-file" id="addFile" name="image">
                </div>                
                <button type="submit" class="btn btn-primary mb-2">Add</button>
            </form>
        </div>
    </div>
</div>


