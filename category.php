<?php
require_once('template/header.php');
$data = get_post_from_category($conn);
$catList = get_cat_info($conn);
close($conn);
?>

<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                        echo "<h1 class='text-center'>{$catList['category']}</h1>";
                    ?>
                </div>         
                <div class="col-lg-12">
                    <?php                   
                        echo "<div class='text-center mt-3 mb-3'>{$catList['description']}</div>";
                    ?>
                </div>         
            </div>
            <div class="row">
                <?php                 
                $out = '';

                for ($i = 0; $i < count($data); $i++) {
                    $out .= "<div class='col-lg-4 col-md-6 col-sm-12'>";
                    $out .= "<div class='card'>";
                    $out .= "<img src='./images/{$data[$i]['image']}' class='card-img-top' alt='Card image cap'>";
                    $out .= "<div class='card-body'>";
                    $out .= "<h5 class='card-title'>{$data[$i]['title']}</h5>";
                    $out .= "<p class='card-text'>{$data[$i]['descr_min']}</p>";
                    $out .= '<p class="text-right"><a class="btn btn-primary" href="./article.php?id='.$data[$i]['id'].'">Читать дальше</a></p>';
                    $out .= "</div>";
                    $out .= "</div>";
                    $out .= "</div>";
                }
                echo $out;
                ?>
            </div>
        </div>
        <div class="col-lg-3">
            <?php require_once('template/nav.php') ?>
        </div>
    </div>
</div>

<?php
require_once('template/footer.php');
?>