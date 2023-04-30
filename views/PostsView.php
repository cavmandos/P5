<?php
require_once('./views/common/headerPosts.php');
?>

<div class="bg-light">
    <div class="container py-4">
        <?php $datas = array_reverse($datas);
        foreach ($datas as $ligne) : ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title"><?= htmlentities($ligne['title']) ?></h2>
                    <p class="card-text"><?= htmlentities($ligne['summary']) ?></p>
                    <div class="d-flex align-items-center justify-content-between">
                        <p>Par <?= htmlentities($ligne['username']) ?> le <?= htmlentities($ligne['creation_date']) ?></p>
                        <a href="article&amp;id=<?= htmlentities($ligne['id_post']) ?>" class="btn btn-secondary stretched-link rounded">Lire l'article</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>