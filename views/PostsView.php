<?php
require_once('./views/common/headerPosts.php');
?>

<div class="bg-light">
    <div class="container my-4">
        <?php foreach ($datas as $ligne) : ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title"><?= $ligne['title'] ?></h2>
                    <p class="card-text"><?= $ligne['summary'] ?></p>
                    <div class="d-flex align-items-center justify-content-between">
                        <p>Par <?= $ligne['username'] ?> le <?= $ligne['creation_date'] ?></p>
                        <a href="#" class="btn btn-secondary stretched-link rounded">Lire l'article</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>