<?php
require_once './views/common/headerPosts.php';
?>

<div class="bg-light">
    <div class="container py-4">
        <?php $datas = array_reverse($datas);
        foreach ($datas as $ligne) :
            $date = date("d.m.Y", strtotime($ligne['update_date']));
            ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title"><?= Security::escapeOutput($ligne['title'], (ENT_QUOTES | ENT_HTML5), 'UTF-8') ?></h2>
                    <p class="card-text"><?= Security::escapeOutput($ligne['summary'], (ENT_QUOTES | ENT_HTML5), 'UTF-8') ?></p>
                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <p>Par <?= Security::escapeOutput($ligne['username'], (ENT_QUOTES | ENT_HTML5), 'UTF-8') ?> le <?= Security::escapeOutput($date) ?></p>
                        <a href="article&amp;id=<?= Security::escapeOutput($ligne['id_post'], (ENT_QUOTES | ENT_HTML5), 'UTF-8') ?>" class="btn btn-secondary stretched-link rounded">Lire l'article</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>