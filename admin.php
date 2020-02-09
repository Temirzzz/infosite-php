<?php
require_once('template/header.php');
$data = select($conn);
close($conn);

?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php
                echo "$flash";

                echo '<div class="mt-5 mb-3 text-center"><h2>Админка</h2></div>';
                echo '<div class="mt-3 mb-3 text-right"><a href="./admin_create.php"><button class="btn btn-success">Добавить запись</button></a></div>';
                $out = '<table class="table table-striped">';
                $out .= '<tr><th>Id</th><th>Title</th><th>Descr_min</th><th>Image</th><th>Update</th><th>Action</th></tr>';
                for ($i = 0; $i < count($data); $i++) {
                    $out .= "<tr><td>{$data[$i]['id']}</td><td>{$data[$i]['title']}</td><td>{$data[$i]['descr_min']}</td><td><img src='./images/{$data[$i]['image']}' width='60'></td>";
                    $out .= "<td><a href='./admin_update.php?id={$data[$i]['id']}' class='btn btn-info'>Update</a></td>";
                    $out .= "<td><button class='btn btn-info check-delete' data='{$data[$i]['id']}'>x</button></td></tr>";
                }
                $out .= '</table>';

                echo "$out";
            ?>
        </div>
    </div>
</div>
<script>
    window.onload = function(){
        let checkDelete = document.querySelectorAll('.check-delete');
        checkDelete.forEach((element) => {
            element.onclick = deleteArt;           
        })
        function deleteArt (event) {
            event.preventDefault();
            let intBtn = confirm ('Удалить статью?');
            if (intBtn == true ) {
                location.href = './admin_delete.php?id='+this.getAttribute('data');
            }
            else {
                return false;
            }
        }
    }
</script>
