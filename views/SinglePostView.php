<?php
require_once('./views/common/headerSinglePost.php');
?>

<div class="bg-light">
    <div class="container my-4 px-2">
        <?php for($i=0; $i<1; $i++) : ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title text-center"><?= $datas[$i]['title'] ?></h2>
                    <div class="d-flex align-items-center justify-content-center">
                        <p>Par <?= $datas[$i]['username'] ?> le <?= $datas[$i]['creation_date'] ?></p>
                    </div>
                    <p class="card-text h4"><?= $datas[$i]['summary'] ?></p>
                    <p class="card-text"><?= $datas[$i]['content'] ?></p>
                </div>
            </div>
        <?php endfor; ?>

    </div>
</div>