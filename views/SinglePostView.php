<?php
require_once('./views/common/headerSinglePost.php');
?>

<div class="bg-light">
    <div class="container my-4 px-2">
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="card-title text-center"><?= $datas[0]['title'] ?></h2>
                <div class="d-flex align-items-center justify-content-center">
                    <p>Par <?= $datas[0]['username'] ?> le <?= $datas[0]['creation_date'] ?></p>
                </div>
                <p class="card-text h4"><?= $datas[0]['summary'] ?></p>
                <p class="card-text"><?= $datas[0]['content'] ?></p>
            </div>
        </div>
    </div>
</div>