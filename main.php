<?php 
require_once('template/header.php');
$data = select_main($conn);
$countPage = pagination_count($conn);
$tag = get_all_tags($conn);
close($conn);
?>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Fluid jumbotron</h1>
    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
  </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-9">
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

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <nav class="mt-5">
                <ul class="pagination">
                    <?php
                        for ($i = 0; $i < $countPage; $i++) {
                            $j = $i + 1;
                            echo "<li class='page-item'><a class='page-link' href='./index.php?page={$i}'>{$j}</a></li>";
                        }
                    ?>
                </ul>
            </nav>
        </div>
        <div class="col-lg-12 text-center">            
            <?php
                for ($i = 0; $i < count($tag); $i++) {
                    echo "<a class='badge badge-info m-1 p-2' href='./tag.php?tag={$tag[$i]}' style='padding: 5px;'>{$tag[$i]}</a>";
                }
            ?>
        </div>
    </div>
</div>


<?php
require_once('template/footer.php');
?>