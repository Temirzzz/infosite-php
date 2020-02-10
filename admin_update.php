<?php
require_once('core/config.php');
require_once('core/functions.php');
$conn = connect();
$cat = get_all_cat_info($conn);
?>

<?php
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

    //

    $conn = connect ();


    if ($_FILES['image']['name'] != '') {
        move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$_FILES['image']['name']);
        $sql = "UPDATE info set title = '".$title."', descr_min = '".$descrMin."', description = '".$description."', image = '".$_FILES['image']['name']."' WHERE id=".$_GET['id'];
    }

    else {
        $sql = "UPDATE info set title = '".$title."', descr_min = '".$descrMin."', description = '".$description."' WHERE id=".$_GET['id'];
    }
    

    if (mysqli_query($conn, $sql)) {
        $sql = "DELETE FROM tag WHERE post=".$_GET['id'];
        mysqli_query($conn, $sql);
        
        
        for ($i = 0; $i < count($newTags); $i++) {
            $sql = "INSERT INTO tag (tag, post) VALUES ('".$newTags[$i]."', ".$_GET['id'].")";
            mysqli_query($conn, $sql);
        }
        setcookie('bd_updated_succsess', 1, time()+10);
        header('Location: ./admin.php');

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    close ($conn);
}
?>

<?php
    $sql = 'SELECT * FROM info WHERE id='.$_GET['id'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $sql = 'SELECT tag FROM tag WHERE post='.$_GET['id'];
    $result = mysqli_query($conn, $sql);
    $t = array();
    while($tag = mysqli_fetch_assoc($result)) {
        $t[] = $tag['tag'];
    }
?>

<?php 
require_once('template/header_admin.php');
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
        <h2>Update Post id=<?php echo $_GET['id'];?></h2>
            <form enctype="multipart/form-data" action="" method="POST">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title"  name="title" value="<?php echo $row['title'];?>">
                </div>
                <div class="form-group">
                    <label for="min-descr">Min description</label>
                    <textarea class="form-control" id="min-descr"  name="descr-min" value="<?php echo $row['descr-min'];?>"></textarea>
                </div>
                <div class="form-group">
                    <label for="description">Title</label>
                    <textarea class="form-control" id="description"  name="description" rows="5" value="<?php echo $row['description'];?>"></textarea>
                </div>
                <div class="form-group">
                    <img src="./images/<?php echo $row['image'];?>" alt="">
                </div>   
                <div class="form-group">
                    <label for="addFile">Image</label>
                    <input type="file" class="form-control-file" id="addFile" name="image">
                </div>         
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <input type="text" class="form-control" id="tags"  name="tag" value="<?php echo join(',',$t);?>">
                </div>       
                <button type="submit" class="btn btn-primary mb-2">Update article</button>
            </form>
        </div>
    </div>
</div>


