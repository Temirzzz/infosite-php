<?php
require_once('template/header.php');
$data = get_post_from_tags ($conn);
$tag = get_all_tags($conn);
close($conn);
?>





<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">   
                    <?php 
                        $out = '';
                        for ($i = 0; $i < count($data); $i++) {
                            $out .= "<img src='./images/{$data[$i]['image']}' class='mt-5'>";
                            $out .= "<h2 class='mt-5'>{$data[$i]['title']}</h2>";
                            $out .= "<p class='mt-3'>{$data[$i]['descr_min']}</p>";
                            $out .= '<p><a class="btn btn-primary mt-4" href="./article.php?id='.$data[$i]['id'].'">Читать дальше</a></p>';
                            $out .= '<hr class="mt-5">';
                        }
                        echo $out;
                    ?>
                    </div>
                </div>
                <div class="col-lg-12"> 
                    <?php
                        for ($i = 0; $i < count($tag); $i++) {
                        echo "<span><a href='./tag.php?tag={$tag[$i]}' class='badge badge-info m-1 p-2'  style='padding: 5px;'>{$tag[$i]}</a></span>";
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