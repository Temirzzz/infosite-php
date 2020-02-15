<?php
require_once('template/header.php');
$data = select_article($conn);
$tag = get_article_tags($conn);
close($conn);
?>

<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">    
                    <?php            
                    $out = '';
                    $out .="<h1 class='text-center mt-5'>{$data['title']}</h1>";
                    $out .="<img src='./images/{$data['image']}' class='img-fluid rounded mx-auto d-block mt-5 mb-5'>";
                    $out .="<div>{$data['description']}</div>";
                    echo $out;
                    ?>
                </div>
            </div>
            <div class="col-lg-12"> 
                <?php
                    echo '<hr>';
                    for ($i=0; $i < count($tag); $i++){
                    echo "<a href='./tag.php?tag={$tag[$i]['tag']}' class='badge badge-info m-1 p-2' style='padding: 5px;'>{$tag[$i]['tag']}</a>";
                    }
                ?>
            </div>
        </div>
        <div class="col-lg-3">
            <?php require_once('template/nav.php') ?>
        </div>
        </div>
    </div>
</div>  

<?php
require_once('template/footer.php');
?>