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
                    <?php 
                        $out = '';
                        for ($i = 0; $i < count($data); $i++) {
                            $out .= "<div class='col-lg-4 col-md-6 col-sm-12 mt-5'>";
                            $out .= "<div class='card mt-5'>";
                            $out .= "<img src='./images/{$data[$i]['image']}' class='card-img-top'>";
                            $out .= "<div class='card-body'>";
                            $out .= "<h2 class='card-title'>{$data[$i]['title']}</h2>";
                            $out .= "<p class='card-text'>{$data[$i]['descr_min']}</p>";
                            $out .= '<p class="text-right"><a class="btn btn-primary mt-4" href="./article.php?id='.$data[$i]['id'].'">Читать дальше</a></p>';
                            $out .= "</div>";
                            $out .= "</div>";
                            $out .= "</div>";
                        }
                        echo $out;
                    ?>         
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center"> 
                        <?php
                            for ($i = 0; $i < count($tag); $i++) {
                            echo "<span><a href='./tag.php?tag={$tag[$i]}' class='badge badge-info m-1 p-2 mt-5'  style='padding: 5px;'>{$tag[$i]}</a></span>";
                            }
                        ?>
                    </div>
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