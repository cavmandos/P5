<?php
require_once('./views/common/headerPosts.php');
?>

<div class="bg-light">
    <div class="container py-4">
        <?php $datas = array_reverse($datas);
        foreach ($datas as $ligne) : ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title"><?= htmlspecialchars($ligne['title']) ?></h2>
                    <p class="card-text"><?= htmlspecialchars($ligne['summary']) ?></p>
                    <div class="d-flex align-items-center justify-content-between">
                        <p>Par <?= htmlspecialchars($ligne['username']) ?> le <?= htmlspecialchars($ligne['creation_date']) ?></p>
                        <a href="article&amp;id=<?= htmlspecialchars($ligne['id_post']) ?>" class="btn btn-secondary stretched-link rounded">Lire l'article</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>